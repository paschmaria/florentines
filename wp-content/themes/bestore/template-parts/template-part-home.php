<?php
$second_cat = get_terms( 'product_cat' );
if ( !empty( $second_cat ) && !is_wp_error( $second_cat ) ) {
	// Random order.
	shuffle( $second_cat );
	$terms	 = $second_cat;
	$i		 = 0;
	foreach ( $terms as $term ) {
		if ( ++$i > 4 )	break;
		$random_term_id				 = $term->term_id;
		$random_term_name			 = $term->name;
		$random_term_id				 = $term->term_id;
		$random_term_slug			 = $term->slug;
		$random_term_terms			 = get_terms( $random_term_slug );
		$random_term_category_link	 = get_term_link( $random_term_id );
		$random_term_thumb_id		 = get_term_meta( $random_term_id, 'thumbnail_id', true );
		$random_term_term_img_one		 = wp_get_attachment_image( $random_term_thumb_id, 'bestore-cat-one' );
		$random_term_term_img_two		 = wp_get_attachment_image( $random_term_thumb_id, 'bestore-cat-two' );
		?>
		<div class="top-grid-cat <?php if ( $i == 1 || $i == 2 ) { echo 'col-sm-6'; } elseif ( $i == 3 || $i == 4 ) { echo 'col-xs-6 col-sm-3'; } ?>">
			<a href="<?php echo esc_url( $random_term_category_link ); ?>"> 
				<div class="top-grid-img <?php if ( $i == 2 ) { echo 'second-img'; } ?>">
					<?php
					if ( $random_term_term_img_one ) {
						if ( $i != 2 ) {
							echo $random_term_term_img_one;
						} else {
							echo $random_term_term_img_two;
						}
					} else {
						if ( $i != 2 ) {
							echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="' . esc_html__( 'Placeholder', 'bestore' ) . '" />';
						} else {
							echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="' . esc_html__( 'Placeholder', 'bestore' ) . '" />';
						}
					}
					?>
				</div>
				<div class="top-grid-heading">
					<h2>
						<?php
						if ( $random_term_name ) {
							echo esc_html( $random_term_name );
						}
						?>
					</h2>
				</div>
			</a> 
		</div>
	<?php } ?>
<?php } ?>