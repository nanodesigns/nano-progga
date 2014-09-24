<?php global $authordata;

/**
*   CHECK WHETHER THE POST IS IN CERTAIN POST FORMAT
*   then set certain Font Awesome icon for certain Post Format
*/
if( has_post_format( 'gallery' ) ) {
    $ps_class = 'fa-th-large';
} else if( has_post_format( 'image' ) ) {
    $ps_class = 'fa-image';
} else if( has_post_format( 'video' ) ) {
    $ps_class = 'fa-play-circle';
} else if( has_post_format( 'audio' ) ) {
    $ps_class = 'fa-volume-up';
} else if( has_post_format( 'quote' ) ) {
    $ps_class = 'fa-quote-left';
} else if( has_post_format( 'link' ) ) {
    $ps_class = 'fa-link';
} else if( has_post_format( 'aside' ) ) {
    $ps_class = 'fa-align-left';
} else if( has_post_format( 'status' ) ) {
    $ps_class = 'fa-paw';
} else if( has_post_format( 'chat' ) ) {
    $ps_class = 'fa-comments-o';
} else {
    $ps_class = '';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('row page-article h-entry') ); ?>>

    <?php if( has_post_thumbnail() ) {
        $attachment_page_url = '';
        $attachment_page_url = get_attachment_link( get_post_thumbnail_id() ); ?>
        <a href="<?php echo $attachment_page_url; ?>" class="featured-image">
            <?php the_post_thumbnail(); ?>
        </a>
    <?php } ?>

    <h2 class="entry-title page-title row p-name">
        <?php echo $ps_class != '' ? '<span title="" class="fa '. $ps_class .'"></span>' : ''; ?>
        <?php the_title(); ?>
    </h2>

    <div class="entry-content row e-content">

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
            <a class="url fn n p-author" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'nano-progga' ), $authordata->display_name ); ?>">
                <?php the_author(); ?>
            </a>
        </span>

        <span class="seperator-v">|</span>

        <span class="entry-meta-item entry-date">
            <span class="fa fa-clock-o" title="<?php _e( 'Published on', 'nano-progga' ); ?>"></span>
            <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
                <abbr class="published dt-published" title="<?php the_time('Y-m-d\TH:i:sO') ?>">
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
                        <td class="p-category"><?php echo get_the_category_list(' | '); ?></td>
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