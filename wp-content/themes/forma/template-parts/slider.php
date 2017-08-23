<?php
/**
 * The template part for displaying featured posts carousel.
 *
 * @package Forma
 */

$args = array(
	'posts_per_page'      => get_theme_mod( 'jgtforma_slider_qty', 3 ),
	'ignore_sticky_posts' => true
);
if ( get_theme_mod( 'jgtforma_slider_tag' ) ) {
	$args['tag_id'] = get_theme_mod( 'jgtforma_slider_tag' );
}
$featured_posts = new WP_Query( $args );
?>
<aside class="featured-posts" aria-label="<?php esc_attr_e( 'Featured', 'forma' ); ?>">
	<div class="slider-loading">
		<div id="featured-slider" class="featured-slider">
			<?php while ( $featured_posts->have_posts() ) : $featured_posts->the_post(); ?>
			<div>
				<div class="slide-inner">
					<?php
					$slide_bg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
					if ( $slide_bg ) {
						echo '<div class="slide-bg" style="background-image: url(' . esc_url( $slide_bg[0] ) . ')"></div>';
					}
					?>
					<div class="slide-overlay">
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
						<div class="entry-meta">
							<?php jgtforma_posted_on(); ?>
						</div>
						<div class="slider-nav">
							<button type="button" class="featured-prev"><span class="fa-arrow-left-custom" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'Previous', 'forma' ); ?></span></button>
							<button type="button" class="featured-next"><span class="fa-arrow-right-custom" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'Next', 'forma' ); ?></span></button>
						</div>
					</div>
				</div>
			</div>
			<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div><!-- .featured-slider -->
	</div><!-- .slider-loading -->
</aside><!-- .featured-posts -->
