<?php

/**
 * 
 *
 * @package Theme_Espingardaria
 */
get_header();
?>
<main id="primary" class="site-main">   
        <?php
        while (have_posts()) :
            the_post();
        ?>
        <?php if (has_post_thumbnail()) : ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
        </div>
        <?php endif; ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container">
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>           
                <div class="entry-content">
                    <?php
                    the_content();
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Páginas:', 'theme-espingardaria'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </div>
        </article>
        <?php endwhile; ?>
</main>

<?php

get_footer();

