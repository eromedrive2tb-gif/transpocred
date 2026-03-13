<?php
/**
 * src/views/Payments/Atoms/Input.php
 */
?>
<div class="form-group" <?php echo isset($props['wrapperStyle']) ? "style='{$props['wrapperStyle']}'" : ""; ?>>
    <label>
        <?php echo $props['label']; ?>
    </label>
    <input type="<?php echo $props['type'] ?? 'text'; ?>" id="<?php echo $props['id']; ?>"
        value="<?php echo htmlspecialchars($props['value'] ?? ''); ?>"
        placeholder="<?php echo $props['placeholder'] ?? ''; ?>" <?php echo isset($props['maxlength']) ? "maxlength='{$props['maxlength']}'" : ""; ?>
    <?php echo isset($props['onkeyup']) ? "onkeyup='{$props['onkeyup']}'" : ""; ?>
    >
</div>