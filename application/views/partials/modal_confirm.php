<?php
$e = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<div class="modal fade" id="<?= $e($modalId); ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $e($modalId); ?>-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?= $e($modalId); ?>-title"><?= $e($title); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body"><p class="modal-text mb-0"><?= $e($message); ?></p></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Batal</button>
        <form method="post" action="<?= $e($action); ?>">
          <button type="submit" class="btn btn-danger-soft">Ya, lanjutkan</button>
        </form>
      </div>
    </div>
  </div>
</div>
