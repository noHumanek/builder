<?php
/**
 * builer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package builer
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function builer_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on builer, use a find and replace
		* to change 'builer' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'builer', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'builer' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'builer_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'builer_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function builer_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'builer_content_width', 640 );
}
add_action( 'after_setup_theme', 'builer_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function builer_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'builer' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'builer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'builer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function builer_scripts() {
	wp_enqueue_style( 'builer-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'builer-style', 'rtl', 'replace' );

	wp_enqueue_script( 'builer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'builer_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


    
function no_menu_slug_to_term_id($slug){  
    $menusArray =  wp_get_nav_menus();     
    foreach ($menusArray as $key=>$menu){
        //echo $menu->term_id." ".$menu->slug."<br>";
        if ($menu->slug==$menu->slug) 
            return $menu->term_id;
    }
    return null;
}


function no_menu_items($slug, $menu_item_parent=0){
    $menuitems = wp_get_nav_menu_items(no_menu_slug_to_term_id($slug), array( 'order' => 'DESC' ) );
    $items=[];
    foreach ($menuitems as $item){
        //echo $item->ID." ".$item->title." ".$item->menu_item_parent."<br>";    
        if ($item->menu_item_parent==$menu_item_parent) {
            $items[]=$item;
        }
    }    
    return $items;
}

function no_nav_menu($slug) {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
        $items=no_menu_items($slug, 0);
        foreach ($items as $item){  
            $sub_items=no_menu_items($slug, $item->ID);
            $active_class="";
            if ($actual_link==$item->url)
                $active_class="active";
            
            if (count($sub_items)==0){
                echo '<li class="nav-item" id="nav-item-'.$item->ID.'">';
                echo '  <a class="nav-link '.$active_class.'" aria-current="page" href="'.$item->url.'">'.$item->title.'</a>';
                echo '</li>';   
            }
            else {    
                echo '<li class="nav-item dropdown">';
                echo '  <a class="nav-link dropdown-toggle '.$active_class.'" href="'.$item->url.'" id="navbarDropdown'.$item->ID.'" role="button" data-bs-toggle="dropdown" aria-expanded="false">'.$item->title.'</a>';

                echo ' <ul class="dropdown-menu" aria-labelledby="navbarDropdown'.$item->ID.'">';
                foreach ($sub_items as $sub_item){
                    $active_class="";
                    if ($actual_link==$sub_item->url)
                        $active_class="active";                    
                    
                    echo '<li><a class="dropdown-item '.$active_class.'" href="'.$sub_item->url.'">'.$sub_item->title.'</a></li>';
                }        
                echo " </ul>";
               echo " </li>";
            }
        }
    echo '</ul>';    
}