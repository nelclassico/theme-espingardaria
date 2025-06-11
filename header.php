<?php
/**
 * O arquivo de cabeçalho do tema
 *
 * @package Theme_Espingardaria
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Pular para o conteúdo', 'theme-espingardaria'); ?></a>

    <?php
    // Verifica se a barra superior deve ser exibida
    if (get_theme_mod('theme_espingardaria_show_topbar', true)) :
    ?>
    <div class="top-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="top-bar-info">
                        <?php if (get_theme_mod('theme_espingardaria_phone')) : ?>
                        <div class="top-bar-info-item">
                            <i class="fas fa-phone-alt"></i>
                            <a href="tel:<?php echo esc_attr(get_theme_mod('theme_espingardaria_phone')); ?>"><?php echo esc_html(get_theme_mod('theme_espingardaria_phone')); ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if (get_theme_mod('theme_espingardaria_hours')) : ?>
                        <div class="top-bar-info-item">
                            <i class="fas fa-clock"></i>
                            <?php echo esc_html(get_theme_mod('theme_espingardaria_hours')); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="top-bar-social">
                        <?php if (get_theme_mod('theme_espingardaria_facebook')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('theme_espingardaria_facebook')); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php if (get_theme_mod('theme_espingardaria_instagram')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('theme_espingardaria_instagram')); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if (get_theme_mod('theme_espingardaria_twitter')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('theme_espingardaria_twitter')); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if (get_theme_mod('theme_espingardaria_youtube')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('theme_espingardaria_youtube')); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <header id="masthead" class="site-header">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <!-- Logotipo -->
                    <div class="navbar-brand site-branding">
                        <?php
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Botão toggler para mobile -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="<?php esc_attr_e('Alternar navegação', 'theme-espingardaria'); ?>">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Menu e elementos à direita -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav ms-auto', // Ajustado de ml-auto para ms-auto (Bootstrap 5)
                    'fallback_cb'    => '__return_false',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'          => 2,
                    'walker'         => new Bootstrap_5_Nav_Walker(),
                ));
                ?>

                <!-- Elementos à direita -->
                <div class="header-right">
                    <?php if (get_theme_mod('theme_espingardaria_show_search', true)) : ?>
                        <div class="header-search">
                            <button class="search-toggle" aria-label="<?php esc_attr_e('Abrir pesquisa', 'theme-espingardaria'); ?>">
                                <i class="fas fa-search"></i>
                            </button>
                            <div class="search-form-container" style="display: none;">
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (get_theme_mod('theme_espingardaria_show_cart', true)) : ?>
                        <div class="header-cart">
                            <a href="<?php echo esc_url(get_theme_mod('theme_espingardaria_cart_url', '#')); ?>" class="header-cart-link" aria-label="<?php esc_attr_e('Ver carrinho', 'theme-espingardaria'); ?>">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="header-cart-count">
                                    <?php
                                    // Se usar WooCommerce, substitua "0" pelo número dinâmico de itens
                                    if (class_exists('WooCommerce')) {
                                        echo WC()->cart->get_cart_contents_count();
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
            </div>
    </header>
</div>