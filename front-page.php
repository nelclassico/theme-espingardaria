<?php
/**
 * Template para a página inicial
 *
 * @package Theme_Espingardaria
 */

get_header();
$options = theme_espingardaria_get_options();
?>

<main id="primary" class="site-main">
    <?php if ($options['show_banner'] && !empty($options['slider'])) : ?>
        <section class="banner-section">
            <div id="mainSlider" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $first = true;
                    foreach ($options['slider'] as $slide) :
                        $active = $first ? ' active' : '';
                        $first = false;
                    ?>
                    <div class="carousel-item<?php echo esc_attr($active); ?>">
                        <?php if (!empty($slide['image'])) : ?>
                        <img src="<?php echo esc_url($slide['image']); ?>" class="d-block w-100 banner-bg" alt="<?php echo esc_attr($slide['title']); ?>">
                        <?php endif; ?>
                        <div class="carousel-caption d-flex align-items-center">
                            <div class="container">
                                <div class="row align-items-center">
                                    <?php if (!empty($slide['image_product_left'])) : ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo esc_url($slide['image_product_left']); ?>" class="product-image" alt="Produto Esquerdo">
                                        </div>
                                        <div class="col-md-6 text-start">
                                            <?php if (!empty($slide['title'])) : ?>
                                            <h1><?php echo esc_html($slide['title']); ?></h1>
                                            <?php endif; ?>
                                            <?php if (!empty($slide['subtitle'])) : ?>
                                            <p class="subtitle"><?php echo esc_html($slide['subtitle']); ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($slide['price'])) : ?>
                                            <div class="price"><?php echo esc_html($slide['price']); ?></div>
                                            <?php endif; ?>
                                            <div class="button-group">
                                                <?php if (!empty($slide['button_text']) && !empty($slide['button_url'])) : ?>
                                                <a href="<?php echo esc_url($slide['button_url']); ?>" class="btn btn-primary"><?php echo esc_html($slide['button_text']); ?></a>
                                                <?php endif; ?>
                                                <?php if (!empty($slide['secondary_button_text']) && !empty($slide['secondary_button_url'])) : ?>
                                                <a href="<?php echo esc_url($slide['secondary_button_url']); ?>" class="btn btn-secondary"><?php echo esc_html($slide['secondary_button_text']); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php elseif (!empty($slide['image_product_right'])) : ?>
                                        <div class="col-md-6 text-end">
                                            <?php if (!empty($slide['title'])) : ?>
                                            <h1><?php echo esc_html($slide['title']); ?></h1>
                                            <?php endif; ?>
                                            <?php if (!empty($slide['subtitle'])) : ?>
                                            <p class="subtitle"><?php echo esc_html($slide['subtitle']); ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($slide['price'])) : ?>
                                            <div class="price"><?php echo esc_html($slide['price']); ?></div>
                                            <?php endif; ?>
                                            <div class="button-group">
                                                <?php if (!empty($slide['button_text']) && !empty($slide['button_url'])) : ?>
                                                <a href="<?php echo esc_url($slide['button_url']); ?>" class="btn btn-primary"><?php echo esc_html($slide['button_text']); ?></a>
                                                <?php endif; ?>
                                                <?php if (!empty($slide['secondary_button_text']) && !empty($slide['secondary_button_url'])) : ?>
                                                <a href="<?php echo esc_url($slide['secondary_button_url']); ?>" class="btn btn-secondary"><?php echo esc_html($slide['secondary_button_text']); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="<?php echo esc_url($slide['image_product_right']); ?>" class="product-image" alt="Produto Direito">
                                        </div>
                                    <?php else : ?>
                                        <div class="col-12 text-center">
                                            <?php if (!empty($slide['title'])) : ?>
                                            <h1><?php echo esc_html($slide['title']); ?></h1>
                                            <?php endif; ?>
                                            <?php if (!empty($slide['subtitle'])) : ?>
                                            <p class="subtitle"><?php echo esc_html($slide['subtitle']); ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($slide['price'])) : ?>
                                            <div class="price"><?php echo esc_html($slide['price']); ?></div>
                                            <?php endif; ?>
                                            <div class="button-group">
                                                <?php if (!empty($slide['button_text']) && !empty($slide['button_url'])) : ?>
                                                <a href="<?php echo esc_url($slide['button_url']); ?>" class="btn btn-primary"><?php echo esc_html($slide['button_text']); ?></a>
                                                <?php endif; ?>
                                                <?php if (!empty($slide['secondary_button_text']) && !empty($slide['secondary_button_url'])) : ?>
                                                <a href="<?php echo esc_url($slide['secondary_button_url']); ?>" class="btn btn-secondary"><?php echo esc_html($slide['secondary_button_text']); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php esc_html_e('Anterior', 'theme-espingardaria'); ?></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php esc_html_e('Próximo', 'theme-espingardaria'); ?></span>
                </button>
            </div>
        </section>
    <?php endif; ?>


    
       <section class="sections-banners bg-dark mt-0 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                     <?php if ($options['show_ammo']) : ?>
                        <section class="ammo-section img aos-init aos-animate" <?php if (!empty($options['ammo_image'])) : ?>style="background-image: url('<?php echo esc_url($options['ammo_image']); ?>');"<?php endif; ?> data-aos="fade-left" data-aos-duration="700">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="ammo-content">
                                            <h2><?php echo esc_html($options['ammo_title'] ?: __('Munições de Qualidade', 'theme-espingardaria')); ?></h2>
                                            <?php if (!empty($options['ammo_text'])) : ?>
                                            <div class="ammo-text"><?php echo wp_kses_post($options['ammo_text']); ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($options['ammo_button_text']) && !empty($options['ammo_button_url'])) : ?>
                                            <a href="<?php echo esc_url($options['ammo_button_url']); ?>" class="btn btn-primary"><?php echo esc_html($options['ammo_button_text']); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-6">
                    <?php if ($options['show_training']) : ?>
                    <section class="training-section aos-init aos-animate" <?php if (!empty($options['training_image'])) : ?>style="background-image: url('<?php echo esc_url($options['training_image']); ?>');"<?php endif; ?> data-aos="fade-right" data-aos-duration="700">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="training-content">
                                        <h2><?php echo esc_html($options['training_title'] ?: __('Treinamento de Tiro', 'theme-espingardaria')); ?></h2>
                                        <?php if (!empty($options['training_text'])) : ?>
                                        <div class="training-text"><?php echo wp_kses_post($options['training_text']); ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($options['training_button_text']) && !empty($options['training_button_url'])) : ?>
                                        <a href="<?php echo esc_url($options['training_button_url']); ?>" class="btn btn-primary"><?php echo esc_html($options['training_button_text']); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>


    <?php if ($options['show_categories']) :
        $categories = !empty($options['selected_categories'])
            ? get_terms(array('taxonomy' => 'categoria-produto', 'include' => $options['selected_categories'], 'hide_empty' => false))
            : get_terms(array('taxonomy' => 'categoria-produto', 'hide_empty' => false, 'number' => 4));
        if (!empty($categories) && !is_wp_error($categories)) :
    ?>
    <section class="categories-section aos-init aos-animate" data-aos="fade-up" data-aos-duration="700">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($options['categories_title'] ?: __('Categorias', 'theme-espingardaria')); ?></h2>
            <div class="row">
                <?php foreach ($categories as $category) : ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="category-item">
                        <a href="<?php echo esc_url(get_term_link($category)); ?>">
                            <?php
                            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                            if ($thumbnail_id) {
                                echo wp_get_attachment_image($thumbnail_id, 'thumbnail', false, array('class' => 'img-fluid'));
                            } else {
                                echo '<img src="' . esc_url(get_template_directory_uri() . '/images/placeholder.png') . '" alt="' . esc_attr($category->name) . '" class="img-fluid">';
                            }
                            ?>
                            <h3><?php echo esc_html($category->name); ?></h3>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; endif; ?>


        <?php if ($options['show_new_products']) :
        $new_args = array(
            'post_type' => 'produto',
            'posts_per_page' => intval($options['new_products_count']),
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $new_query = new WP_Query($new_args);
        if ($new_query->have_posts()) :
    ?>
    <section class="new-products-section" data-aos="fade-down" data-aos-duration="700">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($options['new_products_title'] ?: __('Novos Produtos', 'theme-espingardaria')); ?></h2>
            <div class="row">
                <?php while ($new_query->have_posts()) : $new_query->the_post();
                    $product_id = get_the_ID();
                    $price = get_post_meta($product_id, '_preco', true);
                    $regular_price = get_post_meta($product_id, '_preco_regular', true);
                ?>
                <div class="col-md-6 col-lg-3">
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
                            <div class="product-badge">
                                <span class="badge bg-success"><?php esc_html_e('Novo', 'theme-espingardaria'); ?></span>
                            </div>
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
                                <?php if ($regular_price && $price) : ?>
                                <span class="regular-price"><?php echo 'R$ ' . esc_html($regular_price); ?></span>
                                <span class="sale-price"><?php echo 'R$ ' . esc_html($price); ?></span>
                                <?php elseif ($price) : ?>
                                <span class="price"><?php echo 'R$ ' . esc_html($price); ?></span>
                                <?php endif; ?>
                            </div>                            
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; endif; ?>



    <?php if ($options['show_featured_products']) :
        $featured_args = array(
            'post_type' => 'produto',
            'posts_per_page' => intval($options['featured_products_count']),
        );
        if (!empty($options['featured_products_category'])) {
            $featured_args['tax_query'] = array(
                array(
                    'taxonomy' => 'categoria-produto',
                    'field' => 'term_id',
                    'terms' => intval($options['featured_products_category']),
                ),
            );
        }
        $featured_query = new WP_Query($featured_args);
        if ($featured_query->have_posts()) :
    ?>
    <section class="featured-products-section" data-aos="fade-donw" data-aos-duration="700">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($options['featured_products_title'] ?: __('Produtos em Destaque', 'theme-espingardaria')); ?></h2>
            <div class="row">
                <?php while ($featured_query->have_posts()) : $featured_query->the_post();
                    $product_id = get_the_ID();
                    $price = get_post_meta($product_id, '_preco', true);
                    $regular_price = get_post_meta($product_id, '_preco_regular', true);
                ?>
                <div class="col-md-6 col-lg-3">
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
                            <?php if ($regular_price && $price) : ?>
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
                                <?php if ($regular_price && $price) : ?>
                                <span class="regular-price"><?php echo 'R$ ' . esc_html($regular_price); ?></span>
                                <span class="sale-price"><?php echo 'R$ ' . esc_html($price); ?></span>
                                <?php elseif ($price) : ?>
                                <span class="price"><?php echo 'R$ ' . esc_html($price); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="rating-count">(4.5)</span>
                            </div>
                            <div class="product-actions">
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e('Ver Detalhes', 'theme-espingardaria'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; endif; ?>   



    <section class="sections-banners mt-0 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6" data-aos="fade-right" data-aos-duration="700">
                     <?php if ($options['show_destaque_1']) : ?>
                        <section class="destaque_1-section" <?php if (!empty($options['destaque_1_image'])) : ?>style="background-image: linear-gradient(90deg, rgb(0 0 0) 0%, rgb(48 48 48 / 81%) 40%, rgba(255, 255, 255, 0) 100%),  url('<?php echo esc_url($options['destaque_1_image']); ?>');"<?php endif; ?>>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="destaque_1-content">
                                            <h2><?php echo esc_html($options['destaque_1_title'] ?: __('Munições de Qualidade', 'theme-espingardaria')); ?></h2>
                                            <?php if (!empty($options['destaque_1_text'])) : ?>
                                            <div class="destaque_1-text"><?php echo wp_kses_post($options['destaque_1_text']); ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($options['destaque_1_button_text']) && !empty($options['destaque_1_button_url'])) : ?>
                                            <a href="<?php echo esc_url($options['destaque_1_button_url']); ?>" class="btn btn-primary"><?php echo esc_html($options['destaque_1_button_text']); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-6" data-aos="fade-left" data-aos-duration="700">
                    <?php if ($options['show_destaque_2']) : ?>
                    <section class="destaque_2-section" <?php if (!empty($options['destaque_2_image'])) : ?>style="background-image: linear-gradient(90deg, rgb(0 0 0) 0%, rgb(48 48 48 / 81%) 40%, rgba(255, 255, 255, 0) 100%),  url('<?php echo esc_url($options['destaque_2_image']); ?>');"<?php endif; ?>>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="destaque_2-content">
                                        <h2><?php echo esc_html($options['destaque_2_title'] ?: __('Treinamento de Tiro', 'theme-espingardaria')); ?></h2>
                                        <?php if (!empty($options['destaque_1_text'])) : ?>
                                        <div class="destaque_2-text"><?php echo wp_kses_post($options['destaque_2_text']); ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($options['destaque_2_button_text']) && !empty($options['destaque_2_button_url'])) : ?>
                                        <a href="<?php echo esc_url($options['destaque_2_button_url']); ?>" class="btn btn-primary"><?php echo esc_html($options['destaque_2_button_text']); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

 

    <?php if ($options['show_shop_anywhere'] && !empty($options['shop_anywhere_items'])) : ?>
    <section class="shop-anywhere-section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($options['shop_anywhere_title'] ?: __('Compre em Qualquer Lugar', 'theme-espingardaria')); ?></h2>
            <div class="row">
                <?php
                // Obter o último item e os 4 anteriores
                $items = $options['shop_anywhere_items'];
                $total_items = count($items);
                $last_item = array_pop($items);
                $previous_items = array_slice($items, max(0, $total_items - 5), 4);
                ?>

                <!-- Último item (destaque à esquerda) -->
                <div class="col-12 col-md-6" data-aos="fade-left" data-aos-duration="700">
                    <div class="shop-anywhere-item shop-anywhere-featured">
                        <a href="<?php echo esc_url($last_item['url']); ?>">
                            <?php if (!empty($last_item['image'])) : ?>
                            <img src="<?php echo esc_url($last_item['image']); ?>" alt="<?php echo esc_attr($last_item['title']); ?>" class="img-fluid">
                            <?php endif; ?>
                            <?php if (!empty($last_item['title'])) : ?>
                                <h3><?php echo esc_html($last_item['title']); ?></h3>
                            <?php endif; ?>                            
                        </a>
                    </div>
                </div>

                <!-- Grade 2x2 com os 4 itens anteriores -->
                <div class="col-12 col-md-6" data-aos="fade-right" data-aos-duration="700">
                    <div class="row">
                        <?php foreach ($previous_items as $item) : ?>
                        <div class="col-md-6">
                            <div class="shop-anywhere-item">
                                <a href="<?php echo esc_url($item['url']); ?>">
                                    <?php if (!empty($item['image'])) : ?>
                                    <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="img-fluid">
                                    <?php endif; ?>
                                    <?php if (!empty($item['title'])) : ?>
                                        <h3><?php echo esc_html($item['title']); ?></h3>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

   

    <?php if ($options['show_reviews'] && !empty($options['reviews'])) : ?>
    <section class="reviews-section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($options['reviews_title'] ?: __('O Que Nossos Clientes Dizem', 'theme-espingardaria')); ?></h2>
            <div class="row">
                <?php foreach ($options['reviews'] as $review) : ?>
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-rating">
                            <?php
                            $rating = isset($review['rating']) ? intval($review['rating']) : 5;
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                            }
                            ?>
                        </div>
                        <div class="review-text"><?php echo wp_kses_post($review['text']); ?></div>
                        <div class="review-author">
                            <?php if (!empty($review['image'])) : ?>
                            <div class="review-author-image">
                                <img src="<?php echo esc_url($review['image']); ?>" alt="<?php echo esc_attr($review['author']); ?>" class="img-fluid rounded-circle">
                            </div>
                            <?php endif; ?>
                            <div class="review-author-name"><?php echo esc_html($review['author']); ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>



    <?php if ($options['show_blog']) :
        $blog_args = array(
            'post_type' => 'post',
            'posts_per_page' => intval($options['blog_count']),
        );
        $blog_query = new WP_Query($blog_args);
        if ($blog_query->have_posts()) :
    ?>
    <section class="blog-section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($options['blog_title'] ?: __('Blog e Notícias', 'theme-espingardaria')); ?></h2>
            <div class="row">
                <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="blog-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('theme-espingardaria-blog', array('class' => 'img-fluid'));
                                } else {
                                    echo '<img src="' . esc_url(get_template_directory_uri() . '/images/placeholder.png') . '" alt="' . esc_attr(get_the_title()) . '" class="img-fluid">';
                                }
                                ?>
                            </a>
                        </div>
                        <div class="blog-info">
                            <div class="blog-meta">
                                <span class="blog-date"><?php echo get_the_date(); ?></span>
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo '<span class="blog-category">' . esc_html($categories[0]->name) . '</span>';
                                }
                                ?>
                            </div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="blog-excerpt"><?php the_excerpt(); ?></div>
                            <div class="blog-actions">
                                <a href="<?php the_permalink(); ?>" class="btn btn-link"><?php esc_html_e('Leia Mais', 'theme-espingardaria'); ?> <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; endif; ?>

    <?php if ($options['show_about']) : ?>
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <?php if (!empty($options['about_image'])) : ?>
                    <div class="about-image">
                        <img src="<?php echo esc_url($options['about_image']); ?>" alt="<?php echo esc_attr($options['about_title']); ?>" class="img-fluid">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <div class="about-content">
                        <h2><?php echo esc_html($options['about_title'] ?: __('Sobre Nós', 'theme-espingardaria')); ?></h2>
                        <?php if (!empty($options['about_text'])) : ?>
                        <div class="about-text"><?php echo wp_kses_post($options['about_text']); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php
// Seção Galeria de Imagens
if ($options['show_image_gallery'] && !empty($options['image_gallery_images'])) : ?>
    <section class="image-gallery-section" aria-label="<?php echo esc_attr__('Galeria de Imagens', 'theme-espingardaria'); ?>">
        <div class="container-fluid m-0 p-0">            
            <div id="imageGalleryCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-aos="fade-up" data-aos-duration="700">
                <div class="carousel-inner">
                    <?php
                    $image_count = 0;
                    $total_images = count($options['image_gallery_images']);
                    $images = $options['image_gallery_images'];

                    // Agrupar todas as imagens em um único carousel-item para simular o comportamento
                    for ($i = 0; $i < $total_images; $i++) :
                        if ($i % $total_images === 0) : // Agrupar todas as imagens em um único item
                            if ($i > 0) echo '</div>'; // Fecha o carousel-item anterior, se houver
                            echo '<div class="carousel-item' . ($i === 0 ? ' active' : '') . '">';
                        endif;
                    ?>
                        <div class="gallery-item col-6 col-md-2" >
                            <figure>
                                <img 
                                    src="<?php echo esc_url($images[$i]); ?>" 
                                    alt="<?php echo esc_attr($options['image_gallery_title'] . ' - Imagem ' . ($i + 1)); ?>" 
                                    class="img-fluid"
                                    loading="lazy" >
                                <figcaption class="sr-only">
                                    <?php echo esc_html__('Imagem', 'theme-espingardaria') . ' ' . ($i + 1) . ' ' . esc_html__('da galeria', 'theme-espingardaria'); ?>
                                </figcaption>
                            </figure>
                        </div>
                    <?php
                        $image_count++;
                    endfor;
                    if ($total_images > 0) echo '</div>'; // Fecha o último carousel-item
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#imageGalleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php esc_html_e('Anterior', 'theme-espingardaria'); ?></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#imageGalleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php esc_html_e('Próximo', 'theme-espingardaria'); ?></span>
                </button>
            </div>
        </div>
    </section>
<?php endif; ?>


</main>

<?php get_footer(); ?>