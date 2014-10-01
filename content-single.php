<?php
/**
 * @package Subin's Blog V 1
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("single"); ?>>
 <div class="entry-content">
  <?php the_content(); ?>
  <?php
   wp_link_pages( array(
    'before' => '<div class="page-links">' . __( 'Pages:', 'subinsb-v1' ),
    'after'  => '</div>',
   ) );
  ?>
 </div><!-- .entry-content -->
</article><!-- #post-## -->
