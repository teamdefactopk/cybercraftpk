<?php
declare(strict_types=1);

/** Sends plain-text notifications with PHP mail(), which cPanel hosting supports out of the box. */
final class Mailer
{
    public static function send(string $to, string $subject, string $body, string $replyTo = ''): bool
    {
        $to = self::clean($to);
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $host = parse_url(setting('site_url', 'https://www.cybercraft.biz'), PHP_URL_HOST) ?: 'cybercraft.biz';
        $from = (string)(APP_CONFIG['mail_from'] ?? ('no-reply@' . preg_replace('/^www\./', '', $host)));
        $headers = [
            'From: ' . self::clean(setting('site_name', 'CyberCraft')) . ' <' . self::clean($from) . '>',
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'Content-Transfer-Encoding: 8bit',
        ];
        $replyTo = self::clean($replyTo);
        if ($replyTo !== '' && filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
            $headers[] = 'Reply-To: ' . $replyTo;
        }
        $subject = '=?UTF-8?B?' . base64_encode(self::clean($subject)) . '?=';
        return @mail($to, $subject, $body, implode("\r\n", $headers));
    }

    /** Strip line breaks so user input cannot inject extra headers. */
    private static function clean(string $v): string
    {
        return trim(str_replace(["\r", "\n", '%0a', '%0d'], '', $v));
    }
}
