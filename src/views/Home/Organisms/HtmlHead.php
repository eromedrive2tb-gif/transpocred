<?php
/**
 * Organism: HtmlHead — composição pura do <head> da página.
 *
 * Responsabilidade única: ordenar e incluir os componentes atômicos que formam o <head>.
 * Não contém HTML direto — apenas orquestra requires.
 * Recebe: $isLoggedIn (boolean) — repassado exclusivamente ao AuthInterceptor.
 *
 * Atomic Design — Refactor Clean Architecture
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]--><!--[if IE 8]> <html class="no-js lt-ie10 lt-ie9"> <![endif]--><!--[if IE 9]> <html class="no-js lt-ie10"> <![endif]--><!--[if gt IE 9]><!-->
<html class="no-js" dir="ltr" lang="pt-BR" prefix="og: https://ogp.me/ns#"><!--<![endif]-->

<head>
	<?php require BASE_PATH . '/src/views/Home/Atoms/Scripts/GtmScript.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Atoms/Meta/BaseMeta.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Molecules/Auth/AuthInterceptor.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Molecules/Seo/SeoMeta.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Atoms/Styles/WpImageContain.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Molecules/Social/OpenGraphMeta.php'; ?>
	<?php require BASE_PATH . '/src/views/Home/Molecules/Social/TwitterCardMeta.php'; ?>
	<?php require BASE_PATH . '/src/views/Home/Molecules/Seo/SchemaJsonLd.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Atoms/Styles/WpClassicTheme.php'; ?>
	<?php require BASE_PATH . '/src/views/Home/Atoms/Styles/WpGlobalStyles.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Atoms/Styles/ExternalStyles.php'; ?>
	<?php require BASE_PATH . '/src/views/Home/Atoms/Styles/WpCustomCss.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Atoms/Scripts/JqueryScripts.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Atoms/Styles/AeData.php'; ?>
	<?php require BASE_PATH . '/src/views/Home/Atoms/Styles/ElementorLazyload.php'; ?>
	<?php require BASE_PATH . '/src/views/Home/Atoms/Styles/MegaMenuDisabled.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Atoms/Scripts/ApiScript.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Atoms/Scripts/RuxitAgent.php'; ?>

	<?php require BASE_PATH . '/src/views/Home/Atoms/Scripts/OneTrust.php'; ?>
</head>