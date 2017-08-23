<?php
/**
 * The template for displaying all pages.
 *
 * @package Forma
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main inner">
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();
				// Include the template for the content.
				get_template_part( 'template-parts/content', 'page' );
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile;
			?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php
if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'sidebar-1' ) ) {
	get_sidebar();
}
get_footer();
?>
