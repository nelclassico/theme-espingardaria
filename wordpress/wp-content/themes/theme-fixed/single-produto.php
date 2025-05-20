<?php
/**
 * Template para exibir produtos individuais
 *
 * @package Theme_Espingardaria
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="product-single">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-gallery">
                        <div class="product-gallery-main">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('large', array('class' => 'img-fluid'));
                            } else {
                                echo '<img src="' . esc_url(get_template_directory_uri() . '/images/placeholder.png') . '" alt="' . esc_attr(get_the_title()) . '" class="img-fluid">';
                            }
                            ?>
                        </div>
                        
                        <?php
                        // Galeria de imagens do produto
                        $gallery_images = get_post_meta(get_the_ID(), '_galeria_produto', true);
                        if (!empty($gallery_images)) {
                            echo '<div class="product-gallery-thumbs">';
                            
                            // Adiciona a imagem destacada como primeiro item
                            if (has_post_thumbnail()) {
                                echo '<img src="' . esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')) . '" alt="' . esc_attr(get_the_title()) . '">';
                            }
                            
                            // Adiciona as imagens da galeria
                            $gallery_array = explode(',', $gallery_images);
                            foreach ($gallery_array as $image_id) {
                                $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                                $image_full = wp_get_attachment_image_url($image_id, 'full');
                                if ($image_url) {
                                    echo '<img src="' . esc_url($image_url) . '" data-full="' . esc_url($image_full) . '" alt="' . esc_attr(get_the_title()) . '">';
                                }
                            }
                            
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="product-details">
                        <h1 class="product-title"><?php the_title(); ?></h1>
                        
                        <div class="product-meta">
                            <?php
                            // Marca
                            $marca = get_the_terms(get_the_ID(), 'marca');
                            if ($marca && !is_wp_error($marca)) {
                                echo '<div class="product-meta-item"><strong>' . esc_html__('Marca:', 'theme-espingardaria') . '</strong> ' . esc_html($marca[0]->name) . '</div>';
                            }
                            
                            // Calibre
                            $calibre = get_the_terms(get_the_ID(), 'calibre');
                            if ($calibre && !is_wp_error($calibre)) {
                                echo '<div class="product-meta-item"><strong>' . esc_html__('Calibre:', 'theme-espingardaria') . '</strong> ' . esc_html($calibre[0]->name) . '</div>';
                            }
                            
                            // Código do produto
                            $codigo = get_post_meta(get_the_ID(), '_codigo_produto', true);
                            if (!empty($codigo)) {
                                echo '<div class="product-meta-item"><strong>' . esc_html__('Código:', 'theme-espingardaria') . '</strong> ' . esc_html($codigo) . '</div>';
                            }
                            ?>
                        </div>
                        
                        <div class="product-price">
                            <?php
                            $price = get_post_meta(get_the_ID(), '_preco', true);
                            $regular_price = get_post_meta(get_the_ID(), '_preco_regular', true);
                            
                            if (!empty($regular_price) && !empty($price)) {
                                echo '<span class="regular-price">' . 'R$ ' . esc_html($regular_price) . '</span>';
                                echo '<span class="sale-price">' . 'R$ ' . esc_html($price) . '</span>';
                            } elseif (!empty($price)) {
                                echo '<span class="price">' . 'R$ ' . esc_html($price) . '</span>';
                            }
                            ?>
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
                        
                        <div class="product-description">
                            <?php the_content(); ?>
                        </div>
                        
                        <div class="product-quantity">
                            <span class="quantity-label"><?php esc_html_e('Quantidade:', 'theme-espingardaria'); ?></span>
                            <div class="quantity-controls">
                                <button type="button" class="quantity-button quantity-down">-</button>
                                <input type="number" class="quantity-input" value="1" min="1" max="99">
                                <button type="button" class="quantity-button quantity-up">+</button>
                            </div>
                        </div>
                        
                        <div class="product-actions">
                            <button type="button" class="btn btn-primary add-to-cart">
                                <i class="fas fa-shopping-cart"></i> <?php esc_html_e('Adicionar ao Carrinho', 'theme-espingardaria'); ?>
                            </button>
                            
                            <button type="button" class="btn btn-outline-secondary add-to-wishlist">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="product-share">
                            <span><?php esc_html_e('Compartilhar:', 'theme-espingardaria'); ?></span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/?text=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
                            <a href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer"><i class="far fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="product-tabs">
                <ul class="product-tabs-nav">
                    <li class="active"><a href="#tab-description"><?php esc_html_e('Descrição', 'theme-espingardaria'); ?></a></li>
                    <li><a href="#tab-specifications"><?php esc_html_e('Especificações', 'theme-espingardaria'); ?></a></li>
                    <li><a href="#tab-reviews"><?php esc_html_e('Avaliações', 'theme-espingardaria'); ?></a></li>
                </ul>
                
                <div class="product-tabs-content">
                    <div id="tab-description" class="product-tab active">
                        <?php
                        $description = get_post_meta(get_the_ID(), '_descricao_completa', true);
                        if (!empty($description)) {
                            echo wp_kses_post($description);
                        } else {
                            the_content();
                        }
                        ?>
                    </div>
                    
                    <div id="tab-specifications" class="product-tab">
                        <?php
                        $specifications = get_post_meta(get_the_ID(), '_especificacoes', true);
                        if (!empty($specifications)) {
                            echo wp_kses_post($specifications);
                        } else {
                            echo '<p>' . esc_html__('Nenhuma especificação disponível para este produto.', 'theme-espingardaria') . '</p>';
                        }
                        ?>
                    </div>
                    
                    <div id="tab-reviews" class="product-tab">
                        <?php
                        // Se os comentários estão abertos ou temos pelo menos um comentário, carregue o template de comentários
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        else :
                            echo '<p>' . esc_html__('Avaliações estão fechadas para este produto.', 'theme-espingardaria') . '</p>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            
            <?php
            // Produtos relacionados
            $related_args = array(
                'post_type' => 'produto',
                'posts_per_page' => 4,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand',
            );
            
            // Obtém os termos da taxonomia atual
            $terms = get_the_terms(get_the_ID(), 'categoria-produto');
            if ($terms && !is_wp_error($terms)) {
                $term_ids = array();
                foreach ($terms as $term) {
                    $term_ids[] = $term->term_id;
                }
                
                $related_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'categoria-produto',
                        'field' => 'term_id',
                        'terms' => $term_ids,
                    ),
                );
            }
            
            $related_query = new WP_Query($related_args);
            
            if ($related_query->have_posts()) :
            ?>
            <div class="related-products">
                <h2><?php esc_html_e('Produtos Relacionados', 'theme-espingardaria'); ?></h2>
                
                <div class="row">
                    <?php
                    while ($related_query->have_posts()) :
                        $related_query->the_post();
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
                                <div class="product-actions">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e('Ver Detalhes', 'theme-espingardaria'); ?></a>
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
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
