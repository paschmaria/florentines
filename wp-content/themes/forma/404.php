<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Forma
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main inner">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Page Not Found!', 'forma' ); ?></h1>
				</header><!-- .page-header -->
				<div class="page-content">
					<p><?php printf( wp_kses( __( 'Either something went wrong or the page doesn&rsquo;t exist anymore. Visit our <a href="%s">homepage</a> or search the best match below.', 'forma' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( home_url( '/' ) ) ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php
if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'sidebar-1' ) ) {
	get_sidebar();
}
get_footer();
?>
