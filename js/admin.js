/**

 * JavaScript para o painel de opções do tema

 *

 * @package Theme_Espingardaria

 */



jQuery(document).ready(function($) {

    console.log('admin.js carregado com sucesso'); // Log para depuração



    // Tabs

    $('.theme-options-tabs-nav a').on('click', function(e) {

        e.preventDefault();

        var target = $(this).attr('href');

        $('.theme-options-tabs-nav li').removeClass('active');

        $(this).parent().addClass('active');

        $('.theme-options-tab').removeClass('active');

        $(target).addClass('active');

    });



    // Accordion (abre apenas um item por vez com animação suave)

    $('.theme-options-section-header').on('click', function(e) {

        e.preventDefault();

        console.log('Accordion clicado:', $(this).find('h3').text()); // Log para depuração

        var $section = $(this).parent('.theme-options-section');

        var $content = $(this).next('.theme-options-section-content');



        if ($section.hasClass('open')) {

            // Fecha o accordion se já estiver aberto

            $content.slideUp(300, function() {

                $section.removeClass('open');

            });

        } else {

            // Fecha outros accordions abertos

            $('.theme-options-section.open').removeClass('open').find('.theme-options-section-content').slideUp(300);

            // Abre o accordion clicado

            $content.slideDown(300, function() {

                $section.addClass('open');

            });

        }

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



    // Media Uploader Múltiplo
        $(document).on('click', '.upload-multiple-media', function(e) {
            e.preventDefault();
            var $button = $(this);
            var $mediaUploader = $button.closest('.multiple-media-uploader');
            var $mediaInput = $mediaUploader.find('.multiple-media-input');
            var $mediaPreview = $mediaUploader.find('.multiple-media-preview');

            console.log('Botão "Selecionar Imagens" clicado', $button, $mediaUploader); // Depuração

            if (typeof wp === 'undefined' || !wp.media) {
                console.error('WordPress Media API não está disponível.');
                showFeedback('Erro: O uploader de mídia não está carregado.', 'error');
                return;
            }

            var mediaFrame = wp.media({
                title: themeEspingardaria.mediaTitle,
                button: { text: themeEspingardaria.mediaButton },
                multiple: true // Permite múltiplas seleções
            });

            mediaFrame.on('select', function() {
                var attachments = mediaFrame.state().get('selection').toJSON();
                var currentImages = JSON.parse($mediaInput.attr('data-images') || '[]');
                var newImages = attachments.map(function(attachment) {
                    return attachment.url;
                });
                var updatedImages = [...currentImages, ...newImages];

                $mediaInput.val(JSON.stringify(updatedImages));
                $mediaInput.attr('data-images', JSON.stringify(updatedImages));

                $mediaPreview.empty();
                updatedImages.forEach(function(image) {
                    $mediaPreview.append('<div class="multiple-media-item"><img src="' + image + '" alt=""><button type="button" class="button remove-multiple-media">Remover</button></div>');
                });
                showFeedback('Imagens adicionadas com sucesso.', 'success');
            });

            mediaFrame.open();
        });

        // Remover imagem individual
        $(document).on('click', '.remove-multiple-media', function(e) {
            e.preventDefault();
            var $button = $(this);
            var $mediaItem = $button.closest('.multiple-media-item');
            var $mediaUploader = $button.closest('.multiple-media-uploader');
            var $mediaInput = $mediaUploader.find('.multiple-media-input');
            var $mediaPreview = $mediaUploader.find('.multiple-media-preview');

            var currentImages = JSON.parse($mediaInput.attr('data-images') || '[]');
            var imageToRemove = $mediaItem.find('img').attr('src');
            var updatedImages = currentImages.filter(function(image) {
                return image !== imageToRemove;
            });

            $mediaInput.val(JSON.stringify(updatedImages));
            $mediaInput.attr('data-images', JSON.stringify(updatedImages));
            $mediaItem.remove();
            showFeedback('Imagem removida com sucesso.', 'success');
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

                    console.log('Campo atualizado (sortable): ' + newName); // Log para depuração

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



    // Adicionar suporte para botões add-repeater-item e remove-repeater-item

    $(document).on('click', '.add-repeater-item', function(e) {

        e.preventDefault();

        console.log('Botão add-repeater-item clicado'); // Log para depuração

        var $button = $(this);

        var $repeater = $button.closest('.theme-options-field'); // Ajustado para corresponder à estrutura

        var repeaterName = $repeater.data('repeater-name');

        console.log('repeaterName:', repeaterName); // Log para verificar o valor



        if (!repeaterName) {

            console.error('Atributo data-repeater-name não encontrado no elemento .theme-options-field');

            showFeedback('Erro: Configuração do repeater inválida.', 'error');

            return;

        }



        var typeMatch = repeaterName.match(/\[([^\]]*)\]/);

        if (!typeMatch || !typeMatch[1]) {

            console.error('Não foi possível extrair o tipo do repeaterName:', repeaterName);

            showFeedback('Erro: Tipo de repeater inválido.', 'error');

            return;

        }

        var type = typeMatch[1]; // Extrai 'slider', 'shop_anywhere_items', ou 'reviews'

        console.log('Tipo extraído:', type); // Log para depuração



        // Mapa de campos para cada tipo

        var fieldsMap = {

            'slider': [

                { type: 'media', name: 'image', label: 'Imagem de Fundo' },

                { type: 'media', name: 'image_product_left', label: 'Imagem do Produto (Esquerda)' },

                { type: 'media', name: 'image_product_right', label: 'Imagem do Produto (Direita)' },

                { type: 'text', name: 'title', label: 'Título' },

                { type: 'text', name: 'subtitle', label: 'Subtítulo' },

                { type: 'text', name: 'price', label: 'Preço' },

                { type: 'text', name: 'button_text', label: 'Texto do Botão' },

                { type: 'url', name: 'button_url', label: 'URL do Botão' },

                { type: 'text', name: 'secondary_button_text', label: 'Texto do Segundo Botão' },

                { type: 'url', name: 'secondary_button_url', label: 'URL do Segundo Botão' }

            ],

            'shop_anywhere_items': [

                { type: 'media', name: 'image', label: 'Imagem' },

                { type: 'text', name: 'title', label: 'Título' },

                { type: 'url', name: 'url', label: 'URL' }

            ],

            'reviews': [

                { type: 'textarea', name: 'text', label: 'Texto da Avaliação' },

                { type: 'text', name: 'author', label: 'Autor' },

                { type: 'number', name: 'rating', label: 'Nota (1 a 5)', default: 5, attrs: 'min="1" max="5"' },

                { type: 'media', name: 'image', label: 'Imagem do Autor' }

            ], 
            'image_gallery_items': [ // Adicione ou verifique esta entrada
            { type: 'media', name: 'image', label: 'Imagem' },
            { type: 'text', name: 'title', label: 'Título' },
            { type: 'url', name: 'url', label: 'URL' }
             ]

        };



        var fields = fieldsMap[type];

        if (!fields) {

            console.error('Tipo de repeater desconhecido: ' + type);

            showFeedback('Erro ao adicionar item.', 'error');

            return;

        }



        // Adicionar item

        var $sortable = $repeater.find('.repeater-items');

        var index = $sortable.find('.repeater-item').length;

        var template = `

            <div class="repeater-item" data-index="${index}">

        `;



        fields.forEach(function(field) {

            template += `

                <div class="theme-options-field">

                    <label>${field.label}</label>

            `;

            if (field.type === 'media') {

                template += `

                    <div class="media-uploader">

                        <input type="hidden" name="theme_espingardaria_options[${type}][${index}][${field.name}]" class="media-input">

                        <div class="media-preview"></div>

                        <div class="media-buttons">

                            <button type="button" class="button upload-media">${themeEspingardaria.mediaTitle}</button>

                            <button type="button" class="button remove-media">${themeEspingardaria.removeText}</button>

                        </div>

                    </div>

                `;

            } else if (field.type === 'textarea') {

                template += `

                    <textarea name="theme_espingardaria_options[${type}][${index}][${field.name}]" rows="5"></textarea>

                `;

            } else {

                template += `

                    <input type="${field.type}" name="theme_espingardaria_options[${type}][${index}][${field.name}]" value="${field.default || ''}" ${field.attrs || ''}>

                `;

            }

            template += `</div>`;

        });



        template += `

            <button type="button" class="button remove-repeater-item">${themeEspingardaria.removeText}</button>

            </div>

        `;

        $sortable.append(template);

        updateRepeaterIndexes($sortable);

        showFeedback('Item adicionado com sucesso.', 'success');

    });



    // Remover item

    $(document).on('click', '.remove-repeater-item', function(e) {

        e.preventDefault();

        console.log('Botão remove-repeater-item clicado'); // Log para depuração

        if (confirm('Tem certeza que deseja remover este item?')) {

            var $item = $(this).closest('.repeater-item');

            var $sortable = $item.closest('.repeater-items');

            $item.remove();

            updateRepeaterIndexes($sortable);

            showFeedback('Item removido com sucesso.', 'success');

        }

    });



    // Atualizar índices para repeater-items

    function updateRepeaterIndexes($sortable) {

        $sortable.find('.repeater-item').each(function(index) {

            var $item = $(this);

            var typeMatch = $sortable.closest('.theme-options-field').data('repeater-name')?.match(/\[([^\]]*)\]/);

            var type = typeMatch ? typeMatch[1] : 'slider'; // Fallback para 'slider'

            console.log('Atualizando índices para tipo:', type); // Log para depuração



            $item.find('input, textarea').each(function() {

                var $input = $(this);

                var name = $input.attr('name');

                if (name) {

                    var newName = name.replace(/\[\d+\]/, '[' + index + ']');

                    $input.attr('name', newName);

                    console.log('Campo atualizado (repeater): ' + newName); // Log para depuração

                }

            });

            $item.attr('data-index', index);

        });

    }

});