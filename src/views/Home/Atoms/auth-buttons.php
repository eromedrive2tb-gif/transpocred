<?php
/**
 * Atom: Botões de autenticação do header. Zero lógica de negócio. Recebe $isLoggedIn e $username.
 * Atomic Design — Refactor Clean Architecture
 */
?>
<?php if ($isLoggedIn): ?>
    <span style="color: #00d084; font-weight: 600; margin-right: 15px;">Olá, <?= $username ?></span>
    <a class="remove-target" href="dashboard.php" style="margin-right: 15px; font-weight: 600; color: #007d89;">Ver Informações</a>
    <a class="remove-target" href="auth.php?action=logout" style="color: #ff4757;">Sair</a>
<?php else: ?>
    <a class="remove-target" href="login.php">Acessar sua conta</a>
<?php endif; ?>
