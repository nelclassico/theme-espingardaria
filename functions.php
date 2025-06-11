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
    // Estilos
    wp_enqueue_style(
        'bootstrap',
        get_template_directory_uri() . '/assets/css/bootstrap.min.css',
        array(),
        '5.3.6'
    );
    wp_enqueue_style(
        'fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
        array(),
        '5.15.4'
    );
    // Owl Carousel CSS - Caminho corrigido
    wp_enqueue_style(
        'owl-carousel-css',
        get_template_directory_uri() . '/assets/css/vendor/owl.carousel.min.css',
        array(),
        '2.3.4'
    );
    wp_enqueue_style(
        'owl-theme-css',
        get_template_directory_uri() . '/assets/css/vendor/owl.theme.default.min.css',
        array('owl-carousel-css'),
        '2.3.4'
    );
    // Fancybox CSS
    wp_enqueue_style(
        'fancybox-css',
        get_template_directory_uri() . '/assets/css/vendor/jquery.fancybox.min.css',
        array(),
        '3.5.7'
    );
    // Adicionar AOS CSS
    wp_enqueue_style(
        'aos-css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        array(),
        '2.3.1'
    );
    wp_enqueue_style(
        'theme-espingardaria-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array('bootstrap', 'owl-theme-css', 'fancybox-css', 'aos-css'),
        THEME_ESPINGARDARIA_VERSION
    );
    wp_enqueue_style(
        'theme-espingardaria-main-style',
        get_stylesheet_uri(),
        array('theme-espingardaria-style'),
        THEME_ESPINGARDARIA_VERSION
    );

    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script(
        'bootstrap-cdn',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.6',
        true
    );
    wp_enqueue_script(
        'owl-carousel-js',
        get_template_directory_uri() . '/assets/js/vendor/owl.carousel.min.js',
        array('jquery'),
        '2.3.4',
        true
    );
    wp_enqueue_script(
        'fancybox-js',
        get_template_directory_uri() . '/assets/js/vendor/jquery.fancybox.min.js',
        array('jquery'),
        '3.5.7',
        true
    );
    // Adicionar AOS JS
    wp_enqueue_script(
        'aos-js',
        'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js',
        array('jquery'),
        '2.3.4',
        true
    );
    wp_enqueue_script(
        'theme-espingardaria-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery', 'bootstrap-cdn', 'owl-carousel-js', 'fancybox-js', 'aos-js'),
        THEME_ESPINGARDARIA_VERSION,
        true
    );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Inicializar AOS
    wp_add_inline_script('aos-js', 'AOS.init({ duration: 1000, once: true });');

    // Adicionar script inline para single-produto.php
    if (is_singular('produto')) {
        wp_add_inline_script('theme-espingardaria-main', '
            jQuery(document).ready(function($) {
                // Inicializar Fancybox
                $("[data-fancybox=\"gallery\"]").fancybox({
                    loop: true,
                    buttons: [
                        "zoom",
                        "slideShow",
                        "fullScreen",
                        "thumbs",
                        "close"
                    ],
                    animationEffect: "fade",
                    transitionEffect: "slide"
                });

                // Controle de quantidade (mesmo sem efeito prático)
                $(".quantity-up").on("click", function() {
                    var input = $(this).siblings(".quantity-input");
                    var value = parseInt(input.val());
                    if (value < 99) {
                        input.val(value + 1);
                    }
                });
                $(".quantity-down").on("click", function() {
                    var input = $(this).siblings(".quantity-input");
                    var value = parseInt(input.val());
                    if (value > 1) {
                        input.val(value - 1);
                    }
                });

                // Formulário de contato
                $("#product-contact-form").on("submit", function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var responseDiv = $("#contact-form-response");
                    responseDiv.removeClass("alert-success alert-danger").html("");

                    $.ajax({
                        url: ajaxurl,
                        type: "POST",
                        data: form.serialize(),
                        success: function(response) {
                            if (response.success) {
                                responseDiv.addClass("alert alert-success").html(response.data.message);
                                form[0].reset();
                            } else {
                                responseDiv.addClass("alert alert-danger").html(response.data.message);
                            }
                        },
                        error: function() {
                            responseDiv.addClass("alert alert-danger").html("' . esc_html__('Erro ao enviar a mensagem. Tente novamente.', 'theme-espingardaria') . '");
                        }
                    });
                });

                // Funcionalidade de favoritos
                $(".add-to-wishlist").on("click", function() {
                    var button = $(this);
                    var productId = button.data("product-id");
                    $.ajax({
                        url: ajaxurl,
                        type: "POST",
                        data: {
                            action: "theme_espingardaria_toggle_favorite",
                            product_id: productId,
                            nonce: "' . wp_create_nonce('theme_espingardaria_favorite_nonce') . '"
                        },
                        success: function(response) {
                            if (response.success) {
                                if (response.data.favorited) {
                                    button.addClass("favorited");
                                } else {
                                    button.removeClass("favorited");
                                }
                            }
                        }
                    });
                });
            });
        ');
    }
}
add_action('wp_enqueue_scripts', 'theme_espingardaria_scripts');




function theme_espingardaria_enqueue_admin_scripts($hook) {
    if (in_array($hook, ['appearance_page_theme-espingardaria-options', 'appearance_page_theme-espingardaria-header'])) {
        wp_enqueue_media();
        wp_enqueue_style('theme-espingardaria-admin', get_template_directory_uri() . '/css/admin.css', array(), '1.0.0');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('theme-espingardaria-admin', get_template_directory_uri() . 'js/admin.js', array('jquery', 'jquery-ui-sortable'), '1.0.0', true);
        wp_localize_script('theme-espingardaria-admin', 'themeEspingardaria', array(
            'mediaTitle' => __('Selecionar ou Enviar Imagem', 'theme-espingardaria'),
            'mediaButton' => __('Usar esta imagem', 'theme-espingardaria'),
            'removeText' => __('Remover', 'theme-espingardaria'),
            'addText' => __('Adicionar', 'theme-espingardaria'),
            'ajaxurl' => admin_url('admin-ajax.php'),
        ));
    }

    if ($hook === 'edit-tags.php' || $hook === 'term.php') {
        if (!wp_script_is('wp-media-models', 'enqueued')) {
            wp_enqueue_media();
            error_log('Enfileirando wp.media para ' . $hook);
        }
        wp_enqueue_script(
            'theme-espingardaria-admin-taxonomy',
            get_template_directory_uri() . '/js/admin-taxonomy.js',
            array('jquery'),
            '1.0.0',
            true
        );
        wp_add_inline_script('theme-espingardaria-admin-taxonomy', 'console.log("admin-taxonomy.js carregado em ' . $hook . '");');
    }
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
    register_taxonomy('comprimento_cano', 'produto', array(
        'labels' => array(
            'name'              => __('Comprimento do Cano', 'theme-espingardaria'),
            'singular_name'     => __('Comprimento', 'theme-espingardaria'),
            'search_items'      => __('Buscar Comprimento do cano', 'theme-espingardaria'),
            'all_items'         => __('Todos os Comprimentos', 'theme-espingardaria'),
            'edit_item'         => __('Editar Comprimento', 'theme-espingardaria'),
            'update_item'       => __('Atualizar Comprimento', 'theme-espingardaria'),
            'add_new_item'      => __('Adicionar Novo Comprimento', 'theme-espingardaria'),
            'new_item_name'     => __('Novo Comprimento', 'theme-espingardaria'),
            'menu_name'         => __('Comprimentos', 'theme-espingardaria'),
        ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'comprimento_cano'),
        'show_in_rest'      => true,
    ));
    register_taxonomy('modalidades', 'produto', array(
        'labels' => array(
            'name'              => __('Modalidades', 'theme-espingardaria'),
            'singular_name'     => __('Modalidade', 'theme-espingardaria'),
            'search_items'      => __('Buscar Modalidades', 'theme-espingardaria'),
            'all_items'         => __('Todos as modalidades', 'theme-espingardaria'),
            'edit_item'         => __('Editar Modalidade', 'theme-espingardaria'),
            'update_item'       => __('Atualizar Modalidade', 'theme-espingardaria'),
            'add_new_item'      => __('Adicionar Novo Modalidade', 'theme-espingardaria'),
            'new_item_name'     => __('Nova Modalidade', 'theme-espingardaria'),
            'menu_name'         => __('Modalidades', 'theme-espingardaria'),
        ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'modalidades'),
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
    // Adicionar metabox para e-mail de contato
    add_meta_box(
        'theme_espingardaria_product_contact',
        __('E-mail para Contato', 'theme-espingardaria'),
        'theme_espingardaria_product_contact_callback',
        'produto',
        'side',
        'default'
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
            <button type="button" class="chiropractorbutton" id="galeria_produto_button"><?php esc_html_e('Selecionar Imagens', 'theme-espingardaria'); ?></button>
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

add_action('categoria-produto_add_form_fields', 'add_category_image_field', 10, 2);
function add_category_image_field($taxonomy) {
    ?>
    <div class="form-field">
        <label for="taxonomy_image"><?php _e('Imagem Destaque', 'theme-espingardaria'); ?></label>
        <input type="hidden" name="taxonomy_image" id="taxonomy_image" value="">
        <div id="taxonomy-image-wrapper"></div>
        <p>
            <button class="taxonomy_media_button button"><?php _e('Fazer Upload', 'theme-espingardaria'); ?></button>
            <button class="taxonomy_media_remove button" style="display: none;"><?php _e('Remover Imagem', 'theme-espingardaria'); ?></button>
        </p>
    </div>
    <?php
}

add_action('categoria-produto_edit_form_fields', 'edit_category_image_field', 10, 2);
function edit_category_image_field($term, $taxonomy) {
    $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
    $image_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'thumbnail') : '';
    ?>
    <tr class="form-field">
        <th scope="row"><label for="taxonomy_image"><?php _e('Imagem Destaque', 'theme-espingardaria'); ?></label></th>
        <td>
            <input type="hidden" name="taxonomy_image" id="taxonomy_image" value="<?php echo esc_attr($thumbnail_id); ?>">
            <div id="taxonomy-image-wrapper">
                <?php if ($image_url) : ?>
                    <img src="<?php echo esc_url($image_url); ?>" style="max-width: 200px; height: auto;" alt="<?php _e('Imagem da categoria', 'theme-espingardaria'); ?>">
                <?php endif; ?>
            </div>
            <p>
                <button class="taxonomy_media_button button"><?php _e('Fazer Upload', 'theme-espingardaria'); ?></button>
                <button class="taxonomy_media_remove button" style="<?php echo $image_url ? '' : 'display: none;'; ?>"><?php _e('Remover Imagem', 'theme-espingardaria'); ?></button>
            </p>
        </td>
    </tr>
    <?php
}

add_action('created_categoria-produto', 'save_category_image', 10, 2);
add_action('edited_categoria-produto', 'save_category_image', 10, 2);
function save_category_image($term_id) {
    if (isset($_POST['taxonomy_image'])) {
        $thumbnail_id = sanitize_text_field($_POST['taxonomy_image']);
        update_term_meta($term_id, 'thumbnail_id', $thumbnail_id);
    }
}

function theme_espingardaria_pre_get_posts($query) {
    if (!is_admin() && $query->is_main_query() && (is_tax('categoria-produto') || is_post_type_archive('produto'))) {
        $query->set('post_type', 'produto');
    }
}
add_action('pre_get_posts', 'theme_espingardaria_pre_get_posts');

function theme_espingardaria_breadcrumb() {
    if (is_front_page()) return;

    global $post;
    $delimiter = ' » ';
    echo '<nav class="breadcrumb">';
    echo '<a href="' . home_url() . '">Início</a>' . $delimiter;

    if (is_singular()) {
        $post_type = get_post_type();

        if ($post_type === 'page') {
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            foreach ($ancestors as $ancestor_id) {
                echo '<a href="' . get_permalink($ancestor_id) . '">' . get_the_title($ancestor_id) . '</a>' . $delimiter;
            }
            echo '<span>' . get_the_title() . '</span>';
        } elseif ($post_type === 'post') {
            $category = get_the_category();
            if ($category) {
                $main_cat = $category[0];
                echo get_category_parents($main_cat, true, $delimiter);
            }
            echo '<span>' . get_the_title() . '</span>';
        } else {
            $post_type_object = get_post_type_object($post_type);
            if ($post_type_object && $post_type_object->has_archive) {
                $archive_link = get_post_type_archive_link($post_type);
                echo '<a href="' . $archive_link . '">' . $post_type_object->labels->name . '</a>' . $delimiter;
            }

            $ancestors = array_reverse(get_post_ancestors($post->ID));
            foreach ($ancestors as $ancestor_id) {
                echo '<a href="' . get_permalink($ancestor_id) . '">' . get_the_title($ancestor_id) . '</a>' . $delimiter;
            }

            echo '<span>' . get_the_title() . '</span>';
        }
    } elseif (is_category()) {
        $cat = get_queried_object();
        if ($cat->parent != 0) {
            echo get_category_parents($cat->parent, true, $delimiter);
        }
        echo '<span>' . single_cat_title('', false) . '</span>';
    } elseif (is_tax()) {
        $term = get_queried_object();
        $taxonomy = get_taxonomy($term->taxonomy);
        echo '<a href="' . get_post_type_archive_link(get_post_type()) . '">' . $taxonomy->labels->name . '</a>' . $delimiter;
        echo '<span>' . $term->name . '</span>';
    } elseif (is_tag()) {
        echo '<span>Tag: ' . single_tag_title('', false) . '</span>';
    } elseif (is_author()) {
        echo '<span>Autor: ' . get_the_author() . '</span>';
    } elseif (is_date()) {
        if (is_day()) {
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' .
                 get_the_time('F Y') . '</a>' . $delimiter;
            echo '<span>' . get_the_time('d') . '</span>';
        } elseif (is_month()) {
            echo '<span>' . get_the_time('F Y') . '</span>';
        } elseif (is_year()) {
            echo '<span>' . get_the_time('Y') . '</span>';
        }
    } elseif (is_search()) {
        echo '<span>Resultados da busca por: "' . get_search_query() . '"</span>';
    } elseif (is_404()) {
        echo '<span>Página não encontrada</span>';
    }

    echo '</nav>';
}

function theme_espingardaria_force_archive_template($template) {
    if (is_tax(array('categoria-produto', 'marca', 'calibre', 'comprimento_cano', 'modalidades'))) {
        $new_template = locate_template('archive-produto.php');
        if (!empty($new_template)) {
            $template = $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'theme_espingardaria_force_archive_template');

// Funções adicionais para suportar as novas funcionalidades

// Metabox para e-mail de contato
function theme_espingardaria_product_contact_callback($post) {
    wp_nonce_field('theme_espingardaria_product_contact', 'theme_espingardaria_product_contact_nonce');
    $contact_email = get_post_meta($post->ID, '_contato_email', true);
    ?>
    <p>
        <label for="contato_email"><?php esc_html_e('E-mail para Contato:', 'theme-espingardaria'); ?></label><br>
        <input type="email" id="contato_email" name="contato_email" value="<?php echo esc_attr($contact_email); ?>" style="width: 100%;">
        <span class="description"><?php esc_html_e('E-mail que receberá as mensagens do formulário desta página.', 'theme-espingardaria'); ?></span>
    </p>
    <?php
}

function theme_espingardaria_save_product_contact($post_id) {
    if (!isset($_POST['theme_espingardaria_product_contact_nonce']) || !wp_verify_nonce($_POST['theme_espingardaria_product_contact_nonce'], 'theme_espingardaria_product_contact')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['contato_email'])) {
        $email = sanitize_email($_POST['contato_email']);
        if (is_email($email)) {
            update_post_meta($post_id, '_contato_email', $email);
        } else {
            delete_post_meta($post_id, '_contato_email');
        }
    }
}
add_action('save_post_produto', 'theme_espingardaria_save_product_contact');

// Enviar e-mail de contato
function theme_espingardaria_send_product_contact_email() {
    if (!isset($_POST['product_contact_nonce_field']) || !wp_verify_nonce($_POST['product_contact_nonce_field'], 'product_contact_nonce')) {
        wp_send_json_error(array('message' => __('Erro de validação. Tente novamente.', 'theme-espingardaria')));
    }

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $name = isset($_POST['contact_name']) ? sanitize_text_field($_POST['contact_name']) : '';
    $email = isset($_POST['contact_email']) ? sanitize_email($_POST['contact_email']) : '';
    $message = isset($_POST['contact_message']) ? sanitize_textarea_field($_POST['contact_message']) : '';

    if (!$product_id || !$name || !$email || !$message || !is_email($email)) {
        wp_send_json_error(array('message' => __('Por favor, preencha todos os campos corretamente.', 'theme-espingardaria')));
    }

    $to = get_post_meta($product_id, '_contato_email', true);
    if (!$to || !is_email($to)) {
        $to = get_option('admin_email');
    }

    $product_title = get_the_title($product_id);
    $product_url = get_permalink($product_id);
    $subject = sprintf(__('Contato sobre o produto: %s', 'theme-espingardaria'), $product_title);
    $body = sprintf(
        __("Nome: %s\nE-mail: %s\n\nMensagem:\n%s\n\nProduto: %s\nLink: %s", 'theme-espingardaria'),
        $name,
        $email,
        $message,
        $product_title,
        $product_url
    );

    $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>');
    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => __('Mensagem enviada com sucesso!', 'theme-espingardaria')));
    } else {
        wp_send_json_error(array('message' => __('Erro ao enviar a mensagem. Tente novamente mais tarde.', 'theme-espingardaria')));
    }
}
add_action('wp_ajax_send_product_contact_email', 'theme_espingardaria_send_product_contact_email');
add_action('wp_ajax_nopriv_send_product_contact_email', 'theme_espingardaria_send_product_contact_email');

// Funcionalidade de favoritos
function theme_espingardaria_toggle_favorite() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'theme_espingardaria_favorite_nonce')) {
        wp_send_json_error();
    }

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    if (!$product_id) {
        wp_send_json_error();
    }

    $favorited = false;

    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $favorites = get_user_meta($user_id, 'theme_espingardaria_favorites', true);
        $favorites = $favorites ? (array)$favorites : [];

        if (in_array($product_id, $favorites)) {
            $favorites = array_diff($favorites, [$product_id]);
            $favorited = false;
        } else {
            $favorites[] = $product_id;
            $favorited = true;
        }

        update_user_meta($user_id, 'theme_espingardaria_favorites', array_unique($favorites));
    } else {
        $favorites = isset($_COOKIE['theme_espingardaria_favorites']) ? json_decode(stripslashes($_COOKIE['theme_espingardaria_favorites']), true) : [];

        if (in_array($product_id, $favorites)) {
            $favorites = array_diff($favorites, [$product_id]);
            $favorited = false;
        } else {
            $favorites[] = $product_id;
            $favorited = true;
        }

        setcookie('theme_espingardaria_favorites', json_encode(array_unique($favorites)), time() + (30 * DAY_IN_SECONDS), '/');
    }

    wp_send_json_success(array('favorited' => $favorited));
}
add_action('wp_ajax_theme_espingardaria_toggle_favorite', 'theme_espingardaria_toggle_favorite');
add_action('wp_ajax_nopriv_theme_espingardaria_toggle_favorite', 'theme_espingardaria_toggle_favorite');