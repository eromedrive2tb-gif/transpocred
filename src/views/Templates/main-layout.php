<?php
/**
 * Template: main-layout.php
 * Orquestrador do layout principal. Define a ordem de composição dos Organisms.
 * Recebe $viewData e distribui via extract() para cada Organism.
 * Atomic Design — Refactor Clean Architecture
 */

// Disponibiliza $isLoggedIn e $username para todos os partials incluídos
extract($viewData, EXTR_SKIP);
?>
<?php require BASE_PATH . '/src/views/Organisms/HtmlHead.php'; ?>
<?php require BASE_PATH . '/src/views/Organisms/SiteHeader.php'; ?>
<?php require BASE_PATH . '/src/views/Organisms/MobileNav.php'; ?>
<?php require BASE_PATH . '/src/views/Organisms/MainContent.php'; ?>
<?php require BASE_PATH . '/src/views/Organisms/SiteFooter.php'; ?>
