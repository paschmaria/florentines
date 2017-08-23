<!-- start content container -->
<div class="main-content row">      
	<article class="col-md-<?php bestore_main_content_width_columns(); ?>">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                         
				<div <?php post_class(); ?>>
					<?php if ( has_post_thumbnail() ) : ?>                               
						<a class="featured-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
							<?php the_post_thumbnail( 'bestore-single' ); ?>
						</a>								               
					<?php endif; ?>	
					<div class="single-content"> 
						<header class="col-md-6">
							<h2 class="page-header h1">                                
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>                            
							</h2>
							<div class="post-meta">
								<?php bestore_time_link(); ?>
								<?php bestore_posted_on(); ?>
								<?php bestore_entry_footer(); ?>
							</div><!-- .content-entry-summary -->
						</header>
						<div class="content-entry-summary">
							<?php the_content(); ?> 
						</div><!-- .content-entry-summary -->
						<?php wp_link_pages(); ?>                                                           
					</div>
					<div class="single-footer row">
						<div class="col-md-12">
							<?php get_template_part( 'template-parts/template-part', 'postauthor' ); ?>
						</div>
						<div class="col-md-12">
							<?php comments_template(); ?> 
						</div>
					</div>
				</div>        
			<?php endwhile; ?>        
		<?php else : ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>    
	</article> 

	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->
