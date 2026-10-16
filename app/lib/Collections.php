<?php
declare(strict_types=1);

/**
 * Content types managed by the generic dashboard editor.
 * Each entry describes the table, its form fields and the list columns.
 */
final class Collections
{
    /** Order of the content links in the dashboard sidebar. */
    public const NAV = ['practices', 'services', 'levels', 'industries', 'products', 'clients', 'cases', 'standards', 'commitments', 'steps', 'faqs', 'offices'];

    public static function all(): array
    {
        $practiceOptions = fn() => array_column(Db::all('SELECT id, name FROM practices ORDER BY sort, id'), 'name', 'id');
        $accents = fn() => ['msp' => 'Blue (Managed services)', 'audit' => 'Teal (Compliance & audit)', 'horizons' => 'Amber (Horizons)', 'sky' => 'Sky blue', 'support' => 'Slate (Supporting)'];
        $countries = fn() => ['PK' => 'Pakistan', 'AE' => 'United Arab Emirates', 'SA' => 'Saudi Arabia', 'GB' => 'United Kingdom', 'CZ' => 'Czech Republic', 'CA' => 'Canada', 'XX' => 'Other'];
        $icons = fn() => array_combine(INDUSTRY_ICONS, array_map('ucfirst', INDUSTRY_ICONS));
        $pillarNames = fn() => ['Managed services' => 'Managed services', 'Compliance & audit' => 'Compliance & audit', 'Horizons' => 'Horizons', 'Supporting' => 'Supporting services'];

        return [
            'practices' => [
                'title' => 'Pillars', 'singular' => 'pillar', 'table' => 'practices', 'icon' => 'layers',
                'help' => 'The three core pillars (and Supporting services). Each pillar has its own page and groups its services.',
                'order' => 'sort, id',
                'columns' => ['name' => 'Pillar', 'promise' => 'Promise', 'is_core' => 'Core pillar', 'sort' => 'Order'],
                'fields' => [
                    ['name', 'Name', 'text', true],
                    ['slug', 'URL slug', 'slug', false, 'Used in the page address, e.g. /what-we-do/managed-services.'],
                    ['short_name', 'Short name', 'text', false, 'Used in tabs and menus, e.g. Managed Services.'],
                    ['promise', 'Promise', 'text', false, 'One line, e.g. "We run your IT."'],
                    ['motto', 'Motto (optional)', 'text', false, 'e.g. Adapt · Innovate · Improvise'],
                    ['summary', 'Short summary', 'text', false],
                    ['intro', 'Introduction', 'textarea', false],
                    ['lead_product', 'Lead product', 'text', false],
                    ['accent', 'Colour', 'selectstr', false, '', $accents],
                    ['is_core', 'Show as a core pillar on the homepage', 'checkbox', false],
                    ['sort', 'Order', 'number', false, 'Lower numbers appear first.'],
                ],
            ],
            'services' => [
                'title' => 'Services', 'singular' => 'service', 'table' => 'services', 'icon' => 'grid',
                'help' => 'Each service has its own page. Leave the price empty to show "Let\'s talk".',
                'order' => 'practice_id, sort, id',
                'columns' => ['name' => 'Service', 'practice_id' => 'Pillar', 'tag' => 'Label', 'is_active' => 'Visible'],
                'fields' => [
                    ['name', 'Service name', 'text', true],
                    ['slug', 'URL slug', 'slug', false, 'Used in the page address, e.g. /services/managed-soc. Leave empty to create it from the name.'],
                    ['practice_id', 'Pillar', 'select', true, '', $practiceOptions],
                    ['tag', 'Label', 'text', false, 'Short label shown above the name, e.g. SOC'],
                    ['summary', 'Short summary', 'text', false, 'One line shown on cards and in search results.'],
                    ['description', 'Description', 'textarea', false],
                    ['do_items', 'What we do', 'lines', false, 'One item per line.'],
                    ['get_items', 'What you get', 'lines', false, 'One item per line.'],
                    ['ideal', 'Ideal for', 'text', false],
                    ['price_from', 'Show "from" before the price', 'checkbox', false],
                    ['price_amount', 'Price amount (optional)', 'text', false, 'Leave empty for "Let\'s talk".'],
                    ['price_unit', 'Price unit', 'text', false, 'e.g. /mo'],
                    ['external_url', 'External link (optional)', 'url', false, 'Adds a button to an external site.'],
                    ['is_active', 'Visible on website', 'checkbox', false],
                    ['sort', 'Order', 'number', false, 'Lower numbers appear first.'],
                ],
                'touch' => 'updated_at',
            ],
            'levels' => [
                'title' => 'Care plans', 'singular' => 'Care plan', 'table' => 'levels', 'icon' => 'stack',
                'help' => 'CyberCraft Care managed-services plans, shown on the Managed Services pillar page.',
                'order' => 'sort, id',
                'columns' => ['name' => 'Plan', 'price_amount' => 'From', 'featured' => 'Highlighted'],
                'fields' => [
                    ['name', 'Name', 'text', true],
                    ['audience', 'Who it is for', 'textarea', false],
                    ['items', 'What is included', 'lines', false, 'One item per line.'],
                    ['price_from', 'Show "from" before the price', 'checkbox', false],
                    ['price_amount', 'Price amount (optional)', 'text', false, 'Leave empty for "Let\'s talk".'],
                    ['price_unit', 'Price unit', 'text', false],
                    ['featured', 'Highlight this plan', 'checkbox', false],
                    ['sort', 'Order', 'number', false],
                ],
            ],
            'industries' => [
                'title' => 'Industries', 'singular' => 'industry', 'table' => 'industries', 'icon' => 'building',
                'help' => 'Each industry has its own page showing how the three pillars apply to it.',
                'order' => 'sort, id',
                'columns' => ['name' => 'Industry', 'summary' => 'Summary', 'is_active' => 'Visible'],
                'fields' => [
                    ['name', 'Name', 'text', true],
                    ['slug', 'URL slug', 'slug', false],
                    ['icon', 'Icon', 'selectstr', false, '', $icons],
                    ['summary', 'Short summary', 'text', false],
                    ['intro', 'Introduction (optional)', 'textarea', false],
                    ['msp', 'Managed services for this industry', 'text', false],
                    ['audit', 'Compliance & audit for this industry', 'text', false],
                    ['horizons', 'Horizons for this industry', 'text', false],
                    ['is_active', 'Visible on website', 'checkbox', false],
                    ['sort', 'Order', 'number', false],
                ],
            ],
            'products' => [
                'title' => 'Products', 'singular' => 'product', 'table' => 'products', 'icon' => 'box',
                'order' => 'sort, id',
                'columns' => ['name' => 'Product', 'label' => 'Label', 'is_active' => 'Visible'],
                'fields' => [
                    ['name', 'Name', 'text', true],
                    ['slug', 'Anchor slug', 'slug', false],
                    ['label', 'Label', 'text', false, 'e.g. Managed services, Platform'],
                    ['summary', 'Short summary', 'text', false],
                    ['description', 'Description (optional)', 'textarea', false],
                    ['items', 'Editions / modules', 'lines', false, 'One per line.'],
                    ['accent', 'Colour', 'selectstr', false, '', $accents],
                    ['external_url', 'External link (optional)', 'url', false],
                    ['is_active', 'Visible on website', 'checkbox', false],
                    ['sort', 'Order', 'number', false],
                ],
            ],
            'clients' => [
                'title' => 'Clients', 'singular' => 'client', 'table' => 'clients', 'icon' => 'users',
                'help' => 'Client logos shown on the homepage and Clients page. Untick "Sample" once a client is real, and only list clients who have agreed.',
                'order' => 'sort, id',
                'columns' => ['name' => 'Client', 'country' => 'Country', 'industry' => 'Industry', 'is_sample' => 'Sample', 'is_active' => 'Visible'],
                'fields' => [
                    ['name', 'Client name', 'text', true],
                    ['country', 'Country', 'selectstr', false, '', $countries],
                    ['industry', 'Industry', 'text', false],
                    ['logo_url', 'Logo image address (optional)', 'text', false, 'e.g. /assets/img/clients/acme.svg or https://… Leave empty to show a monogram.'],
                    ['color', 'Monogram colour', 'text', false, 'e.g. #1F4FA8'],
                    ['website', 'Website (optional)', 'url', false],
                    ['is_sample', 'Sample (placeholder) client', 'checkbox', false],
                    ['is_active', 'Visible on website', 'checkbox', false],
                    ['sort', 'Order', 'number', false],
                ],
            ],
            'cases' => [
                'title' => 'Case studies', 'singular' => 'case study', 'table' => 'case_studies', 'icon' => 'file',
                'order' => 'sort, id',
                'columns' => ['title' => 'Case study', 'client' => 'Client', 'pillar' => 'Pillar', 'is_sample' => 'Sample', 'is_active' => 'Visible'],
                'fields' => [
                    ['title', 'Title', 'text', true],
                    ['client', 'Client', 'text', false],
                    ['pillar', 'Pillar', 'selectstr', false, '', $pillarNames],
                    ['country', 'Country', 'selectstr', false, '', $countries],
                    ['challenge', 'Challenge', 'textarea', false],
                    ['solution', 'Solution', 'textarea', false],
                    ['result', 'Result', 'text', false],
                    ['is_sample', 'Sample (placeholder) case study', 'checkbox', false],
                    ['is_active', 'Visible on website', 'checkbox', false],
                    ['sort', 'Order', 'number', false],
                ],
            ],
            'standards' => [
                'title' => 'Standards', 'singular' => 'standards group', 'table' => 'standards', 'icon' => 'shield',
                'help' => 'Compliance standards and regulations by region, shown on the Compliance & Audit page and in the scrolling strip.',
                'order' => 'sort, id',
                'columns' => ['region' => 'Region', 'items' => 'Standards'],
                'fields' => [
                    ['region', 'Region', 'text', true],
                    ['items', 'Standards', 'lines', false, 'One per line.'],
                    ['sort', 'Order', 'number', false],
                ],
            ],
            'commitments' => [
                'title' => 'Why CyberCraft', 'singular' => 'reason', 'table' => 'commitments', 'icon' => 'check',
                'order' => 'sort, id',
                'columns' => ['title' => 'Reason', 'sort' => 'Order'],
                'fields' => [['title', 'Title', 'text', true], ['body', 'Text', 'textarea', false], ['sort', 'Order', 'number', false]],
            ],
            'steps' => [
                'title' => 'How we engage', 'singular' => 'step', 'table' => 'steps', 'icon' => 'route',
                'order' => 'sort, id',
                'columns' => ['title' => 'Step', 'sort' => 'Order'],
                'fields' => [['title', 'Title', 'text', true], ['body', 'Text', 'textarea', false], ['sort', 'Order', 'number', false]],
            ],
            'offices' => [
                'title' => 'Offices', 'singular' => 'office', 'table' => 'offices', 'icon' => 'pin',
                'help' => 'Leave the address empty to show "Address coming soon".',
                'order' => 'sort, id',
                'columns' => ['country' => 'Country', 'city' => 'City', 'email' => 'Email', 'is_hq' => 'HQ'],
                'fields' => [
                    ['country', 'Country', 'text', true],
                    ['code', 'Country code', 'text', false, 'Two letters, e.g. PK'],
                    ['city', 'City', 'text', false],
                    ['region', 'Role / region', 'text', false],
                    ['description', 'Description', 'textarea', false],
                    ['address', 'Address', 'textarea', false],
                    ['phone', 'Phone', 'text', false],
                    ['email', 'Email', 'email', false],
                    ['is_hq', 'Headquarters', 'checkbox', false],
                    ['sort', 'Order', 'number', false],
                ],
            ],
            'faqs' => [
                'title' => 'FAQs', 'singular' => 'question', 'table' => 'faqs', 'icon' => 'help',
                'order' => 'sort, id',
                'columns' => ['question' => 'Question', 'is_active' => 'Visible'],
                'fields' => [
                    ['question', 'Question', 'text', true],
                    ['answer', 'Answer', 'textarea', false],
                    ['is_active', 'Visible on website', 'checkbox', false],
                    ['sort', 'Order', 'number', false],
                ],
            ],
        ];
    }

    public static function get(string $key): ?array
    {
        return self::all()[$key] ?? null;
    }

    /** Normalised field definitions: [name, label, type, required, help, options] */
    public static function fields(array $def): array
    {
        return array_map(fn($f) => [
            'name' => $f[0], 'label' => $f[1], 'type' => $f[2],
            'required' => $f[3] ?? false, 'help' => $f[4] ?? '', 'options' => isset($f[5]) ? ($f[5])() : [],
        ], $def['fields']);
    }

    /** Validate POSTed values into a row. Returns [data, errors]. */
    public static function fromPost(array $def, ?int $id): array
    {
        $data = [];
        $errors = [];
        foreach (self::fields($def) as $f) {
            $n = $f['name'];
            $v = post($n);
            switch ($f['type']) {
                case 'checkbox':
                    $v = isset($_POST[$n]) ? 1 : 0;
                    break;
                case 'number':
                    $v = (int)$v;
                    break;
                case 'select':
                    $v = $v === '' ? null : (int)$v;
                    if ($v !== null && !array_key_exists($v, $f['options'])) {
                        $errors[$n] = 'Choose a valid option.';
                    }
                    break;
                case 'selectstr':
                    if ($v !== '' && !array_key_exists($v, $f['options'])) {
                        $errors[$n] = 'Choose a valid option.';
                    }
                    break;
                case 'url':
                    if ($v !== '' && !preg_match('#^https?://#i', $v)) {
                        $errors[$n] = 'Enter a full address starting with https://';
                    }
                    break;
                case 'email':
                    if ($v !== '' && !filter_var($v, FILTER_VALIDATE_EMAIL)) {
                        $errors[$n] = 'Enter a valid email address.';
                    }
                    break;
                case 'slug':
                    $v = $v === '' ? slugify(post('name') ?: post('title') ?: post('country')) : slugify($v);
                    $dupe = Db::value("SELECT id FROM `{$def['table']}` WHERE slug = ? AND id <> ?", [$v, $id ?? 0]);
                    if ($dupe) {
                        $errors[$n] = 'This slug is already used. Choose another.';
                    }
                    break;
                default:
                    $v = mb_substr($v, 0, $f['type'] === 'text' ? 300 : 20000);
                    if ($n === 'logo_url' && $v !== '' && !preg_match('#^(https?://|/)#i', $v)) {
                        $errors[$n] = 'Enter an address starting with / or https://';
                    }
                    if ($n === 'color' && $v !== '' && !preg_match('/^#[0-9a-f]{3,8}$/i', $v)) {
                        $errors[$n] = 'Enter a colour like #1F4FA8.';
                    }
            }
            if ($f['required'] && ($v === '' || $v === null)) {
                $errors[$n] = $f['label'] . ' is required.';
            }
            $data[$n] = $v;
        }
        if (!empty($def['touch'])) {
            $data[$def['touch']] = now();
        }
        return [$data, $errors];
    }
}
