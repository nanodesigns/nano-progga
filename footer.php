</div> <!-- .wrapper -->

<footer>
    <div class="wrapper footer-border">
        <?php if( is_active_sidebar('footer_widgets_area') ) { ?>
            <?php
            $our_sidebar = wp_get_sidebars_widgets();
            $widget_counter = count( $our_sidebar['footer_widgets_area'] );
            ?>
            <style type="text/css" id="footer-widget-css">
                <?php
                // When 1 widget is active
                if( $widget_counter == 1 ) {
                ?>

                #footer-widget-area ul.xoxo li.widget-container{
                    width: 100%;
                    margin: 0;
                }

                <?php
                // When 2 widgets are active
                } elseif( $widget_counter == 2 ){
                ?>

                #footer-widget-area ul.xoxo li.widget-container{
                    width: 48%;
                }

                #footer-widget-area ul.xoxo li.footer-widget-1{
                    margin-left: 0;
                }

                #footer-widget-area ul.xoxo li.footer-widget-2{
                    margin-right: 0;
                    float: right;
                }

                <?php
                // When 3 widgets are active
                } elseif( $widget_counter == 3 ){
                ?>

                #footer-widget-area ul.xoxo li.widget-container{
                    width: 31.3%;
                }

                #footer-widget-area ul.xoxo li.footer-widget-1{
                    margin-left: 0;
                }

                #footer-widget-area ul.xoxo li.footer-widget-3{
                    margin-right: 0;
                    float: right;
                }

                <?php
                // When 4 or more widgets are active
                } else {
                ?>

                #footer-widget-area ul.xoxo li.widget-container{
                    width: 22.5%;
                }

                #footer-widget-area ul.xoxo li.footer-widget-1{
                    margin-left: 0;
                }

                #footer-widget-area ul.xoxo li.footer-widget-4{
                    margin-right: 0;
                    float: right;
                }

                <?php } ?>
            </style>

            <div id="footer-widget-area" class="widget-area">
                <ul class="xoxo">
                    <?php dynamic_sidebar('footer_widgets_area'); ?>
                </ul>
            </div><!-- #footer-widget-area .widget-area -->
        <?php } ?>
    </div>

    <div class="wrapper dev-info">
        Powered by <span id="generator-link">
            <a href="http://wordpress.org/" title="<?php _e( 'WordPress', 'nano-progga' ) ?>" rel="generator">
                <?php _e( 'WordPress', 'nano-progga' ) ?></a>
        </span> and the theme <strong>nano pr&oacute;gg&aacute;</strong> is developed by <span id="theme-link">
            <a href="http://www.nanodesignsbd.com/" title="<?php _e( 'Developed by nanodesigns, Bangladesh', 'nano-progga' ) ?>" rel="designer">
                <?php _e( '<strong>nano</strong>designs', 'nano-progga' ) ?></a>
        </span>
    </div>

    <?php
    /**
     * If any of the social media field is filled
     * in admin panel, then show the social bar
     */
    $social_options = get_option( 'nanodesigns_theme_display_options' );

    $rss = $social_options['rss'];
    $googleplus = $social_options['googleplus'];
    $facebook = $social_options['facebook'];
    $twitter = $social_options['twitter'];
    $youtube = $social_options['youtube'];
    $linkedin = $social_options['linkedin'];
    $pinterest = $social_options['pinterest'];
    $flickr = $social_options['flickr'];
    $tumblr = $social_options['tumblr'];

    if( $rss || $googleplus || $facebook || $twitter || $youtube || $linkedin || $pinterest || $flickr || $tumblr ) {
    ?>

    <div class="social-footer">
        <script type="text/javascript">
            function show_social(){
                var menu = document.getElementById( 'toggle-social' );

                if( menu.style.display == 'block' || menu.style.display == '' ){
                    menu.style.display = 'none';
                } else {
                    menu.style.display = 'block';
                }
            }
        </script>
        <div class="show-button" onclick="show_social()"><span class="social-close-icon"></span>SHOW/HIDE SOCIAL BAR<span class="social-close-icon"></span></div>
        <ul id="toggle-social">

            <?php if( $rss ) { ?>
                <li><a class="rss-icon" href="<?php echo $rss; ?>" title="Get our RSS feed"></a></li>
            <?php } ?>
            <?php if( $facebook ) { ?>
                <li><a class="facebook-icon" href="<?php echo $facebook; ?>" title="Get us on Facebook"></a></li>
            <?php } ?>
            <?php if( $googleplus ) { ?>
            <li><a class="googleplus-icon" href="<?php echo $googleplus; ?>" title="Get us on Google Plus"></a></li>
            <?php } ?>
            <?php if( $twitter ) { ?>
            <li><a class="twitter-icon" href="<?php echo $twitter; ?>" title="Get us on Twitter"></a></li>
            <?php } ?>
            <?php if( $youtube ) { ?>
            <li><a class="youtube-icon" href="<?php echo $youtube; ?>" title="Get us on YouTube"></a></li>
            <?php } ?>
            <?php if( $linkedin ) { ?>
            <li><a class="linkedin-icon" href="<?php echo $linkedin; ?>" title="Get us on Linked In"></a></li>
            <?php } ?>
            <?php if( $pinterest ) { ?>
            <li><a class="pinterest-icon" href="<?php echo $pinterest; ?>" title="Get us on Pinterest"></a></li>
            <?php } ?>
            <?php if( $flickr ) { ?>
            <li><a class="flickr-icon" href="<?php echo $flickr; ?>" title="Get us on Flickr"></a></li>
            <?php } ?>
            <?php if( $tumblr ) { ?>
            <li><a class="tumblr-icon" href="<?php echo $tumblr; ?>" title="Get us on Tumblr"></a></li>
            <?php } ?>
        </ul>
    </div> <!-- .social-footers -->

    <?php } //endif(get_option('show_footer')) ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>