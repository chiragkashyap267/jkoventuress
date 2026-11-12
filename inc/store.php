<?php
declare(strict_types=1);
/**
 * Writes to the content file, keeping a timestamped backup of every save so a
 * bad edit is recoverable from inside the panel rather than by restoring the
 * whole site.
 */

require_once __DIR__ . '/content.php';

const BACKUPS_KEEP = 30;

function store_read(): array
{
    $base = ['contact' => [], 'text' => [], 'images' => []];
    if (!is_readable(CONTENT_FILE)) {
        return $base;
    }
    $d = json_decode((string) file_get_contents(CONTENT_FILE), true);
    if (!is_array($d)) {
        return $base;
    }
    foreach ($base as $k => $_) {
        if (isset($d[$k]) && is_array($d[$k])) {
            $base[$k] = $d[$k];
        }
    }
    return $base;
}

function store_write(array $data): bool
{
    if (!is_dir(DATA_DIR) && !@mkdir(DATA_DIR, 0775, true) && !is_dir(DATA_DIR)) {
        return false;
    }
    store_backup();

    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        return false;
    }
    // write to a temp file and rename, so a crash mid-write cannot leave the
    // site reading a half-written file
    $tmp = CONTENT_FILE . '.tmp';
    if (file_put_contents($tmp, $json, LOCK_EX) === false) {
        return false;
    }
    return rename($tmp, CONTENT_FILE);
}

function store_backup(): void
{
    if (!is_readable(CONTENT_FILE)) {
        return;
    }
    if (!is_dir(BACKUP_DIR) && !@mkdir(BACKUP_DIR, 0775, true) && !is_dir(BACKUP_DIR)) {
        return;
    }
    @copy(CONTENT_FILE, BACKUP_DIR . '/content-' . date('Ymd-His') . '.json');

    $all = glob(BACKUP_DIR . '/content-*.json') ?: [];
    if (count($all) > BACKUPS_KEEP) {
        sort($all);
        foreach (array_slice($all, 0, count($all) - BACKUPS_KEEP) as $old) {
            @unlink($old);
        }
    }
}

/** Newest first. */
function store_backups(): array
{
    $all = glob(BACKUP_DIR . '/content-*.json') ?: [];
    rsort($all);
    return $all;
}

function store_restore(string $name): bool
{
    // only ever a bare backup filename from our own directory
    if (!preg_match('/^content-\d{8}-\d{6}\.json$/', $name)) {
        return false;
    }
    $path = BACKUP_DIR . '/' . $name;
    if (!is_readable($path)) {
        return false;
    }
    $d = json_decode((string) file_get_contents($path), true);
    if (!is_array($d)) {
        return false;
    }
    return store_write($d);
}

/**
 * Save one section. Values equal to the shipped default are dropped rather
 * than stored, so the file stays small and "reset" just means clearing a box.
 */
function store_update_section(string $section, array $values, callable $defaultFor): bool
{
    $data = store_read();
    $clean = [];
    foreach ($values as $key => $val) {
        if (!is_string($val)) {
            continue;
        }
        $val = trim(preg_replace('/\R/u', ' ', $val) ?? '');
        $val = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $val) ?? '';

        // The editor shows entities decoded (& rather than &amp;), so compare
        // decoded on both sides - otherwise saving an untouched field would
        // store an "override" identical to the original.
        $dec = static fn(string $x): string => html_entity_decode($x, ENT_QUOTES, 'UTF-8');
        if ($val === '' || $dec($val) === $dec($defaultFor((string) $key))) {
            continue;                       // back to shipped text
        }
        $clean[(string) $key] = mb_substr($val, 0, 2000);
    }
    $data[$section] = $clean;
    return store_write($data);
}
