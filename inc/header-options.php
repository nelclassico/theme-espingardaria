<?php
/**
 * Implementação do header dinâmico e menus
 *
 * @package Theme_Espingardaria
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Theme_Espingardaria_Header')) {
    class Theme_Espingardaria_Header {
        private $options;

        public function __construct() {
            $this->options = get_option('theme_espingardaria_header_options', array());
            add_action('admin_menu', array($this, 'add_header_options_page'));
            add_action('admin_init', array($this, 'register_settings'));
        }

        public function add_header_options_page() {
            add_submenu_page(
                'theme-espingardaria-options',
                __('Opções do Header', 'theme-espingardaria'),
                __('Header', 'theme-espingardaria'),
                'manage_options',
                'theme-espingardaria-header',
                array($this, 'render_options_page')
            );
        }

        public function register_settings() {
            register_setting(
                'theme_espingardaria_header_options_group',
                'theme_espingardaria_header_options',
                array($this, 'sanitize_options')
            );
        }

        public function sanitize_options($input) {
            $output = array();
            if (!is_array($input)) {
                return $output;
            }
            if (isset($input['show_topbar'])) {
                $output['show_topbar'] = true;
            }
            if (isset($input['show_search'])) {
                $output['show_search'] = true;
            }
            if (isset($input['show_cart'])) {
                $output['show_cart'] = true;
            }
            $output['phone'] = isset($input['phone']) ? sanitize_text_field($input['phone']) : '';
            $output['email'] = isset($input['email']) ? sanitize_email($input['email']) : '';
            $output['hours'] = isset($input['hours']) ? sanitize_text_field($input['hours']) : '';
            $output['facebook'] = isset($input['facebook']) ? esc_url_raw($input['facebook']) : '';
            $output['instagram'] = isset($input['instagram']) ? esc_url_raw($input['instagram']) : '';
            $output['twitter'] = isset($input['twitter']) ? esc_url_raw($input['twitter']) : '';
            $output['youtube'] = isset($input['youtube']) ? esc_url_raw($input['youtube']) : '';
            $output['logo'] = isset($input['logo']) ? esc_url_raw($input['logo']) : '';
            $output['cart_url'] = isset($input['cart_url']) ? esc_url_raw($input['cart_url']) : '';
            return $output;
        }

        public function render_options_page() {
            $options = get_option('theme_espingardaria_header_options', array());
            ?>
            <div class="wrap">
                <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
                <form method="post" action="options.php">
                    <?php settings_fields('theme_espingardaria_header_options_group'); ?>
                    <div class="theme-options-tabs">
                        <ul class="theme-options-tabs-nav">
                            <li class="active"><a href="#tab-general"><?php esc_html_e('Geral', 'theme-espingardaria'); ?></a></li>
                            <li><a href="#tab-contact"><?php esc_html_e('Informações de Contato', 'theme-espingardaria'); ?></a></li>
                            <li><a href="#tab-social"><?php esc_html_e('Redes Sociais', 'theme-espingardaria'); ?></a></li>
                            <li><a href="#tab-logo"><?php esc_html_e('Logo', 'theme-espingardaria'); ?></a></li>
                            <li><a href="#tab-menu"><?php esc_html_e('Menu', 'theme-espingardaria'); ?></a></li>
                        </ul>
                        <div class="theme-options-tabs-content">
                            <div id="tab-general" class="theme-options-tab active">
                                <div class="theme-options-section">
                                    <div class="theme-options-section-header">
                                        <h3><?php esc_html_e('Configurações Gerais', 'theme-espingardaria'); ?></h3>
                                    </div>
                                    <div class="theme-options-section-content">
                                        <div class="theme-options-field">
                                            <label>
                                                <input type="checkbox" name="theme_espingardaria_header_options[show_topbar]" <?php checked(isset($options['show_topbar'])); ?>>
                                                <?php esc_html_e('Mostrar Barra Superior', 'theme-espingardaria'); ?>
                                            </label>
                                        </div>
                                        <div class="theme-options-field">
                                            <label>
                                                <input type="checkbox" name="theme_espingardaria_header_options[show_search]" <?php checked(isset($options['show_search'])); ?>>
                                                <?php esc_html_e('Mostrar Campo de Busca', 'theme-espingardaria'); ?>
                                            </label>
                                        </div>
                                        <div class="theme-options-field">
                                            <label>
                                                <input type="checkbox" name="theme_espingardaria_header_options[show_cart]" <?php checked(isset($options['show_cart'])); ?>>
                                                <?php esc_html_e('Mostrar Carrinho', 'theme-espingardaria'); ?>
                                            </label>
                                        </div>
                                        <div class="theme-options-field">
                                            <label><?php esc_html_e('URL do Carrinho', 'theme-espingardaria'); ?></label>
                                            <input type="url" name="theme_espingardaria_header_options[cart_url]" value="<?php echo esc_attr(isset($options['cart_url']) ? $options['cart_url'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-contact" class="theme-options-tab">
                                <div class="theme-options-section">
                                    <div class="theme-options-section-header">
                                        <h3><?php esc_html_e('Informações de Contato', 'theme-espingardaria'); ?></h3>
                                    </div>
                                    <div class="theme-options-section-content">
                                        <div class="theme-options-field">
                                            <label><?php esc_html_e('Telefone', 'theme-espingardaria'); ?></label>
                                            <input type="text" name="theme_espingardaria_header_options[phone]" value="<?php echo esc_attr(isset($options['phone']) ? $options['phone'] : ''); ?>">
                                        </div>
                                        <div class="theme-options-field">
                                            <label><?php esc_html_e('Email', 'theme-espingardaria'); ?></label>
                                            <input type="email" name="theme_espingardaria_header_options[email]" value="<?php echo esc_attr(isset($options['email']) ? $options['email'] : ''); ?>">
                                        </div>
                                        <div class="theme-options-field">
                                            <label><?php esc_html_e('Horário de Funcionamento', 'theme-espingardaria'); ?></label>
                                            <input type="text" name="theme_espingardaria_header_options[hours]" value="<?php echo esc_attr(isset($options['hours']) ? $options['hours'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-social" class="theme-options-tab">
                                <div class="theme-options-section">
                                    <div class="theme-options-section-header">
                                        <h3><?php esc_html_e('Redes Sociais', 'theme-espingardaria'); ?></h3>
                                    </div>
                                    <div class="theme-options-section-content">
                                        <div class="theme-options-field">
                                            <label><?php esc_html_e('Facebook', 'theme-espingardaria'); ?></label>
                                            <input type="url" name="theme_espingardaria_header_options[facebook]" value="<?php echo esc_attr(isset($options['facebook']) ? $options['facebook'] : ''); ?>">
                                        </div>
                                        <div class="theme-options-field">
                                            <label><?php esc_html_e('Instagram', 'theme-espingardaria'); ?></label>
                                            <input type="url" name="theme_espingardaria_header_options[instagram]" value="<?php echo esc_attr(isset($options['instagram']) ? $options['instagram'] : ''); ?>">
                                        </div>
                                        <div class="theme-options-field">
                                            <label><?php esc_html_e('Twitter', 'theme-espingardaria'); ?></label>
                                            <input type="url" name="theme_espingardaria_header_options[twitter]" value="<?php echo esc_attr(isset($options['twitter']) ? $options['twitter'] : ''); ?>">
                                        </div>
                                        <div class="theme-options-field">
                                            <label><?php esc_html_e('YouTube', 'theme-espingardaria'); ?></label>
                                            <input type="url" name="theme_espingardaria_header_options[youtube]" value="<?php echo esc_attr(isset($options['youtube']) ? $options['youtube'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-logo" class="theme-options-tab">
                                <div class="theme-options-section">
                                    <div class="theme-options-section-header">
                                        <h3><?php esc_html_e('Logo', 'theme-espingardaria'); ?></h3>
                                    </div>
                                    <div class="theme-options-section-content">
                                        <div class="theme-options-field">
                                            <label><?php esc_html_e('Logo', 'theme-espingardaria'); ?></label>
                                            <div class="media-uploader">
                                                <input type="hidden" name="theme_espingardaria_header_options[logo]" value="<?php echo esc_attr(isset($options['logo']) ? $options['logo'] : ''); ?>">
                                                <div class="media-preview">
                                                    <?php if (isset($options['logo']) && !empty($options['logo'])) : ?>
                                                        <img src="<?php echo esc_url($options['logo']); ?>" alt="">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="media-buttons">
                                                    <button type="button" class="button upload-media"><?php esc_html_e('Selecionar Logo', 'theme-espingardaria'); ?></button>
                                                    <button type="button" class="button remove-media"><?php esc_html_e('Remover Logo', 'theme-espingardaria'); ?></button>
                                                </div>
                                            </div>
                                            <p class="description"><?php esc_html_e('Você também pode definir o logo através do Customizer em "Identidade do Site".', 'theme-espingardaria'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-menu" class="theme-options-tab">
                                <div class="theme-options-section">
                                    <div class="theme-options-section-header">
                                        <h3><?php esc_html_e('Menu', 'theme-espingardaria'); ?></h3>
                                    </div>
                                    <div class="theme-options-section-content">
                                        <p><?php esc_html_e('Você pode gerenciar os menus através do painel "Aparência > Menus" do WordPress.', 'theme-espingardaria'); ?></p>
                                        <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="button"><?php esc_html_e('Ir para Menus', 'theme-espingardaria'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php submit_button(); ?>
                </form>
            </div>
            <?php
        }
    }
}

new Theme_Espingardaria_Header();