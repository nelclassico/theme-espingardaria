<?php
/**
 * Template para exibir posts individuais
 *
 * @package Theme_Espingardaria
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                while (have_posts()) :
                    the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        
                        <div class="entry-meta">
                            <span class="posted-on">
                                <i class="far fa-calendar-alt"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                            
                            <span class="posted-by">
                                <i class="far fa-user"></i>
                                <?php the_author(); ?>
                            </span>
                            
                            <?php
                            $categories_list = get_the_category_list(', ');
                            if ($categories_list) {
                                echo '<span class="cat-links"><i class="far fa-folder-open"></i> ' . $categories_list . '</span>';
                            }
                            ?>
                            
                            <?php
                            $tags_list = get_the_tag_list('', ', ');
                            if ($tags_list) {
                                echo '<span class="tags-links"><i class="fas fa-tags"></i> ' . $tags_list . '</span>';
                            }
                            ?>
                            
                            <?php if (comments_open() || get_comments_number()) : ?>
                            <span class="comments-link">
                                <i class="far fa-comment"></i>
                                <?php comments_popup_link(
                                    __('Deixe um comentário', 'theme-espingardaria'),
                                    __('1 Comentário', 'theme-espingardaria'),
                                    __('% Comentários', 'theme-espingardaria')
                                ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
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

                    <footer class="entry-footer">
                        <?php
                        edit_post_link(
                            sprintf(
                                /* translators: %s: Name of current post */
                                esc_html__('Editar %s', 'theme-espingardaria'),
                                the_title('<span class="screen-reader-text">"', '"</span>', false)
                            ),
                            '<span class="edit-link">',
                            '</span>'
                        );
                        ?>
                    </footer>
                </article>

                <div class="post-navigation">
                    <div class="row">
                        <div class="col-6">
                            <?php previous_post_link('<div class="nav-previous">%link</div>', '<i class="fas fa-chevron-left"></i> %title'); ?>
                        </div>
                        <div class="col-6 text-end">
                            <?php next_post_link('<div class="nav-next">%link</div>', '%title <i class="fas fa-chevron-right"></i>'); ?>
                        </div>
                    </div>
                </div>

                <?php
                // Se os comentários estão abertos ou temos pelo menos um comentário, carregue o template de comentários
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

                <?php endwhile; ?>
            </div>
            
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
