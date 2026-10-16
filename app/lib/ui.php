<?php
declare(strict_types=1);

/** Small presentation helpers shared by the public templates. */

const COUNTRY_NAMES = ['PK' => 'Pakistan', 'AE' => 'United Arab Emirates', 'SA' => 'Saudi Arabia', 'GB' => 'United Kingdom', 'CZ' => 'Czech Republic', 'CA' => 'Canada'];

/** CSS custom-property value for a pillar or product accent key. */
function accent_var(?string $accent): string
{
    return 'var(--' . (in_array($accent, ['msp', 'audit', 'horizons', 'sky', 'support'], true) ? $accent : 'sky') . ')';
}

/** "Sample" badge, shown while placeholders are still on the site. */
function sample_badge(array $row): string
{
    return !empty($row['is_sample']) && setting('show_sample_badges', '1') === '1' ? ' <span class="sample">Sample</span>' : '';
}

/** Client logo image, or a monogram built from the client's initials. */
function client_logo(array $c): string
{
    if (trim((string)$c['logo_url']) !== '') {
        $src = str_starts_with($c['logo_url'], 'http') ? $c['logo_url'] : url($c['logo_url']);
        return '<img src="' . e($src) . '" alt="' . e($c['name']) . '" loading="lazy">';
    }
    $words = preg_split('/\s+/', trim((string)$c['name'])) ?: [];
    $ini = mb_strtoupper(mb_substr($words[0] ?? '?', 0, 1) . mb_substr($words[1] ?? '', 0, 1));
    $col = preg_match('/^#[0-9a-f]{3,8}$/i', (string)$c['color']) ? $c['color'] : '#1F4FA8';
    $shapes = [
        '<circle cx="22" cy="22" r="20"/>', '<path d="M22 2 40 12v20L22 42 4 32V12z"/>', '<rect x="3" y="3" width="38" height="38" rx="10"/>',
        '<path d="M22 1 43 22 22 43 1 22z"/>', '<path d="M3 22a19 19 0 0 1 38 0v19H3z"/>',
    ];
    $shape = $shapes[crc32((string)$c['name']) % count($shapes)];
    return '<svg viewBox="0 0 44 44" width="44" height="44" aria-hidden="true"><g fill="' . e($col) . '">' . $shape . '</g>'
        . '<text x="22" y="27" text-anchor="middle" font-family="Archivo,Arial,sans-serif" font-weight="800" font-size="14" fill="#fff">' . e($ini) . '</text></svg>';
}

/** Split "Title | text" lines into pairs. */
function pairs(?string $text): array
{
    return array_map(fn($l) => array_map('trim', explode('|', $l, 2)) + [1 => ''], lines($text));
}

/** Decorative artwork for a pillar panel. */
function pillar_art(string $accent): string
{
    $open = '<svg class="art" viewBox="0 0 400 540" preserveAspectRatio="xMidYMid slice" aria-hidden="true">';
    switch ($accent) {
        case 'msp':
            $s = $open . '<defs><linearGradient id="a-msp" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#1B4FB5"/><stop offset="1" stop-color="#0A1630"/></linearGradient></defs><rect width="400" height="540" fill="url(#a-msp)"/>';
            mt_srand(7);
            for ($r = 0; $r < 9; $r++) {
                for ($c = 0; $c < 6; $c++) {
                    $x = 30 + $c * 58; $y = 40 + $r * 46;
                    $s .= '<rect x="' . $x . '" y="' . $y . '" width="46" height="30" rx="4" fill="none" stroke="#8CC2FF" stroke-opacity=".25"/>';
                    if (mt_rand(0, 99) < 35) $s .= '<circle cx="' . ($x + 8) . '" cy="' . ($y + 15) . '" r="2.6" fill="' . (mt_rand(0, 9) < 7 ? '#7CF0B0' : '#F5B455') . '"/>';
                    if (mt_rand(0, 99) < 25) $s .= '<rect x="' . ($x + 16) . '" y="' . ($y + 12) . '" width="22" height="6" rx="2" fill="#8CC2FF" fill-opacity=".35"/>';
                }
            }
            return $s . '</svg>';
        case 'audit':
            $s = $open . '<defs><radialGradient id="a-aud" cx="50%" cy="38%" r="70%"><stop offset="0" stop-color="#0E9AA7"/><stop offset=".55" stop-color="#0B3A5C"/><stop offset="1" stop-color="#0A1630"/></radialGradient></defs><rect width="400" height="540" fill="url(#a-aud)"/>';
            for ($i = 0; $i < 12; $i++) {
                $s .= '<circle cx="200" cy="200" r="' . (30 + $i * 26) . '" fill="none" stroke="#9BF1F7" stroke-opacity="' . number_format(.5 - $i * .035, 3) . '" stroke-width="1.2" stroke-dasharray="' . (4 + $i * 3) . ' ' . (6 + $i) . '"/>';
            }
            return $s . '<path d="M200 128 256 150v52c0 40-25 66-56 80-31-14-56-40-56-80v-52z" fill="none" stroke="#fff" stroke-opacity=".9" stroke-width="3"/><path d="m176 206 18 18 34-38" fill="none" stroke="#7CF0B0" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        case 'horizons':
            $s = $open . '<defs><linearGradient id="a-hz" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#0A1630"/><stop offset=".55" stop-color="#3A2A55"/><stop offset="1" stop-color="#C46A1A"/></linearGradient><radialGradient id="a-hzs"><stop offset="0" stop-color="#FFD58A"/><stop offset="1" stop-color="#F5A23A" stop-opacity="0"/></radialGradient></defs><rect width="400" height="540" fill="url(#a-hz)"/><circle cx="200" cy="300" r="150" fill="url(#a-hzs)" fill-opacity=".55"/><circle cx="200" cy="300" r="62" fill="#FFC56B"/>';
            for ($i = 0; $i < 10; $i++) {
                $y = round(318 + $i * $i * 2.6);
                $s .= '<line x1="0" y1="' . $y . '" x2="400" y2="' . $y . '" stroke="#FFE2AE" stroke-opacity="' . number_format(.5 - $i * .04, 2) . '"/>';
            }
            for ($i = -6; $i <= 6; $i++) {
                $s .= '<line x1="200" y1="318" x2="' . (200 + $i * 90) . '" y2="540" stroke="#FFE2AE" stroke-opacity=".22"/>';
            }
            return $s . '<path d="M40 90h80l20 20h60M260 60v40l20 20h80M60 160h40l14-14h50" fill="none" stroke="#fff" stroke-opacity=".35" stroke-width="1.5"/></svg>';
        default:
            return $open . '<defs><linearGradient id="a-sup" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#334155"/><stop offset="1" stop-color="#0A1630"/></linearGradient></defs><rect width="400" height="540" fill="url(#a-sup)"/></svg>';
    }
}
