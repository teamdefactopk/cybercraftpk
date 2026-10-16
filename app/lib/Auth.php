<?php
declare(strict_types=1);

final class Auth
{
    private const MAX_ATTEMPTS = 5;
    private const WINDOW_MINUTES = 15;
    private const IDLE_SECONDS = 7200;

    private static ?array $user = null;

    public static function user(): ?array
    {
        if (self::$user !== null) {
            return self::$user;
        }
        start_session();
        $id = $_SESSION['uid'] ?? null;
        if (!$id) {
            return null;
        }
        if (time() - (int)($_SESSION['last_seen'] ?? 0) > self::IDLE_SECONDS) {
            self::logout();
            return null;
        }
        $_SESSION['last_seen'] = time();
        self::$user = Db::one('SELECT id, name, email, role FROM users WHERE id = ?', [$id]);
        return self::$user;
    }

    public static function isAdmin(): bool
    {
        return (self::user()['role'] ?? '') === 'admin';
    }

    public static function require(?string $role = null): array
    {
        $u = self::user();
        if (!$u) {
            redirect('/admin/login?next=' . rawurlencode('/' . current_path()));
        }
        if ($role === 'admin' && $u['role'] !== 'admin') {
            flash('error', 'Only administrators can open that page.');
            redirect('/admin');
        }
        return $u;
    }

    public static function tooManyAttempts(): bool
    {
        $n = (int)Db::value(
            'SELECT COUNT(*) FROM login_attempts WHERE ip = ? AND created_at > ?',
            [client_ip(), date('Y-m-d H:i:s', time() - self::WINDOW_MINUTES * 60)]
        );
        return $n >= self::MAX_ATTEMPTS;
    }

    public static function attempt(string $email, string $password): bool
    {
        $u = Db::one('SELECT * FROM users WHERE email = ?', [strtolower($email)]);
        if (!$u || !password_verify($password, $u['password_hash'])) {
            Db::insert('login_attempts', ['ip' => client_ip(), 'email' => mb_substr($email, 0, 190), 'created_at' => now()]);
            return false;
        }
        if (password_needs_rehash($u['password_hash'], PASSWORD_DEFAULT)) {
            Db::exec('UPDATE users SET password_hash = ? WHERE id = ?', [password_hash($password, PASSWORD_DEFAULT), $u['id']]);
        }
        start_session();
        session_regenerate_id(true);
        $_SESSION['uid'] = (int)$u['id'];
        $_SESSION['last_seen'] = time();
        unset($_SESSION['csrf']);
        Db::exec('UPDATE users SET last_login_at = ? WHERE id = ?', [now(), $u['id']]);
        Db::exec('DELETE FROM login_attempts WHERE ip = ?', [client_ip()]);
        self::$user = null;
        log_activity('Signed in');
        return true;
    }

    public static function logout(): void
    {
        start_session();
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 3600, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
        self::$user = null;
    }
}
