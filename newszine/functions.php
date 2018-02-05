<?php
/**
 * newszine functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package newszine
 */

if ( ! function_exists( 'newszine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function newszine_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on newszine, use a find and replace
	 * to change 'newszine' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'newszine', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_image_size( 'newszine-blog-thumb', 800, 500, true); // Archive and Search Pages
	add_image_size( 'newszine-post-thumb', 930, 450, true); // Single Post and Pages
	add_image_size( 'newszine-thumbnail', 400, 400, true); // homepage thumbnail
	


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
		'primary' => esc_html__( 'Primary', 'newszine' ),
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
    
     /*
	 * Enable support for Custom Logo.
	 */
    add_theme_support( 'custom-logo', array(
      'height'      => 45,
      'width'       => 200,
      'flex-height' => true,
      'flex-width'  => true,  
    ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'newszine_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'newszine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newszine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'newszine_content_width', 640 );
}
add_action( 'after_setup_theme', 'newszine_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newszine_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'newszine' ),
        'id'            =>'sidebar-1',
		'description'   => '',
		'before_widget' => '<div class="block">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="block-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget Area', 'newszine' ),		
		'id'            => 'newszine-home',
		'description'   => '',
		'before_widget' => '<div class="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="block-title">',
		'after_title'   => '</h2>',
	) );
       
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area Left', 'newszine' ),
		'id'            => 'footer-left',
		'description'   => '',
		'before_widget' => '<div class="logo">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="single-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area Middle Section one', 'newszine' ),
		'id'            => 'footer-middle',
		'description'   => '',
		'before_widget' => '<div class="single">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="single-title">',
		'after_title'   => '</h3>',
	) );
    	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area Middle Section Two', 'newszine' ),
		'id'            => 'footer-middle2',
		'description'   => '',
		'before_widget' => '<div class="single">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="single-title">',
		'after_title'   => '</h3>',
	) );
    	register_sidebar( array(
		'name'          => esc_html__( 'Footer Area Right', 'newszine' ),
		'id'            => 'footer-right',
		'description'   => '',
		'before_widget' => '<div class="single">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="single-title">',
		'after_title'   => '</h3>',
	) );
    	register_sidebar( array(
		'name'          => esc_html__( 'Header Advertisement', 'newszine' ),
		'id'            => 'header_advertisment',
		'description'   => '',
		'before_widget' => '<div class="top-ad hidden-xs">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
    	register_sidebar( array(
		'name'          => esc_html__( 'Single Page Advertisement', 'newszine' ),
		'id'            => 'single_page_advertisment',
		'description'   => '',
		'before_widget' => '<div class="block">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
    	register_sidebar( array(
		'name'          => esc_html__( 'Single Post Advertisement', 'newszine' ),
		'id'            => 'single_post_advertisment',
		'description'   => '',
		'before_widget' => '<div class="block">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'newszine_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function newszine_scripts() {
	wp_enqueue_style( 'newszine-style', get_stylesheet_uri() );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/css/font-awesome.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css' );
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri().'/css/owl.carousel.css' );
	wp_enqueue_style( 'owl.theme', get_template_directory_uri().'/css/owl.theme.css' );
	wp_enqueue_style( 'newszine-styles', get_template_directory_uri().'/css/custom.css' );	
         add_editor_style( 'custom-css', get_template_directory_uri().'/css/custom.css' );
    
    
	wp_enqueue_script( 'newszine-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'newszine-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array(), '1.0.0', true );
	wp_enqueue_script( 'smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.js', array(), '1.0.0', true );
	wp_enqueue_script( 'carousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '1.0.0', true );		
	wp_enqueue_script( 'newszine-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'homescript', get_template_directory_uri() . '/js/home.js', array('jquery'), '1.0.0', true );
  
    if(is_rtl()) {
		wp_enqueue_style( 'newszine-rtl-css', get_template_directory_uri().'/css/custom-rtl.css' );
        wp_enqueue_style( 'newszine-style-rtl-css', get_template_directory_uri().'/style-rtl.css' );
        wp_enqueue_style( 'newszine-font-awesome-rtl-css', get_template_directory_uri().'/css/font-awesome-rtl.css' );        
        wp_enqueue_style( 'newszine-responsive-rtl-css', get_template_directory_uri().'/css/responsive-rtl.css' );
		wp_enqueue_style( 'bootstrap-css-rtl-css', get_template_directory_uri().'/css/bootstrap-rtl.css' );
		wp_enqueue_script( 'bootstrap-js-rtl-js', get_template_directory_uri() . '/js/bootstrap-rtl.js', array(), '1.0.0', true );
	}

	// get localize user options
	$options = array();
	$options['home_url'] = esc_url(home_url('/'));
	wp_localize_script( 'newszine-script', 'newszine_options', $options );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newszine_scripts' );

function newszine_exrcept($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

/**
 * Custom Widget.
 */
require get_template_directory() . '/widget/widgets.php';
require get_template_directory() . '/widget/newszine.php';
require get_template_directory() . '/widget/latest.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load navwalker file.
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
