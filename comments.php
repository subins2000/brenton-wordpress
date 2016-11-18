<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Subin's Blog V 1
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area content-box">
 <?php if (comments_open()) : ?>
  <div id="disqus_thread"><p style="color:black;"></p></div>
  <script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'subinsblog'; // Required - Replace example with your forum shortname
    var disqus_url = '<?php echo str_replace('https://', 'http://', get_permalink());?>';
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//go.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
  </script>
  <noscript>Please enable JavaScript to view the comments</noscript>
 <?php endif; // comments_open ?>
</div><!-- #comments -->
