<?php get_header(); ?>

<!-- start content container -->
<div class="main-content row">
	<div class="col-md-<?php bestore_main_content_width_columns(); ?>">
		<div class="main-content-page">
			<div class="error-template text-center">
				<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bestore' ); ?></h1>
				<p class="error-details">
					<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'bestore' ); ?>
				</p>
				<div class="error-actions">
					<?php get_search_form(); ?>    
				</div>
			</div>
		</div>
	</div>

	<?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>
