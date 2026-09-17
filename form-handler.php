<?php
declare(strict_types=1);
/**
 * J&Ko Ventures — enquiry form handler
 *
 * Receives the contact form, validates it, emails the enquiry and sends the
 * visitor back to contact.html with a status flag.
 *
 * ---------------------------------------------------------------------------
 * SETTINGS — update these two lines once the real address exists.
 * ---------------------------------------------------------------------------
 */
$TO_ADDRESS   = 'hello@jkoventuress.com';  // where enquiries are delivered
$SITE_DOMAIN  = 'jkoventuress.com';        // used to build the envelope sender
$FROM_ADDRESS = '';                        // leave empty to use noreply@<site domain>

/* Optional: also append every enquiry to enquiries.log (protected by .htaccess) */
$KEEP_LOG = true;

// ---------------------------------------------------------------------------

const REDIRECT = 'contact.html';

/** Send the visitor back to the form with a status flag and stop. */
function finish(string $status): void
{
    header('Location: ' . REDIRECT . '?status=' . rawurlencode($status) . '#enquiry-form', true, 303);
    exit;
}

/** Read a POST field as a trimmed, header-injection-safe single line. */
function field(string $key, bool $multiline = false): string
{
    $raw = isset($_POST[$key]) && is_string($_POST[$key]) ? $_POST[$key] : '';
    $raw = trim($raw);
    if ($raw === '') {
        return '';
    }
    // Normalise newlines; collapse them entirely for single-line fields so that
    // nothing can smuggle extra mail headers through the subject or Reply-To.
    $raw = str_replace(["\r\n", "\r"], "\n", $raw);
    if (!$multiline) {
        $raw = str_replace("\n", ' ', $raw);
    }
    $raw = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $raw) ?? '';

    $limit = $multiline ? 5000 : 300;

    return function_exists('mb_substr') ? mb_substr($raw, 0, $limit) : substr($raw, 0, $limit);
}

// --- only accept a real POST ------------------------------------------------

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    // Someone opened the handler directly — just send them to the form.
    header('Location: ' . REDIRECT, true, 303);
    exit;
}

// --- spam traps -------------------------------------------------------------

// 1. Honeypot: a field hidden from people but filled in by naive bots.
if (field('website') !== '') {
    finish('sent'); // silently pretend it worked
}

// 2. Submitted implausibly fast? Almost certainly automated.
$startedAt = (int) (field('started_at') ?: 0);
if ($startedAt > 0 && (time() - intdiv($startedAt, 1000)) < 3) {
    finish('sent');
}

// --- collect + validate -----------------------------------------------------

$name        = field('name');
$company     = field('company');
$email       = field('email');
$phone       = field('phone');
$requirement = field('requirement');
$quantity    = field('quantity');
$timeline    = field('timeline');
$message     = field('message', true);

if ($name === '' || $email === '') {
    finish('missing');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    finish('bademail');
}
if ($message === '' && $requirement === '') {
    finish('missing');
}

// --- compose ----------------------------------------------------------------

/* Build the sender from our own configured domain, never from the Host header
   (which the client controls and could point at someone else's domain). */
if ($FROM_ADDRESS === '') {
    $FROM_ADDRESS = 'noreply@' . preg_replace('/^www\./', '', $SITE_DOMAIN);
}

/* Encode the visitor's name for the Reply-To display slot, and strip the
   characters that would otherwise break the address out of its angle brackets.
   Newlines are already gone, so header injection is not possible here. */
$replyName = preg_replace('/["<>\\\\,;:]/', '', $name) ?? '';
$replyTo = $replyName !== ''
    ? '=?UTF-8?B?' . base64_encode($replyName) . '?= <' . $email . '>'
    : $email;

$subject = 'Gifting enquiry — ' . ($company !== '' ? $company : $name);

$rows = [
    'Name'        => $name,
    'Company'     => $company !== '' ? $company : '—',
    'Email'       => $email,
    'Phone'       => $phone !== '' ? $phone : '—',
    'Requirement' => $requirement !== '' ? $requirement : '—',
    'Quantity'    => $quantity !== '' ? $quantity : '—',
    'Required by' => $timeline !== '' ? $timeline : '—',
];

$body = "New enquiry from the J&Ko Ventures website\n";
$body .= str_repeat('-', 52) . "\n\n";
foreach ($rows as $label => $value) {
    $body .= sprintf("%-14s %s\n", $label . ':', $value);
}
$body .= "\nDetails:\n" . ($message !== '' ? $message : '—') . "\n\n";
$body .= str_repeat('-', 52) . "\n";
$body .= 'Submitted: ' . date('d M Y, H:i') . "\n";
$body .= 'Source: ' . $SITE_DOMAIN . "\n";

$headers = [
    'From: "J&Ko Ventures Website" <' . $FROM_ADDRESS . '>',
    'Reply-To: ' . $replyTo,
    'Content-Type: text/plain; charset=UTF-8',
    'MIME-Version: 1.0',
];

$sent = @mail(
    $TO_ADDRESS,
    '=?UTF-8?B?' . base64_encode($subject) . '?=',
    $body,
    implode("\r\n", $headers),
    '-f' . $FROM_ADDRESS
);

// --- optional local copy ----------------------------------------------------

if ($KEEP_LOG) {
    $line = sprintf(
        "[%s] %s | %s | %s | %s | qty:%s | by:%s | %s | mail:%s\n",
        date('c'),
        $name,
        $company,
        $email,
        $requirement,
        $quantity,
        $timeline,
        str_replace("\n", ' / ', $message),
        $sent ? 'ok' : 'FAILED'
    );
    @file_put_contents(__DIR__ . '/enquiries.log', $line, FILE_APPEND | LOCK_EX);
}

finish($sent ? 'sent' : 'error');
