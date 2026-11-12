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
 * repeat it and the two can never drift apart. Output allows the handful of
 * inline tags the designs use; everything else is escaped.
 */
function t(string $key): string
{
    return rich(content_get('text', $key, content_default($key)));
}

/**
 * Text that is allowed to carry the small set of inline tags the designs use
 * (<br>, <em>, <strong>). Everything else is escaped, so a panel edit cannot
 * inject markup or script into a page.
 */
function t_rich(string $key, string $default = ''): string
{
    return rich(content_get('text', $key, $default));
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
        'address_line2'   => ['label' => 'Address line 2',  'default' => 'New Delhi &ndash; 110048, India'],
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
    // the shipped address carries an &ndash; entity, so allow entities through
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
 * Escape everything, then put back only what the copy legitimately uses:
 * <br>, <em>, <strong>, <em class="metal">, and HTML entities such as &amp;
 * and &ndash;. Restoring entities is safe because the pattern can only ever
 * produce an entity reference, never a tag. Anything else an editor types -
 * a <script>, an onclick, a stray < - stays escaped.
 */
function rich(string $s): string
{
    $out = e($s);
    $out = preg_replace('#&amp;([a-zA-Z][a-zA-Z0-9]{1,30}|\#[0-9]{1,6}|\#x[0-9a-fA-F]{1,5});#', '&$1;', $out) ?? $out;
    $out = preg_replace('#&lt;br\s*/?&gt;#i', '<br />', $out) ?? $out;
    $out = preg_replace('#&lt;(/?)(em|strong)&gt;#i', '<$1$2>', $out) ?? $out;
    $out = preg_replace('#&lt;em class=&quot;metal&quot;&gt;#i', '<em class="metal">', $out) ?? $out;
    return $out;
}

/** tel: href built from a displayed phone number. */
function tel_href(string $display): string
{
    $digits = preg_replace('/[^0-9+]/', '', $display) ?? '';
    return e($digits);
}

/** Cache-busting stamp for assets, bumped when the stylesheet changes. */
const ASSET_V = '20261112';
