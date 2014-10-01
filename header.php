<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Subin's Blog V 1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
 <header id="masthead" class="site-header" role="banner">
  <div class="site-title">
   <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
  </div>
  <form id="search-form" action="http://subinsb.com">
   <label id="search-label">
    <svg viewBox="0 0 100 100" class="shape-search">
     <use xlink:href="#shape-search"></use>
    </svg>
    <input autocomplete="off" type="search" name="s" class="search-field" value="<?if(isset($_GET['s'])){echo $_GET['s'];}?>" />
    <input type="submit" value="Search" class="screen-reader" />
   </label>
   <p class="description"><?echo get_bloginfo('description');?></p>
  </form>
 </header><!-- #masthead -->
 <nav id="site-navigation" class="main-navigation" role="navigation">
  <span class="blog top">
   <a href="http://subinsb.com">Blog</a>
   <div>
    <span><a href="http://subinsb.com/about">About</a></span>
    <span><a href="http://subinsb.com/donate">Donate</a></span>
   </div>
  </span>
  <span class="projects top">
   <a>Projects</a>
   <div>
    <span><a href="http://search.subinsb.com">Web Search</a></span>
    <span><a href="http://open.subinsb.com">Open</a></span>
    <span><a href="http://demos.subinsb.com">Subin's Lab</a></span>
   </div>
  </span>
  <span class="web top">
   <a>Web</a>
   <div>
    <span><a href="http://subinsb.com/category/html">HTML</a></span>
    <span><a href="http://subinsb.com/category/css">CSS</a></span>
    <span><a href="http://subinsb.com/category/php">PHP</a></span>
    <span><a href="http://subinsb.com/category/javascript">JavaScript</a></span>
    <span><a href="http://subinsb.com/category/jquery">jQuery</a></span>
   </div>
  </span>
  <span class="ask top">
   <a href="http://subinsb.com/ask">Ask</a>
   <div>
    <span><a href="http://subinsb.com/ask/code-blocks">Code Blocks</a></span>
    <span><a href="http://subinsb.com/ask/blogger-2-wordpress">Blogger 2 WP</a></span>
    <span><a href="http://subinsb.com/ask/php-logsys">PHP logSys</a></span>
   </div>
  </span>
  <span class="os top">
   <a>OS</a>
   <div>
    <span><a href="http://subinsb.com/category/linux">Linux</a></span>
    <span><a href="http://subinsb.com/category/ubuntu">Ubuntu</a></span>
    <span><a href="http://subinsb.com/category/windows">Windows</a></span>
    <span><a href="http://subinsb.com/category/mac">Mac</a></span>
   </div>
  </span>
  <span class="blogging top">
   <a>Blogging</a>
   <div>
    <span><a href="http://subinsb.com/category/blogger">Blogger</a></span>
    <span><a href="http://subinsb.com/category/wordpress">WordPress</a></span>
   </div>
  </span>
 </nav><!-- #site-navigation -->
 <div id="content" class="site-content">
  <div class="container">
   <?
   if(is_single()){
   ?>
    <div class="single-header">
     <h1 class="entry-title"><a href="<?the_permalink();?>"><?the_title();?></a></h1>
     <div class="entry-meta">
      <?edit_post_link( __( 'Edit', 'subinsb-v1' ), '<span class="edit-link">', '</span>' );?>
      <?php subinsb_v1_posted_on(); ?>
      <div>
     <?
     if('post' == get_post_type()){
       $categories_list = get_the_category_list( __( ', ', 'subinsb-v1' ) );
      if($categories_list && subinsb_v1_categorized_blog()){
     ?>
       <div class="cat-links" title="Categories">
        <?php printf( __( '%1$s', 'subinsb-v1' ), $categories_list ); ?>
       </div>
     <?
      }
      $tags_list = get_the_tag_list( '', __( ', ', 'subinsb-v1' ) );
      if($tags_list){
     ?>
       <div class="tags-links" title="Tags">
        <?php printf( __( '%1$s', 'subinsb-v1' ), $tags_list ); ?>
       </div>
      <?
       }
      }
      ?>
      </div>
     </div><!-- .entry-meta -->
    </div>
   <?}?>