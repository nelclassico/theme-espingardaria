<?php
/**
 * Template para a barra lateral
 *
 * @package Theme_Espingardaria
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>
