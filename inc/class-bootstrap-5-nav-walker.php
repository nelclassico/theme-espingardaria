<?php
/**
 * Classe para navegação Bootstrap 5
 *
 * @package Theme_Espingardaria
 */

// Verifica se a classe já existe para evitar erros
if (!class_exists('Bootstrap_5_Nav_Walker')) {
    /**
     * Classe para criar um menu compatível com Bootstrap 5
     */
    class Bootstrap_5_Nav_Walker {
        /**
         * Inicia o elemento de nível superior
         *
         * @param string $output Usado para anexar conteúdo adicional.
         * @param object $item Item do menu.
         * @param int    $depth Profundidade do item do menu.
         * @param array  $args Argumentos do menu.
         * @param int    $id ID do item atual.
         */
        public function start_lvl(&$output, $depth = 0, $args = null) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }

        /**
         * Termina o elemento de nível superior
         *
         * @param string $output Usado para anexar conteúdo adicional.
         * @param object $item Item do menu.
         * @param int    $depth Profundidade do item do menu.
         * @param array  $args Argumentos do menu.
         */
        public function end_lvl(&$output, $depth = 0, $args = null) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        /**
         * Inicia o elemento do item
         *
         * @param string $output Usado para anexar conteúdo adicional.
         * @param object $item Item do menu.
         * @param int    $depth Profundidade do item do menu.
         * @param array  $args Argumentos do menu.
         * @param int    $id ID do item atual.
         */
        public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            // Adiciona classes do Bootstrap para itens de menu
            if ($args->walker->has_children) {
                $classes[] = 'dropdown';
            }

            if (in_array('current-menu-item', $classes, true) || in_array('current-menu-parent', $classes, true)) {
                $classes[] = 'active';
            }

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names . '>';

            $atts = array();
            $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
            $atts['href']   = !empty($item->url) ? $item->url : '';

            // Se tem filhos, adiciona atributos de dropdown
            if ($args->walker->has_children) {
                $atts['class']         = 'nav-link dropdown-toggle';
                $atts['data-bs-toggle'] = 'dropdown';
                $atts['aria-expanded'] = 'false';
            } else {
                $atts['class'] = 'nav-link';
            }

            // Atualiza classes para itens de menu de nível inferior
            if ($depth > 0) {
                $atts['class'] = 'dropdown-item';
            }

            // Adiciona classe active para item atual
            if (in_array('current-menu-item', $classes, true) || in_array('current-menu-parent', $classes, true)) {
                $atts['class'] .= ' active';
            }

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $title = apply_filters('the_title', $item->title, $item->ID);
            $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }

        /**
         * Termina o elemento do item
         *
         * @param string $output Usado para anexar conteúdo adicional.
         * @param object $item Item do menu.
         * @param int    $depth Profundidade do item do menu.
         * @param array  $args Argumentos do menu.
         */
        public function end_el(&$output, $item, $depth = 0, $args = null) {
            $output .= "</li>\n";
        }
    }
}
