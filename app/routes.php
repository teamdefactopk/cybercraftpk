<?php
declare(strict_types=1);

function current_path(): string
{
    $path = parse_url((string)($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
    $base = rtrim((string)(APP_CONFIG['base_path'] ?? ''), '/');
    if ($base !== '' && str_starts_with($path, $base)) {
        $path = substr($path, strlen($base));
    }
    return trim(rawurldecode($path), '/');
}

function dispatch(): void
{
    $path = defined('CC_FORCE_ROUTE') ? CC_FORCE_ROUTE : current_path();
    if ($path === 'install.php') {
        $path = 'install';
    }

    if (!APP_INSTALLED) {
        if ($path !== 'install') {
            redirect('/install.php');
        }
        require APP_DIR . '/install.php';
        run_installer();
        return;
    }

    if ($path === 'admin' || str_starts_with($path, 'admin/')) {
        require APP_DIR . '/admin.php';
        admin_dispatch(substr($path, 5) === false ? '' : trim(substr($path, 5), '/'));
        return;
    }

    site_dispatch($path);
}

/* ===================== Content queries ===================== */

/** All pillars with their visible services, in order. */
function practices_with_services(): array
{
    static $cache = null;
    if ($cache !== null) {
        return $cache;
    }
    $practices = Db::all('SELECT * FROM practices ORDER BY sort, id');
    $services = Db::all('SELECT * FROM services WHERE is_active = 1 ORDER BY sort, id');
    foreach ($practices as &$p) {
        $p['services'] = array_values(array_filter($services, fn($s) => (int)$s['practice_id'] === (int)$p['id']));
    }
    return $cache = $practices;
}

function core_pillars(): array
{
    return array_values(array_filter(practices_with_services(), fn($p) => (int)$p['is_core'] === 1));
}

function industries(): array
{
    return Db::all('SELECT * FROM industries WHERE is_active = 1 ORDER BY sort, id');
}

function products(): array
{
    return Db::all('SELECT * FROM products WHERE is_active = 1 ORDER BY sort, id');
}

function clients_list(): array
{
    return Db::all('SELECT * FROM clients WHERE is_active = 1 ORDER BY sort, id');
}

function case_studies(): array
{
    return Db::all('SELECT * FROM case_studies WHERE is_active = 1 ORDER BY sort, id');
}

function standards(): array
{
    return Db::all('SELECT * FROM standards ORDER BY sort, id');
}

function offices(): array
{
    return Db::all('SELECT * FROM offices ORDER BY sort, id');
}

/** Contact-form "I'm interested in" options => the setting holding the team mailbox. */
function contact_topics(): array
{
    $topics = [];
    foreach (practices_with_services() as $p) {
        $topics[$p['name']] = match ($p['accent']) {
            'msp' => 'email_msp', 'audit' => 'email_audit', 'horizons' => 'email_horizons', default => 'email_sales',
        };
    }
    return $topics + [
        'Products (CyberERP, b2cloud.io)' => 'email_sales',
        'Partnership / JV' => 'email_partners',
        'Careers' => 'email_careers',
        'Something else' => 'email_info',
    ];
}

/** Team mailbox for a contact-form topic or service name. */
function route_email(string $topic): string
{
    $topics = contact_topics();
    $key = $topics[$topic] ?? null;
    if ($key === null) {
        foreach (practices_with_services() as $p) {
            foreach ($p['services'] as $s) {
                if ($s['name'] === $topic) {
                    $key = $topics[$p['name']] ?? 'email_info';
                }
            }
        }
    }
    return setting($key ?? 'email_info', setting('email_info'));
}

/* ===================== Public site ===================== */

function site_dispatch(string $path): void
{
    $common = ['nav' => practices_with_services()];

    switch (true) {
        case $path === '':
            render('site', 'site/home', $common + [
                'title' => setting('tagline'),
                'industries' => industries(),
                'products' => products(),
                'clients' => clients_list(),
                'cases' => case_studies(),
                'standards' => standards(),
                'reasons' => Db::all('SELECT * FROM commitments ORDER BY sort, id'),
                'offices' => offices(),
            ]);

        case $path === 'what-we-do':
            render('site', 'site/pillars', $common + [
                'title' => 'What we do', 'description' => block('pillars_intro'),
                'steps' => Db::all('SELECT * FROM steps ORDER BY sort, id'),
            ]);

        case (bool)preg_match('#^what-we-do/([a-z0-9-]+)$#', $path, $m):
            $pillar = null;
            foreach ($common['nav'] as $p) {
                if ($p['slug'] === $m[1]) $pillar = $p;
            }
            if (!$pillar) {
                not_found();
            }
            render('site', 'site/pillar', $common + [
                'title' => $pillar['name'], 'description' => $pillar['summary'], 'pillar' => $pillar,
                'levels' => $pillar['accent'] === 'msp' ? Db::all('SELECT * FROM levels ORDER BY sort, id') : [],
                'standards' => $pillar['accent'] === 'audit' ? standards() : [],
                'cases' => array_values(array_filter(case_studies(), fn($c) => stripos((string)$c['pillar'], (string)$pillar['short_name']) !== false || stripos((string)$pillar['name'], (string)$c['pillar']) !== false)),
                'industries' => industries(),
            ]);

        case $path === 'managed-services':
            redirect('/what-we-do/managed-services', 301);

        case $path === 'services':
            render('site', 'site/services', $common + ['title' => 'Services', 'description' => block('services_intro')]);

        case (bool)preg_match('#^services/([a-z0-9-]+)$#', $path, $m):
            $svc = Db::one('SELECT s.*, p.name AS practice_name, p.slug AS practice_slug, p.accent AS practice_accent FROM services s LEFT JOIN practices p ON p.id = s.practice_id WHERE s.slug = ? AND s.is_active = 1', [$m[1]]);
            if (!$svc) {
                not_found();
            }
            $related = Db::all('SELECT * FROM services WHERE practice_id = ? AND id <> ? AND is_active = 1 ORDER BY sort LIMIT 3', [$svc['practice_id'], $svc['id']]);
            render('site', 'site/service', $common + ['title' => $svc['name'], 'description' => $svc['summary'], 'svc' => $svc, 'related' => $related]);

        case $path === 'industries':
            render('site', 'site/industries', $common + ['title' => 'Industries', 'description' => block('industries_intro'), 'industries' => industries()]);

        case (bool)preg_match('#^industries/([a-z0-9-]+)$#', $path, $m):
            $ind = Db::one('SELECT * FROM industries WHERE slug = ? AND is_active = 1', [$m[1]]);
            if (!$ind) {
                not_found();
            }
            $clients = Db::all('SELECT * FROM clients WHERE is_active = 1 AND industry = ? ORDER BY sort', [$ind['name']]);
            render('site', 'site/industry', $common + ['title' => $ind['name'], 'description' => $ind['summary'], 'ind' => $ind, 'clients' => $clients, 'others' => industries()]);

        case $path === 'products':
            render('site', 'site/products', $common + ['title' => 'Products', 'description' => block('products_intro'), 'products' => products()]);

        case $path === 'clients':
            render('site', 'site/clients', $common + ['title' => 'Clients', 'description' => block('clients_intro'), 'clients' => clients_list(), 'cases' => case_studies()]);

        case $path === 'about':
            render('site', 'site/about', $common + ['title' => 'About us', 'description' => block('about_intro'), 'offices' => offices(), 'reasons' => Db::all('SELECT * FROM commitments ORDER BY sort, id')]);

        case $path === 'careers':
            render('site', 'site/careers', $common + ['title' => 'Careers', 'description' => block('careers_intro')]);

        case $path === 'faq':
            render('site', 'site/faq', $common + ['title' => 'Frequently asked questions', 'faqs' => Db::all('SELECT * FROM faqs WHERE is_active = 1 ORDER BY sort, id')]);

        case $path === 'contact':
            contact_page($common);

        case $path === 'search':
            search_page($common);

        case $path === 'privacy':
            render('site', 'site/legal', $common + ['title' => 'Privacy policy', 'body' => block('privacy_body')]);

        case $path === 'terms':
            render('site', 'site/legal', $common + ['title' => 'Terms of use', 'body' => block('terms_body')]);

        case $path === 'sitemap.xml':
            sitemap();

        case $path === 'robots.txt':
            header('Content-Type: text/plain; charset=utf-8');
            echo "User-agent: *\nDisallow: /admin\nDisallow: /install\nSitemap: " . full_url('sitemap.xml') . "\n";
            exit;
    }

    not_found();
}

function contact_page(array $common): never
{
    $errors = [];
    $topics = array_keys(contact_topics());
    $old = ['name' => '', 'email' => '', 'company' => '', 'phone' => '', 'country' => '', 'service' => post('service', (string)($_GET['service'] ?? '')), 'body' => ''];
    $sent = isset($_GET['sent']);

    if (is_post()) {
        foreach ($old as $k => $_) {
            $old[$k] = post($k);
        }
        $started = (int)post('_t');
        if (!csrf_check()) {
            $errors['form'] = 'Your session expired. Please submit the form again.';
        } elseif (post('website') !== '' || ($started > 0 && time() - $started < 3)) {
            redirect('/contact?sent=1'); // likely a bot: pretend success
        } else {
            if (mb_strlen($old['name']) < 2) $errors['name'] = 'Please enter your name.';
            if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Please enter a valid email address, like name@company.com.';
            if (mb_strlen($old['body']) < 10) $errors['body'] = 'Please tell us a little more (at least 10 characters).';
            if (!isset($_POST['consent'])) $errors['consent'] = 'Please confirm we may contact you.';
            $recent = (int)Db::value('SELECT COUNT(*) FROM messages WHERE ip = ? AND created_at > ?', [client_ip(), date('Y-m-d H:i:s', time() - 3600)]);
            if ($recent >= 5) $errors['form'] = 'Too many messages from your connection. Please email us directly at ' . setting('email_info') . '.';
        }
        if (!$errors) {
            $routeTo = route_email($old['service']);
            Db::insert('messages', [
                'name' => mb_substr($old['name'], 0, 150), 'email' => mb_substr($old['email'], 0, 190),
                'company' => mb_substr($old['company'], 0, 190), 'phone' => mb_substr($old['phone'], 0, 60),
                'country' => mb_substr($old['country'], 0, 100), 'service' => mb_substr($old['service'], 0, 150),
                'route_to' => mb_substr($routeTo, 0, 190), 'body' => mb_substr($old['body'], 0, 5000),
                'ip' => client_ip(), 'user_agent' => mb_substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
                'status' => 'new', 'created_at' => now(),
            ]);
            if (setting('notify_enabled') === '1') {
                $recipients = [];
                if (setting('notify_route') === '1' && $routeTo !== '') $recipients[] = $routeTo;
                if (setting('notify_email') !== '') $recipients[] = setting('notify_email');
                $body = "Name: {$old['name']}\nEmail: {$old['email']}\nCompany: {$old['company']}\nPhone: {$old['phone']}\nCountry: {$old['country']}\nInterested in: {$old['service']}\n\n{$old['body']}\n\n— Sent from the contact form at " . full_url('contact');
                foreach (array_unique($recipients) as $to) {
                    Mailer::send($to, 'New enquiry from ' . $old['name'] . ($old['service'] ? ' – ' . $old['service'] : ''), $body, $old['email']);
                }
            }
            redirect('/contact?sent=1');
        }
    }

    render('site', 'site/contact', $common + [
        'title' => 'Contact us',
        'description' => block('contact_intro'),
        'errors' => $errors, 'old' => $old, 'sent' => $sent, 'topics' => $topics,
        'offices' => offices(),
        'countries' => array_merge(array_column(offices(), 'country'), ['Other']),
    ]);
}

function search_page(array $common): never
{
    $q = trim(mb_substr((string)($_GET['q'] ?? ''), 0, 100));
    $results = [];
    if (mb_strlen($q) >= 2) {
        $like = '%' . str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $q) . '%';
        foreach (Db::all('SELECT slug, name, summary, intro FROM practices WHERE name LIKE ? OR summary LIKE ? OR intro LIKE ? OR promise LIKE ? ORDER BY sort', array_fill(0, 4, $like)) as $p) {
            $results[] = ['type' => 'What we do', 'title' => $p['name'], 'text' => $p['summary'], 'url' => url('what-we-do/' . $p['slug'])];
        }
        foreach (Db::all('SELECT slug, name, summary FROM services WHERE is_active = 1 AND (name LIKE ? OR summary LIKE ? OR description LIKE ? OR do_items LIKE ? OR get_items LIKE ? OR tag LIKE ?) ORDER BY sort', array_fill(0, 6, $like)) as $s) {
            $results[] = ['type' => 'Service', 'title' => $s['name'], 'text' => $s['summary'], 'url' => url('services/' . $s['slug'])];
        }
        foreach (Db::all('SELECT slug, name, summary FROM industries WHERE is_active = 1 AND (name LIKE ? OR summary LIKE ? OR msp LIKE ? OR audit LIKE ? OR horizons LIKE ?) ORDER BY sort', array_fill(0, 5, $like)) as $i) {
            $results[] = ['type' => 'Industry', 'title' => $i['name'], 'text' => $i['summary'], 'url' => url('industries/' . $i['slug'])];
        }
        foreach (Db::all('SELECT slug, name, summary FROM products WHERE is_active = 1 AND (name LIKE ? OR summary LIKE ? OR items LIKE ?) ORDER BY sort', array_fill(0, 3, $like)) as $p) {
            $results[] = ['type' => 'Product', 'title' => $p['name'], 'text' => $p['summary'], 'url' => url('products#' . $p['slug'])];
        }
        foreach (Db::all('SELECT region, items FROM standards WHERE region LIKE ? OR items LIKE ? ORDER BY sort', [$like, $like]) as $st) {
            $results[] = ['type' => 'Standards', 'title' => $st['region'] . ' standards', 'text' => implode(', ', lines($st['items'])), 'url' => url('what-we-do/compliance-audit#standards')];
        }
        foreach (Db::all('SELECT question, answer FROM faqs WHERE is_active = 1 AND (question LIKE ? OR answer LIKE ?) ORDER BY sort', [$like, $like]) as $f) {
            $results[] = ['type' => 'FAQ', 'title' => $f['question'], 'text' => $f['answer'], 'url' => url('faq')];
        }
        $pages = ['about' => ['About us', block('about_body')], 'careers' => ['Careers', block('careers_body')], 'contact' => ['Contact us', block('contact_intro')]];
        foreach ($pages as $slug => [$t, $body]) {
            if (mb_stripos($t . ' ' . $body, $q) !== false) {
                $results[] = ['type' => 'Page', 'title' => $t, 'text' => mb_substr(strip_tags(md($body)), 0, 180), 'url' => url($slug)];
            }
        }
        foreach (Db::all('SELECT country, city, region FROM offices WHERE country LIKE ? OR city LIKE ? OR region LIKE ?', [$like, $like, $like]) as $o) {
            $results[] = ['type' => 'Office', 'title' => $o['city'] . ', ' . $o['country'], 'text' => (string)$o['region'], 'url' => url('about#offices')];
        }
    }
    render('site', 'site/search', $common + ['title' => $q ? 'Search: ' . $q : 'Search', 'q' => $q, 'results' => $results]);
}

function sitemap(): never
{
    header('Content-Type: application/xml; charset=utf-8');
    $paths = ['', 'what-we-do', 'services', 'industries', 'products', 'clients', 'about', 'careers', 'faq', 'contact', 'privacy', 'terms'];
    foreach (Db::all('SELECT slug FROM practices') as $p) {
        $paths[] = 'what-we-do/' . $p['slug'];
    }
    foreach (Db::all('SELECT slug FROM services WHERE is_active = 1') as $s) {
        $paths[] = 'services/' . $s['slug'];
    }
    foreach (Db::all('SELECT slug FROM industries WHERE is_active = 1') as $i) {
        $paths[] = 'industries/' . $i['slug'];
    }
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($paths as $p) {
        echo '<url><loc>' . e(full_url($p)) . '</loc></url>';
    }
    echo '</urlset>';
    exit;
}
