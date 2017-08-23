<?php
/**
 * The template for displaying the header.
 *
 * @package Forma
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header">
		<div class="inner">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) {
					$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
					$logo_width = get_theme_mod( 'jgtforma_logo_retina' ) ? floor( $custom_logo[1]/2 ) : $custom_logo[1];
					printf( '<a href="%1$s" class="custom-logo-link" rel="home"><img src="%2$s" width="%3$s" alt="%4$s" /></a>',
						esc_url( home_url( '/' ) ),
						esc_url( $custom_logo[0] ),
						esc_attr( $logo_width ),
						esc_attr( get_bloginfo( 'name', 'display' ) )
					);
				}
				$site_title_link = sprintf( '<a href="%1$s" rel="home">%2$s</a>',
					esc_url( home_url( '/' ) ),
					esc_attr( get_bloginfo( 'name', 'display' ) )
				);
				?>
				<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title<?php if ( get_theme_mod( 'jgtforma_hide_site_title' ) ) echo ' screen-reader-text'; ?>"><?php echo $site_title_link; ?></h1>
				<?php else : ?>
				<p class="site-title<?php if ( get_theme_mod( 'jgtforma_hide_site_title' ) ) echo ' screen-reader-text'; ?>"><?php echo $site_title_link; ?></p>
				<?php endif; ?>
				<?php if ( get_bloginfo( 'description' ) ) : ?>
				<p class="site-description<?php if ( get_theme_mod( 'jgtforma_hide_tagline' ) ) echo ' screen-reader-text'; ?>"><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			<?php if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'sidebar-1' ) ) : ?>
			<button id="show-sidebar" class="toggle-sidebar"><span class="screen-reader-text"><?php esc_html_e( 'Discover More', 'forma' ); ?></span><span aria-hidden="true" class="icon-plus"></span></button>
			<?php endif; ?>
		</div><!-- .inner -->
	</header><!-- .site-header -->

	<div id="content" class="site-content">
