<?php
/**
 * Integração do header dinâmico com o tema
 *
 * @package Theme_Espingardaria
 */

if (!defined('ABSPATH')) {
    exit;
}

function theme_espingardaria_get_header_options() {
    $default_options = array(
        'show_topbar' => true,
        'show_search' => true,
        'show_cart' => true,
        'cart_url' => '#',
        'phone' => '',
        'email' => '',
        'hours' => '',
        'facebook' => '',
        'instagram' => '',
        'twitter' => '',
        'youtube' => '',
        'logo' => '',
    );
    $options = get_option('theme_espingardaria_header_options', array());
    return wp_parse_args($options, $default_options);
}

require get_template_directory() . '/inc/header-options.php';