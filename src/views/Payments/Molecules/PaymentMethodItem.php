<?php
/**
 * src/views/Payments/Molecules/PaymentMethodItem.php
 */
?>
<div class="method-item" onclick="<?php echo $props['onclick']; ?>">
    <div class="method-icon"><i class="fas <?php echo $props['icon']; ?>"></i></div>
    <div class="method-info">
        <b>
            <?php echo $props['title']; ?>
        </b>
        <span>
            <?php echo $props['subtitle']; ?>
        </span>
    </div>
    <i class="fas fa-chevron-right" style="margin-left:auto; color:#ccc;"></i>
</div>