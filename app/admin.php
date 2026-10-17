<?php
declare(strict_types=1);

/** Settings shown on the dashboard's Settings screen, grouped. [key, label, type, help] */
function settings_schema(): array
{
    return [
        'General' => [
            ['site_name', 'Site name', 'text', ''],
            ['legal_name', 'Legal name', 'text', 'Shown in the footer copyright line.'],
            ['site_url', 'Site address', 'url', 'Used for links in the sitemap and emails.'],
            ['tagline', 'Tagline', 'text', 'Shown in the browser tab on the homepage and under the logo.'],
            ['meta_description', 'Search engine description', 'textarea', 'About 150–160 characters, shown by Google under your site name.'],
            ['footer_text', 'Footer text', 'textarea', ''],
            ['announcement', 'Announcement bar', 'text', 'Shown at the top of every page. Leave empty to hide.'],
            ['stats', 'Numbers band', 'lines', 'One per line: number | label. Shown under the homepage hero.'],
            ['show_sample_badges', 'Mark sample clients and case studies with a "Sample" badge', 'checkbox', 'Keep on until all placeholders are replaced with real clients.'],
            ['animations', 'Enable animations', 'checkbox', 'Turn off to show the site without motion.'],
        ],
        'Email addresses' => [
            ['email_info', 'General enquiries', 'email', ''],
            ['email_sales', 'Sales & quotations', 'email', ''],
            ['email_msp', 'Managed services', 'email', ''],
            ['email_support', 'Service desk (clients)', 'email', ''],
            ['email_noc', 'NOC alerts', 'email', ''],
            ['email_audit', 'Compliance & audit', 'email', ''],
            ['email_security', 'Report a security incident', 'email', ''],
            ['email_horizons', 'Innovation team (solar, automation, AI)', 'email', ''],
            ['email_partners', 'Partnerships & JV', 'email', ''],
            ['email_careers', 'Careers', 'email', ''],
            ['email_accounts', 'Accounts & billing', 'email', ''],
            ['email_ceo', 'Office of the CEO', 'email', ''],
            ['phone', 'Main phone (optional)', 'text', ''],
            ['whatsapp', 'WhatsApp number (optional)', 'text', 'International format, e.g. +923001234567. Leave empty to hide.'],
        ],
        'Contact-form notifications' => [
            ['notify_enabled', 'Email new contact-form messages', 'checkbox', ''],
            ['notify_route', 'Send each message to the matching team mailbox', 'checkbox', 'e.g. Compliance & audit enquiries go to the Compliance & audit address above.'],
            ['notify_email', 'Also send a copy to', 'email', 'Leave empty to send only to the team mailbox.'],
        ],
        'Links & buttons' => [
            ['client_login_url', 'Client login address', 'url', 'Leave empty to show the Client login button as "coming soon" (disabled).'],
            ['b2cloud_url', 'b2cloud.io website', 'url', ''],
            ['social_linkedin', 'LinkedIn', 'url', 'Leave a social link empty to show its icon as disabled.'],
            ['social_x', 'X (Twitter)', 'url', ''],
            ['social_facebook', 'Facebook', 'url', ''],
            ['social_instagram', 'Instagram', 'url', ''],
            ['social_youtube', 'YouTube', 'url', ''],
        ],
    ];
}

/** Public page for a dashboard row, or '' when it has none. */
function admin_public_url(string $key, array $r): string
{
    if (isset($r['is_active']) && !$r['is_active']) {
        return '';
    }
    return match ($key) {
        'services' => url('services/' . ($r['slug'] ?? '')),
        'practices' => url('what-we-do/' . ($r['slug'] ?? '')),
        'industries' => url('industries/' . ($r['slug'] ?? '')),
        'products' => url('products#' . ($r['slug'] ?? '')),
        'clients', 'cases' => url('clients'),
        'standards' => url('what-we-do/compliance-audit#standards'),
        default => '',
    };
}

function admin_render(string $view, array $data = []): never
{
    $data['user'] = Auth::user();
    $data['newCount'] = (int)Db::value("SELECT COUNT(*) FROM messages WHERE status = 'new'");
    render('admin', 'admin/' . $view, $data);
}

function require_csrf(): void
{
    if (!csrf_check()) {
        flash('error', 'Your session expired. Please try again.');
        redirect((string)($_SERVER['REQUEST_URI'] ?? '/admin'));
    }
}

function admin_dispatch(string $sub): void
{
    header('X-Robots-Tag: noindex, nofollow');
    header('Cache-Control: no-store');

    if ($sub === 'login') {
        admin_login();
    }
    if ($sub === 'logout' && is_post()) {
        require_csrf();
        log_activity('Signed out');
        Auth::logout();
        redirect('/admin/login');
    }

    $user = Auth::require();

    switch (true) {
        case $sub === '':
            admin_render('dashboard', [
                'title' => 'Dashboard',
                'stats' => [
                    'new' => (int)Db::value("SELECT COUNT(*) FROM messages WHERE status = 'new'"),
                    'messages' => (int)Db::value('SELECT COUNT(*) FROM messages'),
                    'services' => (int)Db::value('SELECT COUNT(*) FROM services WHERE is_active = 1'),
                    'samples' => (int)Db::value('SELECT COUNT(*) FROM clients WHERE is_sample = 1 AND is_active = 1') + (int)Db::value('SELECT COUNT(*) FROM case_studies WHERE is_sample = 1 AND is_active = 1'),
                ],
                'recent' => Db::all('SELECT * FROM messages ORDER BY created_at DESC LIMIT 6'),
                'activity' => Db::all('SELECT * FROM activity ORDER BY created_at DESC LIMIT 8'),
                'week' => Db::all("SELECT DATE(created_at) d, COUNT(*) n FROM messages WHERE created_at >= ? GROUP BY DATE(created_at)", [date('Y-m-d', strtotime('-13 days'))]),
            ]);

        case $sub === 'messages':
            $status = in_array($_GET['status'] ?? '', ['new', 'read', 'archived'], true) ? $_GET['status'] : '';
            $q = trim((string)($_GET['q'] ?? ''));
            $where = [];
            $params = [];
            if ($status) { $where[] = 'status = ?'; $params[] = $status; }
            if ($q !== '') { $where[] = '(name LIKE ? OR email LIKE ? OR company LIKE ? OR body LIKE ? OR service LIKE ? OR country LIKE ?)'; $like = '%' . $q . '%'; array_push($params, $like, $like, $like, $like, $like, $like); }
            $page = max(1, (int)($_GET['p'] ?? 1));
            $sqlWhere = $where ? 'WHERE ' . implode(' AND ', $where) : '';
            $total = (int)Db::value("SELECT COUNT(*) FROM messages $sqlWhere", $params);
            $rows = Db::all("SELECT * FROM messages $sqlWhere ORDER BY created_at DESC LIMIT 25 OFFSET " . (($page - 1) * 25), $params);
            admin_render('messages', ['title' => 'Messages', 'rows' => $rows, 'status' => $status, 'q' => $q, 'page' => $page, 'pages' => max(1, (int)ceil($total / 25)), 'total' => $total]);

        case $sub === 'messages/export':
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="cybercraft-messages-' . date('Y-m-d') . '.csv"');
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Date', 'Name', 'Email', 'Company', 'Phone', 'Country', 'Interested in', 'Routed to', 'Status', 'Message']);
            foreach (Db::all('SELECT * FROM messages ORDER BY created_at DESC') as $m) {
                $row = [$m['created_at'], $m['name'], $m['email'], $m['company'], $m['phone'], $m['country'], $m['service'], $m['route_to'], $m['status'], $m['body']];
                // Prevent spreadsheet formula injection
                fputcsv($out, array_map(fn($v) => preg_match('/^[=+\-@]/', (string)$v) ? "'" . $v : $v, $row));
            }
            log_activity('Exported messages');
            exit;

        case (bool)preg_match('#^messages/(\d+)$#', $sub, $m):
            $msg = Db::one('SELECT * FROM messages WHERE id = ?', [(int)$m[1]]) ?? not_found();
            if (is_post()) {
                require_csrf();
                $action = post('action');
                if ($action === 'delete') {
                    Db::exec('DELETE FROM messages WHERE id = ?', [$msg['id']]);
                    log_activity('Deleted message', $msg['name']);
                    flash('success', 'Message deleted.');
                    redirect('/admin/messages');
                }
                if (in_array($action, ['new', 'read', 'archived'], true)) {
                    Db::exec('UPDATE messages SET status = ? WHERE id = ?', [$action, $msg['id']]);
                    flash('success', 'Message marked as ' . $action . '.');
                    redirect('/admin/messages/' . $msg['id']);
                }
            }
            if ($msg['status'] === 'new') {
                Db::exec("UPDATE messages SET status = 'read' WHERE id = ?", [$msg['id']]);
                $msg['status'] = 'read';
            }
            admin_render('message', ['title' => 'Message from ' . $msg['name'], 'msg' => $msg]);

        case $sub === 'pages':
            $pages = array_unique(array_column(Db::all('SELECT page FROM blocks ORDER BY sort'), 'page'));
            $current = in_array($_GET['page'] ?? '', $pages, true) ? $_GET['page'] : ($pages[0] ?? 'Home');
            if (is_post()) {
                require_csrf();
                foreach (Db::all('SELECT k FROM blocks WHERE page = ?', [$current]) as $b) {
                    if (array_key_exists('b_' . $b['k'], $_POST)) {
                        Db::exec('UPDATE blocks SET v = ? WHERE k = ?', [mb_substr(post('b_' . $b['k']), 0, 60000), $b['k']]);
                    }
                }
                log_activity('Edited page text', $current);
                flash('success', $current . ' text saved. Changes are live.');
                redirect('/admin/pages?page=' . rawurlencode($current));
            }
            admin_render('pages', ['title' => 'Page text', 'pages' => $pages, 'current' => $current, 'blocks' => Db::all('SELECT * FROM blocks WHERE page = ? ORDER BY sort', [$current])]);

        case $sub === 'settings':
            Auth::require('admin');
            $schema = settings_schema();
            if (is_post()) {
                require_csrf();
                $errors = [];
                foreach ($schema as $group) {
                    foreach ($group as [$k, $label, $type]) {
                        $v = $type === 'checkbox' ? (isset($_POST[$k]) ? '1' : '0') : post($k);
                        if ($type === 'url' && $v !== '' && !preg_match('#^https?://#i', $v)) $errors[] = "$label must start with https://";
                        if ($type === 'email' && $v !== '' && !filter_var($v, FILTER_VALIDATE_EMAIL)) $errors[] = "$label is not a valid email.";
                        if (!$errors) Db::exec('INSERT INTO settings (k, v) VALUES (?, ?) ON DUPLICATE KEY UPDATE v = VALUES(v)', [$k, mb_substr($v, 0, 5000)]);
                    }
                }
                if ($errors) {
                    flash('error', implode(' ', $errors));
                } else {
                    log_activity('Updated settings');
                    flash('success', 'Settings saved.');
                }
                redirect('/admin/settings');
            }
            admin_render('settings', ['title' => 'Settings', 'schema' => $schema, 'values' => settings_all()]);

        case (bool)preg_match('#^c/([a-z]+)(?:/(new|\d+))?(?:/(delete))?$#', $sub, $m):
            admin_collection($m[1], $m[2] ?? '', $m[3] ?? '');

        case $sub === 'users':
            Auth::require('admin');
            if (is_post()) {
                require_csrf();
                $action = post('action');
                if ($action === 'create') {
                    $name = post('name'); $email = strtolower(post('email')); $pw = (string)($_POST['password'] ?? ''); $role = post('role') === 'admin' ? 'admin' : 'editor';
                    if (mb_strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pw) < 10) {
                        flash('error', 'Enter a name, a valid email and a password of at least 10 characters.');
                    } elseif (Db::value('SELECT id FROM users WHERE email = ?', [$email])) {
                        flash('error', 'A user with that email already exists.');
                    } else {
                        Db::insert('users', ['name' => $name, 'email' => $email, 'password_hash' => password_hash($pw, PASSWORD_DEFAULT), 'role' => $role, 'created_at' => now()]);
                        log_activity('Added user', $email);
                        flash('success', "User $email added.");
                    }
                } elseif ($action === 'delete') {
                    $id = (int)post('id');
                    if ($id === (int)$user['id']) {
                        flash('error', 'You cannot delete your own account.');
                    } else {
                        $email = (string)Db::value('SELECT email FROM users WHERE id = ?', [$id]);
                        Db::exec('DELETE FROM users WHERE id = ?', [$id]);
                        log_activity('Removed user', $email);
                        flash('success', 'User removed.');
                    }
                }
                redirect('/admin/users');
            }
            admin_render('users', ['title' => 'Users', 'rows' => Db::all('SELECT id, name, email, role, created_at, last_login_at FROM users ORDER BY name')]);

        case $sub === 'account':
            if (is_post()) {
                require_csrf();
                $full = Db::one('SELECT * FROM users WHERE id = ?', [$user['id']]);
                $name = post('name');
                $cur = (string)($_POST['current_password'] ?? '');
                $new = (string)($_POST['new_password'] ?? '');
                if (mb_strlen($name) >= 2) {
                    Db::exec('UPDATE users SET name = ? WHERE id = ?', [$name, $user['id']]);
                }
                if ($new !== '') {
                    if (!password_verify($cur, $full['password_hash'])) {
                        flash('error', 'Your current password is incorrect.');
                        redirect('/admin/account');
                    }
                    if (strlen($new) < 10 || $new !== (string)($_POST['new_password2'] ?? '')) {
                        flash('error', 'New passwords must match and be at least 10 characters.');
                        redirect('/admin/account');
                    }
                    Db::exec('UPDATE users SET password_hash = ? WHERE id = ?', [password_hash($new, PASSWORD_DEFAULT), $user['id']]);
                    log_activity('Changed password');
                }
                flash('success', 'Account updated.');
                redirect('/admin/account');
            }
            admin_render('account', ['title' => 'My account']);

        case $sub === 'activity':
            admin_render('activity', ['title' => 'Activity log', 'rows' => Db::all('SELECT * FROM activity ORDER BY created_at DESC LIMIT 200')]);
    }

    not_found();
}

function admin_login(): never
{
    if (Auth::user()) {
        redirect('/admin');
    }
    $error = '';
    if (is_post()) {
        if (!csrf_check()) {
            $error = 'Your session expired. Please try again.';
        } elseif (Auth::tooManyAttempts()) {
            $error = 'Too many failed attempts. Please wait 15 minutes and try again.';
        } elseif (Auth::attempt(post('email'), (string)($_POST['password'] ?? ''))) {
            $next = (string)($_GET['next'] ?? '');
            redirect(preg_match('#^/[^/\\\\]#', $next) || $next === '/admin' ? $next : '/admin');
        } else {
            $error = 'Incorrect email or password.';
        }
    }
    header('Cache-Control: no-store');
    echo view('admin/login', ['error' => $error, 'installed' => isset($_GET['installed'])]);
    exit;
}

function admin_collection(string $key, string $idPart, string $action): never
{
    $def = Collections::get($key) ?? not_found();
    $fields = Collections::fields($def);
    $table = $def['table'];

    if ($idPart === '') {
        $rows = Db::all("SELECT * FROM `$table` ORDER BY {$def['order']}");
        $lookups = [];
        foreach ($fields as $f) {
            if ($f['type'] === 'select') $lookups[$f['name']] = $f['options'];
        }
        admin_render('collection', ['title' => $def['title'], 'key' => $key, 'def' => $def, 'rows' => $rows, 'lookups' => $lookups]);
    }

    $id = $idPart === 'new' ? null : (int)$idPart;
    $row = $id ? (Db::one("SELECT * FROM `$table` WHERE id = ?", [$id]) ?? not_found()) : [];

    if ($action === 'delete') {
        if (!is_post()) not_found();
        require_csrf();
        Db::exec("DELETE FROM `$table` WHERE id = ?", [$id]);
        $label = $row['name'] ?? $row['title'] ?? $row['question'] ?? $row['country'] ?? $row['region'] ?? '#' . $id;
        log_activity('Deleted ' . $def['singular'], (string)$label);
        flash('success', ucfirst($def['singular']) . ' deleted.');
        redirect('/admin/c/' . $key);
    }

    $errors = [];
    if (is_post()) {
        require_csrf();
        [$data, $errors] = Collections::fromPost($def, $id);
        if (!$errors) {
            if ($id) {
                Db::update($table, $data, $id);
            } else {
                if (in_array('sort', array_column($fields, 'name'), true) && empty($data['sort'])) {
                    $data['sort'] = (int)Db::value("SELECT COALESCE(MAX(sort), 0) + 10 FROM `$table`");
                }
                $id = Db::insert($table, $data);
            }
            $label = $data['name'] ?? $data['title'] ?? $data['question'] ?? $data['country'] ?? $data['region'] ?? '';
            log_activity(($idPart === 'new' ? 'Added ' : 'Edited ') . $def['singular'], (string)$label);
            flash('success', ucfirst($def['singular']) . ' saved. Changes are live.');
            redirect('/admin/c/' . $key . '/' . $id);
        }
        $row = array_merge($row, $data);
    } elseif (!$id) {
        foreach ($fields as $f) {
            if ($f['type'] === 'checkbox') $row[$f['name']] = 1;
        }
    }

    admin_render('edit', [
        'title' => ($id ? 'Edit ' : 'Add ') . $def['singular'],
        'key' => $key, 'def' => $def, 'fields' => $fields, 'row' => $row, 'id' => $id, 'errors' => $errors,
    ]);
}
