<aside id="left-sidebar">

    <h2 class="sidebar-head"><?php _e( 'Sidebar Left', 'nano-progga' ); ?></h2>

    <?php if( is_active_sidebar('left_sidebar') ) { ?>

        <div id="secondary" class="widget-area">
            <ul class="xoxo">

                <?php
                // Retrive Data from Theme Options page
                $option = get_option('site_options');

                // if checked (val 1) then show the author bio on author archives
                if( $option['author_bio'] == 1 )  {

                    // if is author archive
                    // then show an author bio with social links
                    if ( is_author() ) : ?>
                        <?php global $authordata; ?>
                        <li id="author-<?php echo $authordata->ID; ?>" class="widget-container author-profile vcard">
                            <?php
                            // avatar
                            $avatar = str_replace( "class='avatar", "class='photo avatar sidebar-avatar", get_avatar( $authordata->email, 80 ) );
                            echo $avatar;
                            // author description
                            $authordesc = $authordata->user_description;
                            echo '<div class="author-desc">';
                                if ( !empty($authordesc) ) {
                                    echo apply_filters( 'archive_meta', $authordesc );
                                } else {
                                    echo __('Author did not provide any public biography content', 'nano-progga');
                                }
                            echo '</div>';
                            ?>
                            <div class="author-meta">
                                <?php $url = $authordata->user_url; ?>
                                <a href="mailto:<?php echo $authordata->user_email; ?>" class="fa fa-envelope-o"></a>
                                <a href="<?php echo $url != '' ? $url : '#'; ?>" class="fa fa-globe url"></a>

                                <?php
                                // Meta Fields
                                $gplus = get_user_meta( $authordata->ID, 'nano_google_plus', true );
                                $twitter = get_user_meta( $authordata->ID, 'nano_twitter', true );
                                $facebook = get_user_meta( $authordata->ID, 'nano_facebook', true );
                                $linkedin = get_user_meta( $authordata->ID, 'nano_linkedin', true );
                                $pinterest = get_user_meta( $authordata->ID, 'nano_pinterest', true );
                                $tumblr = get_user_meta( $authordata->ID, 'nano_tumblr', true );
                                ?>
                                <a href="<?php echo $gplus != '' ? $gplus : '#'; ?>" class="fa fa-google-plus"></a>
                                <a href="<?php echo $twitter != '' ? $twitter : '#'; ?>" class="fa fa-twitter"></a>
                                <a href="<?php echo $facebook != '' ? $facebook : '#'; ?>" class="fa fa-facebook"></a>
                                <a href="<?php echo $linkedin != '' ? $linkedin : '#'; ?>" class="fa fa-linkedin"></a>
                                <a href="<?php echo $pinterest != '' ? $pinterest : '#'; ?>" class="fa fa-pinterest"></a>
                                <a href="<?php echo $tumblr != '' ? $tumblr : '#'; ?>" class="fa fa-tumblr"></a>
                            </div> <!-- .author-meta -->
                        </li>
                    <?php endif; ?>
                <?php } //endif( $option['author_bio'] ) ?>

                <?php dynamic_sidebar('left_sidebar'); ?>

            </ul>
        </div><!-- #secondary .widget-area -->

    <?php } else { ?>

        <div id="secondary" class="widget-area">
            <ul class="xoxo">

                <li id="default-widget-1" class="widget-container default-widgets">
                    <h3 class="widget-title"><?php _e( 'Archives', 'nano-progga' ); ?></h3>
                    <ul>
                        <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                    </ul>
                </li> <!-- #default-widget-1 -->

                <li id="default-widget-2" class="widget-container default-widgets">
                    <h3 class="widget-title"><?php _e( 'Pages', 'nano-progga' ); ?></h3>
                    <ul>
                        <?php wp_list_pages('sort_column=menu_order&title_li='); ?>
                    </ul>
                </li> <!-- #default-widget-2 -->

            </ul> <!-- .xoxo -->
        </div><!-- #secondary .widget-area -->

    <?php } //endif( is_active_sidebar ?>

</aside>