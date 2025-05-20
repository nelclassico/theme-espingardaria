<?php
/**
 * Template Name: Single Standard
 * Template Post Type: post
 *
 * Template para exibição de posts no estilo standard (sem sidebar)
 *
 * @package Theme_Espingardaria
 */

get_header();
?>

<main id="primary" class="site-main single-standard">
    <div class="container-fluid p-0">
        <?php while (have_posts()) : the_post(); ?>
            
            <div class="post-header">
                <div class="container">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="post-meta">
                        <span class="post-author">
                            <i class="fas fa-user"></i> <?php the_author(); ?>
                        </span>
                        <span class="post-date">
                            <i class="fas fa-calendar"></i> <?php echo get_the_date(); ?>
                        </span>
                        <?php if (get_comments_number() > 0) : ?>
                            <span class="post-comments">
                                <i class="fas fa-comments"></i> <?php echo get_comments_number(); ?> <?php esc_html_e('Comentários', 'theme-espingardaria'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-featured-image">
                    <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                </div>
            <?php endif; ?>

            <div class="container">
                <div class="post-content">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                        <div class="post-tags">
                            <?php the_tags('<span class="tags-title">' . esc_html__('Tags:', 'theme-espingardaria') . '</span> ', ', ', ''); ?>
                        </div>

                        <div class="post-share">
                            <span class="share-title"><?php esc_html_e('Compartilhar:', 'theme-espingardaria'); ?></span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </article>

                    <?php
                    // Autor do post
                    $author_id = get_the_author_meta('ID');
                    $author_avatar = get_avatar_url($author_id, array('size' => 100));
                    $author_name = get_the_author_meta('display_name');
                    $author_bio = get_the_author_meta('description');
                    ?>
                    <div class="post-author-box">
                        <div class="author-avatar">
                            <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>" class="rounded-circle">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name"><?php echo esc_html($author_name); ?></h4>
                            <?php if ($author_bio) : ?>
                                <p class="author-bio"><?php echo esc_html($author_bio); ?></p>
                            <?php endif; ?>
                            <div class="author-social">
                                <?php
                                $author_url = get_the_author_meta('user_url');
                                $author_facebook = get_the_author_meta('facebook');
                                $author_twitter = get_the_author_meta('twitter');
                                $author_instagram = get_the_author_meta('instagram');
                                ?>
                                <?php if ($author_url) : ?>
                                    <a href="<?php echo esc_url($author_url); ?>" target="_blank"><i class="fas fa-globe"></i></a>
                                <?php endif; ?>
                                <?php if ($author_facebook) : ?>
                                    <a href="<?php echo esc_url($author_facebook); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <?php endif; ?>
                                <?php if ($author_twitter) : ?>
                                    <a href="<?php echo esc_url($author_twitter); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                                <?php endif; ?>
                                <?php if ($author_instagram) : ?>
                                    <a href="<?php echo esc_url($author_instagram); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Posts relacionados
                    $categories = get_the_category();
                    if ($categories) {
                        $category_ids = array();
                        foreach ($categories as $category) {
                            $category_ids[] = $category->term_id;
                        }
                        
                        $related_args = array(
                            'post_type' => 'post',
                            'category__in' => $category_ids,
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 2,
                            'orderby' => 'rand'
                        );
                        
                        $related_query = new WP_Query($related_args);
                        
                        if ($related_query->have_posts()) :
                    ?>
                        <div class="related-posts">
                            <h3 class="related-title"><?php esc_html_e('Você também pode gostar', 'theme-espingardaria'); ?></h3>
                            <div class="row">
                                <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                    <div class="col-md-6">
                                        <div class="related-post">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <a href="<?php the_permalink(); ?>" class="related-thumb">
                                                    <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                                </a>
                                            <?php endif; ?>
                                            <div class="related-content">
                                                <h4 class="related-post-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                                <div class="related-post-meta">
                                                    <span class="related-post-category">
                                                        <?php
                                                        $categories = get_the_category();
                                                        if ($categories) {
                                                            echo esc_html($categories[0]->name);
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php
                        endif;
                        wp_reset_postdata();
                    }
                    ?>

                    <?php
                    // Se os comentários estão abertos ou temos pelo menos um comentário, carregue o template de comentários
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
