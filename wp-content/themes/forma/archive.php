<?php
/**
 * The template for displaying archive pages.
 *
 * @package Forma
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main inner">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="page-description">', '</div>' );
					?>
				</header><!-- .page-header -->
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
