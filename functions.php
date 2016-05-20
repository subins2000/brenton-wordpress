<?php
/**
 * Subin\'s Blog V2 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Subin\'s_Blog_V2
 */

if ( ! function_exists( 'subinsb_2_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function subinsb_2_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on Subin\'s Blog V2, use a find and replace
   * to change 'subinsb-2' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'subinsb-2', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary', 'subinsb-2' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  /*
   * Enable support for Post Formats.
   * See https://developer.wordpress.org/themes/functionality/post-formats/
   */
  add_theme_support( 'post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'subinsb_2_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
}
endif;
add_action( 'after_setup_theme', 'subinsb_2_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function subinsb_2_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'subinsb_2_content_width', 640 );
}
add_action( 'after_setup_theme', 'subinsb_2_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function subinsb_2_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'subinsb-2' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'subinsb-2' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'subinsb_2_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function subinsb_2_scripts() {
  wp_enqueue_style( 'subinsb-2-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'subinsb_2_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function nav_parent_class( $classes, $item ) {
    if($item->menu_item_parent == 0){
      $classes[] = "current-menu-parent";
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'nav_parent_class', 10, 2 );

// This function adds nice anchor with id attribute to our h2 tags for reference
// @link: http://www.w3.org/TR/html4/struct/links.html#h-12.2.3
function anchor_content_headings($content) {
    // now run the pattern and callback function on content
    // and process it through a function that replaces the title with an id 
    $content = preg_replace_callback("/\<h([1|2|3])\>(.*?)\<\/h([1|2|3])\>/", function ($matches) {
      $hTag = $matches[1];
      $title = $matches[2];
      $slug = "article-" . sanitize_title_with_dashes($title);
      return '<a href="#'. $slug .'"><h'. $hTag .' id="' . $slug . '">' . $title . '</h'. $hTag .'></a>';
    }, $content);
    return $content;
}
add_filter('the_content', 'anchor_content_headings');

/**
 * Remove unwanted stuff
 */
function wpdocs_dequeue_script() {
        wp_dequeue_script( 'jquery' ); 
} 
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );
