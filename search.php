<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Subin\'s_Blog_V2
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    if ( have_posts() ) : ?>

      <header class="page-header content-box">
        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'subinsb-2' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        <?php get_search_form();?>
      </header><!-- .page-header -->

      <?php
      /* Start the Loop */
      while ( have_posts() ) : the_post();

        /**
         * Run the loop for the search to output the results.
         * If you want to overload this in a child theme then include a file
         * called content-search.php and that will be used instead.
         */
        get_template_part( 'template-parts/content', 'search' );

      endwhile;

      subinsb_2_paging_nav();

    else :

      get_template_part( 'template-parts/content', 'none' );

    endif; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
