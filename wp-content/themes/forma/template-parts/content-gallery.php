<?php
/**
 * Template part for displaying gallery posts.
 *
 * @package Forma
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inside">
		<?php
		$gallery = get_post_gallery( get_the_ID(), false );
		if ( ! empty( $gallery ) ) {
			echo '<div class="post-gallery">';
			$gallery_ids = explode( ',', $gallery['ids'] );
			foreach( $gallery_ids as $id ) {
				$gallery_image = wp_get_attachment_image_src( $id, 'post-thumbnail' );
				$image_alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
				$image_caption = get_post_field( 'post_excerpt', $id );
				echo '<div class="post-gallery-item"><img src="' . $gallery_image[0] . '" alt="' . esc_attr( $image_alt ) . '" />';
				if ( ! empty( $image_caption ) )
					echo '<div class="slider-caption">'. $image_caption .'</div>';
				echo '</div>';
			}
			echo '</div>';
		}
		?>
		<header class="entry-header">
			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
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
				$content = get_the_content( esc_html__( 'Read More', 'forma' ) );
				preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
				if ( ! empty( $matches ) ) {
					foreach ( $matches as $shortcode ) {
						if ( 'gallery' === $shortcode[2] ) {
							$content = str_replace( $shortcode[0], '', $content );
							break;
						}
					}
				}
				echo apply_filters( 'the_content', $content );
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
