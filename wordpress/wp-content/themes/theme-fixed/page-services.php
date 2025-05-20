<?php
/**
 * Template Name: Página de Serviços
 *
 * Template para exibição de página de serviços com colunas e tabela de preços
 *
 * @package Theme_Espingardaria
 */

get_header();
?>

<main id="primary" class="site-main services-page">
    <div class="container-fluid p-0">
        <div class="page-header text-center">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <div class="scroll-down">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </div>

    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="service-featured-section">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="service-featured-image">
                                <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="service-featured-content">
                                <h2 class="service-featured-title">
                                    <?php echo esc_html__('WE OFFER WEAPON CLEANING & REPAIRS', 'theme-espingardaria'); ?>
                                </h2>
                                <div class="service-featured-description">
                                    <?php the_content(); ?>
                                </div>
                                <a href="#" class="btn btn-primary"><?php echo esc_html__('READ MORE', 'theme-espingardaria'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="service-prices-section">
                <h2 class="section-title text-center"><?php echo esc_html__('GUNSMITH PRICES', 'theme-espingardaria'); ?></h2>
                <div class="service-prices-divider"></div>
                
                <div class="service-prices-grid">
                    <div class="row">
                        <?php
                        // Serviços e preços
                        $services = array(
                            array(
                                'title' => 'HANDGUN SIGHT INSTALL',
                                'price' => '$100',
                                'description' => 'Lorem ipsum dolor sit amet, consectetur.'
                            ),
                            array(
                                'title' => 'BARREL THREADING',
                                'price' => '$90',
                                'description' => 'Lorem ipsum dolor sit amet, consectetur.'
                            ),
                            array(
                                'title' => 'BARREL CUT AND RE-CROWN',
                                'price' => '$50',
                                'description' => 'Lorem ipsum dolor sit amet, consectetur.'
                            ),
                            array(
                                'title' => 'DETAIL STRIP AND CLEAN',
                                'price' => '$150',
                                'description' => 'Lorem ipsum dolor sit amet, consectetur.'
                            ),
                            array(
                                'title' => 'GLOCK MAINTENANCE SERVICE',
                                'price' => '$140',
                                'description' => 'Lorem ipsum dolor sit amet, consectetur.'
                            ),
                            array(
                                'title' => 'BARREL PIN & WELDING',
                                'price' => '$120',
                                'description' => 'Lorem ipsum dolor sit amet, consectetur.'
                            )
                        );
                        
                        foreach ($services as $index => $service) :
                            $col_class = ($index < 3) ? 'col-lg-6 left-col' : 'col-lg-6 right-col';
                        ?>
                            <div class="<?php echo esc_attr($col_class); ?>">
                                <div class="service-price-item">
                                    <div class="service-price-title">
                                        <?php echo esc_html($service['title']); ?>
                                    </div>
                                    <div class="service-price-dots"></div>
                                    <div class="service-price-amount">
                                        <?php echo esc_html($service['price']); ?>
                                    </div>
                                    <div class="service-price-description">
                                        <?php echo esc_html($service['description']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="service-contact-section">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="service-contact-info">
                            <h2 class="contact-title"><?php echo esc_html__('HAVE QUESTIONS? GET IN TOUCH!', 'theme-espingardaria'); ?></h2>
                            <div class="contact-divider"></div>
                            <p class="contact-description">
                                <?php echo esc_html__('Adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.', 'theme-espingardaria'); ?>
                            </p>
                            <div class="contact-details">
                                <div class="contact-address">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo esc_html__('785 15th Street, Office 478 Berlin', 'theme-espingardaria'); ?></span>
                                </div>
                                <div class="contact-phone">
                                    <i class="fas fa-phone"></i>
                                    <span><?php echo esc_html__('+ 1 840 841 25 69', 'theme-espingardaria'); ?></span>
                                </div>
                                <div class="contact-email">
                                    <i class="fas fa-envelope"></i>
                                    <span><?php echo esc_html__('info@email.com', 'theme-espingardaria'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="service-contact-form">
                            <form class="contact-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><i class="fas fa-user"></i></label>
                                            <input type="text" id="name" class="form-control" placeholder="<?php echo esc_attr__('Name', 'theme-espingardaria'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"><i class="fas fa-envelope"></i></label>
                                            <input type="email" id="email" class="form-control" placeholder="<?php echo esc_attr__('Email Address', 'theme-espingardaria'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone"><i class="fas fa-phone"></i></label>
                                            <input type="tel" id="phone" class="form-control" placeholder="<?php echo esc_attr__('Phone', 'theme-espingardaria'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject"><i class="fas fa-info-circle"></i></label>
                                            <input type="text" id="subject" class="form-control" placeholder="<?php echo esc_attr__('Subject', 'theme-espingardaria'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message"><i class="fas fa-pencil-alt"></i></label>
                                    <textarea id="message" class="form-control" rows="5" placeholder="<?php echo esc_attr__('How can we help you? Feel free to get in touch!', 'theme-espingardaria'); ?>"></textarea>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="privacy-policy">
                                    <label class="form-check-label" for="privacy-policy">
                                        <?php echo esc_html__('I agree with the site\'s', 'theme-espingardaria'); ?> 
                                        <a href="#"><?php echo esc_html__('privacy policy', 'theme-espingardaria'); ?></a>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary"><?php echo esc_html__('GET IN TOUCH', 'theme-espingardaria'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
