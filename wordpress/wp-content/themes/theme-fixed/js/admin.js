/**
 * JavaScript para o painel de opções do tema
 *
 * @package Theme_Espingardaria
 */

jQuery(document).ready(function($) {
    // Tabs
    $('.theme-options-tabs-nav a').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('.theme-options-tabs-nav li').removeClass('active');
        $(this).parent().addClass('active');
        $('.theme-options-tab').removeClass('active');
        $(target).addClass('active');
    });

    // Accordion
    $('.theme-options-section-header').on('click', function() {
        $(this).next('.theme-options-section-content').slideToggle();
        $(this).parent().toggleClass('open');
    });

    // Media Uploader
    $(document).on('click', '.upload-media', function(e) {
        e.preventDefault();
        var $button = $(this);
        var $mediaUploader = $button.closest('.media-uploader');
        var $mediaInput = $mediaUploader.find('input[type="hidden"]');
        var $mediaPreview = $mediaUploader.find('.media-preview');

        var mediaFrame = wp.media({
            title: themeEspingardaria.mediaTitle,
            button: { text: themeEspingardaria.mediaButton },
            multiple: false
        });

        mediaFrame.on('select', function() {
            var attachment = mediaFrame.state().get('selection').first().toJSON();
            $mediaInput.val(attachment.url);
            $mediaPreview.html('<img src="' + attachment.url + '" alt="" style="max-width: 150px;">');
        });

        mediaFrame.open();
    });

    // Remover imagem
    $(document).on('click', '.remove-media', function(e) {
        e.preventDefault();
        var $button = $(this);
        var $mediaUploader = $button.closest('.media-uploader');
        var $mediaInput = $mediaUploader.find('input[type="hidden"]');
        var $mediaPreview = $mediaUploader.find('.media-preview');
        $mediaInput.val('');
        $mediaPreview.html('');
    });

    // Inicializar Sortable
    function initSortable($sortable) {
        $sortable.sortable({
            handle: '.theme-options-sortable-item-header',
            placeholder: 'theme-options-sortable-placeholder',
            update: function(event, ui) {
                updateSortableIndexes($sortable);
            }
        });
    }

    // Inicializar todos os sortables
    $('.theme-options-sortable').each(function() {
        initSortable($(this));
    });

    // Toggle sortable item
    $(document).on('click', '.theme-options-sortable-item-toggle', function(e) {
        e.preventDefault();
        var $item = $(this).closest('.theme-options-sortable-item');
        var $content = $item.find('.theme-options-sortable-item-content');
        $content.slideToggle();
        $item.toggleClass('open');
        var $icon = $(this).find('.dashicons');
        $icon.toggleClass('dashicons-arrow-down dashicons-arrow-up');
    });

    // Remover sortable item
    $(document).on('click', '.theme-options-sortable-item-remove', function(e) {
        e.preventDefault();
        if (confirm('Tem certeza que deseja remover este item?')) {
            var $item = $(this).closest('.theme-options-sortable-item');
            var $sortable = $item.parent();
            $item.remove();
            updateSortableIndexes($sortable);
            showFeedback('Item removido com sucesso.', 'success');
        }
    });

    // Função genérica para adicionar itens dinâmicos
    function addSortableItem($button, type, fields) {
        var $sortable = $button.closest('.theme-options-sortable-wrapper').find('.' + type + '-sortable');
        var index = $sortable.find('.theme-options-sortable-item').length;
        var template = `
            <li class="theme-options-sortable-item">
                <div class="theme-options-sortable-item-header">
                    <span class="theme-options-sortable-item-title">${themeEspingardaria.addText} ${index + 1}</span>
                    <div class="theme-options-sortable-item-actions">
                        <button type="button" class="theme-options-sortable-item-toggle"><span class="dashicons dashicons-arrow-down"></span></button>
                        <button type="button" class="theme-options-sortable-item-remove"><span class="dashicons dashicons-trash"></span></button>
                    </div>
                </div>
                <div class="theme-options-sortable-item-content">
        `;

        fields.forEach(function(field) {
            if (field.type === 'media') {
                template += `
                    <div class="theme-options-field">
                        <label>${field.label}</label>
                        <div class="media-uploader">
                            <input type="hidden" name="theme_espingardaria_options[${type}][${index}][${field.name}]" value="">
                            <div class="media-preview"></div>
                            <div class="media-buttons">
                                <button type="button" class="button upload-media">${themeEspingardaria.mediaTitle}</button>
                                <button type="button" class="button remove-media">${themeEspingardaria.removeText}</button>
                            </div>
                        </div>
                    </div>
                `;
            } else if (field.type === 'textarea') {
                template += `
                    <div class="theme-options-field">
                        <label>${field.label}</label>
                        <textarea name="theme_espingardaria_options[${type}][${index}][${field.name}]" rows="5"></textarea>
                    </div>
                `;
            } else {
                template += `
                    <div class="theme-options-field">
                        <label>${field.label}</label>
                        <input type="${field.type}" name="theme_espingardaria_options[${type}][${index}][${field.name}]" value="${field.default || ''}" ${field.attrs || ''}>
                    </div>
                `;
            }
        });

        template += `</div></li>`;
        $sortable.append(template);
        initSortable($sortable);
        showFeedback('Item adicionado com sucesso.', 'success');
    }

    // Adicionar Slide
    $(document).on('click', '.add-slide', function(e) {
        e.preventDefault();
        addSortableItem($(this), 'slider', [
            { type: 'media', name: 'image', label: 'Imagem' },
            { type: 'text', name: 'title', label: 'Título' },
            { type: 'text', name: 'subtitle', label: 'Subtítulo' },
            { type: 'text', name: 'price', label: 'Preço' },
            { type: 'text', name: 'button_text', label: 'Texto do Botão' },
            { type: 'url', name: 'button_url', label: 'URL do Botão' }
        ]);
    });

    // Adicionar Item de Compra
    $(document).on('click', '.add-shop-item', function(e) {
        e.preventDefault();
        addSortableItem($(this), 'shop_anywhere_items', [
            { type: 'media', name: 'image', label: 'Imagem' },
            { type: 'text', name: 'title', label: 'Título' },
            { type: 'url', name: 'url', label: 'URL' }
        ]);
    });

    // Adicionar Avaliação
    $(document).on('click', '.add-review', function(e) {
        e.preventDefault();
        addSortableItem($(this), 'reviews', [
            { type: 'textarea', name: 'text', label: 'Texto da Avaliação' },
            { type: 'text', name: 'author', label: 'Nome do Autor' },
            { type: 'number', name: 'rating', label: 'Avaliação (1-5)', default: 5, attrs: 'min="1" max="5"' },
            { type: 'media', name: 'image', label: 'Imagem do Autor' }
        ]);
    });

    // Atualiza os índices dos itens sortable
    function updateSortableIndexes($sortable) {
        $sortable.find('.theme-options-sortable-item').each(function(index) {
            var $item = $(this);
            var type = $sortable.data('sortable-type') || $sortable.attr('class').match(/(slides|shop-items|reviews)-sortable/)[1].replace('-sortable', '');

            $item.find('input, textarea').each(function() {
                var $input = $(this);
                var name = $input.attr('name');
                if (name) {
                    var newName = name.replace(/\[\d+\]/, '[' + index + ']');
                    $input.attr('name', newName);
                }
            });
        });
    }

    // Exibir feedback visual
    function showFeedback(message, type) {
        var $feedback = $('<div class="theme-options-feedback ' + type + '">' + message + '</div>');
        $('body').append($feedback);
        $feedback.fadeIn(300).delay(2000).fadeOut(300, function() {
            $(this).remove();
        });
    }

/*
    function updateSortableIndexes($sortable) {
    $sortable.find('.theme-options-sortable-item').each(function(index) {
        var $item = $(this);
        var type = $sortable.data('sortable-type') || $sortable.attr('class').match(/(slides|shop-items|reviews)-sortable/)[1].replace('-sortable', '');
        $item.find('input, textarea').each(function() {
            var $input = $(this);
            var name = $input.attr('name');
            if (name) {
                var newName = name.replace(/\[\d+\]/, '[' + index + ']');
                $input.attr('name', newName);
                console.log('Campo atualizado: ' + newName); // Log para depuração
            }
        });
    });
}
*/
    /* Validação antes de salvar (opcional) */
    $('form').on('submit', function(e) {
        console.log('Formulário enviado. Dados:', $(this).serialize());
        var $requiredFields = $('.theme-options-sortable-item input[required], .theme-options-sortable-item textarea[required]');
        var errors = [];

        $requiredFields.each(function() {
            if (!$(this).val()) {
                errors.push('O campo ' + $(this).closest('.theme-options-field').find('label').text() + ' é obrigatório.');
            }
        });

        if (errors.length) {
            e.preventDefault();
            showFeedback(errors.join('<br>'), 'error');
        }
    });
});