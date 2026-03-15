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
<?php require BASE_PATH . '/src/views/Home/Organisms/HtmlHead.php'; ?>
<?php require BASE_PATH . '/src/views/Home/Organisms/SiteHeader.php'; ?>
<?php require BASE_PATH . '/src/views/Home/Organisms/MobileNav.php'; ?>
<?php require BASE_PATH . '/src/views/Home/Organisms/MainContent.php'; ?>
<?php require BASE_PATH . '/src/views/Home/Organisms/SiteFooter.php'; ?>
