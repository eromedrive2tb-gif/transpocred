<?php
/**
 * Molecule/VideoSlider — 5-video swiper slider + Swiper init script.
 * Fecha as divs/sections abertas no YoutubeIntro.
 */
?>
<div class="elementor-element elementor-element-bfe3e14 elementor-widget elementor-widget-security_content_videos"
    data-id="bfe3e14" data-element_type="widget" data-widget_type="security_content_videos.default">
    <div class="elementor-widget-container">
        <link rel="stylesheet" href="css/jquery.fancybox.min.css">
        <section class="security-content-video">
            <div class="container">

                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-10 col-12">
                        <h3 class="common_block_title blue yellow"></h3>
                    </div>
                </div>

                <div class="row justify-content-md-center justify-content-start align-items-start">
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
</div>
</div>
</section>
</div>