<?php
/**
 * Funções e definições do tema
 *
 * @package Theme_Espingardaria
 */

if (!defined(\'ABSPATH\')) {
    exit;
}

define(\'THEME_ESPINGARDARIA_VERSION\', \'3.1\'); // Increment version

function theme_espingardaria_setup() {
    load_theme_textdomain(\'theme-espingardaria\', get_template_directory() . \'/languages\');
    add_theme_support(\'title-tag\');
    add_theme_support(\'post-thumbnails\');
    add_theme_support(\'custom-logo\', array(
        \'height\'      => 60,
        \'width\'       => 200,
        \'flex-height\' => true,
        \'flex-width\'  => true,
    ));
    add_theme_support(\'html5\', array(
        \'search-form\', \'comment-form\', \'comment-list\', \'gallery\', \'caption\', \'style\', \'script\',
    ));
    add_theme_support(\'align-wide\');
    add_theme_support(\'custom-colors\');
    add_image_size(\'theme-espingardaria-product\', 400, 400, true);
    add_image_size(\'theme-espingardaria-portfolio\', 400, 300, true);
    add_image_size(\'theme-espingardaria-blog\', 800, 450, true);
    register_nav_menus(array(
        \'primary\' => esc_html__(\'Menu Principal\', \'theme-espingardaria\'),
        \'footer\' => esc_html__(\'Menu do Rodapé\', \'theme-espingardaria\'),
        \'mobile\' => esc_html__(\'Menu Mobile\', \'theme-espingardaria\'),
    ));
}
add_action(\'after_setup_theme\', \'theme_espingardaria_setup\');

function theme_espingardaria_widgets_init() {
    register_sidebar(array(
        \'name\'          => esc_html__(\'Sidebar\', \'theme-espingardaria\'),
        \'id\'            => \'sidebar-1\',
        \'description\'   => esc_html__(\'Adicione widgets aqui.\', \'theme-espingardaria\'),
        \'before_widget\' => \'<section id="%1$s" class="widget %2$s">\',
        \'after_widget\'  => \'</section>\',
        \'before_title\'  => \'<h2 class="widget-title">\',
        \'after_title\'   => \'</h2>\',
    ));
    // ... (outros sidebars)
}
add_action(\'widgets_init\', \'theme_espingardaria_widgets_init\');

function theme_espingardaria_scripts() {
    wp_enqueue_style(\'bootstrap\', get_template_directory_uri() . \'/css/bootstrap.min.css\', array(), \'5.1.3\');
    wp_enqueue_style(\'fontawesome\', \'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css\', array(), \'5.15.4\');
    // Fancybox CSS (Certifique-se de que está sendo carregado, pode ser necessário adicionar)
    wp_enqueue_style(\'fancybox\', \'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css\', array(), \'4.0\');
    wp_enqueue_style(\'theme-espingardaria-style\', get_template_directory_uri() . \'/css/style.css\', array(\'bootstrap\'), THEME_ESPINGARDARIA_VERSION);
    wp_enqueue_style(\'theme-espingardaria-main\', get_stylesheet_uri(), array(), THEME_ESPINGARDARIA_VERSION);
    
    wp_enqueue_script(\'jquery\'); // Garante que jQuery está carregado
    wp_enqueue_script(\'bootstrap\', get_template_directory_uri() . \'/js/bootstrap.bundle.min.js\', array(\'jquery\'), \'5.1.3\', true);
    // Fancybox JS (Certifique-se de que está sendo carregado)
    wp_enqueue_script(\'fancybox\', \'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js\', array(), \'4.0\', true);
    wp_enqueue_script(\'theme-espingardaria-main\', get_template_directory_uri() . \'/js/main.js\', array(\'jquery\', \'bootstrap\', \'fancybox\'), THEME_ESPINGARDARIA_VERSION, true);
    
    // Localize script para AJAX
    wp_localize_script(\'theme-espingardaria-main\', \'productContactAjax\', array(
        \'ajax_url\' => admin_url(\'admin-ajax.php\'),
        \'nonce\'    => wp_create_nonce(\'product_contact_nonce\')
    ));

    if (is_singular() && comments_open() && get_option(\'thread_comments\')) {
        wp_enqueue_script(\'comment-reply\');
    }
}
add_action(\'wp_enqueue_scripts\', \'theme_espingardaria_scripts\');

// ... (enqueue admin scripts)

// ... (register post types)

// ... (register taxonomies)

// --- Metaboxes para Produtos ---
function theme_espingardaria_add_product_meta_boxes() {
    add_meta_box(
        \'theme_espingardaria_product_details\',
        __(\'Detalhes do Produto\', \'theme-espingardaria\'),
        \'theme_espingardaria_product_details_callback\',
        \'produto\',
        \'normal\',
        \'high\'
    );
    add_meta_box(
        \'theme_espingardaria_product_contact\',
        __(\'Contato do Produto\', \'theme-espingardaria\'),
        \'theme_espingardaria_product_contact_callback\',
        \'produto\',
        \'side\', // Coloca na lateral
        \'default\'
    );
}
add_action(\'add_meta_boxes\', \'theme_espingardaria_add_product_meta_boxes\');

// Callback para detalhes do produto (existente)
function theme_espingardaria_product_details_callback($post) {
    wp_nonce_field(\'theme_espingardaria_product_details\', \'theme_espingardaria_product_details_nonce\');
    $preco = get_post_meta($post->ID, \'_preco\', true);
    $preco_regular = get_post_meta($post->ID, \'_preco_regular\', true);
    $codigo = get_post_meta($post->ID, \'_codigo_produto\', true);
    $descricao_completa = get_post_meta($post->ID, \'_descricao_completa\', true);
    $especificacoes = get_post_meta($post->ID, \'_especificacoes\', true);
    $galeria = get_post_meta($post->ID, \'_galeria_produto\', true);
    
    // Campos de especificações
    $modelo = get_post_meta($post->ID, \'_modelo\', true);
    $comprimento_cano = get_post_meta($post->ID, \'_comprimento_cano\', true);
    $capacidade = get_post_meta($post->ID, \'_capacidade\', true);
    $peso = get_post_meta($post->ID, \'_peso\', true);
    $informacoes_diversas = get_post_meta($post->ID, \'_informacoes_diversas\', true);

    ?>
    <div class="theme-espingardaria-product-fields">
        <h4><?php esc_html_e(\'Informações Básicas
', \'theme-espingardaria\'); ?></h4>
        <p>
            <label for="preco"><?php esc_html_e(\'Preço de Venda
', \'theme-espingardaria\'); ?></label><br>
            <input type="text" id="preco" name="preco" value="<?php echo esc_attr($preco); ?>" style="width: 100%;">
            <span class="description"><?php esc_html_e(\'Preço atual do produto (ex: 1999.90)
', \'theme-espingardaria\'); ?></span>
        </p>
        <p>
            <label for="preco_regular"><?php esc_html_e(\'Preço Regular (Opcional)
', \'theme-espingardaria\'); ?></label><br>
            <input type="text" id="preco_regular" name="preco_regular" value="<?php echo esc_attr($preco_regular); ?>" style="width: 100%;">
            <span class="description"><?php esc_html_e(\'Preço original antes do desconto (ex: 2499.90)
', \'theme-espingardaria\'); ?></span>
        </p>
        <p>
            <label for="codigo_produto"><?php esc_html_e(\'Código do Produto
', \'theme-espingardaria\'); ?></label><br>
            <input type="text" id="codigo_produto" name="codigo_produto" value="<?php echo esc_attr($codigo); ?>" style="width: 100%;">
        </p>

        <h4><?php esc_html_e(\'Descrições e Especificações
', \'theme-espingardaria\'); ?></h4>
        <p>
            <label for="descricao_completa"><?php esc_html_e(\'Descrição Completa
', \'theme-espingardaria\'); ?></label><br>
            <?php wp_editor($descricao_completa, \'descricao_completa\', array(\'textarea_name\' => \'descricao_completa\', \'media_buttons\' => false, \'textarea_rows\' => 10)); ?>
        </p>
        <p>
            <label for="especificacoes"><?php esc_html_e(\'Especificações (Formato Livre)
', \'theme-espingardaria\'); ?></label><br>
            <?php wp_editor($especificacoes, \'especificacoes\', array(\'textarea_name\' => \'especificacoes\', \'media_buttons\' => false, \'textarea_rows\' => 10)); ?>
            <span class="description"><?php esc_html_e(\'Use este campo para especificações detalhadas se o formato livre for preferível.
', \'theme-espingardaria\'); ?></span>
        </p>
        
        <h4><?php esc_html_e(\'Especificações Estruturadas
', \'theme-espingardaria\'); ?></h4>
        <p>
            <label for="modelo"><?php esc_html_e(\'Modelo
', \'theme-espingardaria\'); ?></label><br>
            <input type="text" id="modelo" name="modelo" value="<?php echo esc_attr($modelo); ?>" style="width: 100%;">
        </p>
        <p>
            <label for="comprimento_cano"><?php esc_html_e(\'Comprimento do Cano
', \'theme-espingardaria\'); ?></label><br>
            <input type="text" id="comprimento_cano" name="comprimento_cano" value="<?php echo esc_attr($comprimento_cano); ?>" style="width: 100%;">
        </p>
        <p>
            <label for="capacidade"><?php esc_html_e(\'Capacidade
', \'theme-espingardaria\'); ?></label><br>
            <input type="text" id="capacidade" name="capacidade" value="<?php echo esc_attr($capacidade); ?>" style="width: 100%;">
        </p>
        <p>
            <label for="peso"><?php esc_html_e(\'Peso
', \'theme-espingardaria\'); ?></label><br>
            <input type="text" id="peso" name="peso" value="<?php echo esc_attr($peso); ?>" style="width: 100%;">
        </p>
        <p>
            <label for="informacoes_diversas"><?php esc_html_e(\'Informações Diversas
', \'theme-espingardaria\'); ?></label><br>
            <textarea id="informacoes_diversas" name="informacoes_diversas" rows="5" style="width: 100%;"><?php echo esc_textarea($informacoes_diversas); ?></textarea>
        </p>

        <h4><?php esc_html_e(\'Galeria de Imagens
', \'theme-espingardaria\'); ?></h4>
        <p>
            <label for="galeria_produto"><?php esc_html_e(\'IDs das Imagens da Galeria (separados por vírgula)
', \'theme-espingardaria\'); ?></label><br>
            <input type="text" id="galeria_produto" name="galeria_produto" value="<?php echo esc_attr($galeria); ?>" style="width: 100%;">
            <button type="button" class="button" id="upload_gallery_button"><?php esc_html_e(\'Selecionar Imagens
', \'theme-espingardaria\'); ?></button>
            <span class="description"><?php esc_html_e(\'Clique para abrir a biblioteca de mídia e selecione as imagens. Os IDs serão inseridos automaticamente.
', \'theme-espingardaria\'); ?></span>
        </p>
        <div id="gallery_preview"></div>
    </div>
    <script>
    jQuery(document).ready(function($){
        var frame;
        $(\'#upload_gallery_button\').on(\'click\', function(event){
            event.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: \'<?php esc_html_e("Selecionar Imagens da Galeria", "theme-espingardaria"); ?>\',
                button: { text: \'<?php esc_html_e("Usar estas imagens", "theme-espingardaria"); ?>\' },
                multiple: true
            });
            frame.on(\'select\', function(){
                var attachments = frame.state().get(\'selection\').map(function(attachment){
                    attachment.toJSON();
                    return attachment;
                });
                var ids = attachments.map(function(attachment){ return attachment.id; });
                $(\'#galeria_produto\').val(ids.join(\",\"));
                // Atualizar preview (opcional)
                $(\'#gallery_preview\').html(\'\');
                attachments.forEach(function(attachment){
                    $(\'#gallery_preview\').append(\'<img src="\'+attachment.attributes.url+\'" style="max-width:100px; height:auto; margin:5px;">\');
                });
            });
            frame.open();
        });
    });
    </script>
    <?php
}

// Callback para metabox de contato
function theme_espingardaria_product_contact_callback($post) {
    wp_nonce_field(\'theme_espingardaria_product_contact\', \'theme_espingardaria_product_contact_nonce\');
    $contact_email = get_post_meta($post->ID, \'_contato_email\', true);
    ?>
    <p>
        <label for="contato_email"><?php esc_html_e(\'E-mail para Contato:
', \'theme-espingardaria\'); ?></label><br>
        <input type="email" id="contato_email" name="contato_email" value="<?php echo esc_attr($contact_email); ?>" style="width: 100%;">
        <span class="description"><?php esc_html_e(\'E-mail que receberá as mensagens do formulário desta página.
', \'theme-espingardaria\'); ?></span>
    </p>
    <?php
}

// Salvar dados dos metaboxes
function theme_espingardaria_save_product_meta($post_id) {
    // Verifica nonce de detalhes
    if (!isset($_POST[\'theme_espingardaria_product_details_nonce\']) || !wp_verify_nonce($_POST[\'theme_espingardaria_product_details_nonce\'], \'theme_espingardaria_product_details\')) {
        return;
    }
    // Verifica nonce de contato
    if (!isset($_POST[\'theme_espingardaria_product_contact_nonce\']) || !wp_verify_nonce($_POST[\'theme_espingardaria_product_contact_nonce\'], \'theme_espingardaria_product_contact\')) {
        return;
    }
    
    if (defined(\'DOING_AUTOSAVE\') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can(\'edit_post\', $post_id)) {
        return;
    }

    // Salva campos de detalhes
    $fields_details = [\'preco\', \'preco_regular\', \'codigo_produto\', \'descricao_completa\', \'especificacoes\', \'galeria_produto\', \'modelo\', \'comprimento_cano\', \'capacidade\', \'peso\', \'informacoes_diversas\'];
    foreach ($fields_details as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, \'_\'.$field, sanitize_text_field($_POST[$field]));
        } else {
             delete_post_meta($post_id, \'_\'.$field);
        }
    }
    
    // Salva campo de e-mail de contato
    if (isset($_POST[\'contato_email\'])) {
        update_post_meta($post_id, \'_contato_email\', sanitize_email($_POST[\'contato_email\']));
    } else {
        delete_post_meta($post_id, \'_contato_email\');
    }
}
add_action(\'save_post_produto\', \'theme_espingardaria_save_product_meta\');

// --- AJAX Handler para Formulário de Contato do Produto ---
function theme_espingardaria_send_product_contact_email() {
    // 1. Verificar Nonce
    check_ajax_referer(\'product_contact_nonce\', \'product_contact_nonce_field\');

    // 2. Obter e Sanitizar Dados
    $product_id = isset($_POST[\'product_id\']) ? intval($_POST[\'product_id\']) : 0;
    $name = isset($_POST[\'contact_name\']) ? sanitize_text_field($_POST[\'contact_name\']) : \'\';
    $email = isset($_POST[\'contact_email\']) ? sanitize_email($_POST[\'contact_email\']) : \'\';
    $message = isset($_POST[\'contact_message\']) ? sanitize_textarea_field($_POST[\'contact_message\']) : \'\';

    // 3. Validação Básica
    if (empty($product_id) || empty($name) || !is_email($email) || empty($message)) {
        wp_send_json_error(array(\'message\' => esc_html__(\'Por favor, preencha todos os campos corretamente.\', \'theme-espingardaria\')));
        return;
    }

    // 4. Obter E-mail de Destino do Metabox
    $recipient_email = get_post_meta($product_id, \'_contato_email\', true);
    if (!is_email($recipient_email)) {
        // Se não houver e-mail no metabox, usa o e-mail do admin como fallback
        $recipient_email = get_option(\'admin_email\'); 
    }

    // 5. Obter Informações do Produto
    $product_title = get_the_title($product_id);
    $product_link = get_permalink($product_id);

    // 6. Montar E-mail
    $subject = sprintf(esc_html__(\'Contato sobre o produto: %s\', \'theme-espingardaria\'), $product_title);
    $body  = sprintf(esc_html__(\'Nome: %s\', \'theme-espingardaria\'), $name) . "\r\n";
    $body .= sprintf(esc_html__(\'E-mail: %s\', \'theme-espingardaria\'), $email) . "\r\n";
    $body .= sprintf(esc_html__(\'Produto: %s\', \'theme-espingardaria\'), $product_title) . "\r\n";
    $body .= sprintf(esc_html__(\'Link do Produto: %s\', \'theme-espingardaria\'), $product_link) . "\r\n\r\n";
    $body .= esc_html__(\'Mensagem:\', \'theme-espingardaria\') . "\r\n" . $message;

    $headers = array(\'Content-Type: text/plain; charset=UTF-8\', \'From: \' . $name . \' <\' . $email . \'>\', \'Reply-To: \' . $email);

    // 7. Enviar E-mail
    $sent = wp_mail($recipient_email, $subject, $body, $headers);

    // 8. Retornar Resposta
    if ($sent) {
        wp_send_json_success(array(\'message\' => esc_html__(\'Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.\', \'theme-espingardaria\')));
    } else {
        wp_send_json_error(array(\'message\' => esc_html__(\'Ocorreu um erro ao enviar sua mensagem. Tente novamente mais tarde.\', \'theme-espingardaria\')));
    }
}
add_action(\'wp_ajax_send_product_contact_email\', \'theme_espingardaria_send_product_contact_email\'); // Para usuários logados
add_action(\'wp_ajax_nopriv_send_product_contact_email\', \'theme_espingardaria_send_product_contact_email\'); // Para usuários não logados

// --- Outras Funções do Tema ---

// Incluir arquivos adicionais
require get_template_directory() . \'/inc/template-tags.php\';
require get_template_directory() . \'/inc/template-functions.php\';
require get_template_directory() . \'/inc/custom-header.php\';
require get_template_directory() . \'/inc/customizer.php\';
require get_template_directory() . \'/inc/class-bootstrap-5-nav-walker.php\';
require get_template_directory() . \'/inc/theme-options.php\'; // Painel de opções do tema

// Adicionar suporte a WooCommerce (se necessário)
// if (class_exists(\'WooCommerce\')) {
//     require get_template_directory() . \'/inc/woocommerce.php\';
// }

// Limpar head do WordPress
remove_action(\'wp_head\', \'rsd_link\');
remove_action(\'wp_head\', \'wlwmanifest_link\');
remove_action(\'wp_head\', \'wp_generator\');
remove_action(\'wp_head\', \'wp_shortlink_wp_head\');
remove_action(\'wp_head\', \'feed_links\', 2);
remove_action(\'wp_head\', \'feed_links_extra\', 3);

// Adicionar classe ao body
function theme_espingardaria_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = \'home\';
    }
    if (is_singular(\'produto\')) {
        $classes[] = \'single-product-page\';
    }
    return $classes;
}
add_filter(\'body_class\', \'theme_espingardaria_body_classes\');

// Excerpt com mais caracteres
function theme_espingardaria_custom_excerpt_length($length) {
    return 40;
}
add_filter(\'excerpt_length\', \'theme_espingardaria_custom_excerpt_length
', 999);

function theme_espingardaria_custom_excerpt_more($more) {
    return \'... <a class="read-more" href="\'. get_permalink(get_the_ID()) . \'">\' . __(\'Leia mais
', \'theme-espingardaria\') . \'</a>\';
}
add_filter(\'excerpt_more\', \'theme_espingardaria_custom_excerpt_more\');

?>

