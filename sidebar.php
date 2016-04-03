<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Subin\'s_Blog_V2
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
  return;
}
register_sidebar(array(
    'id' => 'sidebar-1',
    'name' => 'Sidebar (Main)',
    'description' => 'Primary sidebar',
    'before_widget' => '<div id="%1$s" class="widget content-box %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
    'class' => 'clearfix'
));
?>

<aside id="secondary" class="widget-area" role="complementary">
  <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
