<?php
/**
 * O arquivo de rodapé do tema
 *
 * @package Theme_Espingardaria
 */

?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-widget">
                        <?php if (has_custom_logo()) : ?>
                            <div class="footer-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php else : ?>
                            <h3 class="site-title"><?php bloginfo('name'); ?></h3>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('theme_espingardaria_footer_about')) : ?>
                            <p><?php echo wp_kses_post(get_theme_mod('theme_espingardaria_footer_about')); ?></p>
                        <?php endif; ?>
                        
                        <div class="footer-contact-info">
                            <?php if (get_theme_mod('theme_espingardaria_address')) : ?>
                            <div class="footer-contact-item">
                                <div class="footer-contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="footer-contact-text">
                                    <?php echo wp_kses_post(get_theme_mod('theme_espingardaria_address')); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('theme_espingardaria_phone')) : ?>
                            <div class="footer-contact-item">
                                <div class="footer-contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="footer-contact-text">
                                    <a href="tel:<?php echo esc_attr(get_theme_mod('theme_espingardaria_phone')); ?>"><?php echo esc_html(get_theme_mod('theme_espingardaria_phone')); ?></a>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('theme_espingardaria_email')) : ?>
                            <div class="footer-contact-item">
                                <div class="footer-contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="footer-contact-text">
                                    <a href="mailto:<?php echo esc_attr(get_theme_mod('theme_espingardaria_email')); ?>"><?php echo esc_html(get_theme_mod('theme_espingardaria_email')); ?></a>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="footer-social">
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
                
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3><?php esc_html_e('Links Rápidos', 'theme-espingardaria'); ?></h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container'      => false,
                            'menu_class'     => 'footer-links',
                            'fallback_cb'    => '__return_false',
                            'depth'          => 1,
                        ));
                        ?>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3><?php esc_html_e('Newsletter', 'theme-espingardaria'); ?></h3>
                        <p><?php esc_html_e('Inscreva-se para receber as últimas notícias e atualizações.', 'theme-espingardaria'); ?></p>
                        
                        <div class="footer-newsletter">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="<?php esc_attr_e('Seu e-mail', 'theme-espingardaria'); ?>" required>
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Todos os direitos reservados.', 'theme-espingardaria'); ?></p>
            </div>
        </div>
    </footer>
    
    <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
