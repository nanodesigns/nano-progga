<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package nano-progga
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

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'nano-progga' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      	=> 'ol',
					'short_ping'	=> true,
					'avatar_size'	=> 80,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'nano-progga' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'nano-progga' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'nano-progga' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'nano-progga' ); ?></p>
	<?php endif; ?>

	<?php //comment_form(); ?>

	<?php
    $required_text = '';
    $aria_req = 'aria-required';

    $args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'submit',
        'title_reply'       => __( 'Comment Here', 'nano-progga' ),
        'title_reply_to'    => __( 'Comment to %s', 'nano-progga' ),
        'cancel_reply_link' => __( '[ Cancel Reply ]', 'nano-progga' ),
        'label_submit'      => __( 'Comment', 'nano-progga' ),
        'class_submit' 		=> 'btn btn-primary',

        'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'nano-progga' ) .
        '</label><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true">' .
        '</textarea></p>',

        'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'You have to <a href="%s">login</a> to comment', 'nano-progga' ),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

        'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out from this account">Log out?</a>', 'nano-progga' ),
            admin_url( 'profile.php' ),
            $user_identity,
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
        ) . '</p>',

        'comment_notes_before' => '<p class="comment-notes">' .
        __( 'Your email won\'t be public', 'nano-progga' ) . ( $req ? $required_text : '' ) .
        '</p>',

        'comment_notes_after' => '<p class="form-allowed-tags">' .
        sprintf(
            __( 'You can use these <abbr title="HyperText Markup Language">HTML</abbr> tags and markups: %s', 'nano-progga' ),
            ' <code>' . allowed_tags() . '</code>'
        ) . '</p>',

        'fields' => apply_filters( 'comment_form_default_fields', array(

                'author' =>
                '<p class="comment-form-author">' .
                '<label for="author">' . __( 'Name', 'nano-progga' ) . '</label> ' .
                ( $req ? '<span class="red">*</span>' : '' ) .
                '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30"' . $aria_req . ' /></p>',

                'email' =>
                '<p class="comment-form-email"><label for="email">' . __( 'Email', 'nano-progga' ) . '</label> ' .
                ( $req ? '<span class="red">*</span>' : '' ) .
                '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"' . $aria_req . ' /></p>',

                'url' =>
                '<p class="comment-form-url"><label for="url">' .
                __( 'Website', 'nano-progga' ) . '</label>' .
                '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                '" size="30" /></p>'
            )
        ),
    );
    ?>
	<?php comment_form( $args ); ?>

</div><!-- #comments -->
