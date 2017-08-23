<?php
/**
 * Forma Theme Customizer.
 *
 * @package Forma
 */

/**
 * Implement Theme Customizer additions and adjustments.
 */
function jgtforma_customize_register( $wp_customize ) {
	// Double size logo for Retina devices.
	$wp_customize->add_setting( 'jgtforma_logo_retina', array(
		'sanitize_callback' => 'jgtforma_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'jgtforma_logo_retina', array(
		'label'    => esc_html__( 'Check if you use double sized logo.', 'forma' ),
		'section'  => 'title_tagline',
		'settings' => 'jgtforma_logo_retina',
		'type'     => 'checkbox',
		'priority' => 9
	) );

	// Remove the core display site title and tagline control.
	$wp_customize->remove_control( 'display_header_text' );

	// Hide site title.
	$wp_customize->add_setting( 'jgtforma_hide_site_title', array(
		'sanitize_callback' => 'jgtforma_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'jgtforma_hide_site_title', array(
		'label'    => esc_html__( 'Hide Site Title.', 'forma' ),
		'section'  => 'title_tagline',
		'settings' => 'jgtforma_hide_site_title',
		'type'     => 'checkbox'
	) );

	// Hide tagline.
	$wp_customize->add_setting( 'jgtforma_hide_tagline', array(
		'sanitize_callback' => 'jgtforma_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'jgtforma_hide_tagline', array(
		'label'    => esc_html__( 'Hide Tagline.', 'forma' ),
		'section'  => 'title_tagline',
		'settings' => 'jgtforma_hide_tagline',
		'type'     => 'checkbox'
	) );

	// Theme accent color.
	$wp_customize->add_setting( 'jgtforma_accent_color', array(
		'default'           => '#00ffff',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'jgtforma_accent_color', array(
		'label'   => esc_html__( 'Accent Color', 'forma' ),
		'section' => 'colors'
	) ) );

	/**
	 * General Settings Section.
	 */
	$wp_customize->add_section( 'jgtforma_general_settings', array( 
		'title'    => esc_html__( 'General Settings', 'forma' ),
		'priority' => 160
	) );

		// Show back to top button.
		$wp_customize->add_setting( 'jgtforma_show_arrow_top', array(
			'sanitize_callback' => 'jgtforma_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'jgtforma_show_arrow_top', array(
			'label'    => esc_html__( 'Display the back to top button at the bottom right corner.', 'forma' ),
			'section'  => 'jgtforma_general_settings',
			'settings' => 'jgtforma_show_arrow_top',
			'type'     => 'checkbox'
		) );

		// Posts navigation type.
		$wp_customize->add_setting( 'jgtforma_posts_nav', array(
			'default'           => 'paginated',
			'sanitize_callback' => 'jgtforma_sanitize_select'
		) );
		$wp_customize->add_control( 'jgtforma_posts_nav', array(
			'label'    => esc_html__( 'Posts Navigation Type', 'forma' ),
			'section'  => 'jgtforma_general_settings',
			'settings' => 'jgtforma_posts_nav',
			'type'     => 'select',
			'choices'  => array(
				'paginated' => esc_html__( 'Paginated Links', 'forma' ),
				'next_prev' => esc_html__( 'Next/Prev Links', 'forma' )
			)
		) );

		// Custom footer text.
		$wp_customize->add_setting( 'jgtforma_footer_text', array(
			'default'           => '',
			'sanitize_callback' => 'jgtforma_sanitize_html'
		) );
		$wp_customize->add_control( 'jgtforma_footer_text', array(
			'label'    => esc_html__( 'Footer Text', 'forma' ),
			'section'  => 'jgtforma_general_settings',
			'settings' => 'jgtforma_footer_text',
			'type'     => 'textarea'
		) );

	/**
	 * Featured Area Settings Section.
	 */
	$wp_customize->add_section( 'jgtforma_featured_area_settings', array( 
		'title'    => esc_html__( 'Featured Area Settings', 'forma' ),
		'priority' => 165
	) );

		// Enable the featured slider.
		$wp_customize->add_setting( 'jgtforma_show_slider', array(
			'sanitize_callback' => 'jgtforma_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'jgtforma_show_slider', array(
			'label'    => esc_html__( 'Enable featured posts slider on the blog (posts index) page.', 'forma' ),
			'section'  => 'jgtforma_featured_area_settings',
			'settings' => 'jgtforma_show_slider',
			'type'     => 'checkbox'
		) );

		// Slides number.
		$wp_customize->add_setting( 'jgtforma_slider_qty', array(
			'default'           => 3,
			'sanitize_callback' => 'jgtforma_sanitize_select'
		) );
		$wp_customize->add_control( 'jgtforma_slider_qty', array(
			'label'    => esc_html__( 'Number of posts to show', 'forma' ),
			'section'  => 'jgtforma_featured_area_settings',
			'settings' => 'jgtforma_slider_qty',
			'type'     => 'select',
			'choices'  => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
				6 => 6,
				7 => 7,
				8 => 8,
				9 => 9
			)
		) );

		// Featured tag.
		$wp_customize->add_setting( 'jgtforma_slider_tag', array(
			'default'           => 0,
			'sanitize_callback' => 'jgtforma_sanitize_select'
		) );
		$wp_customize->add_control( 'jgtforma_slider_tag', array(
			'label'       => esc_html__( 'Featured Tag', 'forma' ),
			'description' => esc_html__( 'If no tag is selected, the latest posts will be featured in the slider. ', 'forma' ),
			'section'     => 'jgtforma_featured_area_settings',
			'settings'    => 'jgtforma_slider_tag',
			'type'        => 'select',
			'choices'     => jgtforma_get_tag_options()
		) );

	/**
	 * Blog and Archives Settings Section.
	 */
	$wp_customize->add_section( 'jgtforma_blog_settings', array( 
		'title'    => esc_html__( 'Blog (Posts Index), Archives', 'forma' ),
		'priority' => 170
	) );

		// Layout style.
		$wp_customize->add_setting( 'jgtforma_layout', array(
			'default'           => 'grid',
			'sanitize_callback' => 'jgtforma_sanitize_select'
		) );
		$wp_customize->add_control( 'jgtforma_layout', array(
			'label'    => esc_html__( 'Posts Layout', 'forma' ),
			'section'  => 'jgtforma_blog_settings',
			'settings' => 'jgtforma_layout',
			'type'     => 'select',
			'choices'  => array(
				'grid'       => esc_html__( 'Grid', 'forma' ),
				'one_column' => esc_html__( 'One Column', 'forma' )
			)
		) );

		// Show footer meta.
		$wp_customize->add_setting( 'jgtforma_show_footer_meta', array(
			'sanitize_callback' => 'jgtforma_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'jgtforma_show_footer_meta', array(
			'label'    => esc_html__( 'Display post categories and tags below the post content.', 'forma' ),
			'section'  => 'jgtforma_blog_settings',
			'settings' => 'jgtforma_show_footer_meta',
			'type'     => 'checkbox'
		) );

		// Show automatically generated excerpts.
		$wp_customize->add_setting( 'jgtforma_auto_excerpt', array(
			'sanitize_callback' => 'jgtforma_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'jgtforma_auto_excerpt', array(
			'label'    => esc_html__( 'Generate excerpts automatically (applies for the "One column" posts layout only).', 'forma' ),
			'section'  => 'jgtforma_blog_settings',
			'settings' => 'jgtforma_auto_excerpt',
			'type'     => 'checkbox'
		) );

		// Excerpts length.
		$wp_customize->add_setting( 'jgtforma_excerpt_length', array(
			'default'           => '55',
			'sanitize_callback' => 'jgtforma_sanitize_number'
		) );
		$wp_customize->add_control( 'jgtforma_excerpt_length', array(
			'label'       => esc_html__( 'Excerpt Length', 'forma' ),
			'description' => esc_html__( 'The default length is 55 words.', 'forma' ),
			'section'     => 'jgtforma_blog_settings',
			'settings'    => 'jgtforma_excerpt_length',
			'type'        => 'text'
		) );

	/**
	 * Post Settings Section.
	 */
	$wp_customize->add_section( 'jgtforma_post_settings', array( 
		'title'    => esc_html__( 'Single Posts', 'forma' ),
		'priority' => 175
	) );

		// Author box.
		$wp_customize->add_setting( 'jgtforma_show_author_box', array(
			'sanitize_callback' => 'jgtforma_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'jgtforma_show_author_box', array(
			'label'    => esc_html__( 'Display an author box below the post content.', 'forma' ),
			'section'  => 'jgtforma_post_settings',
			'settings' => 'jgtforma_show_author_box',
			'type'     => 'checkbox'
		) );

}
add_action( 'customize_register', 'jgtforma_customize_register' );

/**
 * Checkbox sanitization callback.
 */
function jgtforma_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

/**
 * Select and radio sanitization callback.
 */
function jgtforma_sanitize_select( $input, $setting ) {
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * HTML sanitization callback.
 */
function jgtforma_sanitize_html( $input ) {
	return wp_filter_post_kses( $input );
}

/**
 * No HTML sanitization callback.
 */
function jgtforma_sanitize_nohtml( $input ) {
	return wp_filter_nohtml_kses( $input );
}

/**
 * Number sanitization callback.
 */
function jgtforma_sanitize_number( $input, $setting ) {
	$input = absint( $input );
	return ( $input ? $input : $setting->default );
}

/**
 * Customizer tag choices.
 */
function jgtforma_get_tag_options() {
	$tags = get_tags();
	$options = array();
	if ( ! empty( $tags ) ) {
		$options[0] = esc_html__( '&mdash; Select &mdash;', 'forma' );
		foreach ( $tags as $tag ) {
			$options[$tag->term_id] = $tag->name;
		}
	}
	return $options;
}

/**
 * Enqueue front-end CSS for the accent color.
 */
function jgtforma_accent_color_css() {
	$default_color = '#00ffff';
	$custom_color = get_theme_mod( 'jgtforma_accent_color', '#00ffff' );

	// Don't do anything if the current color is the default.
	if ( $custom_color === $default_color ) {
		return;
	}

	$css = 'a,.comment-form .submit,.widget button,.widget input[type="submit"],.widget input[type="button"],.widget input[type="reset"],.entry-meta a:hover,.entry-footer a:hover,.grid-layout .format-link .post-inside,.comment-author .url:hover,.comment-meta a:hover,#cancel-comment-reply-link:hover,.logged-in-as a:hover,.navigation a:hover,.page-links a:hover,.site-info a:hover,.primary-menu a:hover,.widget a:hover,.primary-menu .current-menu-item > a,.primary-menu .current-menu-ancestor > a {border-color:' . esc_attr( $custom_color ) . ';}.tagcloud a {border-color:' . esc_attr( $custom_color ) . ';color:' . esc_attr( $custom_color ) . ';}.tagcloud a:hover,button,input[type="submit"],input[type="button"],input[type="reset"],.avatar-container:before,#hide-sidebar,.format-link .entry-title,.bypostauthor .author-badge {background-color:' . esc_attr( $custom_color ) . ';}button:hover,button:focus,button:active,input[type="submit"]:hover,input[type="submit"]:focus,input[type="submit"]:active,input[type="button"]:hover,input[type="button"]:focus,input[type="button"]:active,input[type="reset"]:hover,input[type="reset"]:focus,input[type="reset"]:active,.nav-inside:before {color:' . esc_attr( $custom_color ) . ';}blockquote:before,.more-link:after,.site-title a:before,.quote-container:before {background-color:' . esc_attr( $custom_color ) . ';border-color:' . esc_attr( $custom_color ) . ';}';

	wp_add_inline_style( 'jgtforma-style', $css );
}
add_action( 'wp_enqueue_scripts', 'jgtforma_accent_color_css', 11 );
