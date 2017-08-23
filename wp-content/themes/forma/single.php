<?php
/**
 * The template for displaying all single posts.
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
				get_template_part( 'template-parts/content', get_post_format() );
				if ( is_singular( 'post' ) ) :
					// Previous/next post navigation.
					$prev = get_adjacent_post( false, '', true );
					$next = get_adjacent_post( false, '', false );
					$links_html = '';
					if( ! empty( $prev ) ) {
						$links_html .= '<div class="nav-previous"><a href="' . esc_url( get_permalink( $prev->ID ) ) . '" class="nav-inside"><span class="nav-before">' . esc_html__( 'Previous post', 'forma' ) . '</span><span class="nav-title">' . esc_html( $prev->post_title ) . '</span><span class="nav-meta">' . esc_html( get_the_author_meta( 'display_name', $prev->post_author ) ) . ' &#47; ' . get_the_time( get_option( 'date_format' ), $prev->ID ) . '</span>';
						$prev_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $prev->ID ), 'jgtforma-nav' );
						if ( $prev_thumb ) {
							$links_html .= '<span class="nav-thumb" style="background-image: url(' . esc_url( $prev_thumb[0] ) . ')"></span>';
						}
						$links_html .= '</a></div>';
					}
					if( ! empty( $next ) ) {
						$links_html .= '<div class="nav-next"><a href="' . esc_url( get_permalink( $next->ID ) ) . '" class="nav-inside"><span class="nav-before">' . esc_html__( 'Next post', 'forma' ) . '</span><span class="nav-title">' . esc_html( $next->post_title ) . '</span><span class="nav-meta">' . esc_html( get_the_author_meta( 'display_name', $next->post_author ) ) . ' &#47; ' . get_the_time( get_option( 'date_format' ), $next->ID ) . '</span>';
						$next_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'jgtforma-nav' );
						if ( $next_thumb ) {
							$links_html .= '<span class="nav-thumb" style="background-image: url(' . esc_url( $next_thumb[0] ) . ')"></span>';
						}
						$links_html .= '</a></div>';
					}
					if ( ! empty( $links_html ) ) {
						printf( '<nav class="navigation post-navigation"><h2 class="screen-reader-text">%1$s</h2><div class="nav-links">%2$s</div></nav>',
							esc_html__( 'Post navigation', 'forma' ),
							$links_html
						);
					}
				endif;
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
