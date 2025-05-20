<?php
/**
 * Template Name: Portfólio
 *
 * @package Theme_Espingardaria
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <?php the_title('<h1 class="page-title">', '</h1>'); ?>
            
            <?php if (get_the_content()) : ?>
                <div class="page-description">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        </header>
        
        <div class="portfolio-filters">
            <ul class="filter-list">
                <li class="active"><a href="#" data-filter="*"><?php esc_html_e('Todos', 'theme-espingardaria'); ?></a></li>
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'categoria-portfolio',
                    'hide_empty' => true,
                ));
                
                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $category) {
                        echo '<li><a href="#" data-filter=".' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</a></li>';
                    }
                }
                ?>
            </ul>
        </div>
        
        <div class="portfolio-grid">
            <div class="row">
                <?php
                $args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => -1,
                );
                
                $portfolio_query = new WP_Query($args);
                
                if ($portfolio_query->have_posts()) :
                    while ($portfolio_query->have_posts()) :
                        $portfolio_query->the_post();
                        
                        $categories = get_the_terms(get_the_ID(), 'categoria-portfolio');
                        $category_classes = '';
                        
                        if (!empty($categories) && !is_wp_error($categories)) {
                            foreach ($categories as $category) {
                                $category_classes .= ' ' . $category->slug;
                            }
                        }
                ?>
                <div class="col-md-6 col-lg-4 portfolio-item<?php echo esc_attr($category_classes); ?>">
                    <div class="portfolio-card">
                        <div class="portfolio-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('theme-espingardaria-portfolio', array('class' => 'img-fluid'));
                                } else {
                                    echo '<img src="' . esc_url(get_template_directory_uri() . '/images/placeholder.png') . '" alt="' . esc_attr(get_the_title()) . '" class="img-fluid">';
                                }
                                ?>
                            </a>
                            <div class="portfolio-overlay">
                                <div class="portfolio-actions">
                                    <a href="<?php the_permalink(); ?>" class="portfolio-link"><i class="fas fa-link"></i></a>
                                    <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" class="portfolio-zoom" data-fancybox="gallery"><i class="fas fa-search-plus"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-info">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            if (!empty($categories) && !is_wp_error($categories)) {
                                echo '<div class="portfolio-categories">';
                                $cat_names = array();
                                foreach ($categories as $category) {
                                    $cat_names[] = $category->name;
                                }
                                echo esc_html(implode(', ', $cat_names));
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <div class="col-12">
                    <p><?php esc_html_e('Nenhum item de portfólio encontrado.', 'theme-espingardaria'); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
