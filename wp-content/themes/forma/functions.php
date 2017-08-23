<?php
/**
 * Forma functions and definitions.
 *
 * @package Forma
 */

if ( ! function_exists( 'jgtforma_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function jgtforma_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'forma', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for custom logo.
	add_theme_support( 'custom-logo', array(
		'height'      => '400',
		'width'       => '740',
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// Register additional image sizes.
	add_image_size( 'jgtforma-grid', 960, 9999 );
	add_image_size( 'jgtforma-nav', 150, 150, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'       => esc_html__( 'Primary Menu', 'forma' ),
		'footer_social' => esc_html__( 'Footer Social Links', 'forma' ),
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

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'video',
		'quote',
		'link',
		'gallery'
	) );

	// Style the visual editor to resemble the theme style.
	add_editor_style( 'css/editor-style.css' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'jgtforma_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function jgtforma_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jgtforma_content_width', 1200 );
}
add_action( 'after_setup_theme', 'jgtforma_content_width', 0 );

/**
 * Register widget areas.
 */
function jgtforma_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'forma' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Slideout sidebar that appears on the right.', 'forma' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'forma' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'forma' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'forma' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'forma' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'forma' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'forma' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'jgtforma_widgets_init' );

if ( ! function_exists( 'jgtforma_fonts_url' ) ) :
/**
 * Register Google fonts for forma.
 */
function jgtforma_fonts_url() {
	$fonts_url = '';
	$fonts = array();

	/* translators: If there are characters in your language that are not
	 * supported by Roboto, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'forma' ) )
		$fonts[] = 'Roboto:400,400i,700,700i';

	/* translators: If there are characters in your language that are not
	 * supported by Cousine, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Cousine font: on or off', 'forma' ) )
		$fonts[] = 'Cousine:400,400i,700,700i';

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Add preconnect for Google Fonts.
 */
function jgtforma_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'jgtforma-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'jgtforma_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function jgtforma_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'jgtforma-fonts', jgtforma_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'jgtforma-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( ! is_singular() && 'grid' === get_theme_mod( 'jgtforma_layout', 'grid' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array( 'jquery' ), '20170605', true );
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), '20170605', true );
	wp_enqueue_script( 'jquery-debouncedresize', get_template_directory_uri() . '/js/jquery.debouncedresize.min.js', array( 'jquery' ), '20170605', true );

	wp_enqueue_script( 'jgtforma-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery-fitvids', 'jquery-slick', 'jquery-debouncedresize' ), '20170605', true );
	wp_localize_script( 'jgtforma-script', 'jgtformaVars', array(
		'submenuText' => esc_html__( 'child menu', 'forma' )
	) );
}
add_action( 'wp_enqueue_scripts', 'jgtforma_scripts' );

/**
 * Add custom classes to the array of body classes.
 */
function jgtforma_body_classes( $classes ) {
	// Add a class of no-avatars if avatars are disabled.
	if ( ! get_option( 'show_avatars' ) ) {
		$classes[] = 'no-avatars';
	}

	// Add a class indicating the theme layout
	if ( ! is_singular() && 'grid' === get_theme_mod( 'jgtforma_layout', 'grid' ) ) {
		$classes[] = 'grid-layout';
	}

	// Add a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'jgtforma_body_classes' );

/**
 * Customize the archive title.
 */
function jgtforma_archive_title( $title ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'All posts in %s', 'forma' ), '<span class="highlight">' . single_cat_title( '', false ) . '</span>' );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'All posts tagged %s', 'forma' ), '<span class="highlight">' . single_tag_title( '', false ) . '</span>' );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'All posts by %s', 'forma' ), '<span class="vcard highlight">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'All posts in %s', 'forma' ), '<span class="highlight">' . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'forma' ) ) . '</span>' );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'All posts in %s', 'forma' ), '<span class="highlight">' . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'forma' ) ) . '</span>' );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'All posts dated %s', 'forma' ), '<span class="highlight">' . get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'forma' ) ) . '</span>' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'jgtforma_archive_title' );

/**
 * Modify tag cloud widget arguments to have all tags in the widget same font size.
 */
function jgtforma_widget_tag_cloud_args( $args ) {
	$args['largest'] = 10;
	$args['smallest'] = 10;
	$args['unit'] = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'jgtforma_widget_tag_cloud_args' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Display Forma Pro info in the Customizer.
 */
require_once get_template_directory() . '/inc/trt-customize-pro/class-customize.php';
