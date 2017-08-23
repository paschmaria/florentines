<?php
/**
 * The sidebar containing widget areas.
 *
 * @package Forma
 */
?>
<div id="footer-widgets" class="footer-widgets">
	<div class="footer-columns">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div>
		<?php endif; ?>
	</div><!-- .footer-columns -->
</div><!-- .footer-widgets -->
