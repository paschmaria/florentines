<?php
/**
 * Template part for displaying posts.
 *
 * @package Forma
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inside">
		<?php jgtforma_post_thumbnail(); ?>
		<header class="entry-header">
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			edit_post_link( esc_html__( 'Edit', 'forma' ), '<div class="entry-meta">', '</div>' );
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<p class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'forma' ) . '</span>',
				'after'       => '</p>',
				'link_before' => '<span class="page-link">',
				'link_after'  => '</span>'
			) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .post-inside -->
</article><!-- #post -->
