<?php
declare(strict_types=1);
/**
 * Replace the photographs used across the site.
 *
 * Uploads are re-encoded server-side rather than stored as sent: that strips
 * anything hidden in the file, and it forces the 1200x1000 ratio the layout
 * expects, so a portrait phone photo cannot break the grid.
 *
 * They are written to assets/img/uploads/, which Git does not track. Saving
 * them next to the shipped photos would risk a deploy overwriting them.
 */

require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/store.php';
require_once __DIR__ . '/_layout.php';

admin_require();

const UPLOAD_DIR = __DIR__ . '/../assets/img/uploads';
const UPLOAD_REL = 'assets/img/uploads';
const TARGET_W   = 1200;
const TARGET_H   = 1000;
const MAX_BYTES  = 12 * 1024 * 1024;

$slots = image_fields();

/** Re-encode an upload to a cover-cropped 1200x1000 JPEG. Returns a message on failure. */
function ingest(array $file, string $slot): array
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return [null, 'Upload failed. The file may be larger than the server allows.'];
    }
    if ($file['size'] > MAX_BYTES) {
        return [null, 'That image is larger than 12 MB.'];
    }
    if (!is_uploaded_file($file['tmp_name'])) {
        return [null, 'That upload could not be read.'];
    }

    $info = @getimagesize($file['tmp_name']);
    if ($info === false) {
        return [null, 'That file is not an image.'];
    }
    $src = match ($info[2]) {
        IMAGETYPE_JPEG => @imagecreatefromjpeg($file['tmp_name']),
        IMAGETYPE_PNG  => @imagecreatefrompng($file['tmp_name']),
        IMAGETYPE_WEBP => @imagecreatefromwebp($file['tmp_name']),
        default        => false,
    };
    if (!$src) {
        return [null, 'Use a JPG, PNG or WebP image.'];
    }

    $sw = imagesx($src);
    $sh = imagesy($src);
    // cover: fill the frame, crop the overflow, never squash
    $scale = max(TARGET_W / $sw, TARGET_H / $sh);
    $nw = (int) round($sw * $scale);
    $nh = (int) round($sh * $scale);
    $dx = (int) round((TARGET_W - $nw) / 2);
    $dy = (int) round((TARGET_H - $nh) / 2);

    $dst = imagecreatetruecolor(TARGET_W, TARGET_H);
    imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
    imagecopyresampled($dst, $src, $dx, $dy, 0, 0, $nw, $nh, $sw, $sh);
    imagedestroy($src);

    if (!is_dir(UPLOAD_DIR) && !@mkdir(UPLOAD_DIR, 0775, true) && !is_dir(UPLOAD_DIR)) {
        imagedestroy($dst);
        return [null, 'Could not create the uploads folder.'];
    }
    $name = $slot . '-' . date('Ymd-His') . '.jpg';
    $ok = imagejpeg($dst, UPLOAD_DIR . '/' . $name, 82);
    imagedestroy($dst);

    return $ok ? [UPLOAD_REL . '/' . $name, null] : [null, 'Could not save the image.'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        flash_set('bad', 'That form expired. Please try again.');
    } else {
        $slot = (string) ($_POST['slot'] ?? '');
        if (!isset($slots[$slot])) {
            flash_set('bad', 'Unknown image.');
        } elseif (isset($_POST['reset'])) {
            $data = store_read();
            unset($data['images'][$slot]);
            flash_set(store_write($data) ? 'good' : 'bad', 'Original photo restored.');
        } else {
            [$rel, $err] = ingest($_FILES['photo'] ?? [], $slot);
            if ($err !== null) {
                flash_set('bad', $err);
            } else {
                $data = store_read();
                $data['images'][$slot] = $rel;
                flash_set(store_write($data) ? 'good' : 'bad', 'Photo replaced. It is live on the website now.');
            }
        }
    }
    header('Location: /admin/images.php', true, 303);
    exit;
}

admin_head('Images');
flash_show();
?>
<h1>Images</h1>
<p class="muted">
  Replace any photograph on the site. Whatever you upload is resized and
  cropped to the correct shape automatically, so it will always fit the layout.
  JPG, PNG or WebP, up to 12&nbsp;MB.
</p>

<div class="img-grid">
  <?php foreach ($slots as $slot => $meta):
      $path = image_path($slot);
      $custom = $path !== 'assets/img/photos/' . $slot . '.jpg'; ?>
    <div class="img-card">
      <div class="thumb"><img src="/<?= e($path) ?>?t=<?= @filemtime(__DIR__ . '/../' . $path) ?: 0 ?>" alt="" /></div>
      <h3><?= e($meta['label']) ?></h3>
      <p class="where"><?= e($meta['page']) ?><?= $custom ? ' &middot; replaced' : '' ?></p>
      <form method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="slot" value="<?= e($slot) ?>" />
        <input type="file" name="photo" accept="image/jpeg,image/png,image/webp" required />
        <button class="btn small" type="submit">Replace</button>
      </form>
      <?php if ($custom): ?>
        <form method="post" class="reset">
          <?= csrf_field() ?>
          <input type="hidden" name="slot" value="<?= e($slot) ?>" />
          <button class="linkish" type="submit" name="reset" value="1">Restore original</button>
        </form>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>
<?php admin_foot();
