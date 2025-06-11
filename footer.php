<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="row">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="col-md-3">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="col-md-3">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="col-md-3">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-4')) : ?>
                <div class="col-md-3">
                    <?php dynamic_sidebar('footer-4'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Todos os direitos reservados.', 'theme-espingardaria'); ?></p>
        </div>
    </div>

    <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>


    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>
     <script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery.fancybox.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
      AOS.init();
    </script>
</footer>
