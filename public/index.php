<?php
declare(strict_types=1);

// Front controller. Every request that isn't a real file is routed here by .htaccess.
define('PUBLIC_DIR', __DIR__);

// The app folder sits next to the web root (recommended on cPanel: ~/cybercraft_app next to ~/public_html),
// or inside it for simple uploads (protected by its own .htaccess).
$candidates = [
    __DIR__ . '/../app',
    __DIR__ . '/../cybercraft_app',
    __DIR__ . '/cybercraft_app',
    __DIR__ . '/app',
];
$appDir = null;
foreach ($candidates as $c) {
    if (is_file($c . '/bootstrap.php')) {
        $appDir = realpath($c);
        break;
    }
}
if ($appDir === null) {
    http_response_code(500);
    exit('Application folder not found. Upload the "app" folder next to public_html (as cybercraft_app) or inside it.');
}

require $appDir . '/bootstrap.php';
require $appDir . '/routes.php';

dispatch();
