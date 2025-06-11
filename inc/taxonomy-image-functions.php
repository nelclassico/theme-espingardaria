<?php
/**
 * Funções para gerenciar imagens de taxonomias
 *
 * @package Theme_Espingardaria
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Adiciona campo de imagem ao formulário de adição de categoria
 */
function theme_espingardaria_add_category_image_field() {
    ?>
    <div class="form-field term-image-wrap">
        <label for="taxonomy_image"><?php _e('Imagem da Categoria', 'theme-espingardaria'); ?></label>
        <input type="hidden" id="taxonomy_image" name="taxonomy_image" value="">
        <div id="taxonomy-image-wrapper"></div>
        <p>
            <button type="button" class="button button-secondary taxonomy_media_button"><?php _e('Adicionar Imagem', 'theme-espingardaria'); ?></button>
            <button type="button" class="button button-secondary taxonomy_media_remove" style="display:none;"><?php _e('Remover Imagem', 'theme-espingardaria'); ?></button>
        </p>
        <p class="description"><?php _e('Imagem que representa esta categoria.', 'theme-espingardaria'); ?></p>
    </div>
    <?php
}
add_action('categoria-produto_add_form_fields', 'theme_espingardaria_add_category_image_field');
add_action('category_add_form_fields', 'theme_espingardaria_add_category_image_field');
add_action('categoria-portfolio_add_form_fields', 'theme_espingardaria_add_category_image_field');

/**
 * Adiciona campo de imagem ao formulário de edição de categoria
 */
function theme_espingardaria_edit_category_image_field($term) {
    $image_id = get_term_meta($term->term_id, 'taxonomy_image', true);
    $image_url = '';
    if ($image_id) {
        $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
    }
    ?>
    <tr class="form-field term-image-wrap">
        <th scope="row"><label for="taxonomy_image"><?php _e('Imagem da Categoria', 'theme-espingardaria'); ?></label></th>
        <td>
            <input type="hidden" id="taxonomy_image" name="taxonomy_image" value="<?php echo esc_attr($image_id); ?>">
            <div id="taxonomy-image-wrapper">
                <?php if ($image_url) : ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php _e('Imagem da categoria', 'theme-espingardaria'); ?>" style="max-width: 200px; height: auto;">
                <?php endif; ?>
            </div>
            <p>
                <button type="button" class="button button-secondary taxonomy_media_button"><?php _e('Adicionar Imagem', 'theme-espingardaria'); ?></button>
                <button type="button" class="button button-secondary taxonomy_media_remove" <?php echo empty($image_id) ? 'style="display:none;"' : ''; ?>><?php _e('Remover Imagem', 'theme-espingardaria'); ?></button>
            </p>
            <p class="description"><?php _e('Imagem que representa esta categoria.', 'theme-espingardaria'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('categoria-produto_edit_form_fields', 'theme_espingardaria_edit_category_image_field');
add_action('category_edit_form_fields', 'theme_espingardaria_edit_category_image_field');
add_action('categoria-portfolio_edit_form_fields', 'theme_espingardaria_edit_category_image_field');

/**
 * Salva o campo de imagem da categoria
 */
function theme_espingardaria_save_category_image($term_id) {
    if (isset($_POST['taxonomy_image'])) {
        update_term_meta($term_id, 'taxonomy_image', sanitize_text_field($_POST['taxonomy_image']));
    }
}
add_action('created_categoria-produto', 'theme_espingardaria_save_category_image');
add_action('edited_categoria-produto', 'theme_espingardaria_save_category_image');
add_action('created_category', 'theme_espingardaria_save_category_image');
add_action('edited_category', 'theme_espingardaria_save_category_image');
add_action('created_categoria-portfolio', 'theme_espingardaria_save_category_image');
add_action('edited_categoria-portfolio', 'theme_espingardaria_save_category_image');

/**
 * Enfileira scripts para o uploader de mídia nas páginas de taxonomia
 */
function theme_espingardaria_enqueue_taxonomy_scripts($hook) {
    if ('edit-tags.php' === $hook || 'term.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script(
            'theme-espingardaria-admin-taxonomy',
            get_template_directory_uri() . '/js/admin-taxonomy.js',
            array('jquery'),
            THEME_ESPINGARDARIA_VERSION,
            true
        );
    }
}
add_action('admin_enqueue_scripts', 'theme_espingardaria_enqueue_taxonomy_scripts');

/**
 * Função auxiliar para obter a imagem de uma categoria
 */
function theme_espingardaria_get_category_image_url($term_id, $size = 'thumbnail') {
    $image_id = get_term_meta($term_id, 'taxonomy_image', true);
    if ($image_id) {
        return wp_get_attachment_image_url($image_id, $size);
    }
    return '';
}

/**
 * Função auxiliar para exibir a imagem de uma categoria
 */
function theme_espingardaria_get_category_image($term_id, $size = 'thumbnail', $attr = array()) {
    $image_id = get_term_meta($term_id, 'taxonomy_image', true);
    if ($image_id) {
        return wp_get_attachment_image($image_id, $size, false, $attr);
    }
    return '';
}
