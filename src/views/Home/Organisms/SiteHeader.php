<?php
/**
 * Organism: <body> opening + seções de acessibilidade + <header> completo. Compõe Molecules/AccessibilityNav, Atoms/auth-buttons, Molecules/SearchBar.
 * Atomic Design — Refactor Clean Architecture
 */
?>

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

	<?php require BASE_PATH . '/src/views/Home/Molecules/AccessibilityNav.php'; ?>

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
																		corrente</b> | forma prática de movimentar
																	seu
																	dinheiro</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2551"
																id="mega-menu-item-2551"><a
																	class="dashicons-admin-page mega-menu-link"
																	href="/para-voce/cartoes"><b>Cartões</b> |
																	melhores
																	benefícios com chance de zero anuidade</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2552"
																id="mega-menu-item-2552"><a
																	class="dashicons-chart-bar mega-menu-link"
																	href="/para-voce/investimentos-financeiros"><b>Investimentos</b>
																	| oportunidades para seu dinheiro render</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2554"
																id="mega-menu-item-2554"><a
																	class="dashicons-money-alt mega-menu-link"
																	href="/para-voce/credito"><b>Crédito</b> | taxas
																	especiais para você realizar seus sonhos</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2553"
																id="mega-menu-item-2553"><a
																	class="dashicons-products mega-menu-link"
																	href="/para-voce/seguros"><b>Seguros</b> |
																	proteção
																	para tudo o que você precisa</a></li>
														</ul>
													</li>
													<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-menu-item-2884"
														id="mega-menu-item-2884"><a class="mega-menu-link"
															href="/para-voce">Todas as soluções para Pessoa
															Física</a>
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
															href="/para-voce/previdencia-privada">Previdência</a>
													</li>
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
																		corrente</b> | forma prática de movimentar
																	seu
																	dinheiro</a></li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2844"
																id="mega-menu-item-2844"><a
																	class="dashicons-money mega-menu-link"
																	href="/para-seu-negocio/pagamentos-e-recebimentos"><b>Pagamentos</b>
																	| fluxo de pagamentos instantâneos e
																	digitais</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2846"
																id="mega-menu-item-2846"><a
																	class="dashicons-money-alt mega-menu-link"
																	href="/para-seu-negocio/credito"><b>Empréstimos</b>
																	| taxas diferenciadas para sua empresa
																	crescer</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2845"
																id="mega-menu-item-2845"><a
																	class="dashicons-admin-page mega-menu-link"
																	href="/para-seu-negocio/cartoes"><b>Cartões</b>
																	|
																	melhores benefícios com chance de zero
																	anuidade</a>
															</li>
															<li class="mega-menu-item mega-menu-item-type-custom mega-menu-item-object-custom mega-has-icon mega-icon-left mega-menu-item-2847"
																id="mega-menu-item-2847"><a
																	class="dashicons-superhero-alt mega-menu-link"
																	href="/para-seu-negocio/seguros"><b>Seguros</b>
																	|
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
															href="/para-seu-negocio/conta-corrente">Conta
															corrente</a>
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
															href="/para-seu-negocio/cota-capital">Cota Capital</a>
													</li>
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
													href="/sua-cooperativa/a-cooperativa">Sobre a Cooperativa</a>
											</li>
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
							<?php require BASE_PATH . '/src/views/Home/Atoms/auth-buttons.php'; ?>
						</div>
					</div>
					<div class="header-align_right-block">
						<a class="header-join_button" href="register.php" title="Simular Agora">SIMULAR AGORA</a>
					</div>
				</div>
			</div>
			<?php require BASE_PATH . '/src/views/Home/Molecules/SearchBar.php'; ?>
		</div>
	</header>