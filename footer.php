<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Subin's Blog V 1
 */
?>
  </div><!-- .container -->
 </div><!-- #content -->
</div><!-- #page -->
<footer id="colophon" class="site-footer" role="contentinfo">
 <div class="site-info">
  <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'subinsb-v1' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'subinsb-v1' ), 'WordPress' ); ?></a>
  <span class="sep"> | </span>
  &copy; Copyright Subin Siby 2011-14
 </div><!-- .site-info -->
</footer><!-- #colophon -->
<svg style="display:none;">
 <defs>
  <path id="shape-tab" d="M100,25C79.568,25,84.815,0,59.692,0H11.149C5.027,0,0,4.634,0,10.385V25"></path>
  <path id="shape-tab-right" d="M0,25C20.432,25,15.185,0,40.308,0h48.543C94.973,0,100,4.634,100,10.385V25"></path>
   <path id="shape-search" d="M3.327,96.684C5.534,98.895,8.434,100,11.331,100s5.797-1.105,8.004-3.316l21.321-21.322
   c5.83,3.188,12.393,4.897,19.223,4.897c10.721,0,20.798-4.172,28.379-11.752c15.646-15.644,15.646-41.105,0.002-56.755
   C80.677,4.171,70.598,0,59.877,0C49.159,0,39.08,4.171,31.504,11.752c-7.581,7.576-11.756,17.655-11.756,28.376
   c0,6.832,1.71,13.396,4.9,19.226L3.327,80.675C-1.096,85.094-1.096,92.266,3.327,96.684z M59.879,68.938
   c-7.695,0-14.93-2.996-20.371-8.435c-5.443-5.442-8.439-12.677-8.439-20.375c0-7.695,2.996-14.933,8.439-20.372
   c5.441-5.44,12.676-8.436,20.369-8.436c7.698,0,14.936,2.997,20.378,8.436c11.231,11.236,11.231,29.515,0,40.747
   C74.812,65.941,67.575,68.938,59.879,68.938z"></path>
 </defs>
</svg>
<?php wp_footer(); ?>
</body>
</html>
