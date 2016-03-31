<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Subin\'s_Blog_V2
 */

?>

  </div><!-- #content -->

  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
      <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'subinsb-2' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'subinsb-2' ), 'WordPress' ); ?></a>
      <span class="sep"> | </span>
      <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'subinsb-2' ), 'subinsb-2', '<a href="http://subinsb.com" rel="designer">Subin Siby</a>' ); ?>
    </div><!-- .site-info -->
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
