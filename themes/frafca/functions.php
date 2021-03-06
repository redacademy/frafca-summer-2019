<?php

/**
 * FRAFCA Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FRAFCA_Theme
 */

if (!function_exists('frafca_theme_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function frafca_theme_setup()
	{
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		// Let WordPress manage the document title.
		add_theme_support('title-tag');

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'Mobile-Header-Menu' => esc_html('Mobile-Header-Menu'),
			'Header-Menu' => esc_html('Header-Menu'),
			'Side-Header-Menu' => esc_html('Side-Header-Menu'),
			'footer_connect' => esc_html('Footer Menu - Connect'),
			'footer_get_involved' => esc_html('Footer Menu - Get Invloved'),
			'footer_what_we_do' => esc_html('Footer Menu - What We Do'),
		));

		// Switch search form, comment form, and comments to output valid HTML5.
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));
	}
endif; // frafca_theme_setup
add_action('after_setup_theme', 'frafca_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function frafca_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('frafca_theme_content_width', 640);
}
add_action('after_setup_theme', 'frafca_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function frafca_theme_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html('Sidebar'),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'frafca_theme_widgets_init');

/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function frafca_theme_minified_css($stylesheet_uri, $stylesheet_dir_uri)
{
	if (file_exists(get_template_directory() . '/build/css/style.min.css')) {
		$stylesheet_uri = $stylesheet_dir_uri . '/build/css/style.min.css';
	}

	return $stylesheet_uri;
}
add_filter('stylesheet_uri', 'frafca_theme_minified_css', 10, 2);

/**
 * Enqueue scripts and styles.
 */
function frafca_theme_scripts()
{
	// Google Fonts
	wp_enqueue_style('google-fonts-style', 'https://fonts.googleapis.com/css?family=Merriweather:700|Raleway:400,700&display=swap');
	/* Font Awesome for Icons */
	wp_enqueue_style('custom-fa', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css');

	// Scripts for FRAFCA theme
	wp_enqueue_script('frafca-hamburger-animations', get_template_directory_uri() . '/build/js/hamburger-animations.min.js', array('jquery'), '', true);
	wp_enqueue_script('frafca-footer-navigation-animations', get_template_directory_uri() . '/build/js/footer-navigation-animations.min.js', array('jquery'), '', true);
	wp_enqueue_script('frafca-show-sub-menu-on-hover', get_template_directory_uri() . '/build/js/show-sub-menu-on-hover.min.js', array('jquery'), '', true);
	wp_enqueue_script('frafca-search-animations', get_template_directory_uri() . '/build/js/search-animations.min.js', array('jquery'), '', true);
	wp_enqueue_script('frafca-header-change-on-scroll', get_template_directory_uri() . '/build/js/header-change-on-scroll.min.js', array('jquery'), '', true);

	// Enqueue script only for single-prgrm_svc 
	if (is_singular('prgrm_svc')) {
		wp_enqueue_script('frafca-theme-cf7-set-default-option', get_template_directory_uri() . '/build/js/cf7-set-default-option.min.js', array('jquery'), '', true);
	}
	// Enqueue CF7 script after submit button is clicked
	wp_enqueue_script('frafca-theme-cf7-event-submit', get_template_directory_uri() . '/build/js/cf7-event-submit.min.js', array('jquery'), '', true);
	// Scripts for Carousels - flickity
	if ( is_front_page() ) {

		wp_enqueue_style('flickity-style', 'https://unpkg.com/flickity@2/dist/flickity.min.css');
		wp_register_script('flickity', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', null, null, true);
		wp_enqueue_script('frafca-carousel', get_template_directory_uri() . '/build/js/carousel.min.js', array('jquery', 'flickity'), '', true);
	}
	// Scripts for articles - About-page
	if ( is_page('about') ){
		wp_enqueue_script('frafca-theme-swipe-article', get_template_directory_uri() . '/build/js/swipe-article.min.js', array('jquery'), '', true);
	}
	
	wp_enqueue_script('frafca-theme-navigation', get_template_directory_uri() . '/build/js/navigation.min.js', array(), '20151215', true);
	wp_enqueue_script('frafca-theme-skip-link-focus-fix', get_template_directory_uri() . '/build/js/skip-link-focus-fix.min.js', array(), '20151215', true);
	
	wp_enqueue_style('frafca-theme-style', get_stylesheet_uri());

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'frafca_theme_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Allows visitors to page forward/backwards in any direction within month view
 * an "infinite" number of times (ie, outwith the populated range of months).
 */
class ContinualMonthViewPagination {
	public function __construct() {
		add_filter( 'tribe_events_the_next_month_link', array( $this, 'next_month' ) );
		add_filter( 'tribe_events_the_previous_month_link', array( $this, 'previous_month' ) );
	}
	public function next_month() {
		$url = tribe_get_next_month_link();
		$text = tribe_get_next_month_text();
		$date = Tribe__Events__Main::instance()->nextMonth( tribe_get_month_view_date() );
		return '<a data-month="' . $date . '" href="' . $url . '" rel="next">' . $text . ' <span>&raquo;</span></a>';
	}
	public function previous_month() {
		$url = tribe_get_previous_month_link();
		$text = tribe_get_previous_month_text();
		$date = Tribe__Events__Main::instance()->previousMonth( tribe_get_month_view_date() );
		return '<a data-month="' . $date . '" href="' . $url . '" rel="prev"><span>&laquo;</span> ' . $text . ' </a>';
	}
}
new ContinualMonthViewPagination;
