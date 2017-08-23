<?php
/**
 *
 * Template name: Homepage
 * The template for displaying homepage.
 *
 * @package bestore
 */
get_header();

?>  
<article class="homepage-layout">        
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                          
			<div <?php post_class(); ?>>
				<div class="main-content-page">                          
					<?php $cat = get_post_meta( get_the_ID(), 'bestore_cat', true ); ?>
					<?php if ( class_exists( 'WooCommerce' ) && $cat == 1 ) { ?>
						<div class="top-grid-content">
							<?php get_template_part( 'template-parts/template-part', 'home' ); ?>
						</div>
					<?php } ?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<?php wp_link_pages(); ?>
				</div>
			</div>        
		<?php endwhile; ?>
	<?php else : ?>            
		<?php get_template_part( 'content', 'none' ); ?>        
	<?php endif; ?>    
</article>       
<!-- end content container -->
<?php
get_footer();
