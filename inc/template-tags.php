<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Subin's Blog V 1
 */

if ( ! function_exists( 'subinsb_v1_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function subinsb_v1_paging_nav() {
 // Don't print empty markup if there's only one page.
 if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
  return;
 }
 ?>
 <nav class="navigation paging-navigation" role="navigation">
  <div class="nav-links">

   <?php if ( get_next_posts_link() ) : ?>
   <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'subinsb-v1' ) ); ?></div>
   <?php endif; ?>

   <?php if ( get_previous_posts_link() ) : ?>
   <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'subinsb-v1' ) ); ?></div>
   <?php endif; ?>

  </div><!-- .nav-links -->
 </nav><!-- .navigation -->
 <?php
}
endif;

if ( ! function_exists( 'subinsb_v1_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function subinsb_v1_post_nav() {
 // Don't print empty markup if there's nowhere to navigate.
 $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
 $next     = get_adjacent_post( false, '', false );

 if ( ! $next && ! $previous ) {
  return;
 }
 ?>
 <nav class="navigation post-navigation" role="navigation">
  <div class="nav-links">
   <?php
    previous_post_link( '<div class="nav-previous"><div>Previous Post</div>%link</div>', _x( ' %title', 'Previous post link', 'subinsb-v1' ) );
    next_post_link(     '<div class="nav-next"><div>Next Post</div>%link</div>',     _x( '%title', 'Next post link',     'subinsb-v1' ) );
   ?>
  </div><!-- .nav-links -->
 </nav><!-- .navigation -->
 <?php
}
endif;

if ( ! function_exists( 'subinsb_v1_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function subinsb_v1_posted_on($short=false) {
 $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
 if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) && !$short) {
  $time_string .= '<br/>Updated <time class="updated" datetime="%3$s">%4$s</time>';
 }
 $time_string = sprintf( $time_string,
  esc_attr( get_the_date( 'c' ) ),
  esc_html( get_the_date() ),
  esc_attr( get_the_modified_date( 'c' ) ),
  esc_html( get_the_modified_date() )
 );
 if(!$short){
  printf( __( '<span class="posted-on">Published %1$s</span><span class="byline"> by %2$s</span>', 'subinsb-v1' ),
   sprintf( '%2$s',
    esc_url( get_permalink() ),
    $time_string
   ),
   sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_html( get_the_author() )
   )
  );
 }else{
  printf( __( '<span class="posted-on">%1$s</span>', 'subinsb-v1' ),
   sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
    esc_url( get_permalink() ),
    $time_string
   )
  );
 }
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function subinsb_v1_categorized_blog() {
 if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
  // Create an array of all the categories that are attached to posts.
  $all_the_cool_cats = get_categories( array(
   'fields'     => 'ids',
   'hide_empty' => 1,
   
   // We only need to know if there is more than one category.
   'number'     => 2,
  ) );

  // Count the number of categories that are attached to the posts.
  $all_the_cool_cats = count( $all_the_cool_cats );

  set_transient( 'all_the_cool_cats', $all_the_cool_cats );
 }

 if ( $all_the_cool_cats > 1 ) {
  // This blog has more than 1 category so subinsb_v1_categorized_blog should return true.
  return true;
 } else {
  // This blog has only 1 category so subinsb_v1_categorized_blog should return false.
  return false;
 }
}

/**
 * Flush out the transients used in subinsb_v1_categorized_blog.
 */
function subinsb_v1_category_transient_flusher() {
 // Like, beat it. Dig?
 delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'subinsb_v1_category_transient_flusher' );
add_action( 'save_post',     'subinsb_v1_category_transient_flusher' );
