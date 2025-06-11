(function($) {
    'use strict';

    $(document).ready(function() {
        // Função para inicializar o media uploader e gerenciar a imagem
        function initializeMediaUploader(button) {
            var inputField = $('#taxonomy_image');
            var imageWrapper = $('#taxonomy-image-wrapper');
            var removeButton = button.siblings('.taxonomy_media_remove');

            if (typeof wp === 'undefined' || !wp.media) {
                console.error('Erro: wp.media não está disponível. Verifique se wp_enqueue_media() foi chamado.');
                return;
            }

            console.log('Abrindo media uploader...');

            var mediaFrame = wp.media({
                title: 'Selecionar ou Enviar Imagem',
                button: {
                    text: 'Usar esta imagem'
                },
                multiple: false
            });

            mediaFrame.on('open', function() {
                console.log('Media frame aberto com sucesso.');
            });

            mediaFrame.on('select', function() {
                var attachment = mediaFrame.state().get('selection').first().toJSON();
                console.log('Imagem selecionada: ', attachment.id, attachment.url);
                inputField.val(attachment.id);
                imageWrapper.html('<img src="' + attachment.url + '" alt="Imagem da categoria" style="max-width: 200px; height: auto;">');
                removeButton.show(); // Mostra o botão de remover após selecionar uma imagem
            });

            mediaFrame.on('close', function() {
                console.log('Media frame fechado.');
            });

            mediaFrame.open();
        }

        // Evento para o botão de upload de imagem
        $('.taxonomy_media_button').on('click', function(e) {
            e.preventDefault();
            console.log('Botão de upload clicado.');
            initializeMediaUploader($(this));
            return false; // Impede submissão do formulário
        });

        // Evento para o botão de remover imagem
        $('.taxonomy_media_remove').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var inputField = $('#taxonomy_image');
            var imageWrapper = $('#taxonomy-image-wrapper');

            console.log('Removendo imagem.');
            inputField.val('');
            imageWrapper.html('');
            button.hide(); // Esconde o botão de remover
        });

        // Inicializa o estado do botão de remover com base na imagem existente
        function updateRemoveButtonVisibility() {
            var inputField = $('#taxonomy_image');
            var removeButton = $('.taxonomy_media_remove');
            var hasImage = !!inputField.val();
            removeButton.toggle(hasImage); // Alterna visibilidade com base no valor do campo
            console.log('Estado do botão de remover atualizado. Tem imagem:', hasImage);
        }

        // Chama a função de inicialização ao carregar a página
        updateRemoveButtonVisibility();

        // Reativa a visibilidade se o campo for alterado manualmente (ex.: via dev tools)
        $('#taxonomy_image').on('change', function() {
            updateRemoveButtonVisibility();
        });
    });

    // Proteção contra erros de carregamento do jQuery
    if (typeof jQuery === 'undefined') {
        console.error('Erro: jQuery não foi carregado. Verifique as dependências.');
    }
})(jQuery);
