<?php get_header(); ?>

<!-- start content container -->
<div class="main-content row">   
	<article class="col-md-<?php bestore_main_content_width_columns(); ?>">                                 
		<?php woocommerce_content(); ?>
	</article>       
	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->

<?php
get_footer();
