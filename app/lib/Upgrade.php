<?php
declare(strict_types=1);

/**
 * One-time content updates for sites installed with an earlier version.
 * A value is replaced only while it still matches an earlier default (see upgrade-defaults.php),
 * so anything edited in the dashboard is kept.
 */
final class Upgrade
{
    private const VERSION = '5';

    /** Service slugs from earlier versions that the 16 service areas replace. */
    private const OLD_SERVICES = [
        'it-outsourcing', 'resident-engineers', 'managed-infrastructure-cloud', 'managed-workplace', 'virtual-cio',
        'security-audit-vapt', 'compliance-readiness', 'grc-privacy', 'managed-soc', 'industrial-automation', 'embedded-iot',
        'smart-living-cities', 'artificial-intelligence', 'robotics-health-tech', 'software-erp', 'infrastructure-telecom',
        'cloud-digitization', 'procurement-contact-center',
    ];

    public static function run(): void
    {
        if (setting('content_version') === self::VERSION) {
            return;
        }
        foreach (['practices', 'industries', 'services', 'products'] as $t) {
            self::addColumn($t, 'image', 'VARCHAR(255) NULL');
        }
        self::addColumn('practices', 'highlights', 'TEXT NULL');
        Db::exec('CREATE TABLE IF NOT EXISTS slides (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, image VARCHAR(255) NULL, title VARCHAR(120) NOT NULL,
            subtitle VARCHAR(200) NULL, link VARCHAR(255) NULL, is_active TINYINT(1) NOT NULL DEFAULT 1, sort INT NOT NULL DEFAULT 0
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        Seed::run(); // adds new settings and page-text keys (INSERT IGNORE); content tables are left alone

        $old = require __DIR__ . '/upgrade-defaults.php';

        foreach (Seed::settings() as $k => $v) {
            self::replaceIfDefault('settings', 'k', $k, 'v', $v, $old['settings'][$k] ?? []);
        }
        foreach (Seed::blocks() as [$k, , , , $v]) {
            self::replaceIfDefault('blocks', 'k', $k, 'v', $v, $old['blocks'][$k] ?? []);
        }
        Db::exec("DELETE FROM blocks WHERE k IN ('home_eyebrow', 'home_title', 'home_intro', 'home_meta', 'home_services_title')");

        // Rows matched by position: practices, plans, reasons, steps, offices, industries, clients, cases, standards, FAQs
        $sources = [
            'practices' => [Seed::practices(), ['slug', 'name', 'short_name', 'promise', 'motto', 'summary', 'intro', 'lead_product', 'accent', 'is_core']],
            'levels' => [Seed::levels(), ['name', 'audience', 'items', 'featured']],
            'commitments' => [Seed::commitments(), ['title', 'body']],
            'steps' => [Seed::steps(), ['title', 'body']],
            'offices' => [Seed::offices(), ['country', 'code', 'city', 'region', 'description', 'email', 'is_hq']],
            'industries' => [Seed::industries(), ['slug', 'name', 'icon', 'summary', 'msp', 'audit', 'horizons']],
            'clients' => [Seed::clients(), ['name', 'country', 'industry', 'color']],
            'case_studies' => [Seed::caseStudies(), ['title', 'client', 'pillar', 'country', 'challenge', 'solution', 'result']],
            'standards' => [Seed::standards(), ['region', 'items']],
            'faqs' => [Seed::faqs(), ['question', 'answer']],
        ];
        foreach ($sources as $table => [$rows, $fields]) {
            $current = Db::all("SELECT * FROM `$table` ORDER BY sort, id");
            foreach ($current as $i => $row) {
                $set = [];
                foreach ($old['rows'][$table][$i] ?? [] as $field => $hashes) {
                    $j = array_search($field, $fields, true);
                    if ($j !== false && isset($rows[$i][$j]) && in_array(md5((string)$row[$field]), $hashes, true)) {
                        $set[$field] = $rows[$i][$j];
                    }
                }
                if ($set) {
                    Db::update($table, $set, (int)$row['id']);
                }
            }
        }

        // Steps from the first version (Run / Secure / Invent) become the four-step process
        if (array_column(Db::all('SELECT title FROM steps ORDER BY sort'), 'title') === ['Run', 'Secure', 'Invent']) {
            Db::exec('DELETE FROM steps');
            foreach (Seed::steps() as $i => [$t, $b]) {
                Db::insert('steps', ['title' => $t, 'body' => $b, 'sort' => ($i + 1) * 10]);
            }
        }
        Db::exec("UPDATE commitments SET title = 'We innovate' WHERE title = 'We invent'");

        // Products: keep CyberERP and b2cloud.io, remove the earlier packaged plans
        Db::exec("DELETE FROM products WHERE slug IN ('cybercraft-care', 'cybercraft-secure', 'cybercraft-horizons')");
        foreach (Seed::products() as $i => $p) {
            $row = Db::one('SELECT * FROM products WHERE slug = ?', [$p[0]]);
            if (!$row) {
                continue;
            }
            $set = ['sort' => ($i + 1) * 10];
            if (trim((string)$row['image']) === '') {
                $set['image'] = $p[7];
            }
            foreach (['slug', 'name', 'label', 'summary', 'items', 'accent', 'external_url'] as $j => $f) {
                if (in_array(md5((string)$row[$f]), $old['products'][$p[0]][$f] ?? [], true)) {
                    $set[$f] = $p[$j];
                }
            }
            Db::update('products', $set, (int)$row['id']);
        }

        // Photos for pillars and industries that still show the default (or no) image
        foreach (Seed::practices() as $p) {
            Db::exec("UPDATE practices SET image = ? WHERE accent = ? AND (image IS NULL OR image = '' OR image LIKE 'scenes/%')", [$p[10], $p[8]]);
            Db::exec("UPDATE practices SET highlights = ? WHERE accent = ? AND (highlights IS NULL OR highlights = '')", [$p[11], $p[8]]);
        }
        foreach (Seed::industries() as $ind) {
            Db::exec("UPDATE industries SET image = ? WHERE slug = ? AND (image IS NULL OR image = '')", ['photos/' . $ind[0] . '.jpg', $ind[0]]);
        }

        // The 16 service areas: add missing ones, refresh defaults, hide the services they replace
        $byAccent = array_column(Db::all('SELECT id, accent FROM practices'), 'id', 'accent');
        $accentOf = ['managed-services' => 'msp', 'compliance-audit' => 'audit', 'innovation' => 'horizons', 'solutions' => 'support'];
        foreach (Seed::services() as $pslug => $list) {
            $pid = $byAccent[$accentOf[$pslug]] ?? null;
            foreach ($list as [$slug, $tag, $name, $summary, $desc, $do, $get, $ideal, $img, $sort]) {
                $row = Db::one('SELECT id, image FROM services WHERE slug = ?', [$slug]);
                if ($row) {
                    if (trim((string)$row['image']) === '') {
                        Db::update('services', ['image' => $img, 'tag' => $tag, 'sort' => $sort], (int)$row['id']);
                    }
                    continue;
                }
                Db::insert('services', [
                    'practice_id' => $pid, 'slug' => $slug, 'tag' => $tag, 'name' => $name, 'summary' => $summary,
                    'description' => $desc, 'do_items' => $do, 'get_items' => $get, 'ideal' => $ideal, 'image' => $img,
                    'price_from' => 1, 'price_amount' => '', 'price_unit' => '', 'is_active' => 1, 'sort' => $sort, 'updated_at' => now(),
                ]);
            }
        }
        $in = implode(',', array_fill(0, count(self::OLD_SERVICES), '?'));
        Db::exec("UPDATE services SET is_active = 0 WHERE slug IN ($in) AND (image IS NULL OR image = '')", self::OLD_SERVICES);

        if ((int)Db::value('SELECT COUNT(*) FROM slides') === 0) {
            foreach (Seed::slides() as $i => [$img, $t, $sub, $link]) {
                Db::insert('slides', ['image' => $img, 'title' => $t, 'subtitle' => $sub, 'link' => $link, 'is_active' => 1, 'sort' => ($i + 1) * 10]);
            }
        }

        Db::exec('INSERT INTO settings (k, v) VALUES (?, ?) ON DUPLICATE KEY UPDATE v = VALUES(v)', ['content_version', self::VERSION]);
    }

    private static function addColumn(string $table, string $column, string $type): void
    {
        $has = Db::value('SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?', [$table, $column]);
        if (!(int)$has) {
            Db::exec("ALTER TABLE `$table` ADD COLUMN `$column` $type");
        }
    }

    private static function replaceIfDefault(string $table, string $keyCol, string $key, string $valCol, string $new, array $hashes): void
    {
        if (!$hashes) {
            return;
        }
        $cur = Db::value("SELECT `$valCol` FROM `$table` WHERE `$keyCol` = ?", [$key]);
        if ($cur !== null && in_array(md5((string)$cur), $hashes, true)) {
            Db::exec("UPDATE `$table` SET `$valCol` = ? WHERE `$keyCol` = ?", [$new, $key]);
        }
    }
}
