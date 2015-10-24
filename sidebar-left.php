<?php
/**
 * The sidebar containing the widget area that is visible only in the archive pages.
 *
 * @package nano-progga
 */

if ( ! is_active_sidebar( 'left_sidebar' ) ) {
	return;
}
?>

<div id="secondary-left" class="widget-area col-sm-3 pull-left" role="complementary">

	<?php
    // if checked in Theme Options page, then show the author bio on author archives
    if( cs_get_option('author_bio') && is_author() )  {
        global $authordata; ?>
        <aside id="author-<?php echo $authordata->ID; ?>" class="widget author-profile vcard">
            <?php
            // avatar
            $avatar = str_replace( "class='avatar", "class='photo avatar alignleft", get_avatar( $authordata->user_email, 50 ) );
            echo $avatar;
            // author description
            $authordesc = $authordata->user_description;
            echo '<div class="author-desc">';
                if ( !empty($authordesc) ) {
                    echo apply_filters( 'archive_meta', $authordesc );
                } else {
                    _e('Author did not provide any public biography', 'nano-progga');
                }
            echo '</div>';
            ?>
            <div class="author-meta text-center">
                <?php $url = $authordata->user_url; ?>
                <a href="mailto:<?php echo $authordata->user_email; ?>" class="np-mail"></a>
                <a href="<?php echo $url != '' ? esc_url( $url ) : '#'; ?>" class="np-globe url"></a>

                <?php
                // Meta Fields
                $gplus = get_user_meta( $authordata->ID, 'nano_google_plus', true );
                $twitter = get_user_meta( $authordata->ID, 'nano_twitter', true );
                $facebook = get_user_meta( $authordata->ID, 'nano_facebook', true );
                $linkedin = get_user_meta( $authordata->ID, 'nano_linkedin', true );
                $pinterest = get_user_meta( $authordata->ID, 'nano_pinterest', true );
                $tumblr = get_user_meta( $authordata->ID, 'nano_tumblr', true );
                ?>
                <a href="<?php echo $gplus != '' ? $gplus : '#'; ?>" class="np-google-plus"></a>
                <a href="<?php echo $twitter != '' ? $twitter : '#'; ?>" class="np-twitter"></a>
                <a href="<?php echo $facebook != '' ? $facebook : '#'; ?>" class="np-facebook"></a>
                <a href="<?php echo $linkedin != '' ? $linkedin : '#'; ?>" class="np-linkedin"></a>
                <a href="<?php echo $pinterest != '' ? $pinterest : '#'; ?>" class="np-pinterest"></a>
                <a href="<?php echo $tumblr != '' ? $tumblr : '#'; ?>" class="np-tumblr"></a>
            </div> <!-- .author-meta -->
        </aside>
    <?php } //endif(cs_get_option('author_bio')) ?>

	<?php dynamic_sidebar( 'left_sidebar' ); ?>
</div><!-- #secondary-left -->
