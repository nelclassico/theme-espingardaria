<?php
/**
 * Funções e definições do tema
 *
 * @package Theme_Espingardaria
 */

if (!defined('ABSPATH')) {
    exit;
}

define('THEME_ESPINGARDARIA_VERSION', '3.0');


function theme_espingardaria_setup() {
    load_theme_textdomain('theme-espingardaria', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ));
    add_theme_support('align-wide');
    add_theme_support('custom-colors');
    add_image_size('theme-espingardaria-product', 400, 400, true);
    add_image_size('theme-espingardaria-portfolio', 400, 300, true);
    add_image_size('theme-espingardaria-blog', 800, 450, true);
    register_nav_menus(array(
        'primary' => esc_html__('Menu Principal', 'theme-espingardaria'),
        'footer' => esc_html__('Menu do Rodapé', 'theme-espingardaria'),
        'mobile' => esc_html__('Menu Mobile', 'theme-espingardaria'),
    ));
}
add_action('after_setup_theme', 'theme_espingardaria_setup');

function theme_espingardaria_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'theme-espingardaria'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Adicione widgets aqui.', 'theme-espingardaria'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Rodapé 1', 'theme-espingardaria'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Adicione widgets aqui.', 'theme-espingardaria'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Rodapé 2', 'theme-espingardaria'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Adicione widgets aqui.', 'theme-espingardaria'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Rodapé 3', 'theme-espingardaria'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Adicione widgets aqui.', 'theme-espingardaria'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Rodapé 4', 'theme-espingardaria'),
        'id'            => 'footer-4',
        'description'   => esc_html__('Adicione widgets aqui.', 'theme-espingardaria'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'theme_espingardaria_widgets_init');

function theme_espingardaria_scripts() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.1.3');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');
    wp_enqueue_style('theme-espingardaria-style', get_template_directory_uri() . '/css/style.css', array('bootstrap'), THEME_ESPINGARDARIA_VERSION);
    wp_enqueue_style('theme-espingardaria-main', get_stylesheet_uri(), array(), THEME_ESPINGARDARIA_VERSION);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '5.1.3', true);
    wp_enqueue_script('theme-espingardaria-main', get_template_directory_uri() . '/js/main.js', array('jquery', 'bootstrap'), THEME_ESPINGARDARIA_VERSION, true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_espingardaria_scripts');

function theme_espingardaria_enqueue_admin_scripts($hook) {
    if (!in_array($hook, ['appearance_page_theme-espingardaria-options', 'appearance_page_theme-espingardaria-header'])) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_style('theme-espingardaria-admin', get_template_directory_uri() . '/css/admin.css', array(), '1.0.0');
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('theme-espingardaria-admin', get_template_directory_uri() . '/js/admin.js', array('jquery', 'jquery-ui-sortable'), '1.0.0', true);
    wp_localize_script('theme-espingardaria-admin', 'themeEspingardaria', array(
        'mediaTitle' => __('Selecionar ou Enviar Imagem', 'theme-espingardaria'),
        'mediaButton' => __('Usar esta imagem', 'theme-espingardaria'),
        'removeText' => __('Remover', 'theme-espingardaria'),
        'addText' => __('Adicionar', 'theme-espingardaria'),
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('admin_enqueue_scripts', 'theme_espingardaria_enqueue_admin_scripts');

function theme_espingardaria_register_post_types() {
    register_post_type('produto', array(
        'labels' => array(
            'name'               => __('Produtos', 'theme-espingardaria'),
            'singular_name'      => __('Produto', 'theme-espingardaria'),
            'menu_name'          => __('Produtos', 'theme-espingardaria'),
            'add_new'            => __('Adicionar Novo', 'theme-espingardaria'),
            'add_new_item'       => __('Adicionar Novo Produto', 'theme-espingardaria'),
            'edit_item'          => __('Editar Produto', 'theme-espingardaria'),
            'new_item'           => __('Novo Produto', 'theme-espingardaria'),
            'view_item'          => __('Ver Produto', 'theme-espingardaria'),
            'search_items'       => __('Buscar Produtos', 'theme-espingardaria'),
            'not_found'          => __('Nenhum produto encontrado', 'theme-espingardaria'),
            'not_found_in_trash' => __('Nenhum produto encontrado na lixeira', 'theme-espingardaria'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-cart',
        'rewrite'             => array('slug' => 'produtos'),
        'show_in_rest'        => true,
    ));
    register_post_type('servico', array(
        'labels' => array(
            'name'               => __('Serviços', 'theme-espingardaria'),
            'singular_name'      => __('Serviço', 'theme-espingardaria'),
            'menu_name'          => __('Serviços', 'theme-espingardaria'),
            'add_new'            => __('Adicionar Novo', 'theme-espingardaria'),
            'add_new_item'       => __('Adicionar Novo Serviço', 'theme-espingardaria'),
            'edit_item'          => __('Editar Serviço', 'theme-espingardaria'),
            'new_item'           => __('Novo Serviço', 'theme-espingardaria'),
            'view_item'          => __('Ver Serviço', 'theme-espingardaria'),
            'search_items'       => __('Buscar Serviços', 'theme-espingardaria'),
            'not_found'          => __('Nenhum serviço encontrado', 'theme-espingardaria'),
            'not_found_in_trash' => __('Nenhum serviço encontrado na lixeira', 'theme-espingardaria'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-hammer',
        'rewrite'             => array('slug' => 'servicos'),
        'show_in_rest'        => true,
    ));
    register_post_type('portfolio', array(
        'labels' => array(
            'name'               => __('Portfólio', 'theme-espingardaria'),
            'singular_name'      => __('Portfólio', 'theme-espingardaria'),
            'menu_name'          => __('Portfólio', 'theme-espingardaria'),
            'add_new'            => __('Adicionar Novo', 'theme-espingardaria'),
            'add_new_item'       => __('Adicionar Novo Item', 'theme-espingardaria'),
            'edit_item'          => __('Editar Item', 'theme-espingardaria'),
            'new_item'           => __('Novo Item', 'theme-espingardaria'),
            'view_item'          => __('Ver Item', 'theme-espingardaria'),
            'search_items'       => __('Buscar Itens', 'theme-espingardaria'),
            'not_found'          => __('Nenhum item encontrado', 'theme-espingardaria'),
            'not_found_in_trash' => __('Nenhum item encontrado na lixeira', 'theme-espingardaria'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-format-gallery',
        'rewrite'             => array('slug' => 'portfolio'),
        'show_in_rest'        => true,
    ));
}
add_action('init', 'theme_espingardaria_register_post_types');

function theme_espingardaria_register_taxonomies() {
    register_taxonomy('categoria-produto', 'produto', array(
        'labels' => array(
            'name'              => __('Categorias de Produto', 'theme-espingardaria'),
            'singular_name'     => __('Categoria de Produto', 'theme-espingardaria'),
            'search_items'      => __('Buscar Categorias', 'theme-espingardaria'),
            'all_items'         => __('Todas as Categorias', 'theme-espingardaria'),
            'parent_item'       => __('Categoria Pai', 'theme-espingardaria'),
            'parent_item_colon' => __('Categoria Pai:', 'theme-espingardaria'),
            'edit_item'         => __('Editar Categoria', 'theme-espingardaria'),
            'update_item'       => __('Atualizar Categoria', 'theme-espingardaria'),
            'add_new_item'      => __('Adicionar Nova Categoria', 'theme-espingardaria'),
            'new_item_name'     => __('Nova Categoria', 'theme-espingardaria'),
            'menu_name'         => __('Categorias', 'theme-espingardaria'),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'categoria-produto'),
        'show_in_rest'      => true,
    ));
    register_taxonomy('marca', 'produto', array(
        'labels' => array(
            'name'              => __('Marcas', 'theme-espingardaria'),
            'singular_name'     => __('Marca', 'theme-espingardaria'),
            'search_items'      => __('Buscar Marcas', 'theme-espingardaria'),
            'all_items'         => __('Todas as Marcas', 'theme-espingardaria'),
            'edit_item'         => __('Editar Marca', 'theme-espingardaria'),
            'update_item'       => __('Atualizar Marca', 'theme-espingardaria'),
            'add_new_item'      => __('Adicionar Nova Marca', 'theme-espingardaria'),
            'new_item_name'     => __('Nova Marca', 'theme-espingardaria'),
            'menu_name'         => __('Marcas', 'theme-espingardaria'),
        ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'marca'),
        'show_in_rest'      => true,
    ));
    register_taxonomy('calibre', 'produto', array(
        'labels' => array(
            'name'              => __('Calibres', 'theme-espingardaria'),
            'singular_name'     => __('Calibre', 'theme-espingardaria'),
            'search_items'      => __('Buscar Calibres', 'theme-espingardaria'),
            'all_items'         => __('Todos os Calibres', 'theme-espingardaria'),
            'edit_item'         => __('Editar Calibre', 'theme-espingardaria'),
            'update_item'       => __('Atualizar Calibre', 'theme-espingardaria'),
            'add_new_item'      => __('Adicionar Novo Calibre', 'theme-espingardaria'),
            'new_item_name'     => __('Novo Calibre', 'theme-espingardaria'),
            'menu_name'         => __('Calibres', 'theme-espingardaria'),
        ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'calibre'),
        'show_in_rest'      => true,
    ));
    register_taxonomy('categoria-portfolio', 'portfolio', array(
        'labels' => array(
            'name'              => __('Categorias de Portfólio', 'theme-espingardaria'),
            'singular_name'     => __('Categoria de Portfólio', 'theme-espingardaria'),
            'search_items'      => __('Buscar Categorias', 'theme-espingardaria'),
            'all_items'         => __('Todas as Categorias', 'theme-espingardaria'),
            'parent_item'       => __('Categoria Pai', 'theme-espingardaria'),
            'parent_item_colon' => __('Categoria Pai:', 'theme-espingardaria'),
            'edit_item'         => __('Editar Categoria', 'theme-espingardaria'),
            'update_item'       => __('Atualizar Categoria', 'theme-espingardaria'),
            'add_new_item'      => __('Adicionar Nova Categoria', 'theme-espingardaria'),
            'new_item_name'     => __('Nova Categoria', 'theme-espingardaria'),
            'menu_name'         => __('Categorias', 'theme-espingardaria'),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'categoria-portfolio'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'theme_espingardaria_register_taxonomies');

function theme_espingardaria_add_product_meta_boxes() {
    add_meta_box(
        'theme_espingardaria_product_details',
        __('Detalhes do Produto', 'theme-espingardaria'),
        'theme_espingardaria_product_details_callback',
        'produto',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'theme_espingardaria_add_product_meta_boxes');

function theme_espingardaria_product_details_callback($post) {
    wp_nonce_field('theme_espingardaria_product_details', 'theme_espingardaria_product_details_nonce');
    $preco = get_post_meta($post->ID, '_preco', true);
    $preco_regular = get_post_meta($post->ID, '_preco_regular', true);
    $codigo = get_post_meta($post->ID, '_codigo_produto', true);
    $descricao_completa = get_post_meta($post->ID, '_descricao_completa', true);
    $especificacoes = get_post_meta($post->ID, '_especificacoes', true);
    $galeria = get_post_meta($post->ID, '_galeria_produto', true);
    ?>
    <div class="theme-espingardaria-product-fields">
        <div class="theme-espingardaria-product-field">
            <label for="preco"><?php esc_html_e('Preço', 'theme-espingardaria'); ?></label>
            <input type="text" id="preco" name="preco" value="<?php echo esc_attr($preco); ?>">
            <p class="description"><?php esc_html_e('Preço atual do produto (ex: 1999.90)', 'theme-espingardaria'); ?></p>
        </div>
        <div class="theme-espingardaria-product-field">
            <label for="preco_regular"><?php esc_html_e('Preço Regular', 'theme-espingardaria'); ?></label>
            <input type="text" id="preco_regular" name="preco_regular" value="<?php echo esc_attr($preco_regular); ?>">
            <p class="description"><?php esc_html_e('Preço regular antes do desconto (ex: 2499.90)', 'theme-espingardaria'); ?></p>
        </div>
        <div class="theme-espingardaria-product-field">
            <label for="codigo_produto"><?php esc_html_e('Código do Produto', 'theme-espingardaria'); ?></label>
            <input type="text" id="codigo_produto" name="codigo_produto" value="<?php echo esc_attr($codigo); ?>">
            <p class="description"><?php esc_html_e('Código ou referência do produto', 'theme-espingardaria'); ?></p>
        </div>
        <div class="theme-espingardaria-product-field">
            <label for="galeria_produto"><?php esc_html_e('Galeria de Imagens', 'theme-espingardaria'); ?></label>
            <input type="text" id="galeria_produto" name="galeria_produto" value="<?php echo esc_attr($galeria); ?>">
            <button type="button" class=" chiropractorbutton" id="galeria_produto_button"><?php esc_html_e('Selecionar Imagens', 'theme-espingardaria'); ?></button>
            <p class="description"><?php esc_html_e('IDs das imagens separados por vírgula', 'theme-espingardaria'); ?></p>
            <div id="galeria_produto_preview" class="gallery-preview"></div>
        </div>
    </div>
    <div class="theme-espingardaria-product-field">
        <label for="descricao_completa"><?php esc_html_e('Descrição Completa', 'theme-espingardaria'); ?></label>
        <?php
        wp_editor($descricao_completa, 'descricao_completa', array(
            'textarea_name' => 'descricao_completa',
            'textarea_rows' => 10,
            'media_buttons' => true,
        ));
        ?>
        <p class="description"><?php esc_html_e('Descrição detalhada do produto', 'theme-espingardaria'); ?></p>
    </div>
    <div class="theme-espingardaria-product-field">
        <label for="especificacoes"><?php esc_html_e('Especificações', 'theme-espingardaria'); ?></label>
        <?php
        wp_editor($especificacoes, 'especificacoes', array(
            'textarea_name' => 'especificacoes',
            'textarea_rows' => 10,
            'media_buttons' => true,
        ));
        ?>
        <p class="description"><?php esc_html_e('Especificações técnicas do produto', 'theme-espingardaria'); ?></p>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#galeria_produto_button').on('click', function(e) {
            e.preventDefault();
            var galleryFrame = wp.media({
                title: '<?php esc_html_e('Selecionar Imagens para Galeria', 'theme-espingardaria'); ?>',
                button: {
                    text: '<?php esc_html_e('Adicionar à Galeria', 'theme-espingardaria'); ?>'
                },
                multiple: true
            });
            galleryFrame.on('select', function() {
                var attachments = galleryFrame.state().get('selection').map(function(attachment) {
                    attachment = attachment.toJSON();
                    return attachment.id;
                });
                $('#galeria_produto').val(attachments.join(','));
                updateGalleryPreview();
            });
            galleryFrame.open();
        });
        function updateGalleryPreview() {
            var ids = $('#galeria_produto').val();
            if (ids) {
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'theme_espingardaria_get_gallery_preview',
                        ids: ids,
                        nonce: '<?php echo wp_create_nonce('theme_espingardaria_gallery_preview'); ?>'
                    },
                    success: function(response) {
                        $('#galeria_produto_preview').html(response);
                    }
                });
            } else {
                $('#galeria_produto_preview').html('');
            }
        }
        updateGalleryPreview();
    });
    </script>
    <?php
}

function theme_espingardaria_save_product_details($post_id) {
    if (!isset($_POST['theme_espingardaria_product_details_nonce']) || !wp_verify_nonce($_POST['theme_espingardaria_product_details_nonce'], 'theme_espingardaria_product_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['preco'])) {
        update_post_meta($post_id, '_preco', sanitize_text_field($_POST['preco']));
    }
    if (isset($_POST['preco_regular'])) {
        update_post_meta($post_id, '_preco_regular', sanitize_text_field($_POST['preco_regular']));
    }
    if (isset($_POST['codigo_produto'])) {
        update_post_meta($post_id, '_codigo_produto', sanitize_text_field($_POST['codigo_produto']));
    }
    if (isset($_POST['descricao_completa'])) {
        update_post_meta($post_id, '_descricao_completa', wp_kses_post($_POST['descricao_completa']));
    }
    if (isset($_POST['especificacoes'])) {
        update_post_meta($post_id, '_especificacoes', wp_kses_post($_POST['especificacoes']));
    }
    if (isset($_POST['galeria_produto'])) {
        update_post_meta($post_id, '_galeria_produto', sanitize_text_field($_POST['galeria_produto']));
    }
}
add_action('save_post_produto', 'theme_espingardaria_save_product_details');

function theme_espingardaria_get_gallery_preview() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'theme_espingardaria_gallery_preview')) {
        wp_die('Acesso negado');
    }
    $ids = isset($_POST['ids']) ? explode(',', $_POST['ids']) : array();
    $html = '';
    if (!empty($ids)) {
        $html .= '<div class="gallery-items">';
        foreach ($ids as $id) {
            $image = wp_get_attachment_image_src($id, 'thumbnail');
            if ($image) {
                $html .= '<div class="gallery-item">';
                $html .= '<img src="' . esc_url($image[0]) . '" alt="">';
                $html .= '</div>';
            }
        }
        $html .= '</div>';
    }
    echo $html;
    wp_die();
}
add_action('wp_ajax_theme_espingardaria_get_gallery_preview', 'theme_espingardaria_get_gallery_preview');
add_action('wp_ajax_nopriv_theme_espingardaria_get_gallery_preview', 'theme_espingardaria_get_gallery_preview');

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/theme-options.php';
require get_template_directory() . '/inc/header-functions.php';
//require get_template_directory() . '/inc/render-home-options.php';


function theme_espingardaria_get_options() {
    $default_options = array(
        'show_banner' => true,
        'slider' => array(
            array(
            'image' => '',
            'image_product_left' => '',
            'image_product_right' => '',
            'title' => '',
            'subtitle' => '',
            'price' => '',
            'button_text' => '',
            'button_url' => '',
            'secondary_button_text' => '',
            'secondary_button_url' => '',
            ),
        ),
        'show_categories' => true,
        'categories_title' => '',
        'selected_categories' => array(),
        'show_featured_products' => true,
        'featured_products_title' => '',
        'featured_products_count' => 4,
        'featured_products_category' => 0,
        'show_training' => true,
        'training_title' => '',
        'training_text' => '',
        'training_button_text' => '',
        'training_button_url' => '',
        'training_image' => '',
        'show_ammo' => true,
        'ammo_title' => '',
        'ammo_text' => '',
        'ammo_button_text' => '',
        'ammo_button_url' => '',
        'ammo_image' => '',
        'show_shop_anywhere' => true,
        'shop_anywhere_title' => '',
        'shop_anywhere_items' => array(),
        'show_reviews' => true,
        'reviews_title' => '',
        'reviews' => array(),
        'show_new_products' => true,
        'new_products_title' => '',
        'new_products_count' => 4,
        'show_blog' => true,
        'blog_title' => '',
        'blog_count' => 3,
        'show_about' => true,
        'about_title' => '',
        'about_text' => '',
        'about_image' => '',
    );
    $options = get_option('theme_espingardaria_options', array());
    $merged_options = wp_parse_args($options, $default_options);
    $merged_options['show_banner'] = get_theme_mod('theme_espingardaria_show_banner', $merged_options['show_banner']);
    $merged_options['show_categories'] = get_theme_mod('theme_espingardaria_show_categories', $merged_options['show_categories']);
    $merged_options['categories_title'] = get_theme_mod('theme_espingardaria_categories_title', $merged_options['categories_title']);
    $merged_options['show_featured_products'] = get_theme_mod('theme_espingardaria_show_featured_products', $merged_options['show_featured_products']);
    $merged_options['featured_products_title'] = get_theme_mod('theme_espingardaria_featured_products_title', $merged_options['featured_products_title']);
    $merged_options['featured_products_count'] = get_theme_mod('theme_espingardaria_featured_products_count', $merged_options['featured_products_count']);
    $merged_options['show_training'] = get_theme_mod('theme_espingardaria_show_training', $merged_options['show_training']);
    $merged_options['training_title'] = get_theme_mod('theme_espingardaria_training_title', $merged_options['training_title']);
    $merged_options['training_text'] = get_theme_mod('theme_espingardaria_training_text', $merged_options['training_text']);
    $merged_options['training_button_text'] = get_theme_mod('theme_espingardaria_training_button_text', $merged_options['training_button_text']);
    $merged_options['training_button_url'] = get_theme_mod('theme_espingardaria_training_button_url', $merged_options['training_button_url']);
    $merged_options['training_image'] = get_theme_mod('theme_espingardaria_training_image', $merged_options['training_image']);
    $merged_options['show_ammo'] = get_theme_mod('theme_espingardaria_show_ammo', $merged_options['show_ammo']);
    $merged_options['ammo_title'] = get_theme_mod('theme_espingardaria_ammo_title', $merged_options['ammo_title']);
    $merged_options['ammo_text'] = get_theme_mod('theme_espingardaria_ammo_text', $merged_options['ammo_text']);
    $merged_options['ammo_button_text'] = get_theme_mod('theme_espingardaria_ammo_button_text', $merged_options['ammo_button_text']);
    $merged_options['ammo_button_url'] = get_theme_mod('theme_espingardaria_ammo_button_url', $merged_options['ammo_button_url']);
    $merged_options['ammo_image'] = get_theme_mod('theme_espingardaria_ammo_image', $merged_options['ammo_image']);
    $merged_options['show_shop_anywhere'] = get_theme_mod('theme_espingardaria_show_shop_anywhere', $merged_options['show_shop_anywhere']);
    $merged_options['shop_anywhere_title'] = get_theme_mod('theme_espingardaria_shop_anywhere_title', $merged_options['shop_anywhere_title']);
    $merged_options['show_reviews'] = get_theme_mod('theme_espingardaria_show_reviews', $merged_options['show_reviews']);
    $merged_options['reviews_title'] = get_theme_mod('theme_espingardaria_reviews_title', $merged_options['reviews_title']);
    $merged_options['show_new_products'] = get_theme_mod('theme_espingardaria_show_new_products', $merged_options['show_new_products']);
    $merged_options['new_products_title'] = get_theme_mod('theme_espingardaria_new_products_title', $merged_options['new_products_title']);
    $merged_options['new_products_count'] = get_theme_mod('theme_espingardaria_new_products_count', $merged_options['new_products_count']);
    $merged_options['show_blog'] = get_theme_mod('theme_espingardaria_show_blog', $merged_options['show_blog']);
    $merged_options['blog_title'] = get_theme_mod('theme_espingardaria_blog_title', $merged_options['blog_title']);
    $merged_options['blog_count'] = get_theme_mod('theme_espingardaria_blog_count', $merged_options['blog_count']);
    $merged_options['show_about'] = get_theme_mod('theme_espingardaria_show_about', $merged_options['show_about']);
    $merged_options['about_title'] = get_theme_mod('theme_espingardaria_about_title', $merged_options['about_title']);
    $merged_options['about_text'] = get_theme_mod('theme_espingardaria_about_text', $merged_options['about_text']);
    $merged_options['about_image'] = get_theme_mod('theme_espingardaria_about_image', $merged_options['about_image']);
    return $merged_options;
}

function theme_espingardaria_sync_options_with_customizer() {
    $options = get_option('theme_espingardaria_options', array());
    if (!empty($options)) {
        set_theme_mod('theme_espingardaria_show_banner', $options['show_banner'] ?? true);
        set_theme_mod('theme_espingardaria_show_categories', $options['show_categories'] ?? true);
        set_theme_mod('theme_espingardaria_categories_title', $options['categories_title'] ?? '');
        set_theme_mod('theme_espingardaria_show_featured_products', $options['show_featured_products'] ?? true);
        set_theme_mod('theme_espingardaria_featured_products_title', $options['featured_products_title'] ?? '');
        set_theme_mod('theme_espingardaria_featured_products_count', $options['featured_products_count'] ?? 4);
        set_theme_mod('theme_espingardaria_show_training', $options['show_training'] ?? true);
        set_theme_mod('theme_espingardaria_training_title', $options['training_title'] ?? '');
        set_theme_mod('theme_espingardaria_training_text', $options['training_text'] ?? '');
        set_theme_mod('theme_espingardaria_training_button_text', $options['training_button_text'] ?? '');
        set_theme_mod('theme_espingardaria_training_button_url', $options['training_button_url'] ?? '');
        set_theme_mod('theme_espingardaria_training_image', $options['training_image'] ?? '');
        set_theme_mod('theme_espingardaria_show_ammo', $options['show_ammo'] ?? true);
        set_theme_mod('theme_espingardaria_ammo_title', $options['ammo_title'] ?? '');
        set_theme_mod('theme_espingardaria_ammo_text', $options['ammo_text'] ?? '');
        set_theme_mod('theme_espingardaria_ammo_button_text', $options['ammo_button_text'] ?? '');
        set_theme_mod('theme_espingardaria_ammo_button_url', $options['ammo_button_url'] ?? '');
        set_theme_mod('theme_espingardaria_ammo_image', $options['ammo_image'] ?? '');
        set_theme_mod('theme_espingardaria_show_shop_anywhere', $options['show_shop_anywhere'] ?? true);
        set_theme_mod('theme_espingardaria_shop_anywhere_title', $options['shop_anywhere_title'] ?? '');
        set_theme_mod('theme_espingardaria_show_reviews', $options['show_reviews'] ?? true);
        set_theme_mod('theme_espingardaria_reviews_title', $options['reviews_title'] ?? '');
        set_theme_mod('theme_espingardaria_show_new_products', $options['show_new_products'] ?? true);
        set_theme_mod('theme_espingardaria_new_products_title', $options['new_products_title'] ?? '');
        set_theme_mod('theme_espingardaria_new_products_count', $options['new_products_count'] ?? 4);
        set_theme_mod('theme_espingardaria_show_blog', $options['show_blog'] ?? true);
        set_theme_mod('theme_espingardaria_blog_title', $options['blog_title'] ?? '');
        set_theme_mod('theme_espingardaria_blog_count', $options['blog_count'] ?? 3);
        set_theme_mod('theme_espingardaria_show_about', $options['show_about'] ?? true);
        set_theme_mod('theme_espingardaria_about_title', $options['about_title'] ?? '');
        set_theme_mod('theme_espingardaria_about_text', $options['about_text'] ?? '');
        set_theme_mod('theme_espingardaria_about_image', $options['about_image'] ?? '');
    }
    $header_options = get_option('theme_espingardaria_header_options', array());
    if (!empty($header_options)) {
        set_theme_mod('theme_espingardaria_show_topbar', $header_options['show_topbar'] ?? true);
        set_theme_mod('theme_espingardaria_phone', $header_options['phone'] ?? '');
        set_theme_mod('theme_espingardaria_email', $header_options['email'] ?? '');
        set_theme_mod('theme_espingardaria_hours', $header_options['hours'] ?? '');
        set_theme_mod('theme_espingardaria_show_cart', $header_options['show_cart'] ?? true);
        set_theme_mod('theme_espingardaria_cart_url', $header_options['cart_url'] ?? '');
        set_theme_mod('theme_espingardaria_facebook', $header_options['facebook'] ?? '');
        set_theme_mod('theme_espingardaria_instagram', $header_options['instagram'] ?? '');
        set_theme_mod('theme_espingardaria_twitter', $header_options['twitter'] ?? '');
        set_theme_mod('theme_espingardaria_youtube', $header_options['youtube'] ?? '');
    }
}
add_action('init', 'theme_espingardaria_sync_options_with_customizer');

function theme_espingardaria_add_customizer_menu() {
    add_menu_page(
        __('Personalizar Tema', 'theme-espingardaria'),
        __('Personalizar Tema', 'theme-espingardaria'),
        'manage_options',
        'customize.php',
        '',
        'dashicons-admin-appearance',
        60
    );
}
add_action('admin_menu', 'theme_espingardaria_add_customizer_menu');

function theme_espingardaria_add_menus_menu() {
    add_menu_page(
        __('Menus de Navegação', 'theme-espingardaria'),
        __('Menus de Navegação', 'theme-espingardaria'),
        'manage_options',
        'nav-menus.php',
        '',
        'dashicons-menu',
        61
    );
}
add_action('admin_menu', 'theme_espingardaria_add_menus_menu');

if (!class_exists('Bootstrap_5_Nav_Walker')) {
    class Bootstrap_5_Nav_Walker extends Walker_Nav_Menu {
        function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }
        function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';
            $li_attributes = '';
            $class_names = $value = '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'nav-item';
            $classes[] = 'menu-item-' . $item->ID;
            if ($args->walker->has_children) {
                $classes[] = 'dropdown';
            }
            if (in_array('current-menu-item', $classes)) {
                $classes[] = 'active';
            }
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            $class_names = ' class="' . esc_attr($class_names) . '"';
            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
            $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
            $nav_link_class = 'nav-link';
            if ($args->walker->has_children) {
                $nav_link_class .= ' dropdown-toggle';
                $attributes .= ' data-bs-toggle="dropdown" aria-expanded="false"';
            }
            $item_output = $args->before;
            $item_output .= '<a class="' . $nav_link_class . '"' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
    }
}