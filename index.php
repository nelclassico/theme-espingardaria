<?php
/**
 * O arquivo principal do tema
 *
 * @package Theme_Espingardaria
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    if (have_posts()) :
        if (is_home() && !is_front_page()) :
            ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

        /* Inicia o loop */
        while (have_posts()) :
            the_post();

            /*
             * Inclui o template de conteúdo parcial.
             */
            get_template_part('template-parts/content', get_post_type());

        endwhile;

        the_posts_pagination(array(
            'prev_text' => '<i class="fas fa-chevron-left"></i> ' . esc_html__('Anterior', 'theme-espingardaria'),
            'next_text' => esc_html__('Próximo', 'theme-espingardaria') . ' <i class="fas fa-chevron-right"></i>',
        ));

    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>
</main>

<?php
get_sidebar();
get_footer();
