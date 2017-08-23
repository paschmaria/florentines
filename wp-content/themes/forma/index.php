<?php
/**
 * The main template file.
 *
 * @package Forma
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<?php
		if ( is_home() && ! is_paged() && get_theme_mod( 'jgtforma_show_slider' ) ) {
			get_template_part( 'template-parts/slider' );
		}
		?>
		<main id="main" class="site-main inner">
			<?php if ( have_posts() ) : ?>
				<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php endif; ?>
				<div id="post-wrapper" class="post-wrapper">
					<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
						// Include the template for the content.
						get_template_part( 'template-parts/content', get_post_format() );
					endwhile;
					?>
				</div><!-- .post-wrapper -->
				<?php
				// Posts navigation.
				jgtforma_loop_navigation();
			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php
if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'sidebar-1' ) ) {
	get_sidebar();
}
get_footer();
?>
