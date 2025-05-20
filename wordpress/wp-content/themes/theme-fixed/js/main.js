/**
 * JavaScript principal do tema
 *
 * @package Theme_Espingardaria
 */

jQuery(document).ready(function($) {
    // Inicializa o Bootstrap Tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Inicializa o Bootstrap Popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Menu fixo no topo ao rolar
    var header = $('.site-header');
    var headerOffset = header.offset().top;

    $(window).scroll(function() {
        if ($(window).scrollTop() > headerOffset) {
            header.addClass('fixed-header');
            $('body').addClass('has-fixed-header');
        } else {
            header.removeClass('fixed-header');
            $('body').removeClass('has-fixed-header');
        }
    });

    // Botão de voltar ao topo
    var backToTop = $('.back-to-top');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            backToTop.addClass('show');
        } else {
            backToTop.removeClass('show');
        }
    });

    backToTop.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, 800);
    });

    // Galeria de produtos
    $('.product-gallery-thumbs').on('click', 'img', function() {
        var imgSrc = $(this).attr('src');
        $('.product-gallery-main img').attr('src', imgSrc);
    });

    // Contador de quantidade
    $('.quantity-button').on('click', function() {
        var button = $(this);
        var quantityInput = button.parent().find('.quantity-input');
        var currentValue = parseInt(quantityInput.val());

        if (button.hasClass('quantity-up')) {
            quantityInput.val(currentValue + 1);
        } else if (button.hasClass('quantity-down') && currentValue > 1) {
            quantityInput.val(currentValue - 1);
        }
    });

    // Filtro de produtos móvel
    $('.filter-toggle').on('click', function(e) {
        e.preventDefault();
        $('.product-filters').toggleClass('show');
    });

    // Fechar filtro móvel
    $('.filter-close').on('click', function(e) {
        e.preventDefault();
        $('.product-filters').removeClass('show');
    });

    // Inicializa o carrossel de produtos
    $('.product-carousel').each(function() {
        var carousel = $(this);
        var options = {
            loop: true,
            margin: 20,
            nav: true,
            dots: false,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        };

        // Verifica se o Owl Carousel está disponível
        if (typeof $.fn.owlCarousel !== 'undefined') {
            carousel.owlCarousel(options);
        }
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
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        };

        // Verifica se o Owl Carousel está disponível
        if (typeof $.fn.owlCarousel !== 'undefined') {
            carousel.owlCarousel(options);
        }
    });

    // Inicializa o Fancybox para galeria de produtos
    if (typeof $.fn.fancybox !== 'undefined') {
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
    }

    // Tabs de produtos
    $('.product-tabs-nav a').on('click', function(e) {
        e.preventDefault();
        
        var target = $(this).attr('href');
        
        $('.product-tabs-nav li').removeClass('active');
        $(this).parent().addClass('active');
        
        $('.product-tab').removeClass('active');
        $(target).addClass('active');
    });

    // Formulário de avaliação
    $('.rating-select i').on('click', function() {
        var rating = $(this).data('rating');
        var ratingSelect = $(this).parent();
        var ratingInput = ratingSelect.next('input');
        
        ratingSelect.find('i').removeClass('active');
        
        for (var i = 1; i <= rating; i++) {
            ratingSelect.find('i[data-rating="' + i + '"]').addClass('active');
        }
        
        ratingInput.val(rating);
    });

    // Validação de formulário de contato
    $('#contact-form').on('submit', function(e) {
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
        var input = $(this);
        
        if (input.val().trim() !== '') {
            input.removeClass('is-invalid');
        }
    });
});
