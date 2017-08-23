<?php
/**
 * The template for displaying author archive pages.
 *
 * @package Forma
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main inner">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<?php
					/*
					 * Queue the first post, that way we know what author
					 * we're dealing with (if that is the case).
					 */
					the_post();
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					if ( get_the_author_meta( 'description' ) ) :
					?>
					<div class="author-box">
						<div class="author-info">
							<div class="avatar-container">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), 110 ); ?>
							</div><!-- .avatar-container -->
							<div class="author-details">
								<h2 class="author-title"><?php printf( esc_html__( 'About %s', 'forma' ), get_the_author() ); ?></h2>
								<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
							</div><!-- .author-details -->
						</div><!-- .author-info -->
					</div><!-- .author-box -->
					<?php endif; ?>
				</header><!-- .page-header -->
				<div id="post-wrapper" class="post-wrapper">
					<?php
					// Rewind the loop back to the beginning.
					rewind_posts();
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
