<?php
/**
 * The template for displaying image attachments.
 *
 * @package Forma
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main inner">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="post-inside">
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							<div class="entry-meta">
								<?php
								jgtforma_posted_on();
								edit_post_link( esc_html__( 'Edit', 'forma' ), '<span class="edit-link">', '</span>' );
								?>
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->
						<div class="entry-content">
							<div class="entry-attachment">
								<?php echo wp_get_attachment_image( get_the_ID(), 'post-thumbnail' );?>
								<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
								<?php endif; ?>
							</div><!-- .entry-attachment -->
							<?php
							the_content( esc_html__( 'Read More', 'forma' ) );
							wp_link_pages( array(
								'before'      => '<p class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'forma' ) . '</span>',
								'after'       => '</p>',
								'link_before' => '<span class="page-link">',
								'link_after'  => '</span>'
							) );
							?>
						</div><!-- .entry-content -->
						<footer class="entry-footer">
							<?php jgtforma_entry_footer(); ?>
						</footer><!-- .entry-footer -->
					</div><!-- .post-inside -->
				</article><!-- #post-## -->
				<?php
				// Show navigation if there is more than one attachment
				$attachments = array_values( get_children( array(
					'post_parent'    => $post->post_parent,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => 'ASC',
					'orderby'        => 'menu_order ID'
				) ) );
				if ( count( $attachments ) > 1 ) :
				?>
				<nav id="image-navigation" class="navigation image-navigation">
					<div class="nav-links">
						<div class="nav-previous"><?php previous_image_link( false, '<span class="fa-arrow-left-custom" aria-hidden="true"></span> ' . esc_html__( 'Previous Image', 'forma' ) ); ?></div>
						<div class="nav-next"><?php next_image_link( false, esc_html__( 'Next Image', 'forma' ) . ' <span class="fa-arrow-right-custom" aria-hidden="true"></span>' ); ?></div>
					</div><!-- .nav-links -->
				</nav><!-- #image-navigation -->
				<?php 
				endif;
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php
if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'sidebar-1' ) ) {
	get_sidebar();
}
get_footer();
?>
