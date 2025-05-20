<?php
/**
 * Template para exibir conteúdo de posts
 *
 * @package Theme_Espingardaria
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()) :
        ?>
        <div class="entry-meta">
            <span class="posted-on">
                <i class="fas fa-calendar-alt"></i>
                <?php echo get_the_date(); ?>
            </span>
            <span class="byline">
                <i class="fas fa-user"></i>
                <?php the_author(); ?>
            </span>
            <?php if (has_category()) : ?>
            <span class="cat-links">
                <i class="fas fa-folder"></i>
                <?php the_category(', '); ?>
            </span>
            <?php endif; ?>
            <?php if (has_tag()) : ?>
            <span class="tags-links">
                <i class="fas fa-tags"></i>
                <?php the_tags('', ', '); ?>
            </span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail() && !is_singular()) : ?>
    <div class="entry-thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('theme-espingardaria-featured', array('class' => 'img-fluid')); ?>
        </a>
    </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if (is_singular()) :
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Páginas:', 'theme-espingardaria'),
                'after'  => '</div>',
            ));
        else :
            the_excerpt();
        ?>
        <div class="read-more">
            <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e('Leia Mais', 'theme-espingardaria'); ?></a>
        </div>
        <?php endif; ?>
    </div>

    <?php if (is_singular() && (comments_open() || get_comments_number())) : ?>
    <div class="entry-comments">
        <?php comments_template(); ?>
    </div>
    <?php endif; ?>
</article>
