<?php
/**
 * Funções de personalização do tema para o Customizer
 *
 * @package Theme_Espingardaria
 */

if (!defined('ABSPATH')) {
    exit;
}

function theme_espingardaria_customize_register($wp_customize) {
    // Configurações do Header
    $wp_customize->add_section('theme_espingardaria_header', array(
        'title'    => __('Configurações do Header', 'theme-espingardaria'),
        'priority' => 30,
    ));

    // Mostrar Barra Superior
    $wp_customize->add_setting('theme_espingardaria_show_topbar', array(
        'default'           => true,
        'sanitize_callback' => 'theme_espingardaria_sanitize_checkbox',
    ));
    $wp_customize->add_control('theme_espingardaria_show_topbar', array(
        'label'    => __('Mostrar Barra Superior', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'checkbox',
    ));

    // Telefone
    $wp_customize->add_setting('theme_espingardaria_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('theme_espingardaria_phone', array(
        'label'    => __('Telefone', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'text',
    ));

    // Email
    $wp_customize->add_setting('theme_espingardaria_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('theme_espingardaria_email', array(
        'label'    => __('Email', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'email',
    ));

    // Horário de Funcionamento
    $wp_customize->add_setting('theme_espingardaria_hours', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('theme_espingardaria_hours', array(
        'label'    => __('Horário de Funcionamento', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'text',
    ));

    // Mostrar Carrinho
    $wp_customize->add_setting('theme_espingardaria_show_cart', array(
        'default'           => true,
        'sanitize_callback' => 'theme_espingardaria_sanitize_checkbox',
    ));
    $wp_customize->add_control('theme_espingardaria_show_cart', array(
        'label'    => __('Mostrar Carrinho', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'checkbox',
    ));

    // URL do Carrinho
    $wp_customize->add_setting('theme_espingardaria_cart_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_espingardaria_cart_url', array(
        'label'    => __('URL do Carrinho', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'url',
    ));

    // Redes Sociais
    $wp_customize->add_setting('theme_espingardaria_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_espingardaria_facebook', array(
        'label'    => __('Facebook', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('theme_espingardaria_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_espingardaria_instagram', array(
        'label'    => __('Instagram', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('theme_espingardaria_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_espingardaria_twitter', array(
        'label'    => __('Twitter', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('theme_espingardaria_youtube', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_espingardaria_youtube', array(
        'label'    => __('YouTube', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_header',
        'type'     => 'url',
    ));

    // Cores
    $wp_customize->add_section('theme_espingardaria_colors', array(
        'title'    => __('Cores', 'theme-espingardaria'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('theme_espingardaria_primary_color', array(
        'default'           => '#d9534f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_espingardaria_primary_color', array(
        'label'    => __('Cor Primária', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_colors',
    )));

    $wp_customize->add_setting('theme_espingardaria_secondary_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_espingardaria_secondary_color', array(
        'label'    => __('Cor Secundária', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_colors',
    )));

    $wp_customize->add_setting('theme_espingardaria_header_bg_color', array(
        'default'           => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_espingardaria_header_bg_color', array(
        'label'    => __('Cor de Fundo do Header', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_colors',
    )));

    $wp_customize->add_setting('theme_espingardaria_topbar_bg_color', array(
        'default'           => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_espingardaria_topbar_bg_color', array(
        'label'    => __('Cor de Fundo da Barra Superior', 'theme-espingardaria'),
        'section'  => 'theme_espingardaria_colors',
    )));
}
add_action('customize_register', 'theme_espingardaria_customize_register');

function theme_espingardaria_sanitize_checkbox($checked) {
    return isset($checked) && true == $checked;
}

function theme_espingardaria_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr(get_theme_mod('theme_espingardaria_primary_color', '#d9534f')); ?>;
            --secondary-color: <?php echo esc_attr(get_theme_mod('theme_espingardaria_secondary_color', '#333333')); ?>;
            --header-bg-color: <?php echo esc_attr(get_theme_mod('theme_espingardaria_header_bg_color', '#222222')); ?>;
            --topbar-bg-color: <?php echo esc_attr(get_theme_mod('theme_espingardaria_topbar_bg_color', '#111111')); ?>;
        }
        .top-bar { background-color: var(--topbar-bg-color); }
        .site-navigation { background-color: var(--header-bg-color); }
        .btn-primary, .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        a { color: var(--primary-color); }
        a:hover { color: var(--secondary-color); }
    </style>
    <?php
}
add_action('wp_head', 'theme_espingardaria_customizer_css');