<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Subin\'s_Blog_V2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( (!is_single() ? "summary " : "") . "content-box"); ?>>
  <header class="entry-header">
    <?php
      if ( !is_single() ) {
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        if ( 'post' === get_post_type() ){ ?>
          <div class="entry-meta">
            <?php
            subinsb_2_posted_on(true);
            subinsb_2_comments_count();
            $categories_list = get_the_category_list( __( ', ', 'subinsb-2' ) );
            if($categories_list && subinsb_2_categorized_blog()){
            ?>
              <span class="cat-links post-nav-item"><?php 
              printf( __( '%1$s', 'subinsb-2' ), $categories_list );
              ?></span>
            <?php
            }
            ?>
          </div>
        <?php
        }
      }
    ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php
      if(is_single()){
        the_content();
      }else{
        the_excerpt();
      }
    ?>
  </div><!-- .entry-content -->
</article><!-- #post-## -->
