<article>
	<div <?php post_class(); ?>>                    
		<?php if ( has_post_thumbnail() ) : ?>                               
			<a class="featured-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail( 'bestore-single' ); ?>
				<header>
					<h2 class="page-header page-header-img h1">                                
						<?php the_title(); ?>                           
					</h2>
				</header>
			</a>								               
		<?php endif; ?>	
		<div class="main-content">
			<?php if ( ! has_post_thumbnail() ) : ?> 
				<header>
					<h2 class="page-header h1">                                
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>                            
					</h2>
				</header>
			<?php endif; ?>	
			<div class="content-inner row">
				<div class="post-meta col-md-4">
					<?php bestore_time_link(); ?>
					<?php bestore_posted_on(); ?>
					<?php bestore_entry_footer(); ?>
				</div><!-- .post-meta -->
				<div class="content-entry-summary col-md-8">
					<?php the_excerpt(); ?> 
				</div><!-- .content-entry-summary -->
			</div>                                                             
		</div>                   
	</div>
</article>
