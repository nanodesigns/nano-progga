<?php
if ( post_password_required() )
	return;
?>
<?php $comments_status = ( comments_open() ? ' post-comments-open' : ' post-comments-closed'); ?>
<div id="comments" class="comments-area<?php echo $comments_status; ?>">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( '&ldquo;%2$s&rdquo;-এ ১টি মন্তব্য রয়েছে', '&ldquo;%2$s&rdquo;-এ %1$sটি মন্তব্য রয়েছে', get_comments_number(), 'nano-progga' ),
                    make_bangla_number( number_format_i18n( get_comments_number() ) ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'nano_comments', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'মন্তব্য ন্যাভিগেশন', 'nano-progga' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; পুরোন মন্তব্যসমূহ', 'nano-progga' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'সাম্প্রতিক মন্তব্যসমূহ &rarr;', 'nano-progga' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		    <p class="nocomments"><?php _e( 'মন্তব্য বন্ধ আছে' , 'nano-progga' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

    <?php
    $required_text = '';
    $aria_req = 'aria-required';

    $args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'submit',
        'title_reply'       => __( 'মন্তব্য করুন', 'nano-progga' ),
        'title_reply_to'    => __( '%s-এর প্রতি মন্তব্য করুন', 'nano-progga' ),
        'cancel_reply_link' => __( '[ প্রত্যুত্তর বাতিল করো ]', 'nano-progga' ),
        'label_submit'      => __( 'মন্তব্য জমা করো', 'nano-progga' ),

        'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __( 'মন্তব্য', 'nano-progga' ) .
        '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
        '</textarea></p>',

        'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'মন্তব্য করতে আপনাকে <a href="%s">লগ ইন</a> করতে হবে।' ),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

        'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( '<a href="%1$s">%2$s</a> হিসেবে লগইন করেছেন। <a href="%3$s" title="এই অ্যাকাউন্ট থেকে লগ আউট করুন।">লগ আউট?</a>' ),
            admin_url( 'profile.php' ),
            $user_identity,
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
        ) . '</p>',

        'comment_notes_before' => '<p class="comment-notes">' .
        __( 'আপনার ই-মেইল ঠিকানা প্রকাশ করা হবে না।', 'nano-progga' ) . ( $req ? $required_text : '' ) .
        '</p>',

        'comment_notes_after' => '<p class="form-allowed-tags">' .
        sprintf(
            __( 'আপনি এই <abbr title="HyperText Markup Language">HTML</abbr> ট্যাগ এবং অ্যাট্রিবিউটগুলো ব্যবহার করতে পারেন: %s' ),
            ' <code>' . allowed_tags() . '</code>'
        ) . '</p>',

        'fields' => apply_filters( 'comment_form_default_fields', array(

                'author' =>
                '<p class="comment-form-author">' .
                '<label for="author">' . __( 'আপনার নাম', 'nano-progga' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30"' . $aria_req . ' /></p>',

                'email' =>
                '<p class="comment-form-email"><label for="email">' . __( 'ই-মেইল', 'nano-progga' ) . '</label> ' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"' . $aria_req . ' /></p>',

                'url' =>
                '<p class="comment-form-url"><label for="url">' .
                __( 'ওয়েবসাইট', 'nano-progga' ) . '</label>' .
                '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                '" size="30" /></p>'
            )
        ),
    );
    ?>
	<?php comment_form( $args ); ?>

    <?php if( !comments_open() ) : ?>
        <div class="disabled-comment"><span class="comment-disabled"></span> <?php printf( __( 'এপাতায় মন্তব্য রহিত আছে', 'nano-progga' ) ); ?></div>
    <?php endif; ?>

</div><!-- #comments .comments-area -->