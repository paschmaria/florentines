<footer id="colophon" class="footer-credits">
	<p class="text-center">
		<?php printf( __( 'Proudly powered by %s', 'bestore' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'bestore' ) ) . '">WordPress</a>' ); ?>
		<span class="sep"> | </span>
		<?php printf( __( 'Theme: %1$s by %2$s', 'bestore' ), '<a href="https://themes4wp.com/theme/bestore/">Bestore</a>', 'Themes4WP' ); ?>
	</p>      
</footer> 
<?php
if ( function_exists( 'bestore_header_cart' ) ) {
	bestore_header_cart();
}
?>
<!-- end main container -->
</div>
<?php wp_footer(); ?>
</body>
</html>
