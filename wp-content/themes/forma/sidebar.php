<?php
/**
 * The sidebar containing navigation and widget area.
 *
 * @package Forma
 */
?>
<aside id="secondary" class="content-sidebar">
	<div class="sidebar-inside">
		<button id="hide-sidebar" class="toggle-sidebar"><span class="screen-reader-text"><?php esc_html_e( 'Close', 'forma' ); ?></span><span class="icon-plus" aria-hidden="true"></span></button>
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<nav id="site-navigation" class="main-navigation widget widget_nav_menu" aria-label="<?php esc_attr_e( 'Menu', 'forma' ); ?>">
			<?php
			$forma_locations = get_nav_menu_locations();
			$forma_menu = get_term( $forma_locations['primary'], 'nav_menu' );
			?>
			<h2 class="widget-title"><?php echo esc_html( $forma_menu->name ); ?></h2>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'primary-menu'
			) );
			?>
		</nav><!-- .site-navigation -->
		<?php endif; ?>
		<?php
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' );
		}
		?>
	</div><!-- .sidebar-inside -->
</aside><!-- .content-sidebar -->
<div id="site-overlay" class="site-overlay"></div>
