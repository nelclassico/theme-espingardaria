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
            if ($term instanceof WP_Term && in_array($term->taxonomy, ['categoria-produto', 'marca', 'calibre', 'comprimento_cano', 'modalidades'])) {
                $taxonomy_label = '';
                switch ($term->taxonomy) {
                    case 'categoria-produto':
                        $taxonomy_label = esc_html__('Categoria', 'theme-espingardaria');
                        break;
                    case 'marca':
                        $taxonomy_label = esc_html__('Marca', 'theme-espingardaria');
                        break;
                    case 'calibre':
                        $taxonomy_label = esc_html__('Calibre', 'theme-espingardaria');
                        break;
                    case 'comprimento_cano':
                        $taxonomy_label = esc_html__('Comprimento do Cano', 'theme-espingardaria');
                        break;
                    case 'modalidades':
                        $taxonomy_label = esc_html__('Modalidade', 'theme-espingardaria');
                        break;
                }
                echo '<h2 class="category-title">' . esc_html($taxonomy_label . ': ' . $term->name) . '</h2>';

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

                    <!-- Filtro de Categorias (Dropdown) -->
                    <div class="filter-section">
                        <h4><?php esc_html_e('Categorias', 'theme-espingardaria'); ?></h4>
                        <select class="filter-dropdown" onchange="if(this.value) window.location.href=this.value;">
                            <option value=""><?php esc_html_e('Selecione uma categoria', 'theme-espingardaria'); ?></option>
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'categoria-produto',
                                'hide_empty' => true,
                            ));

                            $term = get_queried_object();
                            if (!empty($categories) && !is_wp_error($categories)) {
                                foreach ($categories as $category) {
                                    $selected = ($term instanceof WP_Term && $term->taxonomy === 'categoria-produto' && $term->term_id === $category->term_id) ? 'selected' : '';
                                    echo '<option value="' . esc_url(get_term_link($category)) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Filtro de Marcas (Botões Visuais, como Calibres) -->
                    <div class="filter-section">
                        <h4><?php esc_html_e('Marcas', 'theme-espingardaria'); ?></h4>
                        <div class="filter-buttons">
                            <?php
                            $brands = get_terms(array(
                                'taxonomy' => 'marca',
                                'hide_empty' => true,
                            ));

                            if (!empty($brands) && !is_wp_error($brands)) {
                                foreach ($brands as $brand) {
                                    $active_class = ($term instanceof WP_Term && $term->taxonomy === 'marca' && $term->term_id === $brand->term_id) ? 'active' : '';
                                    echo '<a href="' . esc_url(get_term_link($brand)) . '" class="btn btn-outline-secondary btn-sm ' . esc_attr($active_class) . '">' . esc_html($brand->name) . '</a> ';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Filtro de Calibres (Botões Visuais) -->
                    <div class="filter-section">
                        <h4><?php esc_html_e('Calibres', 'theme-espingardaria'); ?></h4>
                        <div class="filter-buttons">
                            <?php
                            $calibers = get_terms(array(
                                'taxonomy' => 'calibre',
                                'hide_empty' => true,
                            ));

                            if (!empty($calibers) && !is_wp_error($calibers)) {
                                foreach ($calibers as $caliber) {
                                    $active_class = ($term instanceof WP_Term && $term->taxonomy === 'calibre' && $term->term_id === $caliber->term_id) ? 'active' : '';
                                    echo '<a href="' . esc_url(get_term_link($caliber)) . '" class="btn btn-outline-secondary btn-sm ' . esc_attr($active_class) . '">' . esc_html($caliber->name) . '</a> ';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Filtro de Comprimento do Cano (Lista Padrão) -->
                    <div class="filter-section">
                        <h4><?php esc_html_e('Comprimento do Cano', 'theme-espingardaria'); ?></h4>
                        <ul class="filter-list">
                            <?php
                            $canos = get_terms(array(
                                'taxonomy' => 'comprimento_cano',
                                'hide_empty' => true,
                            ));

                            if (!empty($canos) && !is_wp_error($canos)) {
                                foreach ($canos as $cano) {
                                    $active_class = ($term instanceof WP_Term && $term->taxonomy === 'comprimento_cano' && $term->term_id === $cano->term_id) ? 'active' : '';
                                    echo '<li><a href="' . esc_url(get_term_link($cano)) . '" class="' . esc_attr($active_class) . '">' . esc_html($cano->name) . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Filtro de Modalidades (Dropdown) -->
                    <div class="filter-section">
                        <h4><?php esc_html_e('Modalidades', 'theme-espingardaria'); ?></h4>
                        <select class="filter-dropdown" onchange="if(this.value) window.location.href=this.value;">
                            <option value=""><?php esc_html_e('Selecione uma modalidade', 'theme-espingardaria'); ?></option>
                            <?php
                            $modalidades = get_terms(array(
                                'taxonomy' => 'modalidades',
                                'hide_empty' => true,
                            ));

                            if (!empty($modalidades) && !is_wp_error($modalidades)) {
                                foreach ($modalidades as $modalidade) {
                                    $selected = ($term instanceof WP_Term && $term->taxonomy === 'modalidades' && $term->term_id === $modalidade->term_id) ? 'selected' : '';
                                    echo '<option value="' . esc_url(get_term_link($modalidade)) . '" ' . $selected . '>' . esc_html($modalidade->name) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="products-header">
                    <div class="products-count">
                        <?php
                        // Define a query personalizada para contar os produtos corretamente
                        $args_count = array(
                            'post_type' => 'produto',
                            'posts_per_page' => -1, // Pega todos os posts para contar
                        );

                        $tax_query = array('relation' => 'AND');
                        $term = get_queried_object();

                        if ($term instanceof WP_Term && in_array($term->taxonomy, ['categoria-produto', 'marca', 'calibre', 'comprimento_cano', 'modalidades'])) {
                            $tax_query[] = array(
                                'taxonomy' => $term->taxonomy,
                                'field' => 'term_id',
                                'terms' => $term->term_id,
                            );
                        }

                        if (!empty($tax_query) && count($tax_query) > 1) {
                            $args_count['tax_query'] = $tax_query;
                        }

                        $count_query = new WP_Query($args_count);
                        $total = $count_query->found_posts;

                        printf(
                            /* translators: %d: number of products */
                            _n('%d produto encontrado', '%d produtos encontrados', $total, 'theme-espingardaria'),
                            $total
                        );
                        wp_reset_postdata(); // Reseta a query de contagem
                        ?>
                    </div>

                    <div class="products-sort">
                        <form class="woocommerce-ordering" method="get">
                            <select name="orderby" class="orderby" onchange="this.form.submit()">
                                <option value="date" <?php selected('date', isset($_GET['orderby']) ? $_GET['orderby'] : 'date'); ?>><?php esc_html_e('Mais recentes', 'theme-espingardaria'); ?></option>
                                <option value="price" <?php selected('price', isset($_GET['orderby']) ? $_GET['orderby'] : ''); ?>><?php esc_html_e('Preço: menor para maior', 'theme-espingardaria'); ?></option>
                                <option value="price-desc" <?php selected('price-desc', isset($_GET['orderby']) ? $_GET['orderby'] : ''); ?>><?php esc_html_e('Preço: maior para menor', 'theme-espingardaria'); ?></option>
                                <option value="title" <?php selected('title', isset($_GET['orderby']) ? $_GET['orderby'] : ''); ?>><?php esc_html_e('Nome: A-Z', 'theme-espingardaria'); ?></option>
                                <option value="title-desc" <?php selected('title-desc', isset($_GET['orderby']) ? $_GET['orderby'] : ''); ?>><?php esc_html_e('Nome: Z-A', 'theme-espingardaria'); ?></option>
                            </select>
                            <?php
                            foreach ($_GET as $key => $value) {
                                if ('orderby' !== $key && 'submit' !== $key && 'paged' !== $key) {
                                    if (is_array($value)) {
                                        foreach ($value as $val) {
                                            echo '<input type="hidden" name="' . esc_attr($key) . '[]" value="' . esc_attr($val) . '" />';
                                        }
                                    } else {
                                        echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" />';
                                    }
                                }
                            }
                            ?>
                        </form>
                    </div>

                    <button class="filter-toggle d-lg-none">
                        <i class="fas fa-filter"></i> <?php esc_html_e('Filtros', 'theme-espingardaria'); ?>
                    </button>
                </div>

                <?php
                $args = array(
                    'post_type' => 'produto',
                    'posts_per_page' => get_option('posts_per_page'),
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                );

                $tax_query = array('relation' => 'AND');
                $term = get_queried_object();

                if ($term instanceof WP_Term && in_array($term->taxonomy, ['categoria-produto', 'marca', 'calibre', 'comprimento_cano', 'modalidades'])) {
                    $tax_query[] = array(
                        'taxonomy' => $term->taxonomy,
                        'field' => 'term_id',
                        'terms' => $term->term_id,
                    );
                }

                if (!empty($tax_query) && count($tax_query) > 1) {
                    $args['tax_query'] = $tax_query;
                }

                // Aplica ordenação
                $orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'date';
                switch ($orderby) {
                    case 'price':
                        $args['meta_key'] = '_preco';
                        $args['orderby'] = 'meta_value_num';
                        $args['order'] = 'ASC';
                        break;
                    case 'price-desc':
                        $args['meta_key'] = '_preco';
                        $args['orderby'] = 'meta_value_num';
                        $args['order'] = 'DESC';
                        break;
                    case 'title':
                        $args['orderby'] = 'title';
                        $args['order'] = 'ASC';
                        break;
                    case 'title-desc':
                        $args['orderby'] = 'title';
                        $args['order'] = 'DESC';
                        break;
                    default:
                        $args['orderby'] = 'date';
                        $args['order'] = 'DESC';
                        break;
                }

                $custom_query = new WP_Query($args);

                if ($custom_query->have_posts()) {
                    $wp_query = $custom_query;
                }
                ?>

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
                            <a href="<?php the_permalink(); ?>" class="nav-link">
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
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="product-price">
                                            <?php if (!empty($regular_price) && !empty($price)) : ?>
                                            <span class="regular-price"><?php echo 'R$ ' . esc_html($regular_price); ?></span>
                                            <span class="sale-price"><?php echo 'R$ ' . esc_html($price); ?></span>
                                            <?php elseif (!empty($price)) : ?>
                                            <span class="price"><?php echo 'R$ ' . esc_html($price); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <!--<div class="product-rating">
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            <span class="rating-count">(4.5)</span>
                                        </div>-->
                                    </div>
                                    <!--<div class="product-actions">                                        
                                    </div>-->
                                </div>
                            </div>
                            </a>
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
wp_reset_postdata();
get_footer();
?>