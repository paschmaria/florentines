<?php

/**
 *
 * Metaboxes
 *
 */
function bestore_options_add_meta_box() {
	global $post;
	$pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
	if ( $pageTemplate == 'template-home.php' && class_exists( 'WooCommerce' ) ) {
		add_meta_box(
		'bestore_options-bestore-options', __( 'Page Options', 'bestore' ), 'bestore_options_html', 'page', 'normal', 'high'
		);
	}
}

add_action( 'add_meta_boxes', 'bestore_options_add_meta_box' );

function bestore_options_html( $post ) {
	wp_nonce_field( '_bestore_options_nonce', 'bestore_options_nonce' );
	$post_id = get_the_ID();

	if ( get_post_type( $post_id ) != 'page' ) {
		return;
	}
	$value = get_post_meta( $post_id, 'bestore_cat', true );
	?>

	<label>
		<input type="checkbox" value="1" <?php checked( $value, true, true ); ?> name="bestore_cat" /><?php esc_html_e( 'Enable random product categories', 'bestore' ); ?>
	</label>

	<?php
}

function bestore_options_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	if ( !isset( $_POST[ 'bestore_options_nonce' ] ) || !wp_verify_nonce( $_POST[ 'bestore_options_nonce' ], '_bestore_options_nonce' ) )
		return;
	if ( !current_user_can( 'edit_post', $post_id ) )
		return;

	if ( isset( $_POST[ 'bestore_cat' ] ) ) {
		update_post_meta( $post_id, 'bestore_cat', esc_attr( $_POST[ 'bestore_cat' ] ) );
	} else {
		delete_post_meta( $post_id, 'bestore_cat' );
	}
}

add_action( 'save_post', 'bestore_options_save' );
