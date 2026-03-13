<?php require_once 'auth.php'; 
// Se já estiver logado, redireciona direto para o dashboard
if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]--><!--[if IE 8]> <html class="no-js lt-ie10 lt-ie9"> <![endif]--><!--[if IE 9]> <html class="no-js lt-ie10"> <![endif]--><!--[if gt IE 9]><!-->
<html class="no-js" dir="ltr" lang="pt-BR" prefix="og: https://ogp.me/ns#"><!--<![endif]-->

<head>
	<!-- Google Tag Manager -->
	<script>
		(function (w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-M3DZ2F');
	</script>
	<!-- End Google Tag Manager -->
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, maximum-scale=5">
    <script>
        const isUserLoggedIn = <?php echo isLoggedIn() ? 'true' : 'false'; ?>;
        if (!isUserLoggedIn) {
            document.addEventListener('click', function(e) {
                const target = e.target.closest('a:not(.remove-target), button:not(.remove-target)');
                if (target) {
                    const href = target.getAttribute('href');
                    const bypass = ['login.php', 'auth.php', 'register.php'];
                    
                    if (href && bypass.some(b => href.includes(b))) return;
                    if (target.id === 'switch-mode') return;
                    
                    e.preventDefault();
                    window.location.href = 'login.php';
                }
            });

            document.addEventListener('submit', function(e) {
                if (e.target.id === 'auth-form' || e.target.id === 'search-form-header') return;
                e.preventDefault();
                window.location.href = 'login.php';
            });
        }
    </script>

	<title>Cartões de Crédito Especiais – Adquira seu cartão agora</title>
	<meta name="keywords" content="">

	<link href="//www.google-analytics.com" rel="dns-prefetch">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<meta name="google-site-verification" content="9hsWoAqPgw2q_55XL-JXnB_Tfhbk17ljs8slRmbqhLU">

	<style>
		img:is([sizes="auto" i], [sizes^="auto," i]) {
			contain-intrinsic-size: 3000px 1500px
		}
	</style>

	<!-- All in One SEO Pro 4.6.8.1 - aioseo.com -->
	<meta name="description"
		content="Adquira sua Carta de Crédito Contemplada com as melhores taxas do mercado. Crédito imediato para imóveis, veículos e caminhões.">
	<meta name="robots" content="max-image-preview:large">
	<link rel="canonical" href="https://www.transpocred.coop.br/transpocred">
	<meta name="generator" content="All in One SEO Pro (AIOSEO) 4.6.8.1">
	<meta property="og:locale" content="pt_BR">
	<meta property="og:site_name" content="Ailos">
	<meta property="og:type" content="article">
	<meta property="og:title" content="Cartões de Crédito Especiais – Adquira seu cartão agora">
	<meta property="og:description"
		content="Adquira seu Cartão de Crédito Especial com as melhores taxas do mercado. Benefícios exclusivos para você e sua frota.">
	<meta property="og:url" content="https://www.transpocred.coop.br/transpocred">
	<meta property="og:image" content="images/iStock-1396606504.jpg">
	<meta property="og:image:secure_url" content="images/iStock-1396606504.jpg">
	<meta property="article:published_time" content="2019-08-27T13:33:07+00:00">
	<meta property="article:modified_time" content="2024-06-18T18:16:12+00:00">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Cartões de Crédito Especiais – Transpocred">
	<meta name="twitter:description"
		content="Cartões de Crédito Especiais com benefícios exclusivos para você e sua frota. Conheça nossos produtos e serviços.">
	<meta name="twitter:image" content="https://www.ailos.coop.br/wp-content/uploads/2024/06/iStock-1396606504.jpg">
	<meta name="google" content="nositelinkssearchbox">
	<script type="text/javascript" src="js/ruxitagentjs_ICANVfqrux_10329260206100503.js"
		data-dtconfig="rid=RID_2418|rpid=1089406532|domain=transpocred.coop.br|reportUrl=/rb_fld33358|app=1b1f71bff8baa18b|cuc=orqzcp5r|owasp=1|mel=100000|featureHash=ICANVfqrux|dpvc=1|lastModification=1770633619734|tp=500,50,0|rdnt=1|uxrgce=1|srbbv=2|agentUri=/ruxitagentjs_ICANVfqrux_10329260206100503.js"></script>
	<script type="application/ld+json" class="aioseo-schema">
			{"@context":"https:\/\/schema.org","@graph":[{"@type":"BreadcrumbList","@id":"https:\/\/www.transpocred.coop.br\/transpocred#breadcrumblist","itemListElement":[{"@type":"ListItem","@id":"https:\/\/www.transpocred.coop.br\/#listItem","position":1,"name":"In\u00edcio","item":"https:\/\/www.transpocred.coop.br\/","nextItem":"https:\/\/www.transpocred.coop.br\/transpocred#listItem"},{"@type":"ListItem","@id":"https:\/\/www.transpocred.coop.br\/transpocred#listItem","position":2,"name":"Transpocred","previousItem":"https:\/\/www.transpocred.coop.br\/#listItem"}]},{"@type":"Organization","@id":"https:\/\/www.transpocred.coop.br\/#organization","name":"Ailos","description":"Cooperativa de cr\u00e9dito","url":"https:\/\/www.transpocred.coop.br\/","telephone":"+558006472200","sameAs":["https:\/\/www.youtube.com\/c\/sistemaailos"]},{"@type":"WebPage","@id":"https:\/\/www.transpocred.coop.br\/transpocred#webpage","url":"https:\/\/www.transpocred.coop.br\/transpocred","name":"Solu\u00e7\u00f5es financeiras feitas por quem entende de transportes \u2013 Transpocred","description":"Transpocred: a \u00fanica institui\u00e7\u00e3o financeira cooperativa dos segmentos de transporte, log\u00edstica e Correios. Conhe\u00e7a nossos produtos e servi\u00e7os.","inLanguage":"pt-BR","isPartOf":{"@id":"https:\/\/www.transpocred.coop.br\/#website"},"breadcrumb":{"@id":"https:\/\/www.transpocred.coop.br\/transpocred#breadcrumblist"},"datePublished":"2019-08-27T10:33:07-03:00","dateModified":"2024-06-18T15:16:12-03:00"},{"@type":"WebSite","@id":"https:\/\/www.transpocred.coop.br\/#website","url":"https:\/\/www.transpocred.coop.br\/","name":"Ailos","description":"Cooperativa de cr\u00e9dito","inLanguage":"pt-BR","publisher":{"@id":"https:\/\/www.transpocred.coop.br\/#organization"}}]}
		</script>
	<!-- All in One SEO Pro -->

	<link rel="dns-prefetch" href="//www.transpocred.coop.br">
	<style id="classic-theme-styles-inline-css" type="text/css">
		/*! This file is auto-generated */
		.wp-block-button__link {
			color: #fff;
			background-color: #32373c;
			border-radius: 9999px;
			box-shadow: none;
			text-decoration: none;
			padding: calc(.667em + 2px) calc(1.333em + 2px);
			font-size: 1.125em
		}

		.wp-block-file__button {
			background: #32373c;
			color: #fff;
			text-decoration: none
		}
	</style>
	<style id="global-styles-inline-css" type="text/css">
		:root {
			--wp--preset--aspect-ratio--square: 1;
			--wp--preset--aspect-ratio--4-3: 4/3;
			--wp--preset--aspect-ratio--3-4: 3/4;
			--wp--preset--aspect-ratio--3-2: 3/2;
			--wp--preset--aspect-ratio--2-3: 2/3;
			--wp--preset--aspect-ratio--16-9: 16/9;
			--wp--preset--aspect-ratio--9-16: 9/16;
			--wp--preset--color--black: #000000;
			--wp--preset--color--cyan-bluish-gray: #abb8c3;
			--wp--preset--color--white: #ffffff;
			--wp--preset--color--pale-pink: #f78da7;
			--wp--preset--color--vivid-red: #cf2e2e;
			--wp--preset--color--luminous-vivid-orange: #ff6900;
			--wp--preset--color--luminous-vivid-amber: #fcb900;
			--wp--preset--color--light-green-cyan: #7bdcb5;
			--wp--preset--color--vivid-green-cyan: #00d084;
			--wp--preset--color--pale-cyan-blue: #8ed1fc;
			--wp--preset--color--vivid-cyan-blue: #0693e3;
			--wp--preset--color--vivid-purple: #9b51e0;
			--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
			--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
			--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
			--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
			--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
			--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
			--wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
			--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
			--wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
			--wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
			--wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
			--wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
			--wp--preset--font-size--small: 13px;
			--wp--preset--font-size--medium: 20px;
			--wp--preset--font-size--large: 36px;
			--wp--preset--font-size--x-large: 42px;
			--wp--preset--spacing--20: 0.44rem;
			--wp--preset--spacing--30: 0.67rem;
			--wp--preset--spacing--40: 1rem;
			--wp--preset--spacing--50: 1.5rem;
			--wp--preset--spacing--60: 2.25rem;
			--wp--preset--spacing--70: 3.38rem;
			--wp--preset--spacing--80: 5.06rem;
			--wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);
			--wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);
			--wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);
			--wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);
			--wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);
		}

		:where(.is-layout-flex) {
			gap: 0.5em;
		}

		:where(.is-layout-grid) {
			gap: 0.5em;
		}

		body .is-layout-flex {
			display: flex;
		}

		.is-layout-flex {
			flex-wrap: wrap;
			align-items: center;
		}

		.is-layout-flex> :is(*, div) {
			margin: 0;
		}

		body .is-layout-grid {
			display: grid;
		}

		.is-layout-grid> :is(*, div) {
			margin: 0;
		}

		:where(.wp-block-columns.is-layout-flex) {
			gap: 2em;
		}

		:where(.wp-block-columns.is-layout-grid) {
			gap: 2em;
		}

		:where(.wp-block-post-template.is-layout-flex) {
			gap: 1.25em;
		}

		:where(.wp-block-post-template.is-layout-grid) {
			gap: 1.25em;
		}

		.has-black-color {
			color: var(--wp--preset--color--black) !important;
		}

		.has-cyan-bluish-gray-color {
			color: var(--wp--preset--color--cyan-bluish-gray) !important;
		}

		.has-white-color {
			color: var(--wp--preset--color--white) !important;
		}

		.has-pale-pink-color {
			color: var(--wp--preset--color--pale-pink) !important;
		}

		.has-vivid-red-color {
			color: var(--wp--preset--color--vivid-red) !important;
		}

		.has-luminous-vivid-orange-color {
			color: var(--wp--preset--color--luminous-vivid-orange) !important;
		}

		.has-luminous-vivid-amber-color {
			color: var(--wp--preset--color--luminous-vivid-amber) !important;
		}

		.has-light-green-cyan-color {
			color: var(--wp--preset--color--light-green-cyan) !important;
		}

		.has-vivid-green-cyan-color {
			color: var(--wp--preset--color--vivid-green-cyan) !important;
		}

		.has-pale-cyan-blue-color {
			color: var(--wp--preset--color--pale-cyan-blue) !important;
		}

		.has-vivid-cyan-blue-color {
			color: var(--wp--preset--color--vivid-cyan-blue) !important;
		}

		.has-vivid-purple-color {
			color: var(--wp--preset--color--vivid-purple) !important;
		}

		.has-black-background-color {
			background-color: var(--wp--preset--color--black) !important;
		}

		.has-cyan-bluish-gray-background-color {
			background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
		}

		.has-white-background-color {
			background-color: var(--wp--preset--color--white) !important;
		}

		.has-pale-pink-background-color {
			background-color: var(--wp--preset--color--pale-pink) !important;
		}

		.has-vivid-red-background-color {
			background-color: var(--wp--preset--color--vivid-red) !important;
		}

		.has-luminous-vivid-orange-background-color {
			background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
		}

		.has-luminous-vivid-amber-background-color {
			background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
		}

		.has-light-green-cyan-background-color {
			background-color: var(--wp--preset--color--light-green-cyan) !important;
		}

		.has-vivid-green-cyan-background-color {
			background-color: var(--wp--preset--color--vivid-green-cyan) !important;
		}

		.has-pale-cyan-blue-background-color {
			background-color: var(--wp--preset--color--pale-cyan-blue) !important;
		}

		.has-vivid-cyan-blue-background-color {
			background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
		}

		.has-vivid-purple-background-color {
			background-color: var(--wp--preset--color--vivid-purple) !important;
		}

		.has-black-border-color {
			border-color: var(--wp--preset--color--black) !important;
		}

		.has-cyan-bluish-gray-border-color {
			border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
		}

		.has-white-border-color {
			border-color: var(--wp--preset--color--white) !important;
		}

		.has-pale-pink-border-color {
			border-color: var(--wp--preset--color--pale-pink) !important;
		}

		.has-vivid-red-border-color {
			border-color: var(--wp--preset--color--vivid-red) !important;
		}

		.has-luminous-vivid-orange-border-color {
			border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
		}

		.has-luminous-vivid-amber-border-color {
			border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
		}

		.has-light-green-cyan-border-color {
			border-color: var(--wp--preset--color--light-green-cyan) !important;
		}

		.has-vivid-green-cyan-border-color {
			border-color: var(--wp--preset--color--vivid-green-cyan) !important;
		}

		.has-pale-cyan-blue-border-color {
			border-color: var(--wp--preset--color--pale-cyan-blue) !important;
		}

		.has-vivid-cyan-blue-border-color {
			border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
		}

		.has-vivid-purple-border-color {
			border-color: var(--wp--preset--color--vivid-purple) !important;
		}

		.has-vivid-cyan-blue-to-vivid-purple-gradient-background {
			background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
		}

		.has-light-green-cyan-to-vivid-green-cyan-gradient-background {
			background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
		}

		.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
			background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
		}

		.has-luminous-vivid-orange-to-vivid-red-gradient-background {
			background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
		}

		.has-very-light-gray-to-cyan-bluish-gray-gradient-background {
			background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
		}

		.has-cool-to-warm-spectrum-gradient-background {
			background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
		}

		.has-blush-light-purple-gradient-background {
			background: var(--wp--preset--gradient--blush-light-purple) !important;
		}

		.has-blush-bordeaux-gradient-background {
			background: var(--wp--preset--gradient--blush-bordeaux) !important;
		}

		.has-luminous-dusk-gradient-background {
			background: var(--wp--preset--gradient--luminous-dusk) !important;
		}

		.has-pale-ocean-gradient-background {
			background: var(--wp--preset--gradient--pale-ocean) !important;
		}

		.has-electric-grass-gradient-background {
			background: var(--wp--preset--gradient--electric-grass) !important;
		}

		.has-midnight-gradient-background {
			background: var(--wp--preset--gradient--midnight) !important;
		}

		.has-small-font-size {
			font-size: var(--wp--preset--font-size--small) !important;
		}

		.has-medium-font-size {
			font-size: var(--wp--preset--font-size--medium) !important;
		}

		.has-large-font-size {
			font-size: var(--wp--preset--font-size--large) !important;
		}

		.has-x-large-font-size {
			font-size: var(--wp--preset--font-size--x-large) !important;
		}

		:where(.wp-block-post-template.is-layout-flex) {
			gap: 1.25em;
		}

		:where(.wp-block-post-template.is-layout-grid) {
			gap: 1.25em;
		}

		:where(.wp-block-columns.is-layout-flex) {
			gap: 2em;
		}

		:where(.wp-block-columns.is-layout-grid) {
			gap: 2em;
		}

		:root :where(.wp-block-pullquote) {
			font-size: 1.5em;
			line-height: 1.6;
		}
	</style>
	<link rel="stylesheet" id="coop-styles-css" href="css/coop.css" type="text/css" media="all">
	<link rel="stylesheet" id="bundle-css" href="css/bundle.css" type="text/css" media="all">
	<link rel="stylesheet" id="elementor-icons-css" href="css/elementor-icons.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="elementor-frontend-css" href="css/frontend.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="elementor-post-24009-css" href="css/post-24009.css" type="text/css" media="all">
	<link rel="stylesheet" id="uael-frontend-css" href="css/uael-frontend.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="font-awesome-5-all-css" href="css/all.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="font-awesome-4-shim-css" href="css/v4-shims.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="elementor-gf-roboto-css"
		href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&display=auto"
		type="text/css" media="all">
	<link rel="stylesheet" id="elementor-gf-robotoslab-css"
		href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&display=auto"
		type="text/css" media="all">
	<link rel="stylesheet" id="elementor-gf-exo2-css"
		href="https://fonts.googleapis.com/css?family=Exo+2:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&display=auto"
		type="text/css" media="all">
	<script type="text/javascript" src="js/v4-shims.min.js" id="font-awesome-4-shim-js"></script>
	<script type="text/javascript" src="js/jquery.min.js" id="jquery-core-js"></script>
	<script type="text/javascript" src="js/jquery-migrate.min.js" id="jquery-migrate-js"></script>
	<style type="text/css">
		.ae_data .elementor-editor-element-setting {
			display: none !important;
		}
	</style>
	<meta name="generator"
		content="Elementor 3.33.1; features: additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-auto">
	<style>
		.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload),
		.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload) * {
			background-image: none !important;
		}

		@media screen and (max-height: 1024px) {

			.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload),
			.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload) * {
				background-image: none !important;
			}
		}

		@media screen and (max-height: 640px) {

			.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload),
			.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload) * {
				background-image: none !important;
			}
		}
	</style>
	<style type="text/css" id="wp-custom-css">
		html,
		body {
			-webkit-overflow-scrolling: touch !important;
		}

		html,
		body {
			touch-action: auto;
		}

		.merling2 {
			background: #fff;
		}

		.btn_chatbot_crm {
			position: fixed;
			z-index: 9999999;
			right: 8.0vw;
			bottom: 10px;
			background: transparent;
			border-color: transparent;
			cursor: pointer;
		}

		.btn_chatbot_crm img {
			max-width: 100%;
			width: 100%;
		}

		@media(max-width:767px) {
			.mobile_floater .header-join_button {
				padding: 0px 0px !important;
				width: 132px !important;
			}

			.mobile_floater-access input {
				width: calc(100vw - 258px) !important;
			}
		}

		@media(max-width:1023px) {
			.mega-menu-toggle {
				display: none;
			}
		}

		@media(max-width:1279px) {
			.invoice iframe {
				height: 500px !important;
				overflow: scroll !important;
			}

			.contact iframe {
				overflow: auto !important;
				display: unset !important;
				cursor: pointer !important;
				touch-action: auto;
			}
		}

		@media(max-width:767px) {
			.invoice iframe {
				height: 600px !important;
				overflow: scroll !important;
			}
		}

		.central_blocks.rings_bottom {
			padding-bottom: 100px;
		}

		p a {
			text-decoration: underline !important;
		}

		.single_news_banner {
			position: relative;
		}

		.single_news_banner .container {
			position: relative;
			z-index: 2;
		}

		.single_news_banner:before {
			content: '';
			position: absolute;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.45);
		}

		.news_slider {
			position: relative;
		}

		.news_slider .container {
			position: relative;
			z-index: 2;
		}

		.news_slider .swiper-slide:before {
			content: '';
			position: absolute;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.45);
		}

		.elementor-widget-ailos-document-list .common_columns-slider-prev {
			display: none;
		}

		.elementor-widget-ailos-document-list .common_columns-slider-next {
			display: none;
		}

		.sales_filter-category.active {
			background-color: #fff;
			border: 1px solid #007d89 !important;
			cursor: default;
		}

		.channels_map-map {
			background: url(https://ailos-sites.azurewebsites.net/wp-content/uploads/2019/08/image-map-partners.png) no-repeat center center !important;
			background-size: cover !important;
		}

		.single_news_content-content img {
			max-width: 100%;
			width: auto;
		}

		.elementor-2807 .elementor-element.elementor-element-ab46e1e>.elementor-widget-container {
			background: transparent !important;
		}

		.elementor-toggle .elementor-tab-title.active {
			border-bottom: 0px;
		}

		.contrast .one_column_list-item img {
			filter: brightness(10) grayscale(1);
		}

		@supports (-webkit-overflow-scrolling: touch) {
			.mobile_access_banner {
				bottom: 60px;
				top: auto;
				-webkit-transform: translate(0%, 200px);
				-moz-transform: translate(0%, 200px);
				-ms-transform: translate(0%, 200px);
				-o-transform: translate(0%, 200px);
				transform: translate(0%, 200px);
			}

			.mobile_access_banner.active {}
		}

		.become {
			height: auto;
			overflow: hidden;
			padding: 89.5px 0px;
		}

		.banner .swiper-slide::before {
			display: none !important;
		}

		.banner .swiper-slide.has_filter::before {
			display: block !important;
		}

		/* CORREÇÕES BUGS PUBLICAÇÃO */
		.header-links .mega-menu-item-has-children.current_menu {
			position: relative !important;
		}

		.header-links .mega-menu-item-has-children.current_menu.active {
			position: static !important;
		}

		.header-links .mega-menu-item-has-children.current_menu.active.single {
			position: relative !important;
		}

		.header-links .mega-sub-menu .container .mega-menu-columns-6-of-12:first-child .mega-menu-link::before {
			background-color: transparent !important;
		}

		.full_link {
			position: absolute;
			left: -500vw;
			top: -40px;
			width: 2000vw;
			height: 100%;
		}

		.ailos_coop_list-item span {
			padding: 0px;
		}

		/* .ailos_coop_list-item span img{
    height: 80px;
    max-height: 80px;
    max-width: 200px !important;
} */
		@media(max-width:1199px) {
			.ailos_coop_list-item span img {
				height: 80px;
				max-height: 80px;
				max-width: 100% !important;
			}

			.btn_chatbot_crm {
				bottom: 70px;
			}
		}

		*::-webkit-scrollbar {
			height: 2px !important;
		}

		@media(max-width:767px) {
			*::-webkit-scrollbar {
				height: 2px !important;
			}
		}

		@media(max-width:1023px) {
			.channels_info-report-all {
				height: auto;
				padding: 10px 20px;
				line-height: 100%;
			}
		}

		.contrast .ailos_pillars {
			background: #000 !important;
			border-bottom: 1px solid #fff;
		}

		.contrast .common_content_links {
			background: #000;
			border-bottom: 1px solid #fff;
		}

		.contrast .banner-content span {
			background: rgba(0, 0, 0, 0.9);
			box-shadow: 0px 0px 0px 1000px rgba(0, 0, 0, 0.9);
		}

		.mobile_app,
		.mobile_app_overlay {
			pointer-events: none;
		}

		.mobile_app.active,
		.mobile_app_overlay.active {
			pointer-events: all;
		}

		.search_results-tabs-scroll {
			min-width: 0px !important;
			white-space: nowrap !important;
		}

		.search_results-tabs a:last-child {
			margin-right: 0px !important;
		}

		/* Remove chat from Ailos */
		body[data-coopname*="Ailos"] .floating_chat_button {
			display: none;
		}

		/* Mobile Menu Fix Ailos */
		body.ailos .header.fixed {
			position: fixed;
			top: 0px !important;
		}

		/* Fix Logo AcrediCoop */
		.logo-acredi {
			background-image: url(images/logo-acredicoop.svg);
		}

		.logo-acredi-white {
			background-image: url(images/logo-acredicoop-white.svg);
		}

		.common_big_content-button+.common_big_content-link {
			margin-top: 0px;
		}

		.black .banner-content-title {
			color: #165C7D;
		}

		.black .common_block_link {
			background: url(https://ailos-sites-prd.azureedge.net/wp-content/themes/theme-ailos/public/images/icon-arrow-right-blue.svg) no-repeat right center;
			color: #165C7D;
		}

		.ailos_coops .row:last-child>div:blank {
			display: none !important;
		}

		#_hj_feedback_container {
			display: none !important;
		}

		/* WP Helper classes editor*/
		.aligncenter {
			display: block;
			margin: 0 auto;
		}

		.alignleft {
			float: left;
			margin: 0.5em 1em 0.5em 0;
		}

		.alignright {
			float: right;
			margin: 0.5em 1em 0.5em 0;
		}

		.sales_list-no_results {
			color: #575757;
			font-size: 14px;
			line-height: 180%;
			text-align: center;
			margin-top: 40px;
			margin-bottom: 20px;
		}

		.sales_list-no_results b {
			font-family: "Exo 2", sans-serif;
			color: #165C7D;
			font-size: 24px;
			font-weight: 700;
		}

		.contact iframe {
			height: 900px !important;
		}

		.single_news_content-content ol {
			font-size: 14px;
			color: #575757;
			line-height: 24px;
			font-weight: 400;
			margin-bottom: 20px;
			list-style-type: decimal;
			padding-left: 30px;
		}

		.single_news_content-content ol li {
			margin-bottom: 10px;
			list-style-type: decimal;
		}

		.single_news_content-content ol li:last-child {
			margin-bottom: 0px;
		}

		.single_news_content-content ul {
			font-size: 14px;
			color: #575757;
			line-height: 24px;
			font-weight: 400;
			margin-bottom: 20px;
			list-style-type: disc;
			padding-left: 30px;
		}

		.single_news_content-content ul li {
			margin-bottom: 10px;
			list-style-type: disc;
		}

		.single_news_content-content ul li:last-child {
			margin-bottom: 0px;
		}

		.single_news_content-content ul li a {
			color: #007D8A;
			text-decoration: underline;
		}

		.swiper-scrollbar-drag {
			min-height: 10px !important;
		}

		.ubots-star-basic>label::before {
			height: 0px !important;
		}

		body .ubots-star-basic>label::after {
			top: 25px !important;
		}

		.ubots-star-basic:before {
			top: 27px;
		}

		.ubots-surveying-card:before {
			display: inline-block;
			margin-bottom: 7px;
		}

		.header-logo.logo-unilos {
			background-size: contain;
		}

		.page-id-27145 .cover_lps-logo {
			display: block;
			width: 249px;
			height: 75px;
			background-image: url(images/logo-viacredi-white.svg);
		}

		.header-links .mega-sub-menu .container .mega-menu-columns-6-of-12:first-child .mega-menu-link.dashicons-update-alt::before {
			background-image: url(images/icon-pix.svg);
		}


		.inpulse-calls__list__item__content__description {
			color: #fff;
		}

		.inpulse-calls__list__item__content__description ul {
			font-size: 14px;
			line-height: 24px;
			margin-bottom: 20px;
			font-weight: 300;
		}


		.inpulse-calls__list__item__content__description li {
			font-size: 14px;
			margin-bottom: 5px;
		}


		.inpulse-calls__list__item__content__description li:before {
			content: "\2022";
			margin-right: 10px;
		}

		.inpulse-calls__list__item__image img {
			width: 100%;
		}

		@media(max-width:767px) {
			.inpulse-calls__list__item__content__title b {
				font-style: normal;
				font-weight: 600;
				line-height: 100%;
				font-size: 27px;
				text-transform: none;
				color: #FFA300;
				text-overflow: ellipsis;
				overflow: hidden;
				display: block;
				white-space: nowrap;
				height: 30px;
				padding-right: 10px;
			}

			.inpulse-calls__list__item__date {
				right: 0px;
				left: 124px;
				top: 97px;
			}
		}

		.page-id-44926 .accessbility_nav {
			display: none;
		}

		.page-id-44926 .header {
			display: none;
		}

		.page-id-44926 .search {
			display: none !important;
		}

		.page-id-44926 .cover_lps-logo {
			background-size: contain !important;
		}

		.common_content_image img.none {
			-webkit-box-shadow: 0px 0px 0px transparent !important;
			-moz-box-shadow: 0px 0px 0px transparent !important;
			-ms-box-shadow: 0px 0px 0px transparent !important;
			-o-box-shadow: 0px 0px 0px transparent !important;
			box-shadow: 0px 0px 0px transparent !important;
		}

		@media(max-width:767px) {

			.now-small-banner__container__title,
			.now-small-banner__container__text {
				max-width: 100%;
			}
		}

		.grecaptcha-badge {
			bottom: 94px !important;
		}

		.coops-footer-link {
			display: none !important;
		}

		.viacredi .coops-footer-link--viacredi {
			display: block !important;
		}

		.mobile_floater-access input {
			width: calc(100vw - 210px);
		}


		@media(max-width:767px) {
			.mobile_floater .header-join_button {
				padding: 0px 0px !important;
				width: 132px !important;
			}

			.mobile_floater-access input {
				width: calc(100vw - 258px) !important;
			}

			.accessbility_nav {
				margin-bottom: 0px;
			}

			.header {
				height: 50px;
				position: relative;
				top: 0px;
			}
		}

		.contrast .download-file-modal__container__holder {
			background: #000;
			border: 1px solid #fff;
		}

		.contrast .download-file-modal__container__holder__close {
			width: 40px;
			filter: grayscale(1) brightness(4);
		}



		.font_size_2 .widget_credit_simulator-form-checkbox {
			font-size: 14px;
		}

		.font_size_3 .widget_credit_simulator-form-checkbox {
			font-size: 16px;
		}

		.admission-banner {
			background-size: cover !important;
		}

		.app-block__slider__item__icon img,
		.app-block__modal__icon img {
			width: 60px !important;
			height: 60px !important;
			max-width: 60px !important;
			max-height: 60px !important;
		}





		@media (max-width: 767px) {
			.widget_consortium-clear {
				width: 80px;
				margin-top: 0px;
				padding-left: 30px;
				background-color: rgba(255, 255, 255, 0.9);
				margin-left: 0px;
				text-align: center;
				position: relative;
				z-index: 2;
				background-position: 10% center;
				font-size: 14px;
				font-weight: 700;
				left: 50%;
				transform: translate(-50%, 0px);
			}
		}

		.ywa-10000 {
			display: none !important;
		}



		/* Inicio Ajuste IZA Paliativo  */

		header>.container>.row>.col-md-2 {
			-ms-flex: 1 0 16.666667%;
			flex: 1 0 16.666667%;
			max-width: 41.666667%;
		}

		.footer.footer_lps .logo-acentra-white {

			background-image: url(images/logo-acentra-white-footer.svg);

		}

		.footer.footer_lps .logo-acredicoop-white {

			background-image: url(images/logo-acredicoop-white-footer.svg);

		}

		.footer.footer_lps .logo-viacredialtovale-white {

			background-image: url(https://www.viacredialtovale.coop.br/wp-content/themes/theme-ailos/public/images/logo-viacredialtovale-white-footer.svg);
		}

		.footer.footer_lps .logo-civia-white {
			background-image: url(images/logo-civia-white-footer.svg);

		}

		.footer.footer_lps .logo-credcrea-white {
			background-image: url(images/logo-credcrea-white-footer.svg);
		}

		.footer.footer_lps .logo-credelesc-white {
			background-image: url(images/logo-credelesc-white-footer.svg);
		}

		.footer.footer_lps .logo-credicomin-white {
			background-image: url(images/logo-credicomin-white-footer.svg);
		}

		.footer.footer_lps .logo-credifoz-white {
			background-image: url(images/logo-credifoz-white-footer.svg);
		}

		.footer.footer_lps .logo-crevisc-white {
			background-image: url(images/logo-crevisc-white-footer.svg);
		}

		.footer.footer_lps .logo-evolua-white {
			background-image: url(images/logo-evolua-white-footer.svg);
		}

		.footer.footer_lps .logo-transpocred-white {
			background-image: url(images/logo-transpocred-white-footer.svg);
		}

		.footer.footer_lps .logo-viacredi-white {
			background-image: url(images/logo-viacredi-white-footer.svg);
		}

		.footer.footer_lps .logo-unilos-white {
			background-image: url(images/logo-unilos-white-footer.svg);

		}

		/* Ajuste Pillar Page 14.04.2022 */
		.SideBarNav .NavTopics {
			margin-top: 10px;
		}

		.SideBarNav .logoPullPage img {
			margin: auto;
		}

		.headerPillarPage {
			padding: 15px 0;
		}

		/* Ajuste Pillar Page 27.04.2022 */
		.headerPillarPage .logoPullPage .img-fluid {
			margin-top: 0;
		}


		/* Fim Ajuste IZA Paliativo  */



		.accordion_lps-box {
			position: relative;
			z-index: 9999;
		}


		@media(max-width:767px) {
			body[data-coopcode='3'] .mobile_floater .header-join_button {
				width: 100% !important;
			}
		}

		/* REMOÇÃO DE LOGO */
		.page-id-120033 .leads-block .section_top a {
			display: none !important;
		}

		.page-id-120033 .leads-block .section_top label.checkbox_label a {
			display: block !important;
		}

		.elementor-widget-faq {

			display: none !important;
		}

		.widget_credit_simulator-modal-container p br {
			display: none;
		}

		.single_news_content-content .wp-caption {
			width: 100% !important;
		}


		div:has(> #sac-cesh) {
			display: none;
		}

		div:has(> #price-cesh) {
			display: none;
		}


		.security-content-gallery__link {
			display: none;
		}

		.floating_chat_button {
			display: none;
		}

        /* Global Mobile Fix for Horizontal Scroll/White Space */
        @media (max-width: 767px) {
            html, body {
                overflow-x: hidden !important;
                width: 100% !important;
                position: relative !important;
            }
            .header {
                height: 70px !important;
                padding: 0 !important;
                background: #fff !important;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05) !important;
                position: relative !important;
                top: 0 !important;
                z-index: 9999 !important;
                width: 100% !important;
                max-width: 100vw !important;
            }
            .header .container {
                padding: 0 15px !important;
                width: 100% !important;
                max-width: 100% !important;
            }
            .header .row {
                display: flex !important;
                flex-wrap: nowrap !important;
                height: 70px !important;
                align-items: center !important;
                margin: 0 !important;
                width: 100% !important;
            }
            .header-logo-container {
                width: 120px !important;
                flex: 0 0 120px !important;
                padding: 0 !important;
            }
            .header-logo {
                background-size: contain !important;
                width: 100% !important;
                height: 35px !important;
                margin: 0 !important;
            }
            .header-buttons-container {
                display: flex !important;
                flex: 1 !important;
                justify-content: flex-end !important;
                align-items: center !important;
                gap: 5px !important;
                padding: 0 !important;
            }
            .header-align_right-block {
                display: block !important;
                margin: 0 !important;
            }
            .header-access a, .header-join_button {
                padding: 0 8px !important;
                font-size: clamp(0.55rem, 2vw, 0.75rem) !important;
                height: 38px !important;
                min-height: unset !important;
                border-radius: 8px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                white-space: nowrap !important;
                box-shadow: none !important;
                margin: 0 !important;
                width: auto !important;
                text-transform: uppercase !important;
                font-weight: 800 !important;
            }
            .header-access a {
                border: 1px solid #e2e8f0 !important;
                color: #64748b !important;
                background: #f8fafc !important;
            }
            .header-join_button {
                background: #007d89 !important;
                color: #fff !important;
            }
            /* Hide extra elements and notification spacers */
            .notification, #telasMobile, #telasGrandes, .accessbility_nav, .header-links-container, 
            .mobile_floater-search_button, .mobile_floater-menu_button {
                display: none !important;
            }
            
            /* Fix elementor containers that might overflow */
            .elementor-section, .elementor-container {
                max-width: 100vw !important;
                overflow: hidden !important;
            }
        }

        @media (min-width: 768px) {
            /* Desktop Styles */
        }
	</style>
	<style type="text/css">
		/** Mega Menu CSS: disabled **/
	</style>

	<script src="js/api.js" defer=""></script>


	<!-- Início do aviso de consentimento de cookies OneTrust para *.coop.br -->
	<script type="text/javascript" src="js/OtAutoBlock.js"></script>
	<script src="js/otSDKStub.js" type="text/javascript" charset="UTF-8"
		data-domain-script="b9b4941a-5ce4-44ab-b696-a5419460feed"></script>
	<script type="text/javascript">
		function OptanonWrapper() { }
	</script>
	<!-- Final do aviso de consentimento de cookies OneTrust para *.coop.br -->
</head>

<body data-adminajax="https://www.transpocred.coop.br/wp-admin/admin-ajax.php"
	data-baseurl="https://www.transpocred.coop.br/wp-content/themes/theme-ailos"
	class="page-template-default page page-id-12594 page-parent mega-menu-ailos-menu mega-menu-coop-menu transpocred font_size_1 elementor-default elementor-kit-24009 elementor-page elementor-page-12594"
	data-coopname="Transpocred" data-coopcode="9" data-ubot-coopname="TRANSPOCRED">
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe title="google tag manager" src="https://www.googletagmanager.com/ns.html?id=GTM-M3DZ2F" height="0"
			width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<section class="accessbility_shortcuts">
		<!-- <div class='container'>
			<div class='row justify-content-center'>
				<div class='col-10'>
					<div class='accessbility_shortcuts-buttons'>
						<a href='#' class='go_to_content'>Ir para o conteúdo</a>
						<a href='#' class='go_to_menu'>Pular para o menu principal</a>
					</div>
				</div>
			</div>
		</div> -->
	</section>

	<section class="accessbility_nav">
		<div class="container">
			<div class="row justify-content-between">
				<!-- <div class='col d-none d-md-block'>Cooperativa Filiada ao Sistema Ailos</div> -->
				<div class="col">
					<a href="https://www.transpocred.coop.br/sobre-acessibilidade"
						title="Acessibilidade">Acessibilidade</a>
					<a href="#" class="button_contrast" title="Alto Contraste">Alto Contraste</a>
					<a href="#" class="button_increase_fonts" title="A+">A+</a>
					<a href="#" class="button_decrease_fonts" title="A-">A-</a>
				</div>
			</div>
		</div>
	</section>

	<a href="#" class="mobile_access_banner" target="_blank">
		<div class="container">
			<div class="row">
				<div class="col-7 offset-4">
					<div class="mobile_access_banner-title">Acesse a conta on-line com mais praticidade no app Ailos
					</div>
					<div class="mobile_access_banner-cta">Abrir no Aplicativo</div>
				</div>
			</div>
		</div>
	</a>







	<header class="header">
		<div class="container">
			<div class="row justify-content-between">
				<div class="header-logo-container">

					<a href="https://www.transpocred.coop.br" class="header-logo logo-transpocred"></a>
				</div>
				<div class="header-links-container">

					<div class="HeaderCoop">
						<div class="header-links">

							<div id="mega-menu-wrap-coop-menu" class="mega-menu-wrap">
								<div class="mega-menu-toggle">
									<div class="mega-toggle-blocks-left"></div>
									<div class="mega-toggle-blocks-center"></div>
									<div class="mega-toggle-blocks-right">
										<div class="mega-toggle-block mega-menu-toggle-block mega-toggle-block-1"
											id="mega-toggle-block-1" tabindex="0"><span class="mega-toggle-label"
												role="button" aria-expanded="false"><span
													class="mega-toggle-label-closed">MENU</span><span
													class="mega-toggle-label-open">MENU</span></span></div>
									</div>
								</div>
								<ul id="mega-menu-coop-menu"
									class="mega-menu max-mega-menu mega-menu-horizontal mega-no-js"
									data-event="hover_intent" data-effect="fade_up" data-effect-speed="200"
									data-effect-mobile="disabled" data-effect-speed-mobile="0"
									data-mobile-force-width="false" data-second-click="close"
									data-document-click="collapse" data-vertical-behaviour="standard"
									data-breakpoint="600" data-unbind="false" data-mobile-state="collapse_all"
									data-mobile-direction="vertical" data-hover-intent-timeout="300"
									data-hover-intent-interval="100">
									<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-align-bottom-left mega-menu-flyout mega-menu-item-117675"
										id="mega-menu-item-117675"><a class="mega-menu-link" href="#"
											aria-expanded="false" tabindex="0">Nossos <b>Cartões</b><span
												class="mega-indicator" aria-hidden="true"></span></a>
										<ul class="mega-sub-menu">
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-2549"
												id="mega-menu-item-2549"><a class="mega-menu-link" href="#"
													aria-expanded="false">Pessoa <b>Física</b><span
														class="mega-indicator" aria-hidden="true"></span></a>
												<ul class="mega-sub-menu">
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-2555"
														id="mega-menu-item-2555"><a class="mega-menu-link" href="#"
															aria-expanded="false">Soluções em Destaque<span
																class="mega-indicator" aria-hidden="true"></span></a>
														<ul class="mega-sub-menu">
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-42724"
																id="mega-menu-item-42724"><a
																	class="dashicons-book mega-menu-link"
																	href="/para-voce/conta-corrente"><b>Conta
																		corrente</b> | forma prática de movimentar seu
																	dinheiro</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2551"
																id="mega-menu-item-2551"><a
																	class="dashicons-admin-page mega-menu-link"
																	href="/para-voce/cartoes"><b>Cartões</b> | melhores
																	benefícios com chance de zero anuidade</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2552"
																id="mega-menu-item-2552"><a
																	class="dashicons-chart-bar mega-menu-link"
																	href="/para-voce/investimentos-financeiros"><b>Investimentos</b>
																	| oportunidades para seu dinheiro render</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2554"
																id="mega-menu-item-2554"><a
																	class="dashicons-money-alt mega-menu-link"
																	href="/para-voce/credito"><b>Crédito</b> | taxas
																	especiais para você realizar seus sonhos</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2553"
																id="mega-menu-item-2553"><a
																	class="dashicons-products mega-menu-link"
																	href="/para-voce/seguros"><b>Seguros</b> | proteção
																	para tudo o que você precisa</a></li>
														</ul>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2884"
														id="mega-menu-item-2884"><a class="mega-menu-link"
															href="/para-voce">Todas as soluções para Pessoa Física</a>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2563"
														id="mega-menu-item-2563"><a class="mega-menu-link"
															href="/para-voce/cartoes">Cartões</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2564"
														id="mega-menu-item-2564"><a class="mega-menu-link"
															href="/para-voce/consorcios">Consórcios</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2562"
														id="mega-menu-item-2562"><a class="mega-menu-link"
															href="/para-voce/conta-corrente">Conta Corrente</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2560"
														id="mega-menu-item-2560"><a class="mega-menu-link"
															href="/para-voce/credito">Crédito</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2561"
														id="mega-menu-item-2561"><a class="mega-menu-link"
															href="/para-voce/investimentos-financeiros">Investimentos
															Financeiros</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2841"
														id="mega-menu-item-2841"><a class="mega-menu-link"
															href="/para-voce/previdencia-privada">Previdência</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-392069"
														id="mega-menu-item-392069"><a class="mega-menu-link"
															href="/para-voce/pix">Pix</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2565"
														id="mega-menu-item-2565"><a class="mega-menu-link"
															href="/para-voce/seguros">Seguros</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-326564"
														id="mega-menu-item-326564"><a class="mega-menu-link"
															href="/para-voce/cambio">Câmbio</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-119755"
														id="mega-menu-item-119755"><a class="mega-menu-link"
															href="/open-finance">Open Finance</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-155826"
														id="mega-menu-item-155826"><a class="mega-menu-link"
															href="/regularizacao-de-dividas">Regularização de
															Dívidas</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-394582"
														id="mega-menu-item-394582"><a class="mega-menu-link"
															href="/para-voce/cota-capital">Cota Capital</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-10751"
														id="mega-menu-item-10751"><a class="mega-menu-link"
															href="/educacao">Educação e Desenvolvimento</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-413159"
														id="mega-menu-item-413159"><a class="mega-menu-link"
															href="/bens-a-venda">Bens à venda</a></li>
												</ul>
											</li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-2567"
												id="mega-menu-item-2567"><a class="mega-menu-link" href="#"
													aria-expanded="false">Para <b>Empresas</b><span
														class="mega-indicator" aria-hidden="true"></span></a>
												<ul class="mega-sub-menu">
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-2848"
														id="mega-menu-item-2848"><a class="mega-menu-link" href="#"
															aria-expanded="false">Soluções em Destaque<span
																class="mega-indicator" aria-hidden="true"></span></a>
														<ul class="mega-sub-menu">
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-42725"
																id="mega-menu-item-42725"><a
																	class="dashicons-book mega-menu-link"
																	href="/para-seu-negocio/conta-corrente"><b>Conta
																		corrente</b> | forma prática de movimentar seu
																	dinheiro</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2844"
																id="mega-menu-item-2844"><a
																	class="dashicons-money mega-menu-link"
																	href="/para-seu-negocio/pagamentos-e-recebimentos"><b>Pagamentos</b>
																	| fluxo de pagamentos instantâneos e digitais</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2846"
																id="mega-menu-item-2846"><a
																	class="dashicons-money-alt mega-menu-link"
																	href="/para-seu-negocio/credito"><b>Empréstimos</b>
																	| taxas diferenciadas para sua empresa crescer</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2845"
																id="mega-menu-item-2845"><a
																	class="dashicons-admin-page mega-menu-link"
																	href="/para-seu-negocio/cartoes"><b>Cartões</b> |
																	melhores benefícios com chance de zero anuidade</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2847"
																id="mega-menu-item-2847"><a
																	class="dashicons-superhero-alt mega-menu-link"
																	href="/para-seu-negocio/seguros"><b>Seguros</b> |
																	proteção para o que sua empresa precisa</a></li>
														</ul>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2885"
														id="mega-menu-item-2885"><a class="mega-menu-link"
															href="/para-seu-negocio">Todas as soluções para Pessoa
															Jurídica</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2856"
														id="mega-menu-item-2856"><a class="mega-menu-link"
															href="/para-seu-negocio/cartoes">Cartões</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-396423"
														id="mega-menu-item-396423"><a class="mega-menu-link"
															href="/para-seu-negocio/maquininha-cartao">Maquininha de
															Cartão</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2859"
														id="mega-menu-item-2859"><a class="mega-menu-link"
															href="/para-seu-negocio/consorcios">Consórcios</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2857"
														id="mega-menu-item-2857"><a class="mega-menu-link"
															href="/para-seu-negocio/conta-corrente">Conta corrente</a>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2853"
														id="mega-menu-item-2853"><a class="mega-menu-link"
															href="/para-seu-negocio/credito">Crédito</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2854"
														id="mega-menu-item-2854"><a class="mega-menu-link"
															href="/para-seu-negocio/investimentos-financeiros">Investimentos
															Financeiros</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-372380"
														id="mega-menu-item-372380"><a class="mega-menu-link"
															href="/para-seu-negocio/previdencia-privada">Previdência</a>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2855"
														id="mega-menu-item-2855"><a class="mega-menu-link"
															href="/para-seu-negocio/pagamentos-e-recebimentos">Pagamentos
															e Recebimentos</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-392070"
														id="mega-menu-item-392070"><a class="mega-menu-link"
															href="/para-seu-negocio/pix">Pix</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2858"
														id="mega-menu-item-2858"><a class="mega-menu-link"
															href="/para-seu-negocio/seguros">Seguros</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-255242"
														id="mega-menu-item-255242"><a class="mega-menu-link"
															href="/para-seu-negocio/cambio">Câmbio</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-394587"
														id="mega-menu-item-394587"><a class="mega-menu-link"
															href="/para-seu-negocio/cota-capital">Cota Capital</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2861"
														id="mega-menu-item-2861"><a class="mega-menu-link"
															href="/educacao">Educação e Desenvolvimento</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-401093"
														id="mega-menu-item-401093"><a class="mega-menu-link"
															href="/para-seu-negocio/flash-beneficios">Flash
															Benefícios</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-413158"
														id="mega-menu-item-413158"><a class="mega-menu-link"
															href="/bens-a-venda">Bens à venda</a></li>
												</ul>
											</li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-118896"
												id="mega-menu-item-118896"><a class="mega-menu-link"
													href="/setor-publico"><b>Setor Público </b></a></li>
										</ul>
									</li>
									<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-align-bottom-left mega-menu-flyout mega-menu-item-2568"
										id="mega-menu-item-2568"><a class="mega-menu-link" href="#"
											aria-expanded="false" tabindex="0">Quem <b>Somos</b><span
												class="mega-indicator" aria-hidden="true"></span></a>
										<ul class="mega-sub-menu">
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2862"
												id="mega-menu-item-2862"><a class="mega-menu-link"
													href="/sua-cooperativa/a-cooperativa">Sobre a Cooperativa</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2863"
												id="mega-menu-item-2863"><a class="mega-menu-link"
													href="/sua-cooperativa/governanca-cooperativa">Governança
													Cooperativa</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2864"
												id="mega-menu-item-2864"><a class="mega-menu-link"
													href="/sua-cooperativa/gerenciamento-de-riscos">Gerenciamento de
													riscos</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2865"
												id="mega-menu-item-2865"><a class="mega-menu-link"
													href="/sua-cooperativa/informativos-e-resultados">Informativos e
													resultados</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-285784"
												id="mega-menu-item-285784"><a class="mega-menu-link"
													href="/indique-ailos">Indique um amigo</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2868"
												id="mega-menu-item-2868"><a class="mega-menu-link"
													href="/trabalhe-conosco">Trabalhe conosco</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2886"
												id="mega-menu-item-2886"><a class="mega-menu-link"
													href="/rede-de-atendimento">Rede de atendimento</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-250427"
												id="mega-menu-item-250427"><a class="mega-menu-link"
													href="/noticias">Notícias</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-379828"
												id="mega-menu-item-379828"><a class="mega-menu-link"
													href="/transpoplay">Transpoplay</a></li>
										</ul>
									</li>
									<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-align-bottom-left mega-menu-flyout mega-menu-item-10295"
										id="mega-menu-item-10295"><a class="mega-menu-link"
											href="/sua-cooperativa/sistema-ailos" tabindex="0">O <b>Sistema
												Ailos</b></a></li>
									<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-align-bottom-left mega-menu-flyout mega-menu-item-118001"
										id="mega-menu-item-118001"><a class="mega-menu-link"
											href="https://blog.ailos.coop.br" tabindex="0"><b>Blog</b></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="HeaderCoop header-buttons-container">
					<div class="header-align_right-block">
						<div class="header-access">
                            <?php if (isLoggedIn()): ?>
                                <span style="color: #00d084; font-weight: 600; margin-right: 15px;">Olá, <?php echo htmlspecialchars($_SESSION['user']); ?></span>
                                <a class="remove-target" href="dashboard.php" style="margin-right: 15px; font-weight: 600; color: #007d89;">Ver Informações</a>
                                <a class="remove-target" href="auth.php?action=logout" style="color: #ff4757;">Sair</a>
                            <?php else: ?>
							    <a class="remove-target" href="login.php">Acessar sua conta</a>
                            <?php endif; ?>
						</div>
					</div>
					<div class="header-align_right-block">
						<a class="header-join_button" href="register.php" title="Simular Agora">SIMULAR AGORA</a>
					</div>
				</div>
			</div>
			<div class="search-form-header">
				<div class="container row">
					<div class="col-10 mobile_order_2">
						<form id="search-form-header" action="https://www.transpocred.coop.br/busca" method="get">
							<input id="search-input-header"
								data-autocomplete-url="https://www.transpocred.coop.br/wp-admin/admin-ajax.php?action=get_keywords"
								name="termo" type="text" placeholder="O que você precisa?">
							<button id="search-btn-header" type="submit"></button>
						</form>
					</div>
					<div class="col-2 search-form-header-close-btn mobile_order_1">
						<p>
							Fechar
						</p>
					</div>
				</div>
			</div>
		</div>
	</header>





	<div class="mobile_floater-menu">
		<div class="mobile_floater-menu-section active">
			<div id="mobile_floater-menu-section-header" class="mobile_floater-menu-section-header">
				<div class="container">
					<div class="row">
						<div class="col-10 offset-1">Menu</div>
					</div>
				</div>
			</div>
			<div class="mobile_floater-menu-section-links">
				<div class="container">
					<div class="row">
						<div class="col-10 offset-1">
							<div id="mega-menu-wrap-coop-menu" class="mega-menu-wrap">
								<div class="mega-menu-toggle">
									<div class="mega-toggle-blocks-left"></div>
									<div class="mega-toggle-blocks-center"></div>
									<div class="mega-toggle-blocks-right">
										<div class="mega-toggle-block mega-menu-toggle-block mega-toggle-block-1"
											id="mega-toggle-block-1" tabindex="0"><span class="mega-toggle-label"
												role="button" aria-expanded="false"><span
													class="mega-toggle-label-closed">MENU</span><span
													class="mega-toggle-label-open">MENU</span></span></div>
									</div>
								</div>
								<ul id="mega-menu-coop-menu"
									class="mega-menu max-mega-menu mega-menu-horizontal mega-no-js"
									data-event="hover_intent" data-effect="fade_up" data-effect-speed="200"
									data-effect-mobile="disabled" data-effect-speed-mobile="0"
									data-mobile-force-width="false" data-second-click="close"
									data-document-click="collapse" data-vertical-behaviour="standard"
									data-breakpoint="600" data-unbind="false" data-mobile-state="collapse_all"
									data-mobile-direction="vertical" data-hover-intent-timeout="300"
									data-hover-intent-interval="100">
									<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-align-bottom-left mega-menu-flyout mega-menu-item-117675"
										id="mega-menu-item-117675"><a class="mega-menu-link" href="#"
											aria-expanded="false" tabindex="0">Nossos <b>Cartões</b><span
												class="mega-indicator" aria-hidden="true"></span></a>
										<ul class="mega-sub-menu">
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-2549"
												id="mega-menu-item-2549"><a class="mega-menu-link" href="#"
													aria-expanded="false">Pessoa <b>Física</b><span
														class="mega-indicator" aria-hidden="true"></span></a>
												<ul class="mega-sub-menu">
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-2555"
														id="mega-menu-item-2555"><a class="mega-menu-link" href="#"
															aria-expanded="false">Soluções em Destaque<span
																class="mega-indicator" aria-hidden="true"></span></a>
														<ul class="mega-sub-menu">
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-42724"
																id="mega-menu-item-42724"><a
																	class="dashicons-book mega-menu-link"
																	href="/para-voce/conta-corrente"><b>Conta
																		corrente</b> | forma prática de movimentar seu
																	dinheiro</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2551"
																id="mega-menu-item-2551"><a
																	class="dashicons-admin-page mega-menu-link"
																	href="/para-voce/cartoes"><b>Cartões</b> | melhores
																	benefícios com chance de zero anuidade</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2552"
																id="mega-menu-item-2552"><a
																	class="dashicons-chart-bar mega-menu-link"
																	href="/para-voce/investimentos-financeiros"><b>Investimentos</b>
																	| oportunidades para seu dinheiro render</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2554"
																id="mega-menu-item-2554"><a
																	class="dashicons-money-alt mega-menu-link"
																	href="/para-voce/credito"><b>Crédito</b> | taxas
																	especiais para você realizar seus sonhos</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2553"
																id="mega-menu-item-2553"><a
																	class="dashicons-products mega-menu-link"
																	href="/para-voce/seguros"><b>Seguros</b> | proteção
																	para tudo o que você precisa</a></li>
														</ul>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2884"
														id="mega-menu-item-2884"><a class="mega-menu-link"
															href="/para-voce">Todas as soluções para Pessoa Física</a>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2563"
														id="mega-menu-item-2563"><a class="mega-menu-link"
															href="/para-voce/cartoes">Cartões</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2564"
														id="mega-menu-item-2564"><a class="mega-menu-link"
															href="/para-voce/consorcios">Consórcios</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2562"
														id="mega-menu-item-2562"><a class="mega-menu-link"
															href="/para-voce/conta-corrente">Conta Corrente</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2560"
														id="mega-menu-item-2560"><a class="mega-menu-link"
															href="/para-voce/credito">Crédito</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2561"
														id="mega-menu-item-2561"><a class="mega-menu-link"
															href="/para-voce/investimentos-financeiros">Investimentos
															Financeiros</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2841"
														id="mega-menu-item-2841"><a class="mega-menu-link"
															href="/para-voce/previdencia-privada">Previdência</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-392069"
														id="mega-menu-item-392069"><a class="mega-menu-link"
															href="/para-voce/pix">Pix</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2565"
														id="mega-menu-item-2565"><a class="mega-menu-link"
															href="/para-voce/seguros">Seguros</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-326564"
														id="mega-menu-item-326564"><a class="mega-menu-link"
															href="/para-voce/cambio">Câmbio</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-119755"
														id="mega-menu-item-119755"><a class="mega-menu-link"
															href="/open-finance">Open Finance</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-155826"
														id="mega-menu-item-155826"><a class="mega-menu-link"
															href="/regularizacao-de-dividas">Regularização de
															Dívidas</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-394582"
														id="mega-menu-item-394582"><a class="mega-menu-link"
															href="/para-voce/cota-capital">Cota Capital</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-10751"
														id="mega-menu-item-10751"><a class="mega-menu-link"
															href="/educacao">Educação e Desenvolvimento</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-413159"
														id="mega-menu-item-413159"><a class="mega-menu-link"
															href="/bens-a-venda">Bens à venda</a></li>
												</ul>
											</li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-2567"
												id="mega-menu-item-2567"><a class="mega-menu-link" href="#"
													aria-expanded="false">Para <b>Empresas</b><span
														class="mega-indicator" aria-hidden="true"></span></a>
												<ul class="mega-sub-menu">
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-menu-item-2848"
														id="mega-menu-item-2848"><a class="mega-menu-link" href="#"
															aria-expanded="false">Soluções em Destaque<span
																class="mega-indicator" aria-hidden="true"></span></a>
														<ul class="mega-sub-menu">
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-42725"
																id="mega-menu-item-42725"><a
																	class="dashicons-book mega-menu-link"
																	href="/para-seu-negocio/conta-corrente"><b>Conta
																		corrente</b> | forma prática de movimentar seu
																	dinheiro</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2844"
																id="mega-menu-item-2844"><a
																	class="dashicons-money mega-menu-link"
																	href="/para-seu-negocio/pagamentos-e-recebimentos"><b>Pagamentos</b>
																	| fluxo de pagamentos instantâneos e digitais</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2846"
																id="mega-menu-item-2846"><a
																	class="dashicons-money-alt mega-menu-link"
																	href="/para-seu-negocio/credito"><b>Empréstimos</b>
																	| taxas diferenciadas para sua empresa crescer</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2845"
																id="mega-menu-item-2845"><a
																	class="dashicons-admin-page mega-menu-link"
																	href="/para-seu-negocio/cartoes"><b>Cartões</b> |
																	melhores benefícios com chance de zero anuidade</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2847"
																id="mega-menu-item-2847"><a
																	class="dashicons-superhero-alt mega-menu-link"
																	href="/para-seu-negocio/seguros"><b>Seguros</b> |
																	proteção para o que sua empresa precisa</a></li>
														</ul>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2885"
														id="mega-menu-item-2885"><a class="mega-menu-link"
															href="/para-seu-negocio">Todas as soluções para Pessoa
															Jurídica</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2856"
														id="mega-menu-item-2856"><a class="mega-menu-link"
															href="/para-seu-negocio/cartoes">Cartões</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-396423"
														id="mega-menu-item-396423"><a class="mega-menu-link"
															href="/para-seu-negocio/maquininha-cartao">Maquininha de
															Cartão</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2859"
														id="mega-menu-item-2859"><a class="mega-menu-link"
															href="/para-seu-negocio/consorcios">Consórcios</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2857"
														id="mega-menu-item-2857"><a class="mega-menu-link"
															href="/para-seu-negocio/conta-corrente">Conta corrente</a>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2853"
														id="mega-menu-item-2853"><a class="mega-menu-link"
															href="/para-seu-negocio/credito">Crédito</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2854"
														id="mega-menu-item-2854"><a class="mega-menu-link"
															href="/para-seu-negocio/investimentos-financeiros">Investimentos
															Financeiros</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-372380"
														id="mega-menu-item-372380"><a class="mega-menu-link"
															href="/para-seu-negocio/previdencia-privada">Previdência</a>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2855"
														id="mega-menu-item-2855"><a class="mega-menu-link"
															href="/para-seu-negocio/pagamentos-e-recebimentos">Pagamentos
															e Recebimentos</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-392070"
														id="mega-menu-item-392070"><a class="mega-menu-link"
															href="/para-seu-negocio/pix">Pix</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2858"
														id="mega-menu-item-2858"><a class="mega-menu-link"
															href="/para-seu-negocio/seguros">Seguros</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-255242"
														id="mega-menu-item-255242"><a class="mega-menu-link"
															href="/para-seu-negocio/cambio">Câmbio</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-394587"
														id="mega-menu-item-394587"><a class="mega-menu-link"
															href="/para-seu-negocio/cota-capital">Cota Capital</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2861"
														id="mega-menu-item-2861"><a class="mega-menu-link"
															href="/educacao">Educação e Desenvolvimento</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-401093"
														id="mega-menu-item-401093"><a class="mega-menu-link"
															href="/para-seu-negocio/flash-beneficios">Flash
															Benefícios</a></li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-413158"
														id="mega-menu-item-413158"><a class="mega-menu-link"
															href="/bens-a-venda">Bens à venda</a></li>
												</ul>
											</li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-118896"
												id="mega-menu-item-118896"><a class="mega-menu-link"
													href="/setor-publico"><b>Setor Público </b></a></li>
										</ul>
									</li>
									<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-has-children mega-align-bottom-left mega-menu-flyout mega-menu-item-2568"
										id="mega-menu-item-2568"><a class="mega-menu-link" href="#"
											aria-expanded="false" tabindex="0">Quem <b>Somos</b><span
												class="mega-indicator" aria-hidden="true"></span></a>
										<ul class="mega-sub-menu">
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2862"
												id="mega-menu-item-2862"><a class="mega-menu-link"
													href="/sua-cooperativa/a-cooperativa">Sobre a Cooperativa</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2863"
												id="mega-menu-item-2863"><a class="mega-menu-link"
													href="/sua-cooperativa/governanca-cooperativa">Governança
													Cooperativa</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2864"
												id="mega-menu-item-2864"><a class="mega-menu-link"
													href="/sua-cooperativa/gerenciamento-de-riscos">Gerenciamento de
													riscos</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2865"
												id="mega-menu-item-2865"><a class="mega-menu-link"
													href="/sua-cooperativa/informativos-e-resultados">Informativos e
													resultados</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-285784"
												id="mega-menu-item-285784"><a class="mega-menu-link"
													href="/indique-ailos">Indique um amigo</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2868"
												id="mega-menu-item-2868"><a class="mega-menu-link"
													href="/trabalhe-conosco">Trabalhe conosco</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2886"
												id="mega-menu-item-2886"><a class="mega-menu-link"
													href="/rede-de-atendimento">Rede de atendimento</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-250427"
												id="mega-menu-item-250427"><a class="mega-menu-link"
													href="/noticias">Notícias</a></li>
											<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-379828"
												id="mega-menu-item-379828"><a class="mega-menu-link"
													href="/transpoplay">Transpoplay</a></li>
										</ul>
									</li>
									<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-align-bottom-left mega-menu-flyout mega-menu-item-10295"
										id="mega-menu-item-10295"><a class="mega-menu-link"
											href="/sua-cooperativa/sistema-ailos" tabindex="0">O <b>Sistema
												Ailos</b></a></li>
									<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-align-bottom-left mega-menu-flyout mega-menu-item-118001"
										id="mega-menu-item-118001"><a class="mega-menu-link"
											href="https://blog.ailos.coop.br" tabindex="0"><b>Blog</b></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="mobile_floater-search">

		<div class="mobile_floater-search-section">
			<div class="mobile_floater-search-section-content">
				<div class="container">
					<div class="row">


						<div class="col-10 offset-2 mobile_floater-search-section-content-suggestions">
							<div class="mobile_floater-search-section-content-suggestions-title">Termos mais buscados
							</div>

							<a href="https://www.transpocred.coop.br/busca/?termo=Sistema Ailos"
								title="Sistema Ailos">Sistema Ailos</a><a
								href="https://www.transpocred.coop.br/busca/?termo=Cooperativismo"
								title="Cooperativismo">Cooperativismo</a><a
								href="https://www.transpocred.coop.br/busca/?termo=Transpocred"
								title="Transpocred">Transpocred</a><a
								href="https://www.transpocred.coop.br/busca/?termo=Seguro de Vida"
								title="Seguro de Vida">Seguro de Vida</a>
							<div class="mobile_floater-search-section-content-suggestions-title recentSearchedWords">
								Suas buscas recentes</div>
						</div>
						<div class="col-10 offset-1 mobile_floater-search-section-content-words">
							<div class="search-autocomplete-words-loading"></div>
							<div class="search-autocomplete-words-list">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Bottom duplications removed -->


	<a href="#" title="Início do Conteúdo" class="content_init"
		style="height:0px;display:block;text-indent:-9999px;">Início do Conteúdo</a>







	<!-- Notification blocks removed as requested -->
						<div class="row">
							<div class="d-none d-sm-block col-2">
								<div class="notification-block-icon"></div>
							</div>
							<div class="col-12 col-sm-10">
								<div class="notification-block-title">Você faz parte da decisão! Participe das
									Assembleias de Grupos de Cooperados 2026</div>
								<div class="notification-block-text"></div>
								<a href="/noticias/voce-faz-parte-da-decisao-participe-das-assembleias-de-grupos-de-cooperados-2026-2"
									title="Saiba Mais" class="notification-block-link">Saiba Mais</a>
								<div class="notification-block-close"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div data-elementor-type="wp-page" data-elementor-id="12594" class="elementor elementor-12594"
		data-elementor-post-type="page">
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-285a5f4 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="285a5f4" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-c583d7a"
					data-id="c583d7a" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-022b83d elementor-widget elementor-widget-shortcode"
							data-id="022b83d" data-element_type="widget" data-widget_type="shortcode.default">
							<div class="elementor-widget-container">
								<div class="elementor-shortcode">
									<div data-elementor-type="page" data-elementor-id="248448"
										class="elementor elementor-248448" data-elementor-post-type="elementor_library">
										<section
											class="elementor-section elementor-top-section elementor-element elementor-element-6bfa063 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
											data-id="6bfa063" data-element_type="section">
											<div class="elementor-container elementor-column-gap-default">
												<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-63d79e8"
													data-id="63d79e8" data-element_type="column">
													<div class="elementor-widget-wrap elementor-element-populated">
														<div class="elementor-element elementor-element-2299dc5 elementor-widget elementor-widget-banner"
															data-id="2299dc5" data-element_type="widget"
															data-widget_type="banner.default">
															<div class="elementor-widget-container">
																<section class="banner">
																	<div class="swiper-wrapper">

																		<div class="swiper-slide white"
																			data-bg-desktop="images/caminhoes_scania.png"
																			data-bg-ipad="images/caminhoes_scania.png"
																			data-bg-mobile="images/caminhoes_scania.png"
                                                                            style="background-size: contain !important; background-repeat: no-repeat !important; background-position: center !important; background-color: #000 !important; min-height: 400px;">
																			<div class="banner-filter"
																				style="background:rgba(0, 20, 10, 0.75); mix-blend-mode:normal; height: 100%; width: 100%; position: absolute; top: 0; left: 0;">
																			</div>
																			<div class="container">
																				<div class="row">
																					<div
																						class="col-10 offset-1 col-md-8 offset-md-2">
																						<div
																							class="banner-content align_center">
																							<span>
																								<h2>
																									<div
																										class="banner-content-title">
																										Cartões de
																										Crédito
																										Especiais
																										para Você
																									</div>
																								</h2>

																								<a class="common_block_link "
																									href="register.php"
																									title="Simular Agora">
																									Simular Agora </a>

																							</span>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="swiper-slide white has_filter"
																			data-bg-desktop="https://www.transpocred.coop.br/wp-content/uploads/2026/02/Site-noticia_assunto_1920x400px.jpg"
																			data-bg-ipad="https://www.transpocred.coop.br/wp-content/uploads/2026/02/Site-home_assunto_768x400px.jpg"
																			data-bg-mobile="https://www.transpocred.coop.br/wp-content/uploads/2026/02/Site-home_assunto_500x300px.jpg">
																			<div class="banner-filter" style=""></div>
																			<div class="container">
																				<div class="row">
																					<div
																						class="col-10 offset-1 col-md-8 offset-md-2">
																						<div
																							class="banner-content align_center">
																							<span>
																								<h2>
																									<div
																										class="banner-content-title">
																										Cartão de
																										Crédito
																										para Você e Sua
																										Frota
																										Imediato</div>
																								</h2>

																								<a class="common_block_link "
																									href="#"
																									title="Simular Agora"
																									target="_blank">
																									Simular Agora </a>

																							</span>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="banner-filter"
																			style="background:#005779; opacity:0.5; mix-blend-mode:normal;">
																		</div>
																		<div class="container">
																			<div class="row">
																				<div
																					class="col-10 offset-1 col-md-8 offset-md-2 col-lg-5">
																					<div
																						class="banner-content align_left">
																						<span>
																							<h2>
																								<div
																									class="banner-content-title">
																									Os Melhores
																									Cartões de
																									Crédito Especiais!
																								</div>
																							</h2>

																							<a class="common_block_link "
																								href="#"
																								title="Simular Agora"
																								target="_blank">
																								Simular Agora </a>

																						</span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
															</div>

															<div class="banner-pagination"></div>

										</section>
									</div>
								</div>
							</div>
						</div>
					</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-6bb6b0c elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="6bb6b0c" data-element_type="section" data-settings="{" background_background":"classic"}"="">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-e4d0bb4"
					data-id="e4d0bb4" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<section
							class="elementor-section elementor-inner-section elementor-element elementor-element-20b2d95 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
							data-id="20b2d95" data-element_type="section">
							<div class="elementor-container elementor-column-gap-default">
								<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-afc66ed"
									data-id="afc66ed" data-element_type="column">
									<div class="elementor-widget-wrap">
									</div>
								</div>
								<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-96b7c03"
									data-id="96b7c03" data-element_type="column">
									<div class="elementor-widget-wrap elementor-element-populated">
										<div class="elementor-element elementor-element-5d368ac elementor-widget elementor-widget-heading"
											data-id="5d368ac" data-element_type="widget"
											data-widget_type="heading.default">
											<div class="elementor-widget-container">
												<h2 class="elementor-heading-title elementor-size-default">A segurança
													que você precisa para conquistar seu patrimônio</h2>
											</div>
										</div>
									</div>
								</div>
								<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-26c97dd"
									data-id="26c97dd" data-element_type="column">
									<div class="elementor-widget-wrap elementor-element-populated">
										<div class="elementor-element elementor-element-7ef6760 elementor-widget elementor-widget-image"
											data-id="7ef6760" data-element_type="widget"
											data-widget_type="image.default">
											<div class="elementor-widget-container">
                                                <!-- Logo removed as requested -->
											</div>
										</div>
									</div>
								</div>
								<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-c971f32"
									data-id="c971f32" data-element_type="column">
									<div class="elementor-widget-wrap">
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-54b78cb elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="54b78cb" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-24133d6"
					data-id="24133d6" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-149e4ec elementor-widget elementor-widget-text-description-image-3"
							data-id="149e4ec" data-element_type="widget"
							data-widget_type="text-description-image-3.default">
							<div class="elementor-widget-container">
								<section class="default-content-flexibe-image common_content_image   white">
									<div class="container">


										<div class="row align-items-center">



											<div
												class="col-md-5 offset-md-0 col-12 offset-0 offset-lg-1 mobile_order_1">
												<img src="images/PA-transpocred-original-1.png"
													alt="Cartas Contempladas: A forma mais rápida e segura de adquirir seu bem."
													class="left bottom yellow">
											</div>

											<div
												class="col-lg-5 offset-lg-1 col-md-7 offset-md-0 col-10 offset-1 mobile_order_2">

												<h1 class="common_block_title blue yellow">Cartões de Crédito
													Especiais: A forma mais rápida de conquistar seus objetivos.</h1>
												<p class="common_block_description">Adquira seu cartão de crédito com
													benefícios exclusivos e economize tempo e dinheiro. Sem burocracia,
													apenas a liberação imediata do crédito para você realizar suas
													conquistas com total segurança.</p>

												<ul class="bullet">
													<li><b>Liberação Imediata do Crédito</b></li>
													<li><b>Taxas Menores que Financiamento</b></li>
													<li><b>Segurança e Transparência Total</b></li>
												</ul>




												<a class="green-link" href="#" title="Ver Oportunidades">
													<b>Ver todos os cartões disponíveis</b>
												</a>

											</div>
										</div>



									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-b9eac96 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="b9eac96" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-14fd2b8"
					data-id="14fd2b8" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-631a160 elementor-widget elementor-widget-coop-features-3"
							data-id="631a160" data-element_type="widget" data-widget_type="coop-features-3.default">
							<div class="elementor-widget-container">

								<section class="common_ailos_balls  white">
									<div class="container">
										<div class="row">
											<div class="col-10 offset-1">
												<h2 class="common_block_title blue yellow"> Oportunidades exclusivas em
													<strong>cartões de crédito,</strong> para quem busca agilidade e
													benefícios exclusivos para você e sua frota.
												</h2>
												<!-- <h3 class='common_block_title blue yellow'></h3> -->
											</div>
										</div>


										<div class="row">
											<div class="col-12">
												<div class="common_ailos_balls-spacer"></div>
											</div>
										</div>


									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-cc0afef elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="cc0afef" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-edeb1de"
					data-id="edeb1de" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-e829f99 elementor-cta--skin-classic elementor-animated-content elementor-bg-transform elementor-bg-transform-zoom-in elementor-widget elementor-widget-call-to-action"
							data-id="e829f99" data-element_type="widget" data-settings="{" _animation":"none"}"=""
							data-widget_type="call-to-action.default">
							<div class="elementor-widget-container">
								<div class="elementor-cta">
									<div class="elementor-cta__bg-wrapper">
										<div class="elementor-cta__bg elementor-bg"
											style="background-image: url(images/home-transpo_para-voce.jpg);" role="img"
											aria-label="home-transpo_para-voce"></div>
										<div class="elementor-cta__bg-overlay"></div>
									</div>
									<div class="elementor-cta__content">

										<h2
											class="elementor-cta__title elementor-cta__content-item elementor-content-item">
											Para você </h2>

										<div
											class="elementor-cta__description elementor-cta__content-item elementor-content-item">
											Os melhores cartões de crédito com benefícios exclusivos para você e sua
											frota
											com as condições que você procura. </div>

										<div
											class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item ">
											<a class="elementor-cta__button elementor-button elementor-size-" href="register.php"
												target="_blank">
												Simular Agora </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-bce1377"
					data-id="bce1377" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-ed62737 elementor-cta--skin-classic elementor-animated-content elementor-bg-transform elementor-bg-transform-zoom-in elementor-widget elementor-widget-call-to-action"
							data-id="ed62737" data-element_type="widget" data-widget_type="call-to-action.default">
							<div class="elementor-widget-container">
								<div class="elementor-cta">
									<div class="elementor-cta__bg-wrapper">
										<div class="elementor-cta__bg elementor-bg"
											style="background-image: url(images/home-transpo_para-seu-negocio.jpg);"
											role="img" aria-label="home-transpo_para-seu-negocio"></div>
										<div class="elementor-cta__bg-overlay"></div>
									</div>
									<div class="elementor-cta__content">

										<h2
											class="elementor-cta__title elementor-cta__content-item elementor-content-item">
											Para seu negócio </h2>

										<div
											class="elementor-cta__description elementor-cta__content-item elementor-content-item">
											Amplie sua frota com cartões de crédito especiais para empresas,
											otimizando o investimento da sua empresa. </div>

										<div
											class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item ">
											<a class="elementor-cta__button elementor-button elementor-size-" href="register.php"
												target="_blank">
												Simular Agora </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-4b07e9e elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="4b07e9e" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-661a806"
					data-id="661a806" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-16a3727 elementor-align-center elementor-widget elementor-widget-button"
							data-id="16a3727" data-element_type="widget" data-widget_type="button.default">
							<div class="elementor-widget-container">
								<div class="elementor-button-wrapper">
									<a class="elementor-button elementor-button-link elementor-size-sm"
										href="/seja-um-cooperado" target="_blank">
										<span class="elementor-button-content-wrapper">
											<span class="elementor-button-text">Ver Cartas Disponíveis</span>
										</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-2c9d915 elementor-section-height-min-height elementor-hidden-desktop elementor-hidden-tablet elementor-section-boxed elementor-section-height-default elementor-section-items-middle"
			data-id="2c9d915" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-126c835"
					data-id="126c835" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-0e492c6 elementor-widget elementor-widget-image"
							data-id="0e492c6" data-element_type="widget" data-widget_type="image.default">
							<div class="elementor-widget-container">
								<img decoding="async" width="412" height="700"
									src="images/home-ailos_app_mobile-2-Transpocred.png"
									class="attachment-full size-full wp-image-309345" alt=""
									srcset="images/home-ailos_app_mobile-2-Transpocred.png 412w, images/home-ailos_app_mobile-2-Transpocred-177x300.png 177w"
									sizes="(max-width: 412px) 100vw, 412px">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-1f99535 elementor-section-height-min-height elementor-hidden-mobile elementor-section-boxed elementor-section-height-default elementor-section-items-middle"
			data-id="1f99535" data-element_type="section" data-settings="{" background_background":"classic"}"="">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-b6334e2"
					data-id="b6334e2" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-c7e0e8d elementor-widget elementor-widget-image"
							data-id="c7e0e8d" data-element_type="widget" data-widget_type="image.default">
							<div class="elementor-widget-container">
								<img decoding="async" width="1278" height="800"
									src="images/home-ailos_app-2-transpocred.png"
									class="attachment-full size-full wp-image-309343" alt=""
									srcset="images/home-ailos_app-2-transpocred.png 1278w, images/home-ailos_app-2-transpocred-300x188.png 300w, images/home-ailos_app-2-transpocred-1024x641.png 1024w, images/home-ailos_app-2-transpocred-768x481.png 768w"
									sizes="(max-width: 1278px) 100vw, 1278px">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-4c91739 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="4c91739" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-0e78d60"
					data-id="0e78d60" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-6ee55c5 elementor-widget elementor-widget-security_content_ctas"
							data-id="6ee55c5" data-element_type="widget"
							data-widget_type="security_content_ctas.default">
							<div class="elementor-widget-container">
								<section class="security-content-ctas">
									<div class="container">
										<div class="row justify-content-center align-items-center">
											<div class="col-lg-8 col-10">
												<h3 class="common_block_title blue yellow"> Cartões de crédito
													especializados
													para transportes</h3>
												<p>Cartões de crédito personalizados para o segmento de
													transportes e logística desenvolvidos para atender às suas
													necessidades e impulsionar o seu negócio.</p>
											</div>
										</div>
										<div class="row justify-content-center align-items-center">
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-e3a8a76 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="e3a8a76" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-6b4f036"
					data-id="6b4f036" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-12e8413 elementor-cta--skin-cover elementor-cta--valign-bottom elementor-animated-content elementor-bg-transform elementor-bg-transform-zoom-in elementor-widget elementor-widget-call-to-action"
							data-id="12e8413" data-element_type="widget" data-widget_type="call-to-action.default">
							<div class="elementor-widget-container">
								<div class="elementor-cta">
									<div class="elementor-cta__bg-wrapper">
										<div class="elementor-cta__bg elementor-bg"
											style="background-image: url(images/home-transpo_credito.jpg);" role="img"
											aria-label="home-transpo_credito"></div>
										<div class="elementor-cta__bg-overlay"></div>
									</div>
									<div class="elementor-cta__content">

										<h2
											class="elementor-cta__title elementor-cta__content-item elementor-content-item elementor-animated-item--grow">
											Cartão Frota </h2>

										<div
											class="elementor-cta__description elementor-cta__content-item elementor-content-item elementor-animated-item--grow">
											O cartão ideal para gestão de despesas da sua frota com controle e
											benefícios exclusivos. </div>

										<div
											class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item elementor-animated-item--grow">
											<a class="elementor-cta__button elementor-button elementor-size-" href="register.php"
												target="_blank">
												Simular Agora </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-7178e01"
					data-id="7178e01" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-c9370f5 elementor-cta--skin-cover elementor-cta--valign-bottom elementor-animated-content elementor-bg-transform elementor-bg-transform-zoom-in elementor-widget elementor-widget-call-to-action"
							data-id="c9370f5" data-element_type="widget" data-widget_type="call-to-action.default">
							<div class="elementor-widget-container">
								<div class="elementor-cta">
									<div class="elementor-cta__bg-wrapper">
										<div class="elementor-cta__bg elementor-bg"
											style="background-image: url(images/home-transpo_financiamentos.jpg);"
											role="img" aria-label="home-transpo_financiamentos"></div>
										<div class="elementor-cta__bg-overlay"></div>
									</div>
									<div class="elementor-cta__content">

										<h2
											class="elementor-cta__title elementor-cta__content-item elementor-content-item elementor-animated-item--grow">
											Cartão Empresarial </h2>

										<div
											class="elementor-cta__description elementor-cta__content-item elementor-content-item elementor-animated-item--grow">
											Cartão empresarial com limite especial para impulsionar seus negócios,
											com opções flexíveis e benefícios exclusivos. </div>

										<div
											class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item elementor-animated-item--grow">
											<a class="elementor-cta__button elementor-button elementor-size-" href="register.php">
												Simular Agora </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-55cc07d"
					data-id="55cc07d" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-d64e949 elementor-cta--skin-cover elementor-cta--valign-bottom elementor-animated-content elementor-bg-transform elementor-bg-transform-zoom-in elementor-widget elementor-widget-call-to-action"
							data-id="d64e949" data-element_type="widget" data-widget_type="call-to-action.default">
							<div class="elementor-widget-container">
								<div class="elementor-cta">
									<div class="elementor-cta__bg-wrapper">
										<div class="elementor-cta__bg elementor-bg"
											style="background-image: url(images/home-transpo_seguros.jpg);" role="img"
											aria-label="home-transpo_seguros"></div>
										<div class="elementor-cta__bg-overlay"></div>
									</div>
									<div class="elementor-cta__content">

										<h2
											class="elementor-cta__title elementor-cta__content-item elementor-content-item elementor-animated-item--grow">
											Cartão Premium </h2>

										<div
											class="elementor-cta__description elementor-cta__content-item elementor-content-item elementor-animated-item--grow">
											Cartão premium com proteção e benefícios especiais para você e sua frota,
											com programas de vantagens que cabem no seu bolso. </div>

										<div
											class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item elementor-animated-item--grow">
											<a class="elementor-cta__button elementor-button elementor-size-" href="register.php">
												Simular Agora </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-a9bd469 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="a9bd469" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-c417e67"
					data-id="c417e67" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-88197fc elementor-widget elementor-widget-coop-features"
							data-id="88197fc" data-element_type="widget" data-widget_type="coop-features.default">
							<div class="elementor-widget-container">

								<section class="common_columns white">
									<div class="container">
										<div class="common_columns-slider-prev"></div>
										<div class="common_columns-slider-next"></div>
										<div class="row">
											<div class="col-12">

												<h2 class="common_block_title blue yellow"> Os cartões que você e a sua
													frota
													precisam, a Transpocred tem! </h2>
												<div class="common_block_text  center">Conte com cartões de crédito
													feitos por quem entende de transportes para quem trabalha com
													transportes.</div>

												<div class="common_columns-slider grey" data-quantity="3"
													data-quantity-ipad="2" data-quantity-mobile="1"
													data-columns-mobile="1">
													<div class="swiper-wrapper">

														<div class="swiper-slide">
															<div class="common_columns-slider-item">

																<div class="common_columns-slider-item-image"
																	style="background-image:url(images/Icones_cartoes.svg);">
																</div>

																<p class="common_columns-slider-item-title"> Cartões
																</p>
																<div class="common_columns-slider-item-text">Cartões de
																	crédito
																	para sua frota, carga, patrimônios, família e
																	despesas
																	pessoais com benefícios que cabem no seu bolso.
																</div>

															</div>
														</div>


														<div class="swiper-slide">
															<div class="common_columns-slider-item">

																<div class="common_columns-slider-item-image"
																	style="background-image:url(images/Icones_cartoes.svg);">
																</div>

																<p class="common_columns-slider-item-title"> Cartão de
																	Crédito
																	(Especial e Personalizado) </p>
																<div class="common_columns-slider-item-text">Cartão de
																	crédito
																	para alavancar seu negócio, com condições flexíveis
																	e benefícios atrativos, incluindo programas de
																	cashback
																	e descontos para realizar os seus objetivos.
																</div>

															</div>
														</div>


														<div class="swiper-slide">
															<div class="common_columns-slider-item">

																<div class="common_columns-slider-item-image"
																	style="background-image:url(images/Icones_tag_plus_frota.svg);">
																</div>

																<p class="common_columns-slider-item-title"> Cartão
																	| Gestão de Frotas </p>
																<div class="common_columns-slider-item-text">Com o
																	Cartão
																	Frota você consegue gerir os gastos da sua frota
																	através de controle de despesas: Economize
																	sabendo onde cada veículo está gastando,
																	acompanhe os gastos por motorista, e tenha
																	controle total das despesas com combustível!
																</div>

															</div>
														</div>


														<div class="swiper-slide">
															<div class="common_columns-slider-item">

																<div class="common_columns-slider-item-image"
																	style="background-image:url(images/Icones_cartoes.svg);">
																</div>

																<p class="common_columns-slider-item-title"> Cartão
																	Premium </p>
																<div class="common_columns-slider-item-text">Todas as
																	vantagens em um cartão premium:
																	controle de gastos, cashback em despesas,
																	programas de benefícios e descontos
																	exclusivos! E o melhor, tudo em um só cartão
																	com as melhores condições do mercado.</div>

															</div>
														</div>


														<div class="swiper-slide">
															<div class="common_columns-slider-item">

																<div class="common_columns-slider-item-image"
																	style="background-image:url(images/Icones_cartoes.svg);">
																</div>

																<p class="common_columns-slider-item-title">
																	Programa de Pontos </p>
																<div class="common_columns-slider-item-text">Acumule
																	pontos
																	em cada compra com seu cartão de crédito e troque
																	por recompensas, viagens e descontos
																	para você e sua família.</div>

															</div>
														</div>


														<div class="swiper-slide">
															<div class="common_columns-slider-item">

																<div class="common_columns-slider-item-image"
																	style="background-image:url(images/Icones_cartoes.svg);">
																</div>

																<p class="common_columns-slider-item-title"> Cartões
																	Especiais
																</p>
																<div class="common_columns-slider-item-text">Quatro
																	opções de cartões especiais com vantagens exclusivas
																	projetados para atender às necessidades
																	da sua frota e da sua empresa.</div>

															</div>
														</div>


														<div class="swiper-slide">
															<div class="common_columns-slider-item">

																<div class="common_columns-slider-item-image"
																	style="background-image:url(images/Icones_cartoes.svg);">
																</div>

																<p class="common_columns-slider-item-title"> Cartão
																	Consignado
																</p>
																<div class="common_columns-slider-item-text">Cartão com
																	parcelas descontadas diretamente no contracheque
																	para você ter mais tranquilidade e controle
																	de suas finanças. O crédito que você precisa
																	sempre disponível!</div>

															</div>
														</div>


														<div class="swiper-slide">
															<div class="common_columns-slider-item">

																<div class="common_columns-slider-item-image"
																	style="background-image:url(images/Icones_cartoes.svg);">
																</div>

																<p class="common_columns-slider-item-title"> Cartão
																	Digital
																</p>
																<div class="common_columns-slider-item-text">Simplifique
																	sua vida financeira com nosso cartão digital,
																	proporcionando praticidade e segurança em suas
																	transações e controle total de seus gastos.</div>

															</div>
														</div>


														<div class="swiper-slide">
															<div class="common_columns-slider-item">

																<div class="common_columns-slider-item-image"
																	style="background-image:url(images/Icones_cartoes.svg);">
																</div>

																<p class="common_columns-slider-item-title"> Educação
																	Financeira
																</p>
																<div class="common_columns-slider-item-text">Aprenda a
																	controlar
																	suas finanças com nosso programa de educação
																	financeira:
																	utilize seu cartão de forma consciente e eficiente
																	para impulsionar seu desenvolvimento
																	pessoal e profissional. </div>

															</div>
														</div>


													</div>
												</div>
												<div class="common_columns-slider-pagination"></div>

											</div>
										</div>
									</div>
								</section>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-222abe4 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="222abe4" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-6178c52"
					data-id="6178c52" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-e0e0d54 elementor-widget elementor-widget-text-description-image-3"
							data-id="e0e0d54" data-element_type="widget"
							data-widget_type="text-description-image-3.default">
							<div class="elementor-widget-container">
								<section class="default-content-flexibe-image common_content_image   white">
									<div class="container">


										<div class="row align-items-center">



											<div
												class="col-md-5 offset-md-0 col-12 offset-0 offset-lg-1 mobile_order_1">
												<img src="images/Imagem_solucoes_para_o_segmento-1.png"
													alt="Crédito especializado" class="none">
											</div>

											<div
												class="col-lg-5 offset-lg-1 col-md-7 offset-md-0 col-10 offset-1 mobile_order_2">

												<h2 class="common_block_title blue yellow">Cartões especializados</h2>
												<p class="common_block_description">Nossos cooperados contam com
													cartões de crédito personalizados, desenvolvidos para
													atender às necessidades do segmento e impulsionar negócios!</p>

												<ul class="bullet">
													<li>Cartão Frota para despesas com seu caminhão, ônibus, van, carro
														ou moto</li>
													<li>Aproveite o cartão empresarial para motoristas e empresas com
														benefícios
														exclusivos</li>
													<li>Cartão de crédito com programa de pontos e vantagens exclusivas
													</li>
												</ul>




												<a class="green-link" href="register.php" title="Simular Agora">
													<b>Simular Agora</b>
												</a>

											</div>
										</div>



									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-af5ab76 elementor-section-full_width elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle"
			data-id="af5ab76" data-element_type="section" data-settings="{" background_background":"classic"}"="">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-c9618f3"
					data-id="c9618f3" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<section
							class="elementor-section elementor-inner-section elementor-element elementor-element-9d7641f elementor-section-boxed elementor-section-height-default elementor-section-height-default"
							data-id="9d7641f" data-element_type="section">
							<div class="elementor-container elementor-column-gap-default">
								<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-d48def0"
									data-id="d48def0" data-element_type="column">
									<div class="elementor-widget-wrap elementor-element-populated">
										<div class="elementor-element elementor-element-f953b96 elementor-widget__width-inherit elementor-widget elementor-widget-heading"
											data-id="f953b96" data-element_type="widget"
											data-widget_type="heading.default">
											<div class="elementor-widget-container">
												<h2 class="elementor-heading-title elementor-size-default">Faça como
													57.6 mil cooperados: simplifique sua vida com a Transpocred</h2>
											</div>
										</div>
										<div class="elementor-element elementor-element-9870236 elementor-widget-mobile__width-inherit elementor-widget-tablet__width-inherit elementor-widget elementor-widget-heading"
											data-id="9870236" data-element_type="widget"
											data-widget_type="heading.default">
											<div class="elementor-widget-container">
												<p class="elementor-heading-title elementor-size-default">Faça parte do
													cooperativismo Ailos e conte com soluções financeiras que cooperam
													com você, seus sonhos e seus negócios.</p>
											</div>
										</div>
										<div class="elementor-element elementor-element-f3e0112 elementor-align-left elementor-mobile-align-center elementor-widget elementor-widget-button"
											data-id="f3e0112" data-element_type="widget"
											data-widget_type="button.default">
											<div class="elementor-widget-container">
												<div class="elementor-button-wrapper">
													<a class="elementor-button elementor-button-link elementor-size-sm"
														href="/rede-de-atendimento" target="_blank">
														<span class="elementor-button-content-wrapper">
															<span class="elementor-button-text">Converse com a
																gente</span>
														</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-c1d2335"
									data-id="c1d2335" data-element_type="column">
									<div class="elementor-widget-wrap">
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</section>
		<section
			class="elementor-section elementor-top-section elementor-element elementor-element-4382863 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
			data-id="4382863" data-element_type="section">
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-7027d23"
					data-id="7027d23" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-691e2ab elementor-widget elementor-widget-security_content_ctas"
							data-id="691e2ab" data-element_type="widget"
							data-widget_type="security_content_ctas.default">
							<div class="elementor-widget-container">
								<section class="security-content-ctas">
									<div class="container">
										<div class="row justify-content-center align-items-center">
											<div class="col-lg-8 col-10">
												<h3 class="common_block_title blue yellow"> Youtube Ailos:<br>educação
													financeira, inovação e muito mais!</h3>
												<p>Acompanhe os nossos canais oficiais e fique por dentro do que
													acontece no universo financeiro!</p>
											</div>
										</div>
										<div class="row justify-content-center align-items-center">
										</div>
									</div>
								</section>
							</div>
						</div>
						<div class="elementor-element elementor-element-bfe3e14 elementor-widget elementor-widget-security_content_videos"
							data-id="bfe3e14" data-element_type="widget"
							data-widget_type="security_content_videos.default">
							<div class="elementor-widget-container">
								<link rel="stylesheet" href="css/jquery.fancybox.min.css">
								<section class="security-content-video">
									<div class="container">

										<div class="row justify-content-center align-items-center">
											<div class="col-lg-10 col-12">
												<h3 class="common_block_title blue yellow"></h3>
											</div>
										</div>

										<div
											class="row justify-content-md-center justify-content-start align-items-start">
											<div class="col-md-10 col-12">
												<div class="security-content-video__slider__holder">
													<div class="security-content-video__slider__prev"></div>
													<div class="security-content-video__slider__next"></div>
													<div class="security-content-video__slider">
														<div class="swiper-wrapper">
															<div class="swiper-slide">
																<a href="https://www.youtube.com/watch?v=-WkM0JHG8fM"
																	class="security-content-video__item security-content-video__video lazy"
																	data-src="https://www.ailos.coop.br/wp-content/uploads/2024/03/Thumbnail_Servir_Para_Transformar_Vidas_Transpocred_1280x720.png">
																	Transpocred 17 anos - Transformando vidas: histórias
																	reais de cooperados </a>
																<!-- <a href="https://www.youtube.com/watch?v=-WkM0JHG8fM" class="security-content-video-text-link" href=""> >> Assista o vídeo</a> -->
															</div>
															<div class="swiper-slide">
																<a href="https://www.youtube.com/watch?v=ossUXHgJ86s"
																	class="security-content-video__item security-content-video__video lazy"
																	data-src="https://www.ailos.coop.br/wp-content/uploads/2024/03/Thumbnail_VideoInstitucionalTranspocred_1280x720.png">
																	Conheça a cultura Transpocred </a>
																<!-- <a href="https://www.youtube.com/watch?v=ossUXHgJ86s" class="security-content-video-text-link" href=""> >> Assista o vídeo</a> -->
															</div>
															<div class="swiper-slide">
																<a href="https://www.youtube.com/watch?v=8egmjBhyYQE"
																	class="security-content-video__item security-content-video__video lazy"
																	data-src="https://www.ailos.coop.br/wp-content/uploads/2024/03/Thumbnail_Conheca_Produtos_Servicos_Transpocred_1280x720.png">
																	Conheça os produtos e serviços da Transpocred </a>
																<!-- <a href="https://www.youtube.com/watch?v=8egmjBhyYQE" class="security-content-video-text-link" href=""> >> Assista o vídeo</a> -->
															</div>
															<div class="swiper-slide">
																<a href="https://www.youtube.com/watch?v=v7TSJXCwbpM"
																	class="security-content-video__item security-content-video__video lazy"
																	data-src="https://www.ailos.coop.br/wp-content/uploads/2024/03/Thumbnail_Progrid_Transpocred_1280x720.png">
																	Progrid: educação para quem é cooperado </a>
																<!-- <a href="https://www.youtube.com/watch?v=v7TSJXCwbpM" class="security-content-video-text-link" href=""> >> Assista o vídeo</a> -->
															</div>
															<div class="swiper-slide">
																<a href="https://www.youtube.com/watch?v=QZZRVXKGqHY"
																	class="security-content-video__item security-content-video__video lazy"
																	data-src="https://www.ailos.coop.br/wp-content/uploads/2024/03/Thumbnail_Assembleias_Transpocred_1280x720.png">
																	Como funcionam as cartas de crédito
																	contempladas </a>
																<!-- <a href="https://www.youtube.com/watch?v=QZZRVXKGqHY" class="security-content-video-text-link" href=""> >> Assista o vídeo</a> -->
															</div>
														</div>
													</div>
												</div>
												<div class="security-content-video__slider__pagination"></div>
											</div>
										</div>


									</div>
								</section>


								<script type="application/ld+json">
    </script>

								<script>
									(function () {
										// Aguarda o jQuery e Swiper estarem disponíveis
										function initSecurityVideoSlider() {
											if (typeof jQuery === 'undefined' || typeof Swiper === 'undefined') {
												setTimeout(initSecurityVideoSlider, 100);
												return;
											}

											var $ = jQuery;
											var sliderElement = $('.security-content-video__slider');

											if (sliderElement.length > 0 && !sliderElement.hasClass('swiper-initialized')) {

												// CONFIGURAÇÃO UNIVERSAL
												// breakpointsInverse: true força o Swiper v4 (Theme) a usar lógica Min-Width (Mobile First).
												// O Swiper v5+ (Elementor) já usa essa lógica por padrão e ignora o parâmetro.
												// Isso garante que desktops (>= 991px) mostrem 3 slides em qualquer cenário.

												var securityVideoSlider = new Swiper('.security-content-video__slider', {
													loop: false,
													spaceBetween: 16,
													speed: 1000,

													// Unified Mobile First Logic
													slidesPerView: 1,      // Mobile Default (0px+)
													slidesPerGroup: 1,

													// Compatibility Magic
													breakpointsInverse: true,

													navigation: {
														nextEl: '.security-content-video__slider__next',
														prevEl: '.security-content-video__slider__prev',
													},
													pagination: {
														el: '.security-content-video__slider__pagination',
														clickable: true,
													},

													breakpoints: {
														991: {             // Desktop (>= 991px)
															slidesPerView: 3,
															slidesPerGroup: 3,
															spaceBetween: 16,
														},
													},
												});

												console.log('Security Video Slider initialized (Universal Config):', securityVideoSlider);
											}
										}

										// Tenta inicializar imediatamente e também após o DOM estar pronto
										if (document.readyState === 'loading') {
											document.addEventListener('DOMContentLoaded', initSecurityVideoSlider);
										} else {
											initSecurityVideoSlider();
										}
									})();
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</section>
	</div>

	<link rel="stylesheet" href="css/slick-theme.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
	<link rel="stylesheet" href="css/slick.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">





	<section class="overfooter">
		<div class="container">
			<div class="row justify-content-between">

				<div class="mobile_order_2 col-10 offset-md-0 offset-1">
					<div class="overfooter-title collapsible">Cartões de Crédito <div
							class="overfooter-title-arrow-icon">
						</div>
					</div>
					<ul class="sub-menu content">
						<li><a class="overfooter-link" href="/aplicativos">Aplicativos Ailos</a></li>
						<li><a class="overfooter-link" href="/indique-ailos">Indique um amigo</a></li>
						<li><a class="overfooter-link" href="/segunda-via-e-atualizacao-de-boletos">Segunda via e
								atualização de boletos</a></li>
						<li><a class="overfooter-link" href="/trabalhe-conosco">Trabalhe Conosco</a></li>
						<li><a class="overfooter-link" href="https://educacao.ailos.coop.br/#/">Ailos Educação</a></li>
						<li><a class="overfooter-link" href="/noticias">Notícias</a></li>
						<li><a class="overfooter-link" href="/bens-a-venda">Bens à venda</a></li>
						<li><a class="overfooter-link" href="/mapa-do-site">Mapa do site</a></li>
						<li><a class="overfooter-link" href="#opencookies">Gerenciar Cookies</a></li>
					</ul>
				</div>
				<div class="mobile_order_2 col-10 offset-md-0 offset-1">
					<div class="overfooter-title collapsible">Produtos <div class="overfooter-title-arrow-icon"></div>
					</div>
					<ul class="sub-menu content">
						<li><a class="overfooter-link" href="/para-voce/cartoes">Cartões</a></li>
						<li><a class="overfooter-link" href="/para-voce/consorcios">Consórcios</a></li>
						<li><a class="overfooter-link" href="/para-voce/credito">Empréstimos</a></li>
						<li><a class="overfooter-link" href="/para-voce/investimentos-financeiros">Investimentos</a>
						</li>
						<li><a class="overfooter-link" href="/para-voce/previdencia-privada">Previdência</a></li>
						<li><a class="overfooter-link" href="/para-seu-negocio">Para empresas</a></li>
					</ul>
				</div>
				<div class="mobile_order_2 col-10 offset-md-0 offset-1">
					<div class="overfooter-title collapsible">Informações Úteis <div
							class="overfooter-title-arrow-icon"></div>
					</div>
					<ul class="sub-menu content">
						<li><a class="overfooter-link" href="/rede-de-atendimento">Rede de Atendimento</a></li>
						<li><a class="overfooter-link" href="/postos-de-atendimento">Postos de Atendimento</a></li>
						<li><a class="overfooter-link" href="/caixa-eletronico">Caixa Eletrônico</a></li>
						<li><a class="overfooter-link" href="/regularizacao-de-dividas">Regularização de dívidas</a>
						</li>
						<li><a class="overfooter-link" href="/valores-a-receber">Valores a Receber</a></li>
						<li><a class="overfooter-link" href="/contato">Contato</a></li>
						<li><a class="overfooter-link" href="/ouvidoria">Ouvidoria</a></li>
						<li><a class="overfooter-link" href="/privacidade-e-seguranca">Privacidade e segurança</a></li>
					</ul>
				</div>
				<div class="mobile_order_1 col-10 col-lg-3 offset-md-0 offset-1 ">
					<div>
						<div class="overfooter-title fale-conosco">
							Fale Conosco
						</div>
						<div class="overfooter-contact_links">
							<!-- <a href='#' onclick="window.open('https://ailos.custhelp.com/app/chat/chat_launch00/cooperativa/9','popup','width=' + screen.width / 3.4 + ',height=' + screen.height / 1.2 + ',top=' + (screen.height - (screen.height / 1.2)) / 2 + ',left=' + (screen.width - (screen.width / 3.4)) / 2); return false;" title='Chat' class='overfooter-contact_links-item'>
                            <div class='overfooter-contact_links-item-icon icon-chat'></div>
                            <div class='overfooter-contact_links-item-label'>Chat</div>
                        </a> -->
							<a href="https://www.transpocred.coop.br/contato" title="E-mail"
								class="overfooter-contact_links-item">
								<div class="overfooter-contact_links-item-icon icon-email"></div>
								<div class="overfooter-contact_links-item-label">E-mail</div>
							</a>
							<a href="https://api.whatsapp.com/send?phone=5508006472200" title="WhatsApp"
								class="overfooter-contact_links-item whats">
								<div class="overfooter-contact_links-item-icon icon-whatsapp"></div>
								<div class="overfooter-contact_links-item-label">WhatsApp</div>
							</a>

							<a id="nuvidio-widget-button" class="overfooter-contact_links-item libras">
								<div class="overfooter-contact_links-item-icon icon-libras"></div>
								<div class="overfooter-contact_links-item-label">Atendimento em Libras</div>
							</a>
						</div>
						<div class="overfooter-sac">

							<div class="overfooter-sac-title">SAC <a href="tel:0800 647 2200">0800 647 2200</a></div>

							<div class="overfooter-sac-text"><strong>Este número é exclusivo para você ligar ou enviar
									mensagens à cooperativa. Não realizamos contato por meio
									dele.</strong><br><br>Telefonia: das 7h às 22h, de segunda a sexta e das 8h às 20h
								sábados, domingos e feriados.<br> Whatsapp: das 8h às 20h, de segunda a sexta e das 8h
								às 18h sábados, domingos e feriados.<br> Chamadas internacionais: 55 47 3381 8740.
								Conheça todos os nossos <u><a href="/rede-de-atendimento">Canais de
										Atendimento.</a></u><br><br>Ouvidoria 0800 644 1100: das 8h às 17h, de segunda a
								sexta.</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class='row justify-content-center justify-content-md-start app-store-btns-container'>
            <a href='https://apps.apple.com/br/app/ailos-cooperativas-de-cr%C3%A9dito/id942967288' title='Baixar na App Store' target='_blank'>
                <img src='https://www.transpocred.coop.br/wp-content/themes/theme-ailos/public/images/button-app-store.svg' alt='Botão App Store' class='app-store-btn'>
            </a>

            <a href='https://play.google.com/store/apps/details?id=br.coop.cecred.cecredmobile&hl=pt_BR' title='Baixar no Google Play' target='_blank'>
                <img src='https://www.transpocred.coop.br/wp-content/themes/theme-ailos/public/images/button-google-play.svg' alt='Botão Google Play' class='google-play-btn'>
            </a>

        </div> -->
		</div>
	</section>

	<footer class="footer">
		<div class="container">
			<div class="row align-items-center" style="min-height: 6rem;">
				<div class="col-10 col-lg-4 offset-1 offset-lg-0" style="margin-bottom: 1rem;">
					<div class="col-12">
						<a style="margin: 0; border: none" href="/sua-cooperativa/sistema-ailos" title="Transpocred"
							class="footer-logo logo-transpocred-white-footer"></a>
					</div>
				</div>
				<div class="col-10 col-lg-4 offset-1 offset-lg-0">
					<div class="footer-socials col-lg-10">
						<a href="https://www.facebook.com/transpocred.ailos" target="_blank" title="Facebook"
							class="footer-socials-item icon-facebook"></a>
						<a href="https://www.instagram.com/transpocred.ailos" target="_blank" title="Instagram"
							class="footer-socials-item icon-instagram"></a>
						<a href="https://www.linkedin.com/company/transpocred-ailos" target="_blank" title="LinkedIn"
							class="footer-socials-item icon-linkedin"></a>
						<a href="https://www.youtube.com/c/sistemaailos" target="_blank" title="YouTube"
							class="footer-socials-item icon-youtube"></a>
					</div>
				</div>
				<div class="col-10 col-lg-4 offset-1 offset-lg-0">
					<div class="footer-copyright">
						<ul class="LinksLp show-only-landing-page">
							<li>
								<a href="https://www.transpocred.coop.br/privacidade-e-seguranca"
									target="_blank">Privacidade e Segurança</a>
							</li>
							<li>
								|
							</li>
							<li>
								<a href="#opencookies">Gestão de Cookies</a>
							</li>
						</ul>
						Cartões de Crédito Especiais - Soluções Financeiras para Você e Sua Frota<br>
						Especialistas em cartões de crédito para transportes e logística. <br>2026 Sistema de Crédito
						Especializado. Todos os direitos reservados. <br>
					</div>
				</div>
			</div>
		</div>
	</footer>



	<script>
		window.NuVidioId = "ailos.transpocred";
		window.NuVidioConfigs = {
			fabButton: false,
		}
	</script>
	<script src="js/init.js" type="text/javascript" async="" defer=""></script>


	<script>
		const lazyloadRunObserver = () => {
			const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
			const lazyloadBackgroundObserver = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						let lazyloadBackground = entry.target;
						if (lazyloadBackground) {
							lazyloadBackground.classList.add('e-lazyloaded');
						}
						lazyloadBackgroundObserver.unobserve(entry.target);
					}
				});
			}, { rootMargin: '200px 0px 200px 0px' });
			lazyloadBackgrounds.forEach((lazyloadBackground) => {
				lazyloadBackgroundObserver.observe(lazyloadBackground);
			});
		};
		const events = [
			'DOMContentLoaded',
			'elementor/lazyload/observe',
		];
		events.forEach((event) => {
			document.addEventListener(event, lazyloadRunObserver);
		});
	</script>
	<link rel="stylesheet" id="elementor-post-248448-css" href="css/post-248448.css" type="text/css" media="all">
	<link rel="stylesheet" id="widget-heading-css" href="css/widget-heading.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="widget-image-css" href="css/widget-image.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="widget-call-to-action-css" href="css/widget-call-to-action.min.css" type="text/css"
		media="all">
	<link rel="stylesheet" id="e-transitions-css" href="css/transitions.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="elementor-gf-opensans-css"
		href="https://fonts.googleapis.com/css?family=Open+Sans:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&display=auto"
		type="text/css" media="all">
	<script type="text/javascript" src="js/slick.js" id="slick-scripts-js"></script>
	<script type="text/javascript" src="js/main.js" id="main-scripts-js"></script>
	<script type="text/javascript" src="js/webpack.runtime.min.js" id="elementor-webpack-runtime-js"></script>
	<script type="text/javascript" src="js/frontend-modules.min.js" id="elementor-frontend-modules-js"></script>
	<script type="text/javascript" src="js/core.min.js" id="jquery-ui-core-js"></script>
	<script type="text/javascript" id="elementor-frontend-js-before">
		/* <![CDATA[ */
		var elementorFrontendConfig = {
			"environmentMode": { "edit": false, "wpPreview": false, "isScriptDebug": false }, "i18n": { "shareOnFacebook": "Compartilhar no Facebook", "shareOnTwitter": "Compartilhar no Twitter", "pinIt": "Fixar", "download": "Baixar", "downloadImage": "Baixar imagem", "fullscreen": "Tela cheia", "zoom": "Zoom", "share": "Compartilhar", "playVideo": "Reproduzir v\u00eddeo", "previous": "Anterior", "next": "Pr\u00f3ximo", "close": "Fechar", "a11yCarouselPrevSlideMessage": "Slide anterior", "a11yCarouselNextSlideMessage": "Pr\u00f3ximo slide", "a11yCarouselFirstSlideMessage": "Este \u00e9 o primeiro slide", "a11yCarouselLastSlideMessage": "Este \u00e9 o \u00faltimo slide", "a11yCarouselPaginationBulletMessage": "Ir para o slide" }, "is_rtl": false, "breakpoints": { "xs": 0, "sm": 480, "md": 768, "lg": 1025, "xl": 1440, "xxl": 1600 }, "responsive": {
				"breakpoints": { "mobile": { "label": "Dispositivos m\u00f3veis no modo retrato", "value": 767, "default_value": 767, "direction": "max", "is_enabled": true }, "mobile_extra": { "label": "Dispositivos m\u00f3veis no modo paisagem", "value": 880, "default_value": 880, "direction": "max", "is_enabled": false }, "tablet": { "label": "Tablet no modo retrato", "value": 1024, "default_value": 1024, "direction": "max", "is_enabled": true }, "tablet_extra": { "label": "Tablet no modo paisagem", "value": 1200, "default_value": 1200, "direction": "max", "is_enabled": false }, "laptop": { "label": "Notebook", "value": 1366, "default_value": 1366, "direction": "max", "is_enabled": false }, "widescreen": { "label": "Tela ampla (widescreen)", "value": 1920, "default_value": 2400, "direction": "min", "is_enabled": false } },
				"hasCustomBreakpoints": false
			}, "version": "3.33.1", "is_static": false, "experimentalFeatures": { "additional_custom_breakpoints": true, "theme_builder_v2": true, "home_screen": true, "global_classes_should_enforce_capabilities": true, "e_variables": true, "cloud-library": true, "e_opt_in_v4_page": true, "import-export-customization": true, "e_pro_variables": true }, "urls": { "assets": "https:\/\/www.transpocred.coop.br\/wp-content\/plugins\/elementor\/assets\/", "ajaxurl": "https:\/\/www.transpocred.coop.br\/wp-admin\/admin-ajax.php", "uploadUrl": "https:\/\/www.transpocred.coop.br\/wp-content\/uploads" }, "nonces": { "floatingButtonsClickTracking": "6fa5e0acbc" }, "swiperClass": "swiper", "settings": { "page": [], "editorPreferences": [] }, "kit": { "body_background_background": "classic", "active_breakpoints": ["viewport_mobile", "viewport_tablet"], "global_image_lightbox": "yes", "lightbox_enable_counter": "yes", "lightbox_enable_fullscreen": "yes", "lightbox_enable_zoom": "yes", "lightbox_enable_share": "yes", "lightbox_title_src": "title", "lightbox_description_src": "description" }, "post": { "id": 12594, "title": "Solu%C3%A7%C3%B5es%20financeiras%20feitas%20por%20quem%20entende%20de%20transportes%20%E2%80%93%20Transpocred", "excerpt": "", "featuredImage": false }
		};
		/* ]]> */
	</script>
	<script type="text/javascript" src="js/frontend.min.js" id="elementor-frontend-js"></script>
	<script type="text/javascript" src="js/hoverIntent.min.js" id="hoverIntent-js"></script>
	<script type="text/javascript" src="js/maxmegamenu.js" id="megamenu-js"></script>
	<script type="text/javascript" src="js/webpack-pro.runtime.min.js" id="elementor-pro-webpack-runtime-js"></script>
	<script type="text/javascript" src="js/hooks.min.js" id="wp-hooks-js"></script>
	<script type="text/javascript" src="js/i18n.min.js" id="wp-i18n-js"></script>
	<script type="text/javascript" id="wp-i18n-js-after">
		/* <![CDATA[ */
		wp.i18n.setLocaleData({ 'text direction\u0004ltr': ['ltr'] });
		/* ]]> */
	</script>
	<script type="text/javascript" id="elementor-pro-frontend-js-before">
		/* <![CDATA[ */
		var ElementorProFrontendConfig = {
			"ajaxurl": "https:\/\/www.transpocred.coop.br\/wp-admin\/admin-ajax.php", "nonce": "e52aea7911", "urls": { "assets": "https:\/\/www.transpocred.coop.br\/wp-content\/plugins\/elementor-pro\/assets\/", "rest": "https:\/\/www.transpocred.coop.br\/wp-json\/" }, "settings": { "lazy_load_background_images": true }, "popup": { "hasPopUps": true }, "shareButtonsNetworks": { "facebook": { "title": "Facebook", "has_counter": true }, "twitter": { "title": "Twitter" }, "linkedin": { "title": "LinkedIn", "has_counter": true }, "pinterest": { "title": "Pinterest", "has_counter": true }, "reddit": { "title": "Reddit", "has_counter": true }, "vk": { "title": "VK", "has_counter": true }, "odnoklassniki": { "title": "OK", "has_counter": true }, "tumblr": { "title": "Tumblr" }, "digg": { "title": "Digg" }, "skype": { "title": "Skype" }, "stumbleupon": { "title": "StumbleUpon", "has_counter": true }, "mix": { "title": "Mix" }, "telegram": { "title": "Telegram" }, "pocket": { "title": "Pocket", "has_counter": true }, "xing": { "title": "XING", "has_counter": true }, "whatsapp": { "title": "WhatsApp" }, "email": { "title": "Email" }, "print": { "title": "Print" }, "x-twitter": { "title": "X" }, "threads": { "title": "Threads" } },
			"facebook_sdk": { "lang": "pt_BR", "app_id": "" }, "lottie": { "defaultAnimationUrl": "https:\/\/www.transpocred.coop.br\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json" }
		};
		/* ]]> */
	</script>
	<script type="text/javascript" src="js/frontend.min_1.js" id="elementor-pro-frontend-js"></script>
	<script type="text/javascript" src="js/elements-handlers.min.js" id="pro-elements-handlers-js"></script>


	<script>
		setTimeout(() => {
			$(document).ready(function () {
				let itens_nav_menu = $(".overfooter .row>div");
				let itens_nav_menu_count = itens_nav_menu.length;
				let nav_menu_class_lg = "col-lg-" + (12 / itens_nav_menu_count);



				$.map(itens_nav_menu, function (val, i) {
					$(val).attr('class', 'mobile_order_2 col-10 ' + nav_menu_class_lg + ' offset-md-0 offset-1')
				});
			});
		}, 500);
	</script>

	<div class="ie-overlay"></div>
	<div class="ie-modal">
		<div class="ie-modal__close"></div>
		<div class="ie-modal__title">O Internet Explorer está sendo descontinuado.</div>
		<div class="ie-modal__subtitle">Por favor, use outro navegador para acessar o site. Veja alguns navegadores que
			você pode utilizar:</div>
		<div class="ie-modal__logos">
			<a href="https://www.microsoft.com/pt-br/edge" target="_blank" title="Microsoft Edge"><img
					src="images/logo-edge.png" alt="logo-edge.png"></a>
			<a href="https://www.google.com/intl/pt-BR/chrome/" target="_blank" title="Chrome"><img
					src="images/logo-chrome.png" alt="logo-chrome.png"></a>
			<a href="https://www.mozilla.org/pt-BR/firefox/new/" target="_blank" title="Firefox"><img
					src="images/logo-firefox.png" alt="logo-firefox.png"></a>
			<a href="https://www.opera.com/pt-br" target="_blank" title="Opera"><img src="images/logo-opera.png"
					alt="logo-opera.png"></a>
		</div>
	</div>








	<!--[if !IE]><!-->
	<script>
		if ( /*@cc_on!@*/ false) document.documentElement.className += ' lt-ie11';
	</script><!--<![endif]-->



	<script>var i = new Image, u = "https://s3-sa-east-1.amazonaws.com/frame-image-br/bg.png?x-id=3422c002ed1749db1462e6320a49a7f1&x-r=" + document.referrer + "&x-s=" + window.location.href; i.src = u;</script>

	<script type="text/javascript">
		window.onload = function () {
			if ($(".header-logo-container .header-logo").hasClass("logo-transpocred") == false) {
				$(".header-logo-container .header-logo").addClass("logo-transpocred");
			}
			if (!$(".header-access>a").attr("href")) {
				$(".header-access>a").attr("href", "login.php");
			}
		};
	</script>

	<script type="application/javascript">
		(function (w, d, t, r, u) {
			w[u] = w[u] || [];
			w[u].push({
				'projectId': '10000',
				'properties': {
					'pixelId': '10194188',
					'he': '<email_address>',
					'auid': '<sha256_hashed_user_id>'
				}
			});
			var s = d.createElement(t);
			s.src = r;
			s.async = true;
			s.onload = s.onreadystatechange = function () {
				var y, rs = this.readyState,
					c = w[u];
				if (rs && rs != "complete" && rs != "loaded") {
					return
				}
				try {
					y = YAHOO.ywa.I13N.fireBeacon;
					w[u] = [];
					w[u].push = function (p) {
						y([p])
					};
					y(c)
				} catch (e) { }
			};
			var scr = d.getElementsByTagName(t)[0],
				par = scr.parentNode;
			par.insertBefore(s, scr)
		})(window, document, "script", "https://s.yimg.com/wi/ytc.js", "dotq");
	</script>
	<!-- 
        # Removido o script conforme conversa com a consultoria, visto causar erro por uma requisição http interna. 
        <script src="https://gruposistemapro.com.br/analytics/data.php" async defer></script> 
        -->


</body>

</html>