<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>

        <title><?php wp_title(' • ',true,'right'); ?></title>

        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <!-- Responsive and mobile friendly stuff -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>

        <!--[if lt IE 6]>
        <div class="chromeframe">Old days are good, but not Internet Explorer. Please <a href="http://browsehappy.com/">upgrade your browser </a> or <a href="https://www.google.com/chrome/">install Google Chrome</a>.</div>
        <![endif]-->

        <?php
        // Retrive Data from Theme Options page
        $option = get_option('site_options');
        ?>

        <div class="top-head row">
    		<div class="wrapper">
                <div class="social-connections">
                    <a href="#site-content" class="skip-link" title="<?php _e( 'Skip to content', 'nano-progga' ); ?>">
                        <span class="fa fa-caret-down"></span>
                        <?php _e( 'Skip to content', 'nano-progga' ); ?>
                    </a>

                    <?php
                    // Dynamically show/hide social icons
                    $fbURL = $option['facebookURL']; //Facebook
                    $twtURL = $option['twitterURL']; //Twitter
                    $lnkdinURL = $option['linkedinURL']; //LinkedIn
                    $gplusURL = $option['googleplusURL']; //Google+
                    $flickrURL = $option['flickrURL']; //Flickr
                    $pinterestURL = $option['pinterestURL']; //Pinterest
                    $tubmlrURL = $option['tubmlrURL']; //Tumblr
                    $youtubeURL = $option['youtubeURL']; //YouTube
                    ?>
                    <div class="sr-only"><?php _e('Our Social Links', 'nano-progga'); ?></div>
                    <a class="s-rss" href="<?php echo get_feed_link(); ?>" title="RSS Feed URL"><span class="fa fa-rss"></span></a>
                    <?php if($fbURL) { ?>
                        <a class="s-facebook" href="<?php echo $fbURL; ?>" target="_blank" title="Facebook Page URL"><span class="fa fa-facebook"></span></a>
                    <?php } ?>
                    <?php if($twtURL) { ?>
                        <a class="s-twitter" href="<?php echo $twtURL; ?>" target="_blank" title="Twitter Account URL"><span class="fa fa-twitter"></span></a>
                    <?php } ?>
                    <?php if($lnkdinURL) { ?>
                        <a class="s-linkedin" href="<?php echo $lnkdinURL; ?>" target="_blank" title="LinkedIn Page URL"><span class="fa fa-linkedin"></span></a>
                    <?php } ?>
                    <?php if($gplusURL) { ?>
                        <a class="s-gplus" href="<?php echo $gplusURL; ?>" target="_blank" title="Google Plus Page URL"><span class="fa fa-google-plus"></span></a>
                    <?php } ?>
                    <?php if($flickrURL) { ?>
                        <a class="s-flickr" href="<?php echo $flickrURL; ?>" target="_blank" title="Flickr Account URL"><span class="fa fa-flickr"></span></a>
                    <?php } ?>
                    <?php if($pinterestURL) { ?>
                        <a class="s-pinterest" href="<?php echo $pinterestURL; ?>" target="_blank" title="Pinterest Account URL"><span class="fa fa-pinterest"></span></a>
                    <?php } ?>
                    <?php if($tubmlrURL) { ?>
                        <a class="s-tumblr" href="<?php echo $tubmlrURL; ?>" target="_blank" title="Tumblr Blog URL"><span class="fa fa-tumblr"></span></a>
                    <?php } ?>
                    <?php if($youtubeURL) { ?>
                        <a class="s-youtube" href="<?php echo $youtubeURL; ?>" target="_blank" title="YouTube Channel URL"><span class="fa fa-youtube"></span></a>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div> <!-- .social-connections -->
                <nav id="site-navigation">
                    <?php wp_nav_menu( array( 'walker' => new arrow_walker_nav_menu, 'theme_location'=>'main-menu', 'menu_class' => 'main-menu', 'container_class' => 'main-menu-container row' , 'fallback_cb'=>'wp_page_menu') ); ?>
                </nav>                
                <div class="clearfix"></div>
            </div> <!-- .wrapper -->
    	</div> <!-- .top-head -->

    	<header id="site-head" class="row" role="banner">
    		<div class="wrapper">
    			<h1 id="site-title"><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
    		</div>
    	</header>

        <div id="site-content" class="main-area row">