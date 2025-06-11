/**
 * JavaScript principal do tema
 *
 * @package Theme_Espingardaria
 */

// Log inicial para confirmar o carregamento do arquivo
console.log("main.js: Arquivo sendo lido!");

// Verifica se jQuery está disponível
if (typeof jQuery === 'undefined') {
    console.error("main.js: jQuery não está disponível. Verifique o enfileiramento no functions.php.");
} else {
    console.log("main.js: jQuery disponível. Versão:", jQuery.fn.jquery);

    // Executa o código quando o DOM estiver pronto
    jQuery(document).ready(function($) {
        console.log("main.js: Document ready executado.");

        // Inicializa o Bootstrap Tooltip
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            console.log("main.js: Bootstrap disponível. Inicializando Tooltips.");
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        } else {
            console.error("main.js: Bootstrap ou bootstrap.Tooltip não está disponível. Verifique o enfileiramento.");
        }

        // Inicializa o Bootstrap Popover
        if (typeof bootstrap !== 'undefined' && bootstrap.Popover) {
            console.log("main.js: Inicializando Popovers.");
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        } else {
            console.error("main.js: Bootstrap ou bootstrap.Popover não está disponível. Verifique o enfileiramento.");
        }

        // Menu fixo no topo ao rolar
        var header = $(".site-header");
        if (header.length) {
            console.log("main.js: Elemento .site-header encontrado.");
            var headerOffset = header.offset().top;
            $(window).scroll(function() {
                if ($(window).scrollTop() > headerOffset) {
                    header.addClass("fixed-header");
                    $("body").addClass("has-fixed-header");
                } else {
                    header.removeClass("fixed-header");
                    $("body").removeClass("has-fixed-header");
                }
            });
        } else {
            console.log("main.js: Elemento .site-header NÃO encontrado.");
        }

        // Botão de voltar ao topo
        var backToTop = $(".back-to-top");
        if (backToTop.length) {
            console.log("main.js: Elemento .back-to-top encontrado.");
            $(window).scroll(function() {
                if ($(window).scrollTop() > 300) {
                    backToTop.addClass("show");
                } else {
                    backToTop.removeClass("show");
                }
            });
            backToTop.on("click", function(e) {
                console.log("main.js: Clique no .back-to-top detectado.");
                e.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, 800);
            });
        } else {
            console.log("main.js: Elemento .back-to-top NÃO encontrado.");
        }

        // Galeria de produtos
        var productGalleryThumbs = $('.product-gallery-thumbs');
        if (productGalleryThumbs.length) {
            console.log("main.js: Elemento .product-gallery-thumbs encontrado.");
            productGalleryThumbs.on('click', 'img', function() {
                console.log("main.js: Clique na miniatura da galeria detectado.");
                var imgSrc = $(this).attr('src');
                $('.product-gallery-main img').attr('src', imgSrc);
            });
        } else {
            console.log("main.js: Elemento .product-gallery-thumbs NÃO encontrado.");
        }

        // Contador de quantidade
        var quantityButtons = $('.quantity-button');
        if (quantityButtons.length) {
            console.log("main.js: Elemento .quantity-button encontrado.");
            quantityButtons.on('click', function() {
                console.log("main.js: Clique no botão de quantidade detectado.");
                var button = $(this);
                var quantityInput = button.parent().find('.quantity-input');
                var currentValue = parseInt(quantityInput.val());

                if (button.hasClass('quantity-up')) {
                    quantityInput.val(currentValue + 1);
                } else if (button.hasClass('quantity-down') && currentValue > 1) {
                    quantityInput.val(currentValue - 1);
                }
            });
        } else {
            console.log("main.js: Elemento .quantity-button NÃO encontrado.");
        }

        // Filtro de produtos móvel
        var filterToggle = $('.filter-toggle');
        if (filterToggle.length) {
            console.log("main.js: Elemento .filter-toggle encontrado.");
            filterToggle.on('click', function(e) {
                console.log("main.js: Clique no .filter-toggle detectado.");
                e.preventDefault();
                $('.product-filters').toggleClass('show');
            });
        } else {
            console.log("main.js: Elemento .filter-toggle NÃO encontrado.");
        }

        // Fechar filtro móvel
        var filterClose = $('.filter-close');
        if (filterClose.length) {
            console.log("main.js: Elemento .filter-close encontrado.");
            filterClose.on('click', function(e) {
                console.log("main.js: Clique no .filter-close detectado.");
                e.preventDefault();
                $('.product-filters').removeClass('show');
            });
        } else {
            console.log("main.js: Elemento .filter-close NÃO encontrado.");
        }

        // Formulário de avaliação
        var ratingSelect = $('.rating-select i');
        if (ratingSelect.length) {
            console.log("main.js: Elemento .rating-select i encontrado.");
            ratingSelect.on('click', function() {
                console.log("main.js: Clique na estrela de avaliação detectado.");
                var rating = $(this).data('rating');
                var ratingSelect = $(this).parent();
                var ratingInput = ratingSelect.next('input');

                ratingSelect.find('i').removeClass('active');

                for (var i = 1; i <= rating; i++) {
                    ratingSelect.find('i[data-rating="' + i + '"]').addClass('active');
                }

                ratingInput.val(rating);
            });
        } else {
            console.log("main.js: Elemento .rating-select i NÃO encontrado.");
        }

        // Validação de formulário de contato
        var contactForm = $('#contact-form');
        if (contactForm.length) {
            console.log("main.js: Elemento #contact-form encontrado.");
            contactForm.on('submit', function(e) {
                console.log("main.js: Submissão do formulário de contato detectada.");
                var form = $(this);
                var formValid = true;

                form.find('.required').each(function() {
                    var input = $(this);

                    if (input.val().trim() === '') {
                        input.addClass('is-invalid');
                        formValid = false;
                    } else {
                        input.removeClass('is-invalid');
                    }
                });

                if (!formValid) {
                    e.preventDefault();
                    form.find('.form-message').html('<div class="alert alert-danger">Por favor, preencha todos os campos obrigatórios.</div>');
                }
            });

            // Limpa mensagens de erro ao digitar
            $('#contact-form .required').on('input', function() {
                console.log("main.js: Input no campo requerido detectado.");
                var input = $(this);

                if (input.val().trim() !== '') {
                    input.removeClass('is-invalid');
                }
            });
        } else {
            console.log("main.js: Elemento #contact-form NÃO encontrado.");
        }

        // Comentado: Owl Carousel e Fancybox (reativar quando as dependências forem corrigidas)
        /*
        // Inicializa o carrossel de produtos
        if (typeof $.fn.owlCarousel !== 'undefined') {
            console.log('main.js: Owl Carousel disponível.');
            $('.product-carousel').each(function() {
                var carousel = $(this);
                var options = {
                    loop: true,
                    margin: 20,
                    nav: true,
                    dots: false,
                    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                    responsive: {
                        0: { items: 1 },
                        576: { items: 2 },
                        768: { items: 3 },
                        992: { items: 4 }
                    }
                };
                carousel.owlCarousel(options);
            });

            // Inicializa o carrossel de avaliações
            $('.reviews-carousel').each(function() {
                var carousel = $(this);
                var options = {
                    loop: true,
                    margin: 20,
                    nav: true,
                    dots: true,
                    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                    responsive: {
                        0: { items: 1 },
                        768: { items: 2 },
                        992: { items: 3 }
                    }
                };
                carousel.owlCarousel(options);
            });
        } else {
            console.error('main.js: Owl Carousel NÃO disponível. Verifique o enfileiramento.');
        }

        // Inicializa o Fancybox para galeria de produtos
        if (typeof $.fn.fancybox !== 'undefined') {
            console.log('main.js: Fancybox disponível.');
            $('[data-fancybox="gallery"]').fancybox({
                buttons: [
                    "zoom",
                    "share",
                    "slideShow",
                    "fullScreen",
                    "download",
                    "thumbs",
                    "close"
                ],
                loop: true,
                protect: true
            });
        } else {
            console.error('main.js: Fancybox NÃO disponível. Verifique o enfileiramento.');
        }
        */
    });
}