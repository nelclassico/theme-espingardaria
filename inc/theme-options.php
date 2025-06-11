<?php

/**

 * Implementação do painel de opções do tema

 *

 * @package Theme_Espingardaria

 */



if (!defined('ABSPATH')) {

    exit;

}



/**

 * Classe para gerenciar as opções do tema

 */

class Theme_Espingardaria_Options {

    private $options;



    public function __construct() {

        $this->options = get_option('theme_espingardaria_options', array());

        add_action('admin_menu', array($this, 'add_theme_options_page'));

        add_action('admin_init', array($this, 'register_settings'));

        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));



        // Adicionar esta linha:

        //add_action('admin_init', array($this, 'register_home_options'));

    }



    public function add_theme_options_page() {

        add_menu_page(

            __('Opções do Site', 'theme-espingardaria'),

            __('Opções do Site', 'theme-espingardaria'),

            'manage_options',

            'theme-espingardaria-options',

            array($this, 'render_options_page'),

            'dashicons-admin-settings',

            59

        );

    }



  public function register_settings() {

        register_setting(

            'theme_espingardaria_options_group',

            'theme_espingardaria_options',

            array($this, 'sanitize_options')

        );

    }



    public function sanitize_options($input) {

        $output = array();



        // Banner Principal (Slider)

            if (isset($input['slider']) && is_array($input['slider'])) {

            $output['slider'] = array();

            foreach ($input['slider'] as $index => $slide) {

                $output['slider'][$index] = array(

                    'image' => isset($slide['image']) ? esc_url_raw($slide['image']) : '',

                    'image_product_left' => isset($slide['image_product_left']) ? esc_url_raw($slide['image_product_left']) : '',

                    'image_product_right' => isset($slide['image_product_right']) ? esc_url_raw($slide['image_product_right']) : '',

                    'title' => isset($slide['title']) ? sanitize_text_field($slide['title']) : '',

                    'subtitle' => isset($slide['subtitle']) ? sanitize_text_field($slide['subtitle']) : '',

                    'price' => isset($slide['price']) ? sanitize_text_field($slide['price']) : '',

                    'button_text' => isset($slide['button_text']) ? sanitize_text_field($slide['button_text']) : '',

                    'button_url' => isset($slide['button_url']) ? esc_url_raw($slide['button_url']) : '',

                    'secondary_button_text' => isset($slide['secondary_button_text']) ? sanitize_text_field($slide['secondary_button_text']) : '',

                    'secondary_button_url' => isset($slide['secondary_button_url']) ? esc_url_raw($slide['secondary_button_url']) : '',

                );

            }

        }



        // Para training

            $training_button_url = esc_url_raw($input['training_button_url'] ?? '');

            $output['training_button_url'] = ($training_button_url === '#' || empty($training_button_url)) ? '' : $training_button_url;

            // Para ammo

            $ammo_button_url = esc_url_raw($input['ammo_button_url'] ?? '');

            $output['ammo_button_url'] = ($ammo_button_url === '#' || empty($ammo_button_url)) ? '' : $ammo_button_url;


            // Para destaque 1

            $destaque_1_button_url = esc_url_raw($input['destaque_1_button_url'] ?? '');

            $output['destaque_1_button_url'] = ($destaque_1_button_url === '#' || empty($destaque_1_button_url)) ? '' : $destaque_1_button_url;

            // Para destaque 2

            $destaque_2_button_url = esc_url_raw($input['destaque_2_button_url'] ?? '');

            $output['destaque_2_button_url'] = ($destaque_2_button_url === '#' || empty($destaque_2_button_url)) ? '' : $destaque_2_button_url;
            

            // Para shop_anywhere_items

            if (isset($input['shop_anywhere_items']) && is_array($input['shop_anywhere_items'])) {

                $output['shop_anywhere_items'] = array();

                foreach ($input['shop_anywhere_items'] as $key => $item) {

                    $url = esc_url_raw($item['url'] ?? '');

                    $output['shop_anywhere_items'][$key] = array(

                        'image' => esc_url_raw($item['image'] ?? ''),

                        'title' => sanitize_text_field($item['title'] ?? ''),

                        'url' => ($url === '#' || empty($url)) ? '' : $url,

                    );

                }

            }      

            



        // Categorias de Produtos

        $output['show_categories'] = isset($input['show_categories']);

        $output['categories_title'] = sanitize_text_field($input['categories_title'] ?? '');

        $output['selected_categories'] = isset($input['selected_categories']) && is_array($input['selected_categories'])

            ? array_map('intval', $input['selected_categories'])

            : array();



        // Produtos em Destaque

        $output['show_featured_products'] = isset($input['show_featured_products']);

        $output['featured_products_title'] = sanitize_text_field($input['featured_products_title'] ?? '');

        $output['featured_products_count'] = intval($input['featured_products_count'] ?? 4);

        $output['featured_products_category'] = intval($input['featured_products_category'] ?? 0);



        // Seção de Treinamento

        $output['show_training'] = isset($input['show_training']);

        $output['training_title'] = sanitize_text_field($input['training_title'] ?? '');

        $output['training_text'] = wp_kses_post($input['training_text'] ?? '');

        $output['training_button_text'] = sanitize_text_field($input['training_button_text'] ?? '');

        $output['training_button_url'] = esc_url_raw($input['training_button_url'] ?? '');

        $output['training_image'] = esc_url_raw($input['training_image'] ?? '');



        // Seção de Munições

        $output['show_ammo'] = isset($input['show_ammo']);

        $output['ammo_title'] = sanitize_text_field($input['ammo_title'] ?? '');

        $output['ammo_text'] = wp_kses_post($input['ammo_text'] ?? '');

        $output['ammo_button_text'] = sanitize_text_field($input['ammo_button_text'] ?? '');

        $output['ammo_button_url'] = esc_url_raw($input['ammo_button_url'] ?? '');

        $output['ammo_image'] = esc_url_raw($input['ammo_image'] ?? '');


         // Seção de destaque 01

        $output['show_destaque_1'] = isset($input['show_destaque_1']);

        $output['destaque_1_title'] = sanitize_text_field($input['destaque_1_title'] ?? '');

        $output['destaque_1_text'] = wp_kses_post($input['destaque_1_text'] ?? '');

        $output['destaque_1_button_text'] = sanitize_text_field($input['destaque_1_button_text'] ?? '');

        $output['destaque_1_button_url'] = esc_url_raw($input['destaque_1_button_url'] ?? '');

        $output['destaque_1_image'] = esc_url_raw($input['destaque_1_image'] ?? '');


        // Seção de Destaque 02

        $output['show_destaque_2'] = isset($input['show_destaque_2']);

        $output['destaque_2_title'] = sanitize_text_field($input['destaque_2_title'] ?? '');

        $output['destaque_2_text'] = wp_kses_post($input['destaque_2_text'] ?? '');

        $output['destaque_2_button_text'] = sanitize_text_field($input['destaque_2_button_text'] ?? '');

        $output['destaque_2_button_url'] = esc_url_raw($input['destaque_2_button_url'] ?? '');

        $output['destaque_2_image'] = esc_url_raw($input['destaque_2_image'] ?? '');



        // Compre em Qualquer Lugar

        $output['show_shop_anywhere'] = isset($input['show_shop_anywhere']);

        $output['shop_anywhere_title'] = sanitize_text_field($input['shop_anywhere_title'] ?? '');

        if (isset($input['shop_anywhere_items']) && is_array($input['shop_anywhere_items'])) {

            $output['shop_anywhere_items'] = array();

            foreach ($input['shop_anywhere_items'] as $key => $item) {

                $output['shop_anywhere_items'][$key] = array(

                    'image' => esc_url_raw($item['image'] ?? ''),

                    'title' => sanitize_text_field($item['title'] ?? ''),

                    'url' => esc_url_raw($item['url'] ?? ''),

                );

            }

        }



        // Avaliações de Clientes

        $output['show_reviews'] = isset($input['show_reviews']);

        $output['reviews_title'] = sanitize_text_field($input['reviews_title'] ?? '');

        if (isset($input['reviews']) && is_array($input['reviews'])) {

            $output['reviews'] = array();

            foreach ($input['reviews'] as $key => $review) {

                $output['reviews'][$key] = array(

                    'text' => wp_kses_post($review['text'] ?? ''),

                    'author' => sanitize_text_field($review['author'] ?? ''),

                    'rating' => intval($review['rating'] ?? 5),

                    'image' => esc_url_raw($review['image'] ?? ''),

                );

            }

        }


        // Sanitização para a seção Galeria de Imagens
            $output['show_image_gallery'] = isset($input['show_image_gallery']);
            $output['image_gallery_title'] = sanitize_text_field($input['image_gallery_title'] ?? '');

            if (isset($input['image_gallery_images']) && !empty($input['image_gallery_images'])) {
                $images = json_decode(stripslashes($input['image_gallery_images']), true);
                if (is_array($images)) {
                    $output['image_gallery_images'] = array_map('esc_url_raw', array_filter($images));
                } else {
                    $output['image_gallery_images'] = array();
                }
            } else {
                $output['image_gallery_images'] = array();
            }


        // Novos Produtos

        $output['show_new_products'] = isset($input['show_new_products']);

        $output['new_products_title'] = sanitize_text_field($input['new_products_title'] ?? '');

        $output['new_products_count'] = intval($input['new_products_count'] ?? 4);



        // Blog e Notícias

        $output['show_blog'] = isset($input['show_blog']);

        $output['blog_title'] = sanitize_text_field($input['blog_title'] ?? '');

        $output['blog_count'] = intval($input['blog_count'] ?? 3);



        // Sobre Nós

        $output['show_about'] = isset($input['show_about']);

        $output['about_title'] = sanitize_text_field($input['about_title'] ?? '');

        $output['about_text'] = wp_kses_post($input['about_text'] ?? '');

        $output['about_image'] = esc_url_raw($input['about_image'] ?? '');



        // Opções do Cabeçalho

        $output['header_phone'] = sanitize_text_field($input['header_phone'] ?? '');

        $output['header_email'] = sanitize_email($input['header_email'] ?? '');

        $output['header_address'] = sanitize_text_field($input['header_address'] ?? '');

        $output['header_hours'] = sanitize_text_field($input['header_hours'] ?? '');



        // Opções do Rodapé

        $output['footer_text'] = wp_kses_post($input['footer_text'] ?? '');

        $output['footer_copyright'] = sanitize_text_field($input['footer_copyright'] ?? '');

        $output['footer_address'] = sanitize_text_field($input['footer_address'] ?? '');

        $output['footer_phone'] = sanitize_text_field($input['footer_phone'] ?? '');

        $output['footer_email'] = sanitize_email($input['footer_email'] ?? '');



        // Redes Sociais

        $output['social_facebook'] = esc_url_raw($input['social_facebook'] ?? '');

        $output['social_twitter'] = esc_url_raw($input['social_twitter'] ?? '');

        $output['social_instagram'] = esc_url_raw($input['social_instagram'] ?? '');

        $output['social_youtube'] = esc_url_raw($input['social_youtube'] ?? '');

        $output['social_linkedin'] = esc_url_raw($input['social_linkedin'] ?? '');



        // Opções Avançadas

        $output['tracking_head'] = wp_kses($input['tracking_head'] ?? '', array());

        $output['tracking_footer'] = wp_kses($input['tracking_footer'] ?? '', array());

        $output['custom_css'] = wp_kses($input['custom_css'] ?? '', array());        



        return $output;

    }



    public function enqueue_admin_scripts($hook) {

        if ('toplevel_page_theme-espingardaria-options' !== $hook) {

            return;

        }



        wp_enqueue_media();

        wp_enqueue_style('theme-espingardaria-admin', get_template_directory_uri() . '/css/admin.css', array(), '1.0.0');

        wp_enqueue_script('jquery-ui-sortable');

        wp_enqueue_script('theme-espingardaria-admin', get_template_directory_uri() . '/js/admin.js', array('jquery', 'jquery-ui-sortable'), '1.0.0', true);



        wp_localize_script('theme-espingardaria-admin', 'themeEspingardaria', array(

            'mediaTitle' => __('Selecionar ou Enviar Imagem', 'theme-espingardaria'),

            'mediaButton' => __('Usar esta imagem', 'theme-espingardaria'),

            'removeText' => __('Remover', 'theme-espingardaria'),

            'addText' => __('Adicionar', 'theme-espingardaria'),

        ));

    }



    public function render_options_page() {

        ?>

        <div class="wrap">

            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

            <form method="post" action="options.php" novalidate>

                <?php settings_fields('theme_espingardaria_options_group'); ?>

                <div class="theme-options-tabs">

                    <ul class="theme-options-tabs-nav">

                        <li class="active"><a href="#tab-home"><?php esc_html_e('Home Page', 'theme-espingardaria'); ?></a></li>

                        <li><a href="#tab-header"><?php esc_html_e('Header', 'theme-espingardaria'); ?></a></li>

                        <li><a href="#tab-footer"><?php esc_html_e('Footer', 'theme-espingardaria'); ?></a></li>

                        <li><a href="#tab-social"><?php esc_html_e('Redes Sociais', 'theme-espingardaria'); ?></a></li>

                        <li><a href="#tab-advanced"><?php esc_html_e('Avançado', 'theme-espingardaria'); ?></a></li>

                    </ul>

                    <div class="theme-options-tabs-content">

                        <div id="tab-home" class="theme-options-tab active">

                            <?php $this->render_home_options(); ?>

                        </div>

                        <div id="tab-header" class="theme-options-tab">

                            <?php $this->render_header_options(); ?>

                        </div>

                        <div id="tab-footer" class="theme-options-tab">

                            <?php $this->render_footer_options(); ?>

                        </div>

                        <div id="tab-social" class="theme-options-tab">

                            <?php $this->render_social_options(); ?>

                        </div>

                        <div id="tab-advanced" class="theme-options-tab">

                            <?php $this->render_advanced_options(); ?>

                        </div>

                    </div>

                </div>

                <?php submit_button(); ?>

            </form>

        </div>

        <?php

    }



    // Substitua o método render_home_options() por:

        public function render_home_options() {

            // Não use um formulário aqui, pois já estamos dentro do formulário principal

            echo '<div class="theme-options-home-content">';

            include get_template_directory() . '/inc/render-home-options.php';

            echo '</div>';

        }



    public function render_header_options() {

        ?>

        <div class="theme-options-field">

            <label><?php esc_html_e('Telefone', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[header_phone]" value="<?php echo esc_attr(isset($this->options['header_phone']) ? $this->options['header_phone'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Email', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[header_email]" value="<?php echo esc_attr(isset($this->options['header_email']) ? $this->options['header_email'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Endereço', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[header_address]" value="<?php echo esc_attr(isset($this->options['header_address']) ? $this->options['header_address'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Horário de Funcionamento', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[header_hours]" value="<?php echo esc_attr(isset($this->options['header_hours']) ? $this->options['header_hours'] : ''); ?>">

        </div>

        <?php

    }



    public function render_footer_options() {

        ?>

        <div class="theme-options-field">

            <label><?php esc_html_e('Texto do Rodapé', 'theme-espingardaria'); ?></label>

            <textarea name="theme_espingardaria_options[footer_text]" rows="5"><?php echo esc_textarea(isset($this->options['footer_text']) ? $this->options['footer_text'] : ''); ?></textarea>

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Texto de Copyright', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[footer_copyright]" value="<?php echo esc_attr(isset($this->options['footer_copyright']) ? $this->options['footer_copyright'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Endereço', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[footer_address]" value="<?php echo esc_attr(isset($this->options['footer_address']) ? $this->options['footer_address'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Telefone', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[footer_phone]" value="<?php echo esc_attr(isset($this->options['footer_phone']) ? $this->options['footer_phone'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Email', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[footer_email]" value="<?php echo esc_attr(isset($this->options['footer_email']) ? $this->options['footer_email'] : ''); ?>">

        </div>

        <?php

    }



    public function render_social_options() {

        ?>

        <div class="theme-options-field">

            <label><?php esc_html_e('Facebook', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[social_facebook]" value="<?php echo esc_attr(isset($this->options['social_facebook']) ? $this->options['social_facebook'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Twitter', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[social_twitter]" value="<?php echo esc_attr(isset($this->options['social_twitter']) ? $this->options['social_twitter'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Instagram', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[social_instagram]" value="<?php echo esc_attr(isset($this->options['social_instagram']) ? $this->options['social_instagram'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('YouTube', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[social_youtube]" value="<?php echo esc_attr(isset($this->options['social_youtube']) ? $this->options['social_youtube'] : ''); ?>">

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('LinkedIn', 'theme-espingardaria'); ?></label>

            <input type="text" name="theme_espingardaria_options[social_linkedin]" value="<?php echo esc_attr(isset($this->options['social_linkedin']) ? $this->options['social_linkedin'] : ''); ?>">

        </div>

        <?php

    }



    public function render_advanced_options() {

        ?>

        <div class="theme-options-field">

            <label><?php esc_html_e('Código de Rastreamento (Head)', 'theme-espingardaria'); ?></label>

            <textarea name="theme_espingardaria_options[tracking_head]" rows="5"><?php echo esc_textarea(isset($this->options['tracking_head']) ? $this->options['tracking_head'] : ''); ?></textarea>

            <p class="description"><?php esc_html_e('Este código será adicionado à seção head do site.', 'theme-espingardaria'); ?></p>

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('Código de Rastreamento (Footer)', 'theme-espingardaria'); ?></label>

            <textarea name="theme_espingardaria_options[tracking_footer]" rows="5"><?php echo esc_textarea(isset($this->options['tracking_footer']) ? $this->options['tracking_footer'] : ''); ?></textarea>

            <p class="description"><?php esc_html_e('Este código será adicionado ao final do site, antes do fechamento da tag body.', 'theme-espingardaria'); ?></p>

        </div>



        <div class="theme-options-field">

            <label><?php esc_html_e('CSS Personalizado', 'theme-espingardaria'); ?></label>

            <textarea name="theme_espingardaria_options[custom_css]" rows="10"><?php echo esc_textarea(isset($this->options['custom_css']) ? $this->options['custom_css'] : ''); ?></textarea>

        </div>

        <?php

    }
    

}



new Theme_Espingardaria_Options();