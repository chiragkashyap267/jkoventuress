<?php
declare(strict_types=1);
/**
 * J&Ko Ventures — editable content layer
 *
 * Every editable string on the site is written as t('key', 'the current text').
 * The second argument is the live default, so the pages render correctly even
 * if the data file is missing, empty or corrupt. The admin panel only ever
 * stores OVERRIDES, which keeps the data file small and makes "reset to
 * original" a matter of deleting a key.
 *
 * The data file deliberately lives outside version control: the site deploys
 * from Git, so anything the owner edits through the panel would be wiped by
 * the next deploy if it were tracked.
 */

const DATA_DIR    = __DIR__ . '/../data';
const CONTENT_FILE = DATA_DIR . '/content.json';
const BACKUP_DIR   = DATA_DIR . '/backups';

/** Read the whole override set, cached for the request. */
function content_all(): array
{
    static $cache = null;
    if ($cache !== null) {
        return $cache;
    }
    $cache = ['contact' => [], 'text' => [], 'images' => []];

    if (is_readable(CONTENT_FILE)) {
        $raw = file_get_contents(CONTENT_FILE);
        $decoded = $raw === false ? null : json_decode($raw, true);
        if (is_array($decoded)) {
            foreach (['contact', 'text', 'images'] as $section) {
                if (isset($decoded[$section]) && is_array($decoded[$section])) {
                    $cache[$section] = $decoded[$section];
                }
            }
        }
    }
    return $cache;
}

/** Raw stored value for a key, or the supplied default. */
function content_get(string $section, string $key, string $default = ''): string
{
    $all = content_all();
    $v = $all[$section][$key] ?? null;
    return (is_string($v) && $v !== '') ? $v : $default;
}

/** The shipped text for a key, straight from the generated manifest. */
function content_default(string $key): string
{
    static $fields = null;
    if ($fields === null) {
        require_once __DIR__ . '/fields.php';
        $fields = content_fields();
    }
    return (string) ($fields[$key]['default'] ?? '');
}

/**
 * Page copy. The manifest supplies the default, so a page never needs to
 * repeat it and the two can never drift apart. The stored text is plain:
 * see rich() for the two things it is allowed to do.
 */
function t(string $key): string
{
    return rich(content_get('text', $key, content_default($key)));
}

/**
 * The business details as the site shipped. The panel overrides these; if the
 * data file is lost these are what the site falls back to, so the footer can
 * never render an empty address.
 */
function contact_fields(): array
{
    return [
        'founder'         => ['label' => 'Founder name',    'default' => 'Jaswinder Kour'],
        'email_primary'   => ['label' => 'Main email',      'default' => 'info@jkoventuress.com'],
        'email_secondary' => ['label' => 'Second email',    'default' => 'jaswinder@jkoventuress.com'],
        'phone_primary'   => ['label' => 'Main phone',      'default' => '+91 96542 72273'],
        'phone_secondary' => ['label' => 'Second phone',    'default' => '+91 93199 16172'],
        'address_line1'   => ['label' => 'Address line 1',  'default' => 'B-227, Basement, Greater Kailash 1'],
        'address_line2'   => ['label' => 'Address line 2',  'default' => 'New Delhi – 110048, India'],
    ];
}

/**
 * The replaceable photographs, by slot. Keys match the filenames the site
 * shipped with, which is also what img_src() falls back to.
 */
function image_fields(): array
{
    return [
        'team-meeting'          => ['label' => 'Home — Who We Are',            'page' => 'Home'],
        'personalised-gifts'    => ['label' => 'Home — Personalisation',       'page' => 'Home'],
        'kraft-packaging'       => ['label' => 'Home — Sustainable Gifting',   'page' => 'Home'],
        'lanyards-id-cards'     => ['label' => 'Lanyards & ID Cards card',     'page' => 'Home + Solutions'],
        'trophies-awards'       => ['label' => 'Trophies & Awards card',       'page' => 'Home + Solutions'],
        'name-plates'           => ['label' => 'Name Plates card',            'page' => 'Home + Solutions'],
        'premium-gift-boxes'    => ['label' => 'About — Who We Are',           'page' => 'About'],
        'curated-hampers'       => ['label' => 'Solutions — Curated Hampers',  'page' => 'Gifting Solutions'],
        'launch-kit'            => ['label' => 'Occasions — Launches',         'page' => 'Occasions'],
        'branded-stationery'    => ['label' => 'Approach — Brand Alignment',   'page' => 'Our Approach'],
        'packaging-quality'     => ['label' => 'Approach — Quality',           'page' => 'Our Approach'],
        'sustainable-packaging' => ['label' => 'Approach — Sustainable',       'page' => 'Our Approach'],
    ];
}

/** Where an image slot currently points. */
function image_path(string $slot): string
{
    $shipped = 'assets/img/photos/' . $slot . '.jpg';
    $v = content_get('images', $slot, $shipped);
    return preg_match('#^assets/img/[A-Za-z0-9._/\-]+$#', $v) ? $v : $shipped;
}

/** Escaped contact field. */
function contact(string $key): string
{
    $d = contact_fields()[$key]['default'] ?? '';
    return rich(content_get('contact', $key, $d));
}

/** Contact field unescaped, for building href values. */
function contact_raw(string $key): string
{
    return content_get('contact', $key, contact_fields()[$key]['default'] ?? '');
}

/** Image path for a slot, falling back to the shipped photo. */
function img_src(string $key, string $default): string
{
    $v = content_get('images', $key, $default);
    // only ever serve something inside assets/img
    if (!preg_match('#^assets/img/[A-Za-z0-9._/\-]+$#', $v)) {
        $v = $default;
    }
    return e($v);
}

/** htmlspecialchars with sane flags. */
function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * The whole editing format, in two rules:
 *
 *     a new line   ->  a line break
 *     *a word*     ->  that word in gold
 *
 * That is all of it. No HTML is required and none is honoured: the text is
 * escaped first, so anything that looks like a tag - a <script>, an onclick,
 * a stray < - is shown as plain text and cannot alter the page.
 */
function rich(string $s): string
{
    $out = e(content_plain($s));
    // Gold. The stars must hug the words - "2 * 3 * 4" is arithmetic, not
    // formatting - and may not span a line break, so a lone star is harmless.
    $out = preg_replace('/\*(\S[^*\r\n]{0,118}\S|\S)\*/u', '<em class="metal">$1</em>', $out) ?? $out;

    return str_replace("\n", '<br />', $out);
}

/**
 * Bring a stored value into the plain format, so the editor shows the owner
 * readable text rather than markup. Anything saved before the panel dropped
 * HTML still carries <br> and <em class="metal">; those are translated here
 * instead of being put in front of the owner as raw tags.
 */
function content_plain(string $s): string
{
    $s = preg_replace('#<em\s+class=["\']metal["\']\s*>(.*?)</em>#is', '*$1*', $s) ?? $s;
    $s = preg_replace('#</?(em|strong)\s*>#i', '', $s) ?? $s;
    $s = preg_replace('#<br\s*/?>#i', "\n", $s) ?? $s;
    $s = html_entity_decode($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    return str_replace(["\r\n", "\r"], "\n", $s);
}

/** The plain text behind a key, for the editor to put in its box. */
function content_plain_value(string $section, string $key, string $default = ''): string
{
    return content_plain(content_get($section, $key, $default));
}

/** tel: href built from a displayed phone number. */
function tel_href(string $display): string
{
    $digits = preg_replace('/[^0-9+]/', '', $display) ?? '';
    return e($digits);
}

/** Cache-busting stamp for assets, bumped when the stylesheet changes. */
const ASSET_V = '20261112';
