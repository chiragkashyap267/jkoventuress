<?php
declare(strict_types=1);
/** Landing screen: what can be changed, and how to undo a change. */

require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/store.php';
require_once __DIR__ . '/../inc/fields.php';
require_once __DIR__ . '/_layout.php';

admin_require();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['restore'])) {
    if (!csrf_check()) {
        flash_set('bad', 'That form expired. Please try again.');
    } else {
        $ok = store_restore((string) $_POST['restore']);
        flash_set($ok ? 'good' : 'bad', $ok ? 'Restored that version.' : 'Could not restore that version.');
    }
    header('Location: /admin/dashboard.php', true, 303);
    exit;
}

$data   = store_read();
$counts = [
    'contact' => count($data['contact'] ?? []),
    'text'    => count($data['text'] ?? []),
    'images'  => count($data['images'] ?? []),
];
$backups = array_slice(store_backups(), 0, 10);

admin_head('Overview');
flash_show();
?>
<h1>What you can change</h1>

<div class="cards">
  <a class="card tile" href="/admin/contact.php">
    <h3>Contact details</h3>
    <p>Emails, phone numbers, address and founder name. Used in the footer of every page and on the contact page.</p>
    <span class="tag"><?= $counts['contact'] ?> changed</span>
  </a>
  <a class="card tile" href="/admin/text.php">
    <h3>Page text</h3>
    <p>Headings and intro paragraphs across all <?= count(array_unique(array_column(content_fields(), 'page'))) ?> pages.</p>
    <span class="tag"><?= $counts['text'] ?> changed</span>
  </a>
  <a class="card tile" href="/admin/images.php">
    <h3>Images</h3>
    <p>Replace any of the <?= count(image_fields()) ?> photographs. Cropping and sizing are handled for you.</p>
    <span class="tag"><?= $counts['images'] ?> changed</span>
  </a>
</div>

<h2>Undo a change</h2>
<p class="muted">Every save keeps a copy first. Restoring puts everything back to how it was at that moment.</p>

<?php if (!$backups): ?>
  <p class="note">No saves yet.</p>
<?php else: ?>
  <table class="backups">
    <?php foreach ($backups as $b):
        $n = basename($b);
        $when = DateTime::createFromFormat('Ymd-His', substr($n, 8, 15)); ?>
      <tr>
        <td><?= e($when ? $when->format('j M Y, H:i') : $n) ?></td>
        <td class="right">
          <form method="post" onsubmit="return confirm('Put the website back to how it was at this point?');">
            <?= csrf_field() ?>
            <button class="linkish" type="submit" name="restore" value="<?= e($n) ?>">Restore</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

<p class="note">
  Design, colours, the logo and the menu are not editable here on purpose &mdash;
  they are part of the brand and changing them through a form is the easiest way
  to break the site. Ask your developer for those.
</p>
<?php admin_foot();
