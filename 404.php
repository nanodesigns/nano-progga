<?php
// HEADER OF NANO BANGLA
?>
    <!DOCTYPE html>
    <!--[if IE 7 | IE 8]>
    <html class="ie" lang="en-US">
    <![endif]-->
    <!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <title>
            <?php wp_title('&mdash;',true,'right'); ?>
            <?php bloginfo('name'); ?>
        </title>

        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimumscale=1.0, maximum-scale=1.0">
        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_stylesheet_uri(); ?>" />

        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

<!--[if lt IE 9]>
<div class="chromeframe">Your browser is out of date. Please <a href="http://browsehappy.com/">upgrade your browser </a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>.</div>
<![endif]-->

    <content>

        <div class="not-found-holder">

            <div id="post-0" class="post error404 not-found">
                <div class="not-found-image">
                    <div class="bat-image"></div>
                </div> <!-- .not-found-image -->
                <h2 class="entry-title">404</h2>
                <div class="small-texts">NOT FOUND</div>
                <div class="entry-content">
                    <p><?php _e( '<strong>দুঃখিত! পাওয়া গেল না।</strong><br/> একটু অনুসন্ধান করে দেখা যেতে পারে...', 'nano-progga' ); ?></p>
                    <?php get_search_form(); ?>
                    <a class="back-to-home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="&laquo; BACK TO HOME PAGE" rel="home"></a>
                </div><!-- .entry-content -->
            </div><!-- #post-0 -->

        </div><!-- .not-found-holder -->

    </content>

<footer>

</footer>

</body>
</html>