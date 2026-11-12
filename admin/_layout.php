<?php
declare(strict_types=1);
/** Shared chrome for every admin screen. */

function admin_head(string $title, bool $nav = true): void
{
    $cur = basename($_SERVER['SCRIPT_NAME'] ?? '');
    ?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="noindex, nofollow" />
<title><?= e($title) ?> — J&amp;Ko Ventures</title>
<link rel="icon" href="/assets/img/favicon.ico" sizes="any" />
<link rel="stylesheet" href="/admin/admin.css?v=<?= ASSET_V ?>" />
</head>
<body>
<header class="bar">
  <a class="brand" href="/admin/dashboard.php">
    <img src="/assets/img/logo-mark.png" alt="" width="36" height="36" />
    <span>Website Admin</span>
  </a>
<?php if ($nav): ?>
  <nav>
    <a href="/admin/dashboard.php"<?= $cur === 'dashboard.php' ? ' class="on"' : '' ?>>Overview</a>
    <a href="/admin/contact.php"<?= $cur === 'contact.php' ? ' class="on"' : '' ?>>Contact details</a>
    <a href="/admin/text.php"<?= $cur === 'text.php' ? ' class="on"' : '' ?>>Page text</a>
    <a href="/admin/images.php"<?= $cur === 'images.php' ? ' class="on"' : '' ?>>Images</a>
    <a href="/" target="_blank" rel="noopener">View site &#8599;</a>
    <a class="out" href="/admin/logout.php">Sign out</a>
  </nav>
<?php endif; ?>
</header>
<main class="wrap">
<?php
}

function admin_foot(): void
{
    ?>
</main>
<footer class="foot">J&amp;Ko Ventures &middot; changes appear on the website immediately after saving.</footer>
</body>
</html><?php
}

function flash_set(string $kind, string $msg): void
{
    admin_session_start();
    $_SESSION['flash'] = ['kind' => $kind, 'msg' => $msg];
}

function flash_show(): void
{
    admin_session_start();
    if (empty($_SESSION['flash'])) {
        return;
    }
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    printf('<p class="flash %s">%s</p>', e($f['kind']), e($f['msg']));
}
