<?php
declare(strict_types=1);
/** Edit the headings and intro paragraphs on each page. */

require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/store.php';
require_once __DIR__ . '/../inc/fields.php';
require_once __DIR__ . '/_layout.php';

admin_require();

$all = content_fields();

/* group by page, preserving manifest order */
$pages = [];
foreach ($all as $key => $f) {
    $pages[$f['page']][$key] = $f;
}

$slug = (string) ($_GET['page'] ?? array_key_first($pages));
if (!isset($pages[$slug])) {
    $slug = array_key_first($pages);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        flash_set('bad', 'That form expired. Please try again.');
    } else {
        // keep every other page's overrides, replace only the posted ones
        // field names are posted as f[key]: PHP rewrites dots in plain POST
        // names to underscores, which would silently drop every key here
        $posted   = is_array($_POST['f'] ?? null) ? $_POST['f'] : [];
        $existing = store_read()['text'] ?? [];
        foreach ($all as $key => $f) {
            if (array_key_exists($key, $posted)) {
                $existing[$key] = (string) $posted[$key];
            }
        }
        $ok = store_update_section(
            'text',
            $existing,
            static fn(string $k): string => content_default($k)
        );
        flash_set($ok ? 'good' : 'bad', $ok
            ? 'Page text saved. It is live on the website now.'
            : 'Could not save. Check that the data folder is writable.');
    }
    header('Location: /admin/text.php?page=' . rawurlencode($slug), true, 303);
    exit;
}

$current = store_read()['text'] ?? [];
$viewUrl = [
    'Home' => '/', 'About' => '/about', 'Gifting Solutions' => '/services',
    'Occasions' => '/occasions', 'Our Approach' => '/approach',
    'Why Us' => '/why-us', 'Contact' => '/contact', 'Not Found' => '/404',
][$slug] ?? '/';

admin_head('Page text');
flash_show();
?>
<h1>Page text</h1>
<p class="muted">
  Headings and intro paragraphs, in the order they appear down the page. Clear a
  box to put the original wording back.
</p>

<div class="tabs">
  <?php foreach (array_keys($pages) as $p): ?>
    <a href="/admin/text.php?page=<?= rawurlencode($p) ?>"<?= $p === $slug ? ' class="on"' : '' ?>><?= e($p) ?></a>
  <?php endforeach; ?>
</div>

<form method="post" class="card">
  <?= csrf_field() ?>
  <?php foreach ($pages[$slug] as $key => $f): ?>
    <div class="field">
      <label for="f-<?= e($key) ?>"><?= e($f['label']) ?></label>
      <?php
        // The owner edits plain readable text. Headings keep a box they can
        // press Enter in, because a new line there is a line break on the page.
        $val  = content_plain((string) ($current[$key] ?? $f['default']));
        $rows = $f['type'] === 'textarea' ? 3 : 2;
      ?>
      <?php if ($f['type'] === 'text'): ?>
        <input id="f-<?= e($key) ?>" name="f[<?= e($key) ?>]" type="text" value="<?= e($val) ?>" />
      <?php else: ?>
        <textarea id="f-<?= e($key) ?>" name="f[<?= e($key) ?>]" rows="<?= $rows ?>"><?= e($val) ?></textarea>
      <?php endif; ?>
      <span class="hint">Original: <?= nl2br(e(content_plain($f['default'])), false) ?></span>
    </div>
  <?php endforeach; ?>

  <div class="actions">
    <button class="btn" type="submit">Save <?= e($slug) ?></button>
    <a class="btn ghost" href="<?= e($viewUrl) ?>" target="_blank" rel="noopener">Preview page</a>
  </div>
</form>

<p class="note">
  Just write normally. Two things are worth knowing:
  press <strong>Enter</strong> to start a new line, and put
  <strong>*stars*</strong> around a word to show it in gold &mdash; like
  <strong>*Customised*</strong>. Everything else you type appears exactly as
  written, so nothing here can break the page.
</p>
<?php admin_foot();
