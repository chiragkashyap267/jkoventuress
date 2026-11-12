<?php
declare(strict_types=1);
/** Edit the business contact details shown in the footer and on the contact page. */

require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/store.php';
require_once __DIR__ . '/_layout.php';

admin_require();

$fields = contact_fields();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        flash_set('bad', 'That form expired. Please try again.');
    } else {
        $posted = is_array($_POST['f'] ?? null) ? $_POST['f'] : [];
        $vals = [];
        foreach ($fields as $key => $_) {
            $vals[$key] = (string) ($posted[$key] ?? '');
        }
        $ok = store_update_section(
            'contact',
            $vals,
            static fn(string $k): string => (string) (contact_fields()[$k]['default'] ?? '')
        );
        flash_set($ok ? 'good' : 'bad', $ok
            ? 'Contact details saved. They are live on the website now.'
            : 'Could not save. Check that the data folder is writable.');
    }
    header('Location: /admin/contact.php', true, 303);
    exit;
}

$current = store_read()['contact'] ?? [];

admin_head('Contact details');
flash_show();
?>
<h1>Contact details</h1>
<p class="muted">
  These appear in the footer of every page and on the contact page. Leave a box
  empty to restore the original wording shown beneath it.
</p>

<form method="post" class="card">
  <?= csrf_field() ?>
  <?php foreach ($fields as $key => $f): ?>
    <div class="field">
      <label for="f-<?= e($key) ?>"><?= e($f['label']) ?></label>
      <input id="f-<?= e($key) ?>" name="f[<?= e($key) ?>]" type="text"
             value="<?= e(html_entity_decode((string) ($current[$key] ?? $f['default']), ENT_QUOTES, 'UTF-8')) ?>" />
      <span class="hint">Original: <?= e(html_entity_decode($f['default'], ENT_QUOTES, 'UTF-8')) ?></span>
    </div>
  <?php endforeach; ?>

  <div class="actions">
    <button class="btn" type="submit">Save changes</button>
    <a class="btn ghost" href="/contact" target="_blank" rel="noopener">Preview contact page</a>
  </div>
</form>

<p class="note">
  Changing the main email also changes where enquiries from the website form
  are delivered.
</p>
<?php admin_foot();
