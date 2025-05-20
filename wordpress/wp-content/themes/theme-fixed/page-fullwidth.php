<?php
/**
 * Template Name: Página Largura Total
 *
 * Template para exibição de página em largura total (fullscreen)
 *
 * @package Theme_Espingardaria
 */

get_header();
?>

<main id="primary" class="site-main fullwidth-page">
    <div class="container-fluid p-0">
        <?php while (have_posts()) : the_post(); ?>
            
            <div class="page-header text-center">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <div class="scroll-down">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>

            <article id="post-<?php the_ID(); ?>" <?php post_class('fullwidth-content'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="page-featured-image">
                        <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                    </div>
                <?php endif; ?>

                <div class="container">
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>

        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
