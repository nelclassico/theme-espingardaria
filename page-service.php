<?php
/**
 * Template Name: Serviços
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
        
        <div class="services-grid">
            <div class="row">
                <?php
                $args = array(
                    'post_type' => 'servico',
                    'posts_per_page' => -1,
                );
                
                $services_query = new WP_Query($args);
                
                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) :
                        $services_query->the_post();
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <?php
                            $icon = get_post_meta(get_the_ID(), '_icone_servico', true);
                            if (!empty($icon)) {
                                echo '<i class="' . esc_attr($icon) . '"></i>';
                            } else {
                                echo '<i class="fas fa-tools"></i>';
                            }
                            ?>
                        </div>
                        <div class="service-info">
                            <h3><?php the_title(); ?></h3>
                            <div class="service-description">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary"><?php esc_html_e('Saiba Mais', 'theme-espingardaria'); ?></a>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <div class="col-12">
                    <p><?php esc_html_e('Nenhum serviço encontrado.', 'theme-espingardaria'); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
