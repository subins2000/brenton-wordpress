<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Subin\'s_Blog_V2
 */

get_header();
?>
  <div id="single-header">
    <h1 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
    <div class="entry-meta">
      <?php edit_post_link( __( 'Edit', 'subinsb-2' ), '<span class="edit-link">', '</span><br/>' ); ?>
      <?php
      subinsb_2_breadcrumbs();
      subinsb_2_posted_on();echo "<br/>";
      subinsb_2_comments_count();
      ?>
      <div>
        <?php
        if('post' == get_post_type()){
          $tags_list = get_the_tag_list( '', __( ', ', 'subinsb-2' ) );
          if($tags_list){
        ?>
          <div class="tags-links" title="Tags">
            <?php printf( __( '%1$s', 'subinsb-2' ), $tags_list ); ?>
          </div>
        <?php
          }
        }
        ?>
      </div>
    </div><!-- .entry-meta -->
  </div>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    while ( have_posts() ) : the_post();

      get_template_part( 'template-parts/content', get_post_format() );
      
      subinsb_2_post_social();
      
      subinsb_2_post_nav();

      comments_template();

    endwhile; // End of the loop.
    ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
