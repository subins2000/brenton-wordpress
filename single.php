<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Brenton 
 */

get_header();
?>
  <div id="single-header">
    <h1 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
    <div class="entry-meta">
      <?php
      brenton_breadcrumbs();
      ?>
      <p>
        <?php
        if('post' == get_post_type()){
          $tags_list = get_the_tag_list( '', __( ', ', 'brenton' ) );
          if($tags_list){
        ?>
          <div class="tags-links" title="Tags">
            <?php printf( __( '%1$s', 'brenton' ), $tags_list ); ?>
          </div>
        <?php
          }
        }
        ?>
      </p>
      <?php
      brenton_posted_on();
      brenton_comments_count();
      ?>
    </div><!-- .entry-meta -->
  </div>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    while ( have_posts() ) : the_post();

      get_template_part( 'template-parts/content', get_post_format() );
      
      brenton_post_social();
      
      brenton_post_nav();

      comments_template();

    endwhile; // End of the loop.
    ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
