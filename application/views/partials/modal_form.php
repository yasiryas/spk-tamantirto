<?php
$e = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$size = $size ?? '';
?>
<div class="modal fade" id="<?= $e($modalId); ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $e($modalId); ?>-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered <?= $e($size); ?>" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?= $e($modalId); ?>-title"><?= $e($title); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form method="post" action="<?= $e($action); ?>">
        <div class="modal-body">
          <?php foreach ($fields as $field): ?>
            <?php
            $name = $field['name'];
            $type = $field['type'] ?? 'text';
            $value = $field['value'] ?? '';
            $required = !empty($field['required']);
            $fieldId = $modalId . '-' . $name;
            $attributes = '';

            foreach (['list', 'placeholder', 'min', 'max', 'step'] as $attribute) {
                if (array_key_exists($attribute, $field)) {
                    $attributes .= ' ' . $attribute . '="' . $e($field[$attribute]) . '"';
                }
            }

            if ($type === 'hidden') {
                echo '<input type="hidden" name="' . $e($name) . '" value="' . $e($value) . '">';
                continue;
            }
            ?>
            <?php if ($type === 'checkbox'): ?>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="<?= $e($name); ?>" id="<?= $e($fieldId); ?>" value="1" <?= !empty($value) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="<?= $e($fieldId); ?>"><?= $e($field['label'] ?? 'Aktif'); ?></label>
              </div>
            <?php else: ?>
              <div class="form-group">
                <label class="form-label" for="<?= $e($fieldId); ?>"><?= $e($field['label'] ?? $name); ?></label>
                <?php if ($type === 'select'): ?>
                  <select class="custom-select" name="<?= $e($name); ?>" id="<?= $e($fieldId); ?>" <?= $required ? 'required' : ''; ?>>
                    <?php foreach ($field['options'] ?? [] as $optionValue => $optionLabel): ?>
                      <option value="<?= $e($optionValue); ?>" <?= (string) $optionValue === (string) $value ? 'selected' : ''; ?>><?= $e($optionLabel); ?></option>
                    <?php endforeach; ?>
                  </select>
                <?php elseif ($type === 'textarea'): ?>
                  <textarea class="form-control" name="<?= $e($name); ?>" id="<?= $e($fieldId); ?>" rows="3" <?= $required ? 'required' : ''; ?>><?= $e($value); ?></textarea>
                <?php else: ?>
                  <input class="form-control" type="<?= $e($type); ?>" name="<?= $e($name); ?>" id="<?= $e($fieldId); ?>" value="<?= $e($value); ?>" <?= $required ? 'required' : ''; ?><?= $attributes; ?>>
                <?php endif; ?>
                <?php if (!empty($field['help'])): ?><small class="form-text text-muted"><?= $e($field['help']); ?></small><?php endif; ?>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-gold">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
