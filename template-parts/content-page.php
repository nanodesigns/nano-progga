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
    $ps_title = 'Post Format Gallery';
    $title_class = 'gallery-title';
    $content_class = 'gallery-content';
} else if( $ps_image ) {
    $ps_class = 'fa-image';
    $ps_title = 'Post Format Image';
    $title_class = 'image-title';
    $content_class = 'image-content';
} else if( $ps_video ) {
    $ps_class = 'fa-play-circle';
    $ps_title = 'Post Format Video';
    $title_class = 'video-title';
    $content_class = 'video-content';
} else if( $ps_audio ) {
    $ps_class = 'fa-volume-up';
    $ps_title = 'Post Format Audio';
    $title_class = 'audio-title';
    $content_class = 'audio-content';
} else if( $ps_quote ) {
    $ps_class = 'fa-quote-left';
    $ps_title = 'Post Format Quote';
    $title_class = 'quote-title';
    $content_class = 'quote-content';
} else if( $ps_link ) {
    $ps_class = 'fa-link';
    $ps_title = 'Post Format Link';
    $title_class = 'link-title';
    $content_class = 'link-content';
} else if( $ps_aside ) {
    $ps_class = 'fa-align-left';
    $ps_title = 'Post Format Aside';
    $title_class = 'aside-title';
    $content_class = 'aside-content';
} else if( $ps_status ) {
    $ps_class = 'fa-paw';
    $ps_title = 'Post Format Status';
    $title_class = 'status-title';
    $content_class = 'status-content';
} else if( $ps_chat ) {
    $ps_class = 'fa-comments-o';
    $ps_title = 'Post Format Chat';
    $title_class = 'chat-title';
    $content_class = 'chat-content';
} else {
    $ps_class = '';
    $ps_title = '';
    $title_class = '';
    $content_class = '';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('row page-article') ); ?>>

    <?php if( has_post_thumbnail() ) {
        $attachment_page_url = '';
        $attachment_page_url = get_attachment_link( get_post_thumbnail_id() ); ?>
        <a href="<?php echo $attachment_page_url; ?>" class="featured-image">
            <?php the_post_thumbnail(); ?>
        </a>
    <?php } ?>

    <h2 class="entry-title page-title row <?php echo $title_class; ?>">
        <?php echo $ps_class != '' ? '<span title="'. __( $ps_title , 'nano-progga') .'" class="fa '. $ps_class .'"></span>' : ''; ?>
        <?php the_title(); ?>
    </h2>

    <div class="entry-content <?php echo $content_class; ?> row">

        <?php the_content(); ?>
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

    <div class="entry-meta entry-meta-bottom row">
        <span class="entry-meta-item author vcard">
            <span class="fa fa-user" title="<?php _e( 'Author', 'nano-progga' ); ?>"></span>
            <a class="url fn n" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'nano-progga' ), $authordata->display_name ); ?>">
                <?php the_author(); ?>
            </a>
        </span>

        <span class="seperator-v">|</span>

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

        <?php // SPECIFIC TO SINGLE POST ENTRY ?>
        <?php if( is_single() ) { ?>

            <table class="structure-table">
                <tbody>
                    <tr class="cat-links">
                        <td class="controlled-speciality">
                            <span class="fa fa-folder-open-o" title="<?php _e('Categories', 'nano-progga'); ?>"></span>
                        </td>
                        <td><?php echo get_the_category_list(' | '); ?></td>
                    </tr>
                    <tr class="tag-links">
                        <td class="controlled-speciality">
                            <span class="tag-links"><span class="fa fa-tags" title="<?php _e('Tags', 'nano-progga'); ?>"></span>
                        </td>
                        <td><?php the_tags( '', ' | ', '' ); ?></td>
                    </tr>
                </tbody>
            </table>

        <?php } ?>

        <?php if( is_page() ) {
            edit_post_link( __( '[edit this page]', 'nano-progga' ), '<span class="post-edit-link">', '</span>' );
        } else {
            edit_post_link( __( '[edit this post]', 'nano-progga' ), '<span class="post-edit-link">', '</span>' );
        } ?>

    </div> <!-- .entry-meta .entry-meta-bottom -->

</article> <!-- #post-<?php the_ID(); ?> -->