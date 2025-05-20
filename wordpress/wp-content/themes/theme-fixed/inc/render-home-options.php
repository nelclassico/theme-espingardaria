<?php
/**
 * Renderiza as opções da página inicial no painel de opções do tema
 *
 * @package Theme_Espingardaria
 */

if (!defined('ABSPATH')) {
    exit;
}

$options = get_option('theme_espingardaria_options', array());
?>

<div class="theme-options-section">
    <h2><?php esc_html_e('Configurações da Página Inicial', 'theme-espingardaria'); ?></h2>
    <!-- Banner Principal (Slider) -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Banner Principal (Slider)', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_banner]" <?php checked($options['show_banner'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Banner Principal', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field slider-repeater" data-repeater-name="theme_espingardaria_options[slider]">
                <h4><?php esc_html_e('Slides', 'theme-espingardaria'); ?></h4>
                <div class="repeater-items">
                    <?php
                    $slides = isset($options['slider']) && is_array($options['slider']) ? $options['slider'] : array(array('image' => '', 'image_product_left' => '', 'image_product_right' => '', 'title' => '', 'subtitle' => '', 'price' => '', 'button_text' => '', 'button_url' => '', 'secondary_button_text' => '', 'secondary_button_url' => ''));
                    foreach ($slides as $index => $slide) :
                    ?>
                        <div class="repeater-item" data-index="<?php echo esc_attr($index); ?>">
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Imagem de Fundo', 'theme-espingardaria'); ?></label>
                                <div class="media-uploader">
                                    <input type="hidden" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][image]" value="<?php echo esc_attr($slide['image'] ?? ''); ?>">
                                    <div class="media-preview">
                                        <?php if (isset($slide['image']) && !empty($slide['image'])) : ?>
                                            <img src="<?php echo esc_url($slide['image']); ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="media-buttons">
                                        <button type="button" class="button upload-media"><?php esc_html_e('Selecionar Imagem', 'theme-espingardaria'); ?></button>
                                        <button type="button" class="button remove-media"><?php esc_html_e('Remover Imagem', 'theme-espingardaria'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Imagem do Produto (Esquerda)', 'theme-espingardaria'); ?></label>
                                <div class="media-uploader">
                                    <input type="hidden" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][image_product_left]" value="<?php echo esc_attr($slide['image_product_left'] ?? ''); ?>">
                                    <div class="media-preview">
                                        <?php if (isset($slide['image_product_left']) && !empty($slide['image_product_left'])) : ?>
                                            <img src="<?php echo esc_url($slide['image_product_left']); ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="media-buttons">
                                        <button type="button" class="button upload-media"><?php esc_html_e('Selecionar Imagem', 'theme-espingardaria'); ?></button>
                                        <button type="button" class="button remove-media"><?php esc_html_e('Remover Imagem', 'theme-espingardaria'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Imagem do Produto (Direita)', 'theme-espingardaria'); ?></label>
                                <div class="media-uploader">
                                    <input type="hidden" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][image_product_right]" value="<?php echo esc_attr($slide['image_product_right'] ?? ''); ?>">
                                    <div class="media-preview">
                                        <?php if (isset($slide['image_product_right']) && !empty($slide['image_product_right'])) : ?>
                                            <img src="<?php echo esc_url($slide['image_product_right']); ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="media-buttons">
                                        <button type="button" class="button upload-media"><?php esc_html_e('Selecionar Imagem', 'theme-espingardaria'); ?></button>
                                        <button type="button" class="button remove-media"><?php esc_html_e('Remover Imagem', 'theme-espingardaria'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Título', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][title]" value="<?php echo esc_attr($slide['title'] ?? ''); ?>">
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Subtítulo', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][subtitle]" value="<?php echo esc_attr($slide['subtitle'] ?? ''); ?>">
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Preço', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][price]" value="<?php echo esc_attr($slide['price'] ?? ''); ?>">
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Texto do Botão', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][button_text]" value="<?php echo esc_attr($slide['button_text'] ?? ''); ?>">
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('URL do Botão', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][button_url]" value="<?php echo esc_attr($slide['button_url'] ?? ''); ?>">
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Texto do Segundo Botão', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][secondary_button_text]" value="<?php echo esc_attr($slide['secondary_button_text'] ?? ''); ?>">
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('URL do Segundo Botão', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[slider][<?php echo esc_attr($index); ?>][secondary_button_url]" value="<?php echo esc_attr($slide['secondary_button_url'] ?? ''); ?>">
                            </div>
                            <button type="button" class="button remove-repeater-item"><?php esc_html_e('Remover Slide', 'theme-espingardaria'); ?></button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="button add-repeater-item"><?php esc_html_e('Adicionar Slide', 'theme-espingardaria'); ?></button>
            </div>
        </div>
    </div>

    <!-- Categorias de Produtos -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Categorias de Produtos', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_categories]" <?php checked($options['show_categories'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Categorias de Produtos', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Título da Seção', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[categories_title]" value="<?php echo esc_attr($options['categories_title'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Selecionar Categorias', 'theme-espingardaria'); ?></label>
                <?php
                $categories = get_terms(array('taxonomy' => 'categoria-produto', 'hide_empty' => false));
                if (!empty($categories) && !is_wp_error($categories)) :
                ?>
                    <select name="theme_espingardaria_options[selected_categories][]" multiple>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo esc_attr($category->term_id); ?>" <?php selected(in_array($category->term_id, $options['selected_categories'] ?? array()), true); ?>>
                                <?php echo esc_html($category->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="description"><?php esc_html_e('Segure Ctrl (ou Cmd) para selecionar múltiplas categorias.', 'theme-espingardaria'); ?></p>
                <?php else : ?>
                    <p><?php esc_html_e('Nenhuma categoria encontrada.', 'theme-espingardaria'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Produtos em Destaque -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Produtos em Destaque', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_featured_products]" <?php checked($options['show_featured_products'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Produtos em Destaque', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Título da Seção', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[featured_products_title]" value="<?php echo esc_attr($options['featured_products_title'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Quantidade de Produtos', 'theme-espingardaria'); ?></label>
                <input type="number" name="theme_espingardaria_options[featured_products_count]" value="<?php echo esc_attr($options['featured_products_count'] ?? 4); ?>" min="1" max="12">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Categoria', 'theme-espingardaria'); ?></label>
                <?php
                wp_dropdown_categories(array(
                    'taxonomy' => 'categoria-produto',
                    'name' => 'theme_espingardaria_options[featured_products_category]',
                    'selected' => $options['featured_products_category'] ?? 0,
                    'show_option_all' => __('Todas as Categorias', 'theme-espingardaria'),
                    'hide_empty' => false,
                ));
                ?>
            </div>
        </div>
    </div>

    <!-- Seção de Treinamento -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Seção de Treinamento', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_training]" <?php checked($options['show_training'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Seção de Treinamento', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Título da Seção', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[training_title]" value="<?php echo esc_attr($options['training_title'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Texto da Seção', 'theme-espingardaria'); ?></label>
                <textarea name="theme_espingardaria_options[training_text]" rows="5"><?php echo esc_textarea($options['training_text'] ?? ''); ?></textarea>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Texto do Botão', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[training_button_text]" value="<?php echo esc_attr($options['training_button_text'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('URL do Botão', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[training_button_url]" value="<?php echo esc_attr($options['training_button_url'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Imagem de Fundo', 'theme-espingardaria'); ?></label>
                <div class="media-uploader">
                    <input type="hidden" name="theme_espingardaria_options[training_image]" value="<?php echo esc_attr($options['training_image'] ?? ''); ?>" class="media-input">
                    <div class="media-preview">
                        <?php if (!empty($options['training_image'])) : ?>
                            <img src="<?php echo esc_url($options['training_image']); ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="media-buttons">
                        <button type="button" class="button upload-media"><?php esc_html_e('Selecionar Imagem', 'theme-espingardaria'); ?></button>
                        <button type="button" class="button remove-media"><?php esc_html_e('Remover Imagem', 'theme-espingardaria'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção de Munições -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Seção de Munições', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_ammo]" <?php checked($options['show_ammo'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Seção de Munições', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Título da Seção', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[ammo_title]" value="<?php echo esc_attr($options['ammo_title'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Texto da Seção', 'theme-espingardaria'); ?></label>
                <textarea name="theme_espingardaria_options[ammo_text]" rows="5"><?php echo esc_textarea($options['ammo_text'] ?? ''); ?></textarea>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Texto do Botão', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[ammo_button_text]" value="<?php echo esc_attr($options['ammo_button_text'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('URL do Botão', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[ammo_button_url]" value="<?php echo esc_attr($options['ammo_button_url'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Imagem de Fundo', 'theme-espingardaria'); ?></label>
                <div class="media-uploader">
                    <input type="hidden" name="theme_espingardaria_options[ammo_image]" value="<?php echo esc_attr($options['ammo_image'] ?? ''); ?>" class="media-input">
                    <div class="media-preview">
                        <?php if (!empty($options['ammo_image'])) : ?>
                            <img src="<?php echo esc_url($options['ammo_image']); ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="media-buttons">
                        <button type="button" class="button upload-media"><?php esc_html_e('Selecionar Imagem', 'theme-espingardaria'); ?></button>
                        <button type="button" class="button remove-media"><?php esc_html_e('Remover Imagem', 'theme-espingardaria'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Compre em Qualquer Lugar -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Compre em Qualquer Lugar', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_shop_anywhere]" <?php checked($options['show_shop_anywhere'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Seção Compre em Qualquer Lugar', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Título da Seção', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[shop_anywhere_title]" value="<?php echo esc_attr($options['shop_anywhere_title'] ?? ''); ?>">
            </div>
            <div class="theme-options-field repeater" data-repeater-name="theme_espingardaria_options[shop_anywhere_items]">
                <h4><?php esc_html_e('Itens', 'theme-espingardaria'); ?></h4>
                <div class="repeater-items">
                    <?php
                    $items = isset($options['shop_anywhere_items']) && is_array($options['shop_anywhere_items']) ? $options['shop_anywhere_items'] : array(array('image' => '', 'title' => '', 'url' => ''));
                    foreach ($items as $index => $item) :
                    ?>
                        <div class="repeater-item" data-index="<?php echo esc_attr($index); ?>">
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Imagem', 'theme-espingardaria'); ?></label>
                                <div class="media-uploader">
                                    <input type="hidden" name="theme_espingardaria_options[shop_anywhere_items][<?php echo esc_attr($index); ?>][image]" value="<?php echo esc_attr($item['image'] ?? ''); ?>" class="media-input">
                                    <div class="media-preview">
                                        <?php if (!empty($item['image'])) : ?>
                                            <img src="<?php echo esc_url($item['image']); ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="media-buttons">
                                        <button type="button" class="button upload-media"><?php esc_html_e('Selecionar Imagem', 'theme-espingardaria'); ?></button>
                                        <button type="button" class="button remove-media"><?php esc_html_e('Remover Imagem', 'theme-espingardaria'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Título', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[shop_anywhere_items][<?php echo esc_attr($index); ?>][title]" value="<?php echo esc_attr($item['title'] ?? ''); ?>">
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('URL', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[shop_anywhere_items][<?php echo esc_attr($index); ?>][url]" value="<?php echo esc_attr($item['url'] ?? ''); ?>">
                            </div>
                            <button type="button" class="button remove-repeater-item"><?php esc_html_e('Remover Item', 'theme-espingardaria'); ?></button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="button add-repeater-item"><?php esc_html_e('Adicionar Item', 'theme-espingardaria'); ?></button>
            </div>
        </div>
    </div>

    <!-- Avaliações de Clientes -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Avaliações de Clientes', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_reviews]" <?php checked($options['show_reviews'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Seção de Avaliações', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Título da Seção', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[reviews_title]" value="<?php echo esc_attr($options['reviews_title'] ?? ''); ?>">
            </div>
            <div class="theme-options-field repeater" data-repeater-name="theme_espingardaria_options[reviews]">
                <h4><?php esc_html_e('Avaliações', 'theme-espingardaria'); ?></h4>
                <div class="repeater-items">
                    <?php
                    $reviews = isset($options['reviews']) && is_array($options['reviews']) ? $options['reviews'] : array(array('text' => '', 'author' => '', 'rating' => 5, 'image' => ''));
                    foreach ($reviews as $index => $review) :
                    ?>
                        <div class="repeater-item" data-index="<?php echo esc_attr($index); ?>">
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Texto da Avaliação', 'theme-espingardaria'); ?></label>
                                <textarea name="theme_espingardaria_options[reviews][<?php echo esc_attr($index); ?>][text]" rows="5"><?php echo esc_textarea($review['text'] ?? ''); ?></textarea>
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Autor', 'theme-espingardaria'); ?></label>
                                <input type="text" name="theme_espingardaria_options[reviews][<?php echo esc_attr($index); ?>][author]" value="<?php echo esc_attr($review['author'] ?? ''); ?>">
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Nota (1 a 5)', 'theme-espingardaria'); ?></label>
                                <input type="number" name="theme_espingardaria_options[reviews][<?php echo esc_attr($index); ?>][rating]" value="<?php echo esc_attr($review['rating'] ?? 5); ?>" min="1" max="5">
                            </div>
                            <div class="theme-options-field">
                                <label><?php esc_html_e('Imagem do Autor', 'theme-espingardaria'); ?></label>
                                <div class="media-uploader">
                                    <input type="hidden" name="theme_espingardaria_options[reviews][<?php echo esc_attr($index); ?>][image]" value="<?php echo esc_attr($review['image'] ?? ''); ?>" class="media-input">
                                    <div class="media-preview">
                                        <?php if (!empty($review['image'])) : ?>
                                            <img src="<?php echo esc_url($review['image']); ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="media-buttons">
                                        <button type="button" class="button upload-media"><?php esc_html_e('Selecionar Imagem', 'theme-espingardaria'); ?></button>
                                        <button type="button" class="button remove-media"><?php esc_html_e('Remover Imagem', 'theme-espingardaria'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="button remove-repeater-item"><?php esc_html_e('Remover Avaliação', 'theme-espingardaria'); ?></button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="button add-repeater-item"><?php esc_html_e('Adicionar Avaliação', 'theme-espingardaria'); ?></button>
            </div>
        </div>
    </div>

    <!-- Novos Produtos -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Novos Produtos', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_new_products]" <?php checked($options['show_new_products'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Seção de Novos Produtos', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Título da Seção', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[new_products_title]" value="<?php echo esc_attr($options['new_products_title'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Quantidade de Produtos', 'theme-espingardaria'); ?></label>
                <input type="number" name="theme_espingardaria_options[new_products_count]" value="<?php echo esc_attr($options['new_products_count'] ?? 4); ?>" min="1" max="12">
            </div>
        </div>
    </div>

    <!-- Blog e Notícias -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Blog e Notícias', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_blog]" <?php checked($options['show_blog'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Seção de Blog', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Título da Seção', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[blog_title]" value="<?php echo esc_attr($options['blog_title'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Quantidade de Posts', 'theme-espingardaria'); ?></label>
                <input type="number" name="theme_espingardaria_options[blog_count]" value="<?php echo esc_attr($options['blog_count'] ?? 3); ?>" min="1" max="12">
            </div>
        </div>
    </div>

    <!-- Sobre Nós -->
    <div class="theme-options-section">
        <div class="theme-options-section-header">
            <h3><?php esc_html_e('Sobre Nós', 'theme-espingardaria'); ?></h3>
        </div>
        <div class="theme-options-section-content">
            <div class="theme-options-field">
                <label>
                    <input type="checkbox" name="theme_espingardaria_options[show_about]" <?php checked($options['show_about'] ?? true); ?>>
                    <?php esc_html_e('Mostrar Seção Sobre Nós', 'theme-espingardaria'); ?>
                </label>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Título da Seção', 'theme-espingardaria'); ?></label>
                <input type="text" name="theme_espingardaria_options[about_title]" value="<?php echo esc_attr($options['about_title'] ?? ''); ?>">
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Texto da Seção', 'theme-espingardaria'); ?></label>
                <textarea name="theme_espingardaria_options[about_text]" rows="5"><?php echo esc_textarea($options['about_text'] ?? ''); ?></textarea>
            </div>
            <div class="theme-options-field">
                <label><?php esc_html_e('Imagem da Seção', 'theme-espingardaria'); ?></label>
                <div class="media-uploader">
                    <input type="hidden" name="theme_espingardaria_options[about_image]" value="<?php echo esc_attr($options['about_image'] ?? ''); ?>" class="media-input">
                    <div class="media-preview">
                        <?php if (!empty($options['about_image'])) : ?>
                            <img src="<?php echo esc_url($options['about_image']); ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="media-buttons">
                        <button type="button" class="button upload-media"><?php esc_html_e('Selecionar Imagem', 'theme-espingardaria'); ?></button>
                        <button type="button" class="button remove-media"><?php esc_html_e('Remover Imagem', 'theme-espingardaria'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>