<?php
/**
 * Organism: Overfooter, <footer>, scripts JS inline de bootstrap (lazyload, elementorFrontendConfig, tracking).
 * Atomic Design — Refactor Clean Architecture
 */
?>
<link rel="stylesheet" href="public/assets/vendor/css/slick-theme.min.css" crossorigin="anonymous"
	referrerpolicy="no-referrer">
<link rel="stylesheet" href="public/assets/vendor/css/slick.min.css" crossorigin="anonymous"
	referrerpolicy="no-referrer">





<section class="overfooter">
	<div class="container">
		<div class="row justify-content-between">

			<div class="mobile_order_2 col-10 offset-md-0 offset-1">
				<div class="overfooter-title collapsible">Cartões de Crédito <div class="overfooter-title-arrow-icon">
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
				<div class="overfooter-title collapsible">Informações Úteis <div class="overfooter-title-arrow-icon">
					</div>
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
				<img src='https://www.transpocred.coop.br/wp-content/themes/theme-ailos/public/assets/vendor/images/button-app-store.svg' alt='Botão App Store' class='app-store-btn'>
			</a>

			<a href='https://play.google.com/store/apps/details?id=br.coop.cecred.cecredmobile&hl=pt_BR' title='Baixar no Google Play' target='_blank'>
				<img src='https://www.transpocred.coop.br/wp-content/themes/theme-ailos/public/assets/vendor/images/button-google-play.svg' alt='Botão Google Play' class='google-play-btn'>
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
<script src="public/assets/vendor/js/init.js" type="text/javascript" async="" defer=""></script>


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
<link rel="stylesheet" id="elementor-post-248448-css" href="public/assets/vendor/css/post-248448.css" type="text/css"
	media="all">
<link rel="stylesheet" id="widget-heading-css" href="public/assets/vendor/css/widget-heading.min.css" type="text/css"
	media="all">
<link rel="stylesheet" id="widget-image-css" href="public/assets/vendor/css/widget-image.min.css" type="text/css"
	media="all">
<link rel="stylesheet" id="widget-call-to-action-css" href="public/assets/vendor/css/widget-call-to-action.min.css"
	type="text/css" media="all">
<link rel="stylesheet" id="e-transitions-css" href="public/assets/vendor/css/transitions.min.css" type="text/css"
	media="all">
<link rel="stylesheet" id="elementor-gf-opensans-css"
	href="https://fonts.googleapis.com/css?family=Open+Sans:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&display=auto"
	type="text/css" media="all">
<script type="text/javascript" src="public/assets/vendor/js/slick.js" id="slick-scripts-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/main.js" id="main-scripts-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/webpack.runtime.min.js"
	id="elementor-webpack-runtime-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/frontend-modules.min.js"
	id="elementor-frontend-modules-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/core.min.js" id="jquery-ui-core-js"></script>
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
<script type="text/javascript" src="public/assets/vendor/js/frontend.min.js" id="elementor-frontend-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/hoverIntent.min.js" id="hoverIntent-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/maxmegamenu.js" id="megamenu-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/webpack-pro.runtime.min.js"
	id="elementor-pro-webpack-runtime-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/hooks.min.js" id="wp-hooks-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/i18n.min.js" id="wp-i18n-js"></script>
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
<script type="text/javascript" src="public/assets/vendor/js/frontend.min_1.js" id="elementor-pro-frontend-js"></script>
<script type="text/javascript" src="public/assets/vendor/js/elements-handlers.min.js"
	id="pro-elements-handlers-js"></script>


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
				src="public/assets/vendor/images/logo-edge.png" alt="logo-edge.png"></a>
		<a href="https://www.google.com/intl/pt-BR/chrome/" target="_blank" title="Chrome"><img
				src="public/assets/vendor/images/logo-chrome.png" alt="logo-chrome.png"></a>
		<a href="https://www.mozilla.org/pt-BR/firefox/new/" target="_blank" title="Firefox"><img
				src="public/assets/vendor/images/logo-firefox.png" alt="logo-firefox.png"></a>
		<a href="https://www.opera.com/pt-br" target="_blank" title="Opera"><img src="public/assets/vendor/images/logo-opera.png"
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