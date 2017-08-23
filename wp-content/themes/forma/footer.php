<?php
/**
 * The template for displaying the footer.
 *
 * @package Forma
 */
?>
	</div><!-- .site-content -->
	<footer id="colophon" class="site-footer">
		<div class="inner">
			<?php
			if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) )
				get_sidebar( 'footer' );
			?>
			<div class="footer-bottom">
				<?php if ( has_nav_menu( 'footer_social' ) ) : ?>
				<div class="footer-links">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer_social',
						'container'      => false,
						'menu_id'        => 'footer-social-links',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					) );
					?>
				</div><!-- .footer-links -->
				<?php endif; ?>
				<div class="site-info">
					<?php
					if ( get_theme_mod( 'jgtforma_footer_text' ) ) {
						echo wp_kses_post( get_theme_mod( 'jgtforma_footer_text' ) );
					} else {
						printf( esc_html__( '&copy; %1$s %2$s', 'forma' ),
							date_i18n( __( 'Y', 'forma' ) ),
							sprintf( '<a href="%1$s" rel="home">%2$s</a>', esc_url( home_url( '/' ) ), get_bloginfo( 'name', 'display' ) )
						);
						echo '<br />';
						printf( esc_html__( 'Forma theme by %s', 'forma' ),
							sprintf( '<a href="%s">justgoodthemes.com</a>', esc_url( 'https://justgoodthemes.com/' ) )
						);
					}
					?>
				</div><!-- .site-info -->
				<?php if ( get_theme_mod( 'jgtforma_show_arrow_top' ) ) : ?>
				<a href="#page" id="top-link" class="top-link"><span class="fa-arrow-left-custom" aria-hidden="true"></span> <span class="top-link-text"><?php esc_html_e( 'Up', 'forma' ); ?></span></a>
				<?php endif; ?>
			</div><!-- .footer-bottom -->
		</div><!-- .inner -->
	</footer><!-- .site-footer -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
