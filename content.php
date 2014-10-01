<?php
/**
 * @package Subin's Blog V 1
 */
?>
<article id="post-<?php the_ID(); ?>" <?post_class("summary");?>>
 <time><?php subinsb_v1_posted_on(true); ?></time>
 <?php edit_post_link( __( 'Edit', 'subinsb-v1' ), '<span class="edit-link">', '</span>' ); 
 if('post' == get_post_type()){
  $categories_list = get_the_category_list( __( ', ', 'subinsb-v1' ) );
  if($categories_list && subinsb_v1_categorized_blog()){
 ?>
   <div class="cat-links">
    <?php printf( __( '%1$s', 'subinsb-v1' ), $categories_list ); ?>
   </div>
 <?
  }
  $tags_list = get_the_tag_list( '', __( ', ', 'subinsb-v1' ) );
  if($tags_list){
 ?>
   <div class="tags-links">
    <?php printf( __( '%1$s', 'subinsb-v1' ), $tags_list ); ?>
   </div>
 <?
  }
 }
 ?>
 <a class="entry-title" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
 <?
 if ( is_search() || is_home() || is_author() || is_category() || is_archive() ){?>
  <div class="entry-summary">
    <?php the_excerpt();?>
  </div><!-- .entry-summary -->
  <p>
   <a href="<?the_permalink();?>">Read Article <span class="meta-nav">&rarr;</span></a>
  </p>
 <?}else{?>
  <div class="entry-content">
   <?php the_content(); ?>
  </div><!-- .entry-content -->
 <?}?>
 <footer class="entry-footer">
  
 </footer><!-- .entry-footer -->
</article><!-- #post-## -->
