<?php
/**
 * Custom template tags for this theme.
 *
 * @package Forma
 */

if ( ! function_exists( 'jgtforma_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post date and author.
 */
function jgtforma_posted_on() {
	if ( 'post' === get_post_type() ) {
		printf( '<span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span>',
			esc_html_x( 'Author', 'Used before post author name.', 'forma' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
		jgtforma_entry_date();
	} elseif ( 'attachment' === get_post_type() ) {
		jgtforma_entry_date();
		if ( wp_attachment_is_image() ) {
			$metadata = wp_get_attachment_metadata();
			printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
				esc_html_x( 'Full size', 'Used before full size attachment link.', 'forma' ),
				esc_url( wp_get_attachment_url() ),
				absint( $metadata['width'] ),
				absint( $metadata['height'] )
			);
		}
	}
	if ( comments_open() || get_comments_number() ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'forma' ), esc_html__( '1 Comment', 'forma' ), esc_html__( '% Comments', 'forma' ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'jgtforma_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the tags.
 */
function jgtforma_entry_footer() {
	if ( 'post' === get_post_type() ) {
		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list && jgtforma_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="meta-before">%1$s</span> %2$s</span>',
				esc_html_x( 'Posted in:', 'Used before category links', 'forma' ),
				$categories_list
			);
		}
		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) {
			printf( '<span class="tag-links"><span class="meta-before">%1$s</span> %2$s</span>',
				esc_html_x( 'Tagged:', 'Used before tag links', 'forma' ),
				$tags_list
			);
		}
	} elseif ( 'attachment' === get_post_type() ) {
		previous_post_link( '<div class="parent-post-link"><span class="meta-before">' . esc_html__( 'Published in:', 'forma' ) . '</span> %link</div>', '%title' );
	}
}
endif;

if ( ! function_exists( 'jgtforma_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 */
function jgtforma_post_thumbnail() {
	if ( is_attachment() || ! has_post_thumbnail() )
		return;
	if ( is_singular() ) {
	?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->
	<?php
	} else {
		$size = ( get_theme_mod( 'jgtforma_layout' ) === 'one_column' ) ? 'post-thumbnail' : 'jgtforma-grid';
		?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $size, array( 'alt' => get_the_title() ) ); ?></a>
		<?php
	}
}
endif;

if ( ! function_exists( 'jgtforma_entry_date' ) ) :
/**
 * Prints HTML with date information for the current post.
 */
function jgtforma_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);
	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		esc_html_x( 'Posted on', 'Used before publish date.', 'forma' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;

if ( ! function_exists( 'jgtforma_get_link_url' ) ) :
/**
 * Returns the first link found in the post content.
 * Falls back to the post permalink if no URL is found.
 */
function jgtforma_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );
	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function jgtforma_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'jgtforma_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'jgtforma_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so jgtforma_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so jgtforma_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in jgtforma_categorized_blog.
 */
function jgtforma_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'jgtforma_categories' );
}
add_action( 'edit_category', 'jgtforma_category_transient_flusher' );
add_action( 'save_post', 'jgtforma_category_transient_flusher' );

if ( ! function_exists( 'jgtforma_excerpt_more' ) ) :
/**
 * Replace "[...]" (appended to automatically generated excerpts) with ... and a 'Read More' link.
 */
function jgtforma_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	$link ='';
	if ( get_theme_mod( 'jgtforma_layout' ) === 'one_column' ) {
		$link = sprintf( '<span class="read-more"><a href="%1$s" class="more-link">%2$s</a></span>',
			esc_url( get_permalink( get_the_ID() ) ),
			esc_html__( 'Read More', 'forma' )
		);
	}
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'jgtforma_excerpt_more' );
endif;

if ( ! function_exists( 'jgtforma_excerpt_length' ) ) :
/**
 * Change the excerpt length.
 */
function jgtforma_excerpt_length( $length ) {
	return get_theme_mod( 'jgtforma_excerpt_length', 55 );
}
add_filter( 'excerpt_length', 'jgtforma_excerpt_length' );
endif;

/**
 * Wrap "Read more" link.
 */
function jgtforma_wrap_more_link( $more ) {
	return '<span class="read-more">' . $more . '</span>';
}
add_filter( 'the_content_more_link','jgtforma_wrap_more_link' );

if ( ! function_exists( 'jgtforma_loop_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function jgtforma_loop_navigation() {
	if ( get_theme_mod( 'jgtforma_posts_nav' ) === 'next_prev' ) {
		the_posts_navigation( array (
			'prev_text' => '<span class="fa-arrow-left-custom" aria-hidden="true"></span> ' . esc_html__( 'Older posts', 'forma' ),
			'next_text' => esc_html__( 'Newer posts', 'forma' ) . ' <span class="fa-arrow-right-custom" aria-hidden="true"></span>',
		) );
	} else {
		the_posts_pagination( array(
			'prev_text'          => '<span class="fa-arrow-left-custom" aria-hidden="true"></span> ' . esc_html__( 'Previous', 'forma' ),
			'next_text'          => esc_html__( 'Next', 'forma' ) . ' <span class="fa-arrow-right-custom" aria-hidden="true"></span>',
			'before_page_number' => '<span class="screen-reader-text">' . esc_html__( 'Page', 'forma' ) . ' </span>'
		) );
	}
}
endif;

/**
 * Template for comments and pingbacks.
 */
function jgtforma_comment( $comment, $args, $depth ) {
	global $post;
	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) :
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'forma' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'forma' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	<?php else : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author vcard">
				<div class="avatar-container">
					<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
				<b class="fn"><?php comment_author_link(); ?></b> <span class="screen-reader-text"><?php esc_html_e( 'says:', 'forma' ); ?></span>
				<?php if( $comment->user_id === $post->post_author ) { ?>
				<span class="author-badge"><?php esc_html_e( 'Author', 'forma' ); ?></span>
				<?php } ?>
			</div>
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'forma' ); ?></p>
			<?php endif; ?>
			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
			<footer class="comment-meta">
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( esc_html__( '%1$s at %2$s', 'forma' ), get_comment_date(), get_comment_time() ) ?></a><?php edit_comment_link( esc_html__( 'Edit', 'forma' ), ' &#47; <span class="edit-link">', '</span>' ); ?>
				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth' => $depth,
					'max_depth' => $args['max_depth'],
					'before' => ' &mdash; <span class="reply">',
					'after'  => '</span>'
				) ) );
				?>
			</footer>
		</article><!-- .comment-body -->
	<?php
	endif;
}
