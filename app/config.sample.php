<?php
// Reference only. The installer (/install) writes app/config.php for you.
// To configure by hand: copy this file to config.php, fill in the values,
// and create an empty file app/storage/installed.lock.
return [
    'db' => [
        'host' => 'localhost',
        'port' => 3306,
        'name' => 'cpaneluser_cybercraft',
        'user' => 'cpaneluser_cybercraft',
        'pass' => 'your-database-password',
    ],
    'base_path' => '',        // '' when the site is at the domain root
    'timezone' => 'UTC',
    'debug' => false,         // never true on the live site
    // 'mail_from' => 'no-reply@cybercraft.biz',
];
