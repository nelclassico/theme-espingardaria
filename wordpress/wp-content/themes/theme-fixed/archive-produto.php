<?php
/**
 * Template para exibir arquivo de produtos
 *
 * @package Theme_Espingardaria
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('Produtos', 'theme-espingardaria'); ?></h1>
            
            <?php
            $term = get_queried_object();
            if ($term && isset($term->taxonomy) && $term->taxonomy === 'categoria-produto') {
                echo '<h2 class="category-title">' . esc_html($term->name) . '</h2>';
                
                if (!empty($term->description)) {
                    echo '<div class="category-description">' . wp_kses_post($term->description) . '</div>';
                }
            }
            ?>
        </header>
        
        <div class="row">
            <div class="col-lg-3">
                <div class="product-filters">
                    <div class="filter-header">
                        <h3><?php esc_html_e('Filtros', 'theme-espingardaria'); ?></h3>
                        <button class="filter-close d-lg-none"><i class="fas fa-times"></i></button>
                    </div>
                    
                    <div class="filter-section">
                        <h4><?php esc_html_e('Categorias', 'theme-espingardaria'); ?></h4>
                        <ul class="filter-list">
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'categoria-produto',
                                'hide_empty' => true,
                            ));
                            
                            if (!empty($categories) && !is_wp_error($categories)) {
                                foreach ($categories as $category) {
                                    echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    
                    <div class="filter-section">
                        <h4><?php esc_html_e('Marcas', 'theme-espingardaria'); ?></h4>
                        <ul class="filter-list">
                            <?php
                            $brands = get_terms(array(
                                'taxonomy' => 'marca',
                                'hide_empty' => true,
                            ));
                            
                            if (!empty($brands) && !is_wp_error($brands)) {
                                foreach ($brands as $brand) {
                                    echo '<li><a href="' . esc_url(get_term_link($brand)) . '">' . esc_html($brand->name) . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    
                    <div class="filter-section">
                        <h4><?php esc_html_e('Calibres', 'theme-espingardaria'); ?></h4>
                        <ul class="filter-list">
                            <?php
                            $calibers = get_terms(array(
                                'taxonomy' => 'calibre',
                                'hide_empty' => true,
                            ));
                            
                            if (!empty($calibers) && !is_wp_error($calibers)) {
                                foreach ($calibers as $caliber) {
                                    echo '<li><a href="' . esc_url(get_term_link($caliber)) . '">' . esc_html($caliber->name) . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="products-header">
                    <div class="products-count">
                        <?php
                        $total = $wp_query->found_posts;
                        printf(
                            /* translators: %d: number of products */
                            _n('%d produto encontrado', '%d produtos encontrados', $total, 'theme-espingardaria'),
                            $total
                        );
                        ?>
                    </div>
                    
                    <div class="products-sort">
                        <form class="woocommerce-ordering" method="get">
                            <select name="orderby" class="orderby">
                                <option value="date" <?php selected('date', isset($_GET['orderby']) ? $_GET['orderby'] : ''); ?>><?php esc_html_e('Mais recentes', 'theme-espingardaria'); ?></option>
                                <option value="price" <?php selected('price', isset($_GET['orderby']) ? $_GET['orderby'] : ''); ?>><?php esc_html_e('Preço: menor para maior', 'theme-espingardaria'); ?></option>
                                <option value="price-desc" <?php selected('price-desc', isset($_GET['orderby']) ? $_GET['orderby'] : ''); ?>><?php esc_html_e('Preço: maior para menor', 'theme-espingardaria'); ?></option>
                                <option value="title" <?php selected('title', isset($_GET['orderby']) ? $_GET['orderby'] : ''); ?>><?php esc_html_e('Nome: A-Z', 'theme-espingardaria'); ?></option>
                                <option value="title-desc" <?php selected('title-desc', isset($_GET['orderby']) ? $_GET['orderby'] : ''); ?>><?php esc_html_e('Nome: Z-A', 'theme-espingardaria'); ?></option>
                            </select>
                            <?php
                            // Mantém os parâmetros de consulta existentes
                            foreach ($_GET as $key => $value) {
                                if ('orderby' !== $key && 'submit' !== $key && 'paged' !== $key) {
                                    echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" />';
                                }
                            }
                            ?>
                        </form>
                    </div>
                    
                    <button class="filter-toggle d-lg-none">
                        <i class="fas fa-filter"></i> <?php esc_html_e('Filtros', 'theme-espingardaria'); ?>
                    </button>
                </div>
                
                <?php if (have_posts()) : ?>
                    <div class="row products-grid">
                        <?php
                        while (have_posts()) :
                            the_post();
                            $product_id = get_the_ID();
                            $price = get_post_meta($product_id, '_preco', true);
                            $regular_price = get_post_meta($product_id, '_preco_regular', true);
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="product-card">
                                <div class="product-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('theme-espingardaria-product', array('class' => 'img-fluid'));
                                        } else {
                                            echo '<img src="' . esc_url(get_template_directory_uri() . '/images/placeholder.png') . '" alt="' . esc_attr(get_the_title()) . '" class="img-fluid">';
                                        }
                                        ?>
                                    </a>
                                    <?php if (!empty($regular_price) && !empty($price)) : ?>
                                    <div class="product-badge">
                                        <?php
                                        $discount = (floatval($regular_price) - floatval($price)) / floatval($regular_price) * 100;
                                        echo '<span class="badge bg-danger">' . round($discount) . '% OFF</span>';
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="product-info">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="product-meta">
                                        <?php
                                        $marca = get_the_terms($product_id, 'marca');
                                        if ($marca && !is_wp_error($marca)) {
                                            echo '<span class="product-brand">' . esc_html($marca[0]->name) . '</span>';
                                        }
                                        
                                        $calibre = get_the_terms($product_id, 'calibre');
                                        if ($calibre && !is_wp_error($calibre)) {
                                            echo '<span class="product-caliber">' . esc_html($calibre[0]->name) . '</span>';
                                        }
                                        ?>
                                    </div>
                                    <div class="product-price">
                                        <?php if (!empty($regular_price) && !empty($price)) : ?>
                                        <span class="regular-price"><?php echo 'R$ ' . esc_html($regular_price); ?></span>
                                        <span class="sale-price"><?php echo 'R$ ' . esc_html($price); ?></span>
                                        <?php elseif (!empty($price)) : ?>
                                        <span class="price"><?php echo 'R$ ' . esc_html($price); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span class="rating-count">(4.5)</span>
                                    </div>
                                    <div class="product-actions">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e('Ver Detalhes', 'theme-espingardaria'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <div class="pagination-wrapper">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '<i class="fas fa-chevron-left"></i>',
                            'next_text' => '<i class="fas fa-chevron-right"></i>',
                        ));
                        ?>
                    </div>
                <?php else : ?>
                    <div class="no-products">
                        <p><?php esc_html_e('Nenhum produto encontrado.', 'theme-espingardaria'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
