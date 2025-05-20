<?php
/**
 * Template para exibir conteúdo quando nenhum post é encontrado
 *
 * @package Theme_Espingardaria
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Nada Encontrado', 'theme-espingardaria'); ?></h1>
    </header>

    <div class="page-content">
        <?php if (is_search()) : ?>
            <p><?php esc_html_e('Desculpe, mas nada corresponde aos seus termos de pesquisa. Por favor, tente novamente com algumas palavras-chave diferentes.', 'theme-espingardaria'); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php esc_html_e('Parece que não conseguimos encontrar o que você está procurando. Talvez a pesquisa possa ajudar.', 'theme-espingardaria'); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>
