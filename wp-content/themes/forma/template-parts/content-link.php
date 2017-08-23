<?php
/**
 * Template part for displaying link posts.
 *
 * @package Forma
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inside">
		<header class="entry-header">
			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title"><a href="' . esc_url( jgtforma_get_link_url() ) . '">', ' <span class="fa-arrow-right-custom" aria-hidden="true"></span></a></h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( jgtforma_get_link_url() ) . '">', ' <span class="fa-arrow-right-custom" aria-hidden="true"></span></a></h2>' );
			}
			?>
			<div class="entry-meta">
				<?php
				jgtforma_posted_on();
				edit_post_link( esc_html__( 'Edit', 'forma' ), '<span class="edit-link">', '</span>' );
				?>
			</div>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			if ( is_search() || ( ! is_singular() && ( get_theme_mod( 'jgtforma_auto_excerpt' ) || 'grid' === get_theme_mod( 'jgtforma_layout', 'grid' ) ) ) ) {
				the_excerpt();
			} else {
				the_content( esc_html__( 'Read More', 'forma' ) );
				wp_link_pages( array(
					'before'      => '<p class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'forma' ) . '</span>',
					'after'       => '</p>',
					'link_before' => '<span class="page-link">',
					'link_after'  => '</span>'
				) );
			}
			?>
		</div><!-- .entry-content -->
		<?php if ( is_single() || get_theme_mod( 'jgtforma_show_footer_meta' ) ) : ?>
		<footer class="entry-footer">
			<?php jgtforma_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php endif; ?>
		<?php
		// Author bio.
		if ( is_single() && ! is_attachment() && get_theme_mod( 'jgtforma_show_author_box' ) ) :
			get_template_part( 'template-parts/biography' );
		endif;
		?>
	</div><!-- .post-inside -->
</article><!-- #post -->
