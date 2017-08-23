<?php
/**
 * The template for displaying comments.
 *
 * @package Forma
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
<?php if ( have_comments() ) : ?>
	<h2 class="comments-title"><?php
		printf( esc_html( _nx( '%s comment', '%s comments', get_comments_number(), 'comments title', 'forma' ) ), number_format_i18n( get_comments_number() ) );
		if ( comments_open() ) {
			echo ' &#47; <a href="#respond">' . esc_html__( 'Add your comment below', 'forma' ) . '</a>';
		}
	?></h2>
	<ol class="comment-list">
		<?php
		wp_list_comments( array(
			'style'       => 'ol',
			'callback'    => 'jgtforma_comment',
			'avatar_size' => 90,
			'short_ping'  => true
		) );
	?>
	</ol><!-- .comment-list -->
	<?php
	the_comments_navigation( array(
		'prev_text' => '<span class="fa-arrow-left-custom" aria-hidden="true"></span> ' . esc_html__( 'Older comments', 'forma' ),
		'next_text' => esc_html__( 'Newer comments', 'forma' ) . ' <span class="fa-arrow-right-custom" aria-hidden="true"></span>'
	) );
	?>
<?php
endif;
// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'forma' ); ?></p>
<?php
endif;
$req      = get_option( 'require_name_email' );
$aria_req = ( $req ? ' aria-required="true"' : '' );
$html_req = ( $req ? ' required="required"' : '' );
comment_form( array(
	'fields'               => array(
		'author' => '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'forma' ) . ( $req ? '' : ' <span class="optional">' . esc_html__( '(optional)', 'forma' ) . '</span>' ) . '</label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'forma' ) . ( $req ? '' : ' <span class="optional">' . esc_html__( '(optional)', 'forma' ) . '</span>' ) . '</label> <input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'forma' ) . ' <span class="optional">' . esc_html__( '(optional)', 'forma' ) . '</span></label> <input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>'
	),
	'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html_x( 'Comment', 'noun', 'forma' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>',
	'comment_notes_before' => ''
) );
?>
</div><!-- .comments-area -->
