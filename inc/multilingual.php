<?php
/**
 * Implementação do suporte multilíngue
 *
 * @package Theme_Espingardaria
 */

if (!defined('ABSPATH')) {
    exit; // Saída direta se acessado diretamente
}

/**
 * Classe para gerenciar o suporte multilíngue
 */
class Theme_Espingardaria_Multilingual {
    /**
     * Construtor
     */
    public function __construct() {
        add_action('init', array($this, 'register_language_switcher'));
        add_action('wp_head', array($this, 'language_switcher_styles'));
    }

    /**
     * Registra o seletor de idiomas
     */
    public function register_language_switcher() {
        // Verifica se o plugin WPML ou Polylang está ativo
        if (function_exists('icl_get_languages') || function_exists('pll_the_languages')) {
            add_filter('wp_nav_menu_items', array($this, 'add_language_switcher_to_menu'), 10, 2);
        }
    }

    /**
     * Adiciona o seletor de idiomas ao menu
     *
     * @param string $items Itens do menu
     * @param object $args Argumentos do menu
     * @return string Itens do menu com o seletor de idiomas
     */
    public function add_language_switcher_to_menu($items, $args) {
        if ($args->theme_location == 'primary') {
            $languages = $this->get_languages();
            
            if (!empty($languages)) {
                $items .= '<li class="menu-item menu-item-language dropdown">';
                $items .= '<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">';
                $items .= '<i class="fas fa-globe"></i> ' . esc_html($languages['current']['name']);
                $items .= '</a>';
                $items .= '<ul class="dropdown-menu language-dropdown">';
                
                foreach ($languages['available'] as $lang) {
                    $items .= '<li>';
                    $items .= '<a href="' . esc_url($lang['url']) . '">';
                    
                    if (!empty($lang['flag'])) {
                        $items .= '<img src="' . esc_url($lang['flag']) . '" alt="' . esc_attr($lang['name']) . '" class="language-flag"> ';
                    }
                    
                    $items .= esc_html($lang['name']);
                    $items .= '</a>';
                    $items .= '</li>';
                }
                
                $items .= '</ul>';
                $items .= '</li>';
            }
        }
        
        return $items;
    }

    /**
     * Obtém os idiomas disponíveis
     *
     * @return array Idiomas disponíveis
     */
    private function get_languages() {
        $languages = array(
            'current' => array(),
            'available' => array(),
        );
        
        // WPML
        if (function_exists('icl_get_languages')) {
            $wpml_languages = icl_get_languages('skip_missing=0');
            
            if (!empty($wpml_languages)) {
                foreach ($wpml_languages as $lang_code => $lang) {
                    if ($lang['active']) {
                        $languages['current'] = array(
                            'code' => $lang_code,
                            'name' => $lang['native_name'],
                            'url' => $lang['url'],
                            'flag' => $lang['country_flag_url'],
                        );
                    } else {
                        $languages['available'][] = array(
                            'code' => $lang_code,
                            'name' => $lang['native_name'],
                            'url' => $lang['url'],
                            'flag' => $lang['country_flag_url'],
                        );
                    }
                }
            }
        }
        // Polylang
        elseif (function_exists('pll_the_languages')) {
            $pll_languages = pll_the_languages(array('raw' => 1));
            
            if (!empty($pll_languages)) {
                foreach ($pll_languages as $lang) {
                    if ($lang['current_lang']) {
                        $languages['current'] = array(
                            'code' => $lang['slug'],
                            'name' => $lang['name'],
                            'url' => $lang['url'],
                            'flag' => $lang['flag'],
                        );
                    } else {
                        $languages['available'][] = array(
                            'code' => $lang['slug'],
                            'name' => $lang['name'],
                            'url' => $lang['url'],
                            'flag' => $lang['flag'],
                        );
                    }
                }
            }
        }
        // Fallback para demonstração
        else {
            $languages['current'] = array(
                'code' => 'pt-br',
                'name' => 'Português',
                'url' => '#',
                'flag' => get_template_directory_uri() . '/images/flags/br.png',
            );
            
            $languages['available'] = array(
                array(
                    'code' => 'en',
                    'name' => 'English',
                    'url' => '#',
                    'flag' => get_template_directory_uri() . '/images/flags/us.png',
                ),
                array(
                    'code' => 'es',
                    'name' => 'Español',
                    'url' => '#',
                    'flag' => get_template_directory_uri() . '/images/flags/es.png',
                ),
            );
        }
        
        return $languages;
    }

    /**
     * Adiciona estilos para o seletor de idiomas
     */
    public function language_switcher_styles() {
        ?>
        <style>
            .menu-item-language {
                position: relative;
            }
            
            .language-dropdown {
                min-width: 150px;
            }
            
            .language-flag {
                width: 16px;
                height: 11px;
                margin-right: 5px;
            }
        </style>
        <?php
    }
}

// Inicializa o suporte multilíngue
new Theme_Espingardaria_Multilingual();
