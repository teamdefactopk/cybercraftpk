<?php
declare(strict_types=1);

/**
 * One-time content updates for sites installed with an earlier version.
 * Each step only replaces text that still matches the old default, so edits made in the dashboard are kept.
 */
final class Upgrade
{
    private const VERSION = '3';

    public static function run(): void
    {
        if (setting('content_version') === self::VERSION) {
            return;
        }
        foreach (['practices', 'industries'] as $t) {
            $has = Db::value('SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?', [$t, 'image']);
            if (!(int)$has) {
                Db::exec("ALTER TABLE `$t` ADD COLUMN image VARCHAR(255) NULL");
            }
        }
        Seed::run(); // adds any new settings and page-text keys (INSERT IGNORE)

        $oldSteps = array_column(Db::all('SELECT title FROM steps ORDER BY sort'), 'title');
        if ($oldSteps === ['Run', 'Secure', 'Invent']) {
            Db::exec('DELETE FROM steps');
            foreach (Seed::steps() as $i => [$t, $b]) {
                Db::insert('steps', ['title' => $t, 'body' => $b, 'sort' => ($i + 1) * 10]);
            }
        }
        Db::exec("UPDATE commitments SET title = 'We innovate' WHERE title = 'We invent'");
        $blocks = [];
        foreach (Seed::blocks() as [$k, , , , $v]) {
            $blocks[$k] = $v;
        }
        $old = [
            'pillars_title' => 'Run. Secure. Invent.',
            'home_pillars_title' => 'Three pillars. One accountable partner.',
            'home_why_title' => 'Ten reasons clients stay.',
            'home_clients_title' => 'Trusted across six countries.',
            'home_products_title' => 'Packaged, repeatable, ready to deploy.',
            'home_cta_band_title' => "Let's run, secure and build the future together",
            'careers_title' => 'Build a career that runs, secures and invents',
        ];
        foreach ($old as $k => $was) {
            Db::exec('UPDATE blocks SET v = ? WHERE k = ? AND v = ?', [$blocks[$k] ?? $was, $k, $was]);
        }
        Db::exec("UPDATE blocks SET v = REPLACE(v, ', and to invent what comes next.', ', and to put new technology to work for our clients.') WHERE k IN ('ceo_quote')");
        Db::exec("UPDATE blocks SET v = REPLACE(v, 'We run your IT, secure it and prove it, and invent what comes next: three pillars under one accountable partner.', ?) WHERE k = 'pillars_intro'", [$blocks['pillars_intro']]);
        Db::exec("DELETE FROM blocks WHERE k IN ('home_eyebrow', 'home_title', 'home_intro', 'home_meta', 'home_services_title')");
        Db::exec('INSERT INTO settings (k, v) VALUES (?, ?) ON DUPLICATE KEY UPDATE v = VALUES(v)', ['content_version', self::VERSION]);
    }
}
