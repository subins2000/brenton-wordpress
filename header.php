<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Subin\'s_Blog_V2
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500' rel='stylesheet' type='text/css' async='async'>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <header id="masthead" class="site-header" role="banner">
    <div class="site-branding">
      <?php
      if ( is_front_page() && is_home() ) : ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
      <?php else : ?>
        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
      <?php
      endif;

      $description = get_bloginfo( 'description', 'display' );
      if ( $description || is_customize_preview() ) : ?>
        <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
      <?php
      endif; ?>
    </div><!-- .site-branding -->
    <svg viewBox="0 0 100 100" id="search-toggle" onclick="toggleSearchForm()">
      <use xlink:href="#shape-search"></use>
    </svg>
    <form id="search-form" class="content-wrapper <?php if(isset($_GET['s'])){ echo "active"; }?>" action="/">
      <input type="search" name="s" class="search-field" placeholder="Type Here..." value="<?php if(isset($_GET['s'])){ echo htmlspecialchars($_GET['s']); }?>" />
      <button type="submit">Search</button>
      <script>
        window.toggleSearchForm = function(){
          el = document.getElementById("search-form");
          cn = "active";
          if(el.className.match(cn)) {
            el.className = 'content-wrapper';
          }else {
            el.className = 'content-wrapper ' + cn;
            el.querySelector("input").focus();
          }
        };
      </script>
    </form>
    <nav id="site-navigation" class="main-navigation content-wrapper" role="navigation">
      <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    </nav><!-- #site-navigation -->
  </header><!-- #masthead -->

  <div id="content" class="site-content content-wrapper">
