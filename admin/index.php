<?php
declare(strict_types=1);
/** Login, and first-run password setup. */

require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/_layout.php';

admin_session_start();

if (admin_logged_in()) {
    header('Location: /admin/dashboard.php', true, 302);
    exit;
}

$setup  = admin_needs_setup();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $errors[] = 'That form expired. Please try again.';
    } elseif ($setup) {
        $pw  = (string) ($_POST['password'] ?? '');
        $pw2 = (string) ($_POST['password2'] ?? '');
        if (mb_strlen($pw) < 10) {
            $errors[] = 'Use at least 10 characters.';
        } elseif ($pw !== $pw2) {
            $errors[] = 'The two passwords do not match.';
        } elseif (!admin_set_password($pw)) {
            $errors[] = 'Could not save the password. Check that the data folder is writable.';
        } else {
            admin_login($pw);
            header('Location: /admin/dashboard.php', true, 302);
            exit;
        }
    } else {
        if (admin_recent_failures() >= LOGIN_MAX) {
            $errors[] = 'Too many attempts. Wait 15 minutes and try again.';
        } elseif (admin_login((string) ($_POST['password'] ?? ''))) {
            header('Location: /admin/dashboard.php', true, 302);
            exit;
        } else {
            $errors[] = 'That password is not right.';
        }
    }
}

admin_head($setup ? 'Set a password' : 'Sign in', false);
?>
<div class="login">
  <img class="login-logo" src="/assets/img/logo-full.png" alt="J&amp;Ko Ventures" width="960" height="960" />

  <?php if ($setup): ?>
    <h1>Set your password</h1>
    <p class="muted">
      Nobody has set one yet. Choose a password now &mdash; it is stored only as a
      hash, so it cannot be read back by anyone, including whoever built this.
    </p>
  <?php else: ?>
    <h1>Sign in</h1>
    <p class="muted">Enter the password to manage the website content.</p>
  <?php endif; ?>

  <?php foreach ($errors as $err): ?>
    <p class="flash bad"><?= e($err) ?></p>
  <?php endforeach; ?>

  <form method="post" autocomplete="off">
    <?= csrf_field() ?>
    <label for="pw"><?= $setup ? 'New password' : 'Password' ?></label>
    <input id="pw" name="password" type="password" required autofocus
           minlength="<?= $setup ? 10 : 1 ?>" autocomplete="<?= $setup ? 'new-password' : 'current-password' ?>" />
    <?php if ($setup): ?>
      <label for="pw2">Repeat password</label>
      <input id="pw2" name="password2" type="password" required minlength="10" autocomplete="new-password" />
    <?php endif; ?>
    <button class="btn" type="submit"><?= $setup ? 'Save password' : 'Sign in' ?></button>
  </form>
</div>
<?php admin_foot();
