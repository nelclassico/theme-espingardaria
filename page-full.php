<?php
/**
 * Template Name: Página Completa
 *
 * @package Theme_Espingardaria
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header>

            <?php if (has_post_thumbnail()) : ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
            </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Páginas:', 'theme-espingardaria'),
                    'after'  => '</div>',
                ));
                ?>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
