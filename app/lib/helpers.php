<?php
declare(strict_types=1);

/** Escape for HTML output. */
function e(mixed $v): string
{
    return htmlspecialchars((string)($v ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Absolute path under the site's base path. */
function url(string $path = '/'): string
{
    $base = rtrim((string)(APP_CONFIG['base_path'] ?? ''), '/');
    return $base . '/' . ltrim($path, '/');
}

/** Address of an image setting: an https:// URL, a site path, or a file under assets/img/. */
function image_url(string $v): string
{
    if ($v === '' || preg_match('#^https?://#i', $v)) {
        return $v;
    }
    return $v[0] === '/' ? url($v) : asset('img/' . $v);
}

function asset(string $path): string
{
    $file = PUBLIC_DIR . '/assets/' . ltrim($path, '/');
    $v = is_file($file) ? (string)filemtime($file) : '1';
    return url('assets/' . ltrim($path, '/')) . '?v=' . $v;
}

function full_url(string $path = '/'): string
{
    return rtrim((string)setting('site_url', 'https://www.cybercraft.biz'), '/') . url($path);
}

function redirect(string $path, int $code = 303): never
{
    header('Location: ' . (str_starts_with($path, 'http') ? $path : url($path)), true, $code);
    exit;
}

function now(): string
{
    return date('Y-m-d H:i:s');
}

function client_ip(): string
{
    return substr((string)($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0'), 0, 45);
}

function is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function post(string $key, string $default = ''): string
{
    $v = $_POST[$key] ?? $default;
    return is_string($v) ? trim($v) : $default;
}

function slugify(string $s): string
{
    $s = strtolower(trim($s));
    $s = preg_replace('/[^a-z0-9]+/', '-', $s) ?? '';
    return trim($s, '-') ?: 'item';
}

/** Split a one-item-per-line text field into an array. */
function lines(?string $text): array
{
    if ($text === null || trim($text) === '') {
        return [];
    }
    return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $text) ?: []), fn($l) => $l !== ''));
}

/* ---------- sessions, flash, CSRF ---------- */

function start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
    session_name('cc_sess');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => url('/'),
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function flash(string $type, string $msg): void
{
    start_session();
    $_SESSION['flash'][] = ['type' => $type, 'msg' => $msg];
}

function take_flash(): array
{
    start_session();
    $f = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $f;
}

function csrf_token(): string
{
    start_session();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

function csrf_check(): bool
{
    start_session();
    $t = $_POST['_csrf'] ?? '';
    return is_string($t) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $t);
}

/* ---------- content helpers ---------- */

function settings_all(): array
{
    static $cache = null;
    if ($cache === null) {
        $cache = [];
        foreach (Db::all('SELECT k, v FROM settings') as $r) {
            $cache[$r['k']] = $r['v'];
        }
    }
    return $cache;
}

function setting(string $key, string $default = ''): string
{
    if (!defined('APP_INSTALLED') || !APP_INSTALLED) {
        return $default;
    }
    $all = settings_all();
    return isset($all[$key]) && $all[$key] !== '' ? (string)$all[$key] : $default;
}

function block(string $key, string $default = ''): string
{
    static $cache = null;
    if ($cache === null) {
        $cache = [];
        foreach (Db::all('SELECT k, v FROM blocks') as $r) {
            $cache[$r['k']] = $r['v'];
        }
    }
    return isset($cache[$key]) && $cache[$key] !== '' ? (string)$cache[$key] : $default;
}

/** Render a price line: "from $49/mo" or "Let's talk". */
function price_html(array $row): string
{
    $amount = trim((string)($row['price_amount'] ?? ''));
    if ($amount === '') {
        return '<b>Let\'s talk</b>';
    }
    $from = !empty($row['price_from']) ? '<span class="price-from">from</span> ' : '';
    $unit = trim((string)($row['price_unit'] ?? ''));
    return $from . '<b>' . e($amount) . '</b>' . ($unit !== '' ? '<span class="price-unit">' . e($unit) . '</span>' : '');
}

/**
 * Minimal, safe Markdown: paragraphs, ## / ### headings, "- " lists,
 * **bold**, *italic* and [links](https://...). Everything else is escaped.
 */
function md(?string $text): string
{
    if ($text === null || trim($text) === '') {
        return '';
    }
    $inline = function (string $s): string {
        $s = e($s);
        $s = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $s) ?? $s;
        $s = preg_replace('/(?<!\*)\*(?!\*)(.+?)\*/', '<em>$1</em>', $s) ?? $s;
        $s = preg_replace_callback('/\[([^\]]+)\]\(((?:https?:\/\/|mailto:|\/)[^\s)]+)\)/', function ($m) {
            $href = html_entity_decode($m[2], ENT_QUOTES);
            $ext = str_starts_with($href, 'http') ? ' target="_blank" rel="noopener"' : '';
            return '<a href="' . e($href) . '"' . $ext . '>' . $m[1] . '</a>';
        }, $s) ?? $s;
        return $s;
    };
    $out = [];
    $para = [];
    $list = [];
    $flushPara = function () use (&$para, &$out, $inline) {
        if ($para) {
            $out[] = '<p>' . $inline(implode(' ', $para)) . '</p>';
            $para = [];
        }
    };
    $flushList = function () use (&$list, &$out, $inline) {
        if ($list) {
            $out[] = '<ul>' . implode('', array_map(fn($i) => '<li>' . $inline($i) . '</li>', $list)) . '</ul>';
            $list = [];
        }
    };
    foreach (preg_split('/\r\n|\r|\n/', $text) ?: [] as $line) {
        $t = trim($line);
        if ($t === '') {
            $flushPara();
            $flushList();
        } elseif (str_starts_with($t, '### ')) {
            $flushPara(); $flushList();
            $out[] = '<h3>' . $inline(substr($t, 4)) . '</h3>';
        } elseif (str_starts_with($t, '## ')) {
            $flushPara(); $flushList();
            $out[] = '<h2>' . $inline(substr($t, 3)) . '</h2>';
        } elseif (str_starts_with($t, '- ') || str_starts_with($t, '* ')) {
            $flushPara();
            $list[] = substr($t, 2);
        } else {
            $flushList();
            $para[] = $t;
        }
    }
    $flushPara();
    $flushList();
    return implode("\n", $out);
}

/* ---------- views ---------- */

function view(string $name, array $data = []): string
{
    extract($data, EXTR_SKIP);
    ob_start();
    require APP_DIR . '/views/' . $name . '.php';
    return (string)ob_get_clean();
}

function render(string $layout, string $name, array $data = []): never
{
    $data['content'] = view($name, $data);
    echo view('layouts/' . $layout, $data);
    exit;
}

function not_found(): never
{
    http_response_code(404);
    render('site', 'site/404', ['title' => 'Page not found']);
}

function log_activity(string $action, string $details = ''): void
{
    $u = Auth::user();
    try {
        Db::insert('activity', [
            'user_id' => $u['id'] ?? null,
            'user_name' => $u['name'] ?? null,
            'action' => $action,
            'details' => mb_substr($details, 0, 255),
            'created_at' => now(),
        ]);
    } catch (Throwable) {
        // activity logging must never break a request
    }
}
