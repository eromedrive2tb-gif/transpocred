<?php
/**
 * src/views/Payments/Atoms/Button.php
 */
?>
<button class="btn-<?php echo $props['type'] ?? 'blue'; ?> <?php echo $props['class'] ?? ''; ?>"
    onclick="<?php echo $props['onclick'] ?? ''; ?>" <?php echo isset($props['style']) ? "style='{$props['style']}'" : ""; ?>
    >
    <?php echo $props['label']; ?>
</button>