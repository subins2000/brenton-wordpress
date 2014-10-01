<?php
/**
 * Subin's Blog V 1 functions and definitions
 *
 * @package Subin's Blog V 1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
 $content_width = 640; /* pixels */
}

if ( ! function_exists( 'subinsb_v1_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function subinsb_v1_setup() {

 /*
  * Make theme available for translation.
  * Translations can be filed in the /languages/ directory.
  * If you're building a theme based on Subin's Blog V 1, use a find and replace
  * to change 'subinsb-v1' to the name of your theme in all the template files
  */
 load_theme_textdomain( 'subinsb-v1', get_template_directory() . '/languages' );

 // Add default posts and comments RSS feed links to head.
 add_theme_support( 'automatic-feed-links' );

 /*
  * Enable support for Post Thumbnails on posts and pages.
  *
  * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
  */
 //add_theme_support( 'post-thumbnails' );

 // This theme uses wp_nav_menu() in one location.
 register_nav_menus( array(
  'primary' => __( 'Primary Menu', 'subinsb-v1' ),
 ) );

 // Enable support for Post Formats.
 add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

 // Setup the WordPress core custom background feature.
 add_theme_support( 'custom-background', apply_filters( 'subinsb_v1_custom_background_args', array(
  'default-color' => 'ffffff',
  'default-image' => '',
 ) ) );

 // Enable support for HTML5 markup.
 add_theme_support( 'html5', array(
  'comment-list',
  'search-form',
  'comment-form',
  'gallery',
 ) );
}
endif; // subinsb_v1_setup
add_action( 'after_setup_theme', 'subinsb_v1_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function subinsb_v1_widgets_init() {
 register_sidebar( array(
  'name'          => __( 'Sidebar', 'subinsb-v1' ),
  'id'            => 'sidebar-1',
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget'  => '</aside>',
  'before_title'  => '<h1 class="widget-title">',
  'after_title'   => '</h1>',
 ) );
}
add_action( 'widgets_init', 'subinsb_v1_widgets_init' );
/**
 * Load Ubuntu Font
 */
function subinsb_v1_font_url() {
 $font_url = '';
 if ( 'off' !== _x( 'on', 'Ubuntu font: on or off', 'twentyfourteen' ) ) {
  $font_url = add_query_arg( 'family', urlencode( 'Ubuntu' ), "//fonts.googleapis.com/css" );
 }
 return $font_url;
}
/**
 * Enqueue scripts and styles.
 */
function subinsb_v1_scripts() {
 wp_enqueue_style( 'subinsb-v1-style', get_stylesheet_uri() );
 wp_enqueue_style( 'subinsb-v1-font', subinsb_v1_font_url(), array(), null );
 if(!is_admin()){
  wp_deregister_script('jquery');
  wp_register_script('jquery', '', '', '', true);
 }
}
add_action( 'wp_enqueue_scripts', 'subinsb_v1_scripts' );

function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'subinsb-v1-font', subinsb_v1_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );
/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
/* Remove Fancy Quotes */
remove_filter('the_content', 'wptexturize');
remove_filter('comment_text', 'wptexturize');
remove_filter ('single_post_title', 'wptexturize');
remove_filter ('the_title', 'wptexturize');
remove_filter ('wp_title', 'wptexturize');

/*function pagesFeedRequest($qv) {
    if (isset($qv['feed']) && !isset($qv['post_type'])){
        $qv['post_type'] = array('post', 'page');
    }
    return $qv;
}
add_filter('request', 'pagesFeedRequest');*/