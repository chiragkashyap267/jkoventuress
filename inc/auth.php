<?php
declare(strict_types=1);
/**
 * J&Ko Ventures — admin authentication
 *
 * One owner account. The password is set on first visit and stored only as a
 * hash, so it never exists in the repository or in any file I can read back.
 * There is no email reset flow on purpose: for a single-user panel that is a
 * whole category of attack surface in exchange for very little. If the
 * password is lost, delete data/admin.json and set it again.
 */

require_once __DIR__ . '/content.php';

const ADMIN_FILE    = DATA_DIR . '/admin.json';
const LOGIN_WINDOW  = 900;   // seconds that failed attempts are remembered
const LOGIN_MAX     = 6;     // attempts allowed inside that window

function admin_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'path'     => '/',
    ]);
    session_name('jkoadmin');
    session_start();
}

function admin_record(): array
{
    if (!is_readable(ADMIN_FILE)) {
        return [];
    }
    $d = json_decode((string) file_get_contents(ADMIN_FILE), true);
    return is_array($d) ? $d : [];
}

function admin_save(array $rec): bool
{
    if (!is_dir(DATA_DIR)) {
        @mkdir(DATA_DIR, 0775, true);
    }
    $json = json_encode($rec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    return $json !== false && file_put_contents(ADMIN_FILE, $json, LOCK_EX) !== false;
}

/** True before anyone has set a password - the panel shows setup instead. */
function admin_needs_setup(): bool
{
    $r = admin_record();
    return empty($r['hash']);
}

function admin_set_password(string $password): bool
{
    $rec = admin_record();
    $rec['hash']    = password_hash($password, PASSWORD_DEFAULT);
    $rec['created'] = $rec['created'] ?? date('c');
    $rec['updated'] = date('c');
    return admin_save($rec);
}

/** Throttle: how many failures are on record inside the window. */
function admin_recent_failures(): int
{
    $rec  = admin_record();
    $fails = $rec['failures'] ?? [];
    $cut  = time() - LOGIN_WINDOW;
    return count(array_filter($fails, static fn($t) => (int) $t > $cut));
}

function admin_note_failure(): void
{
    $rec   = admin_record();
    $fails = array_filter(($rec['failures'] ?? []), static fn($t) => (int) $t > time() - LOGIN_WINDOW);
    $fails[] = time();
    $rec['failures'] = array_values($fails);
    admin_save($rec);
}

function admin_clear_failures(): void
{
    $rec = admin_record();
    unset($rec['failures']);
    admin_save($rec);
}

function admin_login(string $password): bool
{
    $rec = admin_record();
    if (empty($rec['hash']) || !password_verify($password, $rec['hash'])) {
        admin_note_failure();
        return false;
    }
    admin_clear_failures();
    session_regenerate_id(true);           // no fixation
    $_SESSION['admin'] = true;
    $_SESSION['since'] = time();
    return true;
}

function admin_logged_in(): bool
{
    return !empty($_SESSION['admin']);
}

/** Drop anything that is not a logged-in session back to the login screen. */
function admin_require(): void
{
    admin_session_start();
    if (!admin_logged_in()) {
        header('Location: /admin/', true, 302);
        exit;
    }
}

function admin_logout(): void
{
    admin_session_start();
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

/* ---------- CSRF ---------- */

function csrf_token(): string
{
    admin_session_start();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '" />';
}

function csrf_check(): bool
{
    $sent = $_POST['_csrf'] ?? '';
    return is_string($sent) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $sent);
}
