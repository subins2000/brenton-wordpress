<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Subin\'s_Blog_V2
 */

if ( ! function_exists( 'subinsb_2_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function subinsb_2_posted_on($short=false) {
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
  if(!$short) {
    printf( __( '<span class="posted-on">Published %1$s</span>', 'subinsb-2' ),
      sprintf( '%2$s',
         esc_url( get_permalink() ),
         $time_string
       )
    );
  } else {
    printf( __( '<span class="posted-on">%1$s</span>', 'subinsb-2' ),
      sprintf( '<a href="%1$s" rel="bookmark" class="post-nav-item">%2$s</a>',
         esc_url( get_permalink() ),
         $time_string
       )
    );
  }
}
endif;

if ( ! function_exists( 'subinsb_2_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function subinsb_2_entry_footer() {
  // Hide category and tag text for pages.
  if ( 'post' === get_post_type() ) {
    /* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list( esc_html__( ', ', 'subinsb-2' ) );
    if ( $categories_list && subinsb_2_categorized_blog() ) {
      printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'subinsb-2' ) . '</span>', $categories_list ); // WPCS: XSS OK.
    }

    /* translators: used between list items, there is a space after the comma */
    $tags_list = get_the_tag_list( '', esc_html__( ', ', 'subinsb-2' ) );
    if ( $tags_list ) {
      printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'subinsb-2' ) . '</span>', $tags_list ); // WPCS: XSS OK.
    }
  }

  if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
    echo '<span class="comments-link">';
    /* translators: %s: post title */
    comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'subinsb-2' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
    echo '</span>';
  }

  edit_post_link(
    sprintf(
      /* translators: %s: Name of current post */
      esc_html__( 'Edit %s', 'subinsb-2' ),
      the_title( '<span class="screen-reader-text">"', '"</span>', false )
    ),
    '<span class="edit-link">',
    '</span>'
  );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function subinsb_2_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'subinsb_2_categories' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
      'fields'     => 'ids',
      'hide_empty' => 1,
      // We only need to know if there is more than one category.
      'number'     => 2,
    ) );

    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'subinsb_2_categories', $all_the_cool_cats );
  }

  if ( $all_the_cool_cats > 1 ) {
    // This blog has more than 1 category so subinsb_2_categorized_blog should return true.
    return true;
  } else {
    // This blog has only 1 category so subinsb_2_categorized_blog should return false.
    return false;
  }
}

/**
 * Flush out the transients used in subinsb_2_categorized_blog.
 */
function subinsb_2_category_transient_flusher() {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  // Like, beat it. Dig?
  delete_transient( 'subinsb_2_categories' );
}
add_action( 'edit_category', 'subinsb_2_category_transient_flusher' );
add_action( 'save_post',     'subinsb_2_category_transient_flusher' );

if(!function_exists("subinsb_v1_breadcrumbs")){
  function subinsb_2_breadcrumbs(){
    $cats = get_the_category(); //retrieve cats for post
    
    foreach ($cats as $cat) { //go thru to find child one - means cat which has specified parent id
        if ($cat->category_parent != 0) {
            $child = $cat->term_taxonomy_id;
        }
    }
    $parents = get_category_parents( $child, TRUE, ' » ' );
    if(is_string($parents)){
      echo "<p>". $parents . get_the_title() . "</p>";
    }
  }
}

if ( ! function_exists( 'subinsb_2_paging_nav' ) ) :
  /**
   * Display navigation to next/previous set of posts when applicable.
   *
   * @return void
   */
  function subinsb_2_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
      return;
    }
    $wp_query = $GLOBALS['wp_query'];
    ?>
    <nav class="navigation paging-navigation content-box" role="navigation">
      <div class="nav-links">
       <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'subinsb-2' ) ); ?></div>
       <?php endif; ?>
    
       <?php if ( get_previous_posts_link() ) : ?>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'subinsb-2' ) ); ?></div>
       <?php endif; ?>
      </div><!-- .nav-links -->
    </nav><!-- .navigation -->
   <?php
  }
endif;

if ( ! function_exists( 'subinsb_2_post_nav' ) ) :
  /**
   * Display navigation to next/previous post when applicable.
   *
   * @return void
   */
  function subinsb_2_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );
  
    if ( ! $next && ! $previous ) {
      return;
    }
   ?>
    <nav id="post-navigation" class="content-box" role="navigation">
      <div class="nav-links">
      <?php
      previous_post_link( '<div class="nav-previous"><div>Previous Post</div>%link</div>', _x( ' %title', 'Previous post link', 'subinsb-2' ) );
      next_post_link(     '<div class="nav-next"><div>Next Post</div>%link</div>',     _x( '%title', 'Next post link',     'subinsb-2' ) );
      ?>
      </div><!-- .nav-links -->
    </nav><!-- .navigation -->
   <?php
  }
endif;

if(!function_exists("subinsb_2_post_social")){
  function subinsb_2_post_social(){
    ?>
    <div id="post-social" class="content-box">
      <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo the_permalink();?>&width=50&layout=box_count&action=like&show_faces=true&share=true&height=65&appId=205948326169147" width="50" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" width="50" height="60"></iframe>
      <iframe src="https://plusone.google.com/_/+1/fastbutton?bsv&size=tall&hl=en-US&url=<?php echo the_permalink();?>&parent=<?php echo site_url();?>" allowtransparency="true" frameborder="0" scrolling="no" title="+1" width="50" height="65"></iframe>
      <iframe src="https://platform.twitter.com/widgets/tweet_button.html?url=<?php echo the_permalink();?>&count=vertical&size=large" frameborder="0" height="30" width="62"></iframe>
      <script>reddit_url='<?php echo the_permalink();?>';</script>
      <script type="text/javascript" src="//www.redditstatic.com/button/button3.js"></script>
    </div>
    <?php
  }
}

if(!function_exists("subinsb_2_comments_count")){
  function subinsb_2_comments_count(){
    echo is_single() ? '<a href="#disqus_thread" class="post-nav-item"></a>' : '<a href="'. get_permalink() .'#disqus_thread" class="post-nav-item"></a>';
  }
}
