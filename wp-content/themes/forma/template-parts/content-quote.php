<?php
/**
 * Template part for displaying quote posts.
 *
 * @package Forma
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inside">
		<header class="entry-header screen-reader-text">
			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<div class="quote-container">
				<?php the_content( '' ); ?>
				<a href="<?php the_permalink(); ?>" class="quote-link"><span class="quote-link-icon" aria-hidden="true">&rdquo;</span><span class="screen-reader-text"><?php printf( esc_html__( 'Permalink to %s', 'forma' ), get_the_title() ); ?></span></a>
			</div>
		</div><!-- .entry-content -->
		<?php if ( is_single() ) : ?>
			<footer class="entry-footer">
				<?php jgtforma_entry_footer(); ?>
			</footer><!-- .entry-footer -->
			<?php
			// Author bio.
			if ( ! is_attachment() && get_theme_mod( 'jgtforma_show_author_box' ) ) :
				get_template_part( 'template-parts/biography' );
			endif;
			?>
		<?php endif; ?>
	</div><!-- .post-inside -->
</article><!-- #post -->
