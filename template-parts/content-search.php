<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brenton 
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( "summary content-box"); ?>>
  <header class="entry-header">
    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

    <?php if ( 'post' === get_post_type() ) : ?>
      <div class="entry-meta">
        <?php
        brenton_posted_on(true);
        brenton_comments_count();
        $categories_list = get_the_category_list( __( ', ', 'brenton' ) );
        if($categories_list && brenton_categorized_blog()){
        ?>
          <span class="cat-links post-nav-item"><?php 
          printf( __( '%1$s', 'brenton' ), $categories_list );
          ?></span>
        <?php
        }
        ?>
      </div>
    <?php endif; ?>
  </header><!-- .entry-header -->

  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->
</article><!-- #post-## -->
