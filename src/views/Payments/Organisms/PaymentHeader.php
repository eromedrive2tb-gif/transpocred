<?php
/**
 * src/views/Payments/Organisms/PaymentHeader.php
 */
// Normalize properties from either $props or $headerProps
$_props = $props ?? $headerProps ?? [];
?>
<div class="<?php echo $_props['class'] ?? 'header'; ?>">
    <?php if (isset($_props['onBack'])): ?>
        <div onclick="<?php echo $_props['onBack']; ?>" style="position:absolute; left:20px; cursor:pointer; color: #fff;">
            <i class="fas fa-arrow-left"></i>
        </div>
    <?php endif; ?>
    <img src="<?php echo $_props['logo'] ?? '/public/assets/vendor/images/transpoicon.png'; ?>" alt="Transprocred">
</div>