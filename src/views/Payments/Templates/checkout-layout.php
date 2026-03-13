<?php
/**
 * src/views/Payments/Templates/checkout-layout.php
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $props['title'] ?? 'Checkout Seguro'; ?>
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Proxima Nova:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/public/assets/css/checkout.css">
</head>

<body>
    <?php echo $props['content']; ?>

    <?php if (isset($props['modals'])): ?>
        <?php echo $props['modals']; ?>
    <?php endif; ?>

    <?php if (isset($props['scripts'])): ?>
        <?php echo $props['scripts']; ?>
    <?php endif; ?>
</body>

</html>