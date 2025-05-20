<?php
/**
 * Script para campos de imagem em taxonomias
 */
(function($) {
    'use strict';

    // Inicializa quando o DOM estiver pronto
    $(document).ready(function() {
        // Botão para adicionar imagem
        $('.taxonomy_media_button').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var inputField = $('#taxonomy_image');
            var imageWrapper = $('#taxonomy-image-wrapper');
            
            var mediaFrame = wp.media({
                title: 'Selecionar ou Enviar Imagem',
                button: {
                    text: 'Usar esta imagem'
                },
                multiple: false
            });
            
            mediaFrame.on('select', function() {
                var attachment = mediaFrame.state().get('selection').first().toJSON();
                inputField.val(attachment.id);
                imageWrapper.html('<img src="' + attachment.url + '" alt="">');
            });
            
            mediaFrame.open();
        });
        
        // Botão para remover imagem
        $('.taxonomy_media_remove').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var inputField = $('#taxonomy_image');
            var imageWrapper = $('#taxonomy-image-wrapper');
            
            inputField.val('');
            imageWrapper.html('');
        });
    });
})(jQuery);
