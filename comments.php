<?php
if ( post_password_required() )
	return;
?>
<?php $comments_status = ( comments_open() ? ' post-comments-open' : ' post-comments-closed'); ?>

<?php if ( comments_open() ) { ?>

<div id="comments" class="comments-area<?php echo $comments_status; ?>">

		<h2 class="comments-title">
			<?php
				printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'nano-progga' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'nano_comments', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation row" role="navigation">
			<h1 class="sr-only assistive-text section-heading"><?php _e( 'Comment Navigation', 'nano-progga' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '<span class="fa fa-chevron-left"></span> Older Comments', 'nano-progga' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="fa fa-chevron-right"></span>', 'nano-progga' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		    <p class="nocomments"><?php _e( 'Comment is Closed' , 'nano-progga' ); ?></p>
		<?php endif; ?>

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

        'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'nano-progga' ) .
        '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
        '</textarea></p>',

        'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'You have to <a href="%s">login</a> to comment' ),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

        'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out from this account">Log out?</a>' ),
            admin_url( 'profile.php' ),
            $user_identity,
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
        ) . '</p>',

        'comment_notes_before' => '<p class="comment-notes">' .
        __( 'Your email won\'t be public', 'nano-progga' ) . ( $req ? $required_text : '' ) .
        '</p>',

        'comment_notes_after' => '<p class="form-allowed-tags">' .
        sprintf(
            __( 'You can use these <abbr title="HyperText Markup Language">HTML</abbr> tags and markups: %s' ),
            ' <code>' . allowed_tags() . '</code>'
        ) . '</p>',

        'fields' => apply_filters( 'comment_form_default_fields', array(

                'author' =>
                '<p class="comment-form-author">' .
                '<label for="author">' . __( 'Name', 'nano-progga' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30"' . $aria_req . ' /></p>',

                'email' =>
                '<p class="comment-form-email"><label for="email">' . __( 'Email', 'nano-progga' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"' . $aria_req . ' /></p>',

                'url' =>
                '<p class="comment-form-url"><label for="url">' .
                __( 'Website', 'nano-progga' ) . '</label>' .
                '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                '" size="30" /></p>'
            )
        ),
    );
    ?>
	<?php comment_form( $args ); ?>

</div><!-- #comments .comments-area -->

<?php } //endif have_comments() ?>