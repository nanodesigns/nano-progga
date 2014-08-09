<?php global $authordata; ?>

<?php
/**
*   CHECK WHETHER THE POST IS IN CERTAIN POST FORMAT
*/
$ps_gallery = has_post_format( 'gallery' );
$ps_image = has_post_format( 'image' );
$ps_video = has_post_format( 'video' );
$ps_audio = has_post_format( 'audio' );
$ps_quote = has_post_format( 'quote' );
$ps_link = has_post_format( 'link' );
$ps_aside = has_post_format( 'aside' );
$ps_status = has_post_format( 'status' );
$ps_chat = has_post_format( 'chat' );
?>

<?php
// Set certain Font Awesome icon for certain Post Format
if( $ps_gallery ) {
    $ps_class = 'fa-th';
    $ps_title = __('Post Format Gallery', 'nano-progga');
    $content_class = 'gallery-content';
} else if( $ps_image ) {
    $ps_class = 'fa-image';
    $ps_title = __('Post Format Image', 'nano-progga');
    $content_class = 'image-content';
} else if( $ps_video ) {
    $ps_class = 'fa-play-circle';
    $ps_title = __('Post Format Video', 'nano-progga');
    $content_class = 'video-content';
} else if( $ps_audio ) {
    $ps_class = 'fa-volume-up';
    $ps_title = __('Post Format Audio', 'nano-progga');
    $content_class = 'audio-content';
} else if( $ps_quote ) {
    $ps_class = 'fa-quote-left';
    $ps_title = __('Post Format Quote', 'nano-progga');
    $content_class = 'quote-content';
} else if( $ps_link ) {
    $ps_class = 'fa-link';
    $ps_title = __('Post Format Link', 'nano-progga');
    $content_class = 'link-content';
} else if( $ps_aside ) {
    $ps_class = 'fa-align-left';
    $ps_title = __('Post Format Aside', 'nano-progga');
    $content_class = 'aside-content';
} else if( $ps_status ) {
    $ps_class = 'fa-paw';
    $ps_title = __('Post Format Status', 'nano-progga');
    $content_class = 'status-content';
} else if( $ps_chat ) {
    $ps_class = 'fa-comments-o';
    $ps_title = __('Post Format Chat', 'nano-progga');
    $content_class = 'chat-content';
} else {
    $ps_class = '';
    $ps_title = '';
    $content_class = '';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('archive-article row') ); ?>>

    <div class="bookmark-text"><?php _e('Featured Post', 'nano-progga'); ?></div>

    <?php if( has_post_thumbnail() ) { ?>
    <div class="featured-image">
        <a title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
        </a>
    </div>
    <?php } ?>

    <h2 class="entry-title row">
        <?php echo $ps_class != '' ? '<span title="'. $ps_title .'" class="fa '. $ps_class .'"></span>' : ''; ?>
        <a title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
        <a class="entry-link-icon" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>"><span class="fa fa-link"></span></a>
    </h2>

    <div class="entry-meta entry-meta-top row">
        <?php
        // No need to display same data in the author archive
        if( !is_author() ) :
        ?>
            <span class="entry-meta-item author vcard">
                <span class="fa fa-user" title="<?php _e( 'Author', 'nano-progga' ); ?>"></span>
                <a class="url fn n" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'nano-progga' ), $authordata->display_name ); ?>">
                    <?php the_author(); ?>
                </a>
            </span>

            <span class="seperator-v">|</span>
        <?php endif; ?>

        <span class="entry-meta-item entry-date">
            <span class="fa fa-clock-o" title="<?php _e( 'Published on', 'nano-progga' ); ?>"></span>
            <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
                <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>">
                    <?php the_time( 'd M Y' ); ?>
                </abbr>
            </a>
        </span>

        <span class="seperator-v">|</span>

        <span class="comments-link">
            <?php
            if ( comments_open() ) :
                $comment_class = 'comment-enabled';
                $other_class = 'enabled-comment';
            else: //when comment is OFF
                $comment_class = 'comment-disabled';
                $other_class = 'disabled-comment';
            endif;
            ?>
            <span class="fa fa-comment <?php echo $comment_class; ?>" title="<?php _e( 'Comments', 'nano-progga' ); ?>"></span>
            <?php comments_popup_link( __( 'Comment Here', 'nano-progga' ), __( '1 Comment', 'nano-progga' ), __( '% Comments', 'nano-progga' ), $other_class, __( 'Comment Closed', 'nano-progga' ) ) ?>
        </span> <!-- .comments-link -->

    </div> <!-- .entry-meta .entry-meta-top -->

    <?php if( $ps_gallery || $ps_image || $ps_video || $ps_audio || $ps_quote || $ps_link || $ps_status ) { ?>

        <div class="entry-content row <?php echo $content_class != '' ? $content_class : ''; ?>">

            <?php the_content( __( 'Read More <span class="meta-nav">&rarr;</span>', 'nano-progga' ) ); ?>

            <div class="clearfix"></div>
            <?php
            wp_link_pages( array(
                    'before'      => '<div class="page-links">' . __( 'Pages: ', 'nano-progga' ),
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
            
        </div> <!-- .entry-content -->
        <div class="block-read-more"><?php echo block_excerpt_more( 2 ); ?></div>

    <?php } else { ?>

        <div class="entry-excerpt row">

            <?php nano_excerpt( $limit = 100, $more = false ); ?>
            <div class="clearfix"></div>
            <?php
            wp_link_pages( array(
                    'before'      => '<div class="page-links">' . __( 'Pages: ', 'nano-progga' ),
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
            
        </div> <!-- .entry-excerpt -->
        <div class="block-read-more"><?php echo block_excerpt_more(); ?></div>

    <?php } //endif post format ?>

</article> <!-- #post-<?php the_ID(); ?> -->