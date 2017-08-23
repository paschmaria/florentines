<?php
/**
 * Jetpack Compatibility File.
 *
 * @package Forma
 */

/**
 * Jetpack setup function.
 */
function jgtforma_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'      => 'click',
		'container' => 'post-wrapper',
		'render'    => 'jgtforma_infinite_scroll_render',
		'wrapper'   => false,
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'jgtforma_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function jgtforma_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
}

/**
 * Change "Older posts" text in infinite scroll.
 */
function jgtforma_infinite_scroll_handle_text( $js_settings ) {
	$js_settings['text'] = esc_html__( 'Load more', 'forma' ) . ' <i aria-hidden="true" class="icon-plus"></i>';
	return $js_settings;
}
add_filter( 'infinite_scroll_js_settings', 'jgtforma_infinite_scroll_handle_text' );
