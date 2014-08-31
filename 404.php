<!DOCTYPE html>
<html <?php language_attributes(); ?>

    <head>

        <title><?php wp_title(' • ',true,'right'); ?></title>

        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>

        <!-- Responsive and mobile friendly stuff -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>

        <!--[if lt IE 6]>
        <div class="chromeframe">Old days are good, but not Internet Explorer. Please <a href="http://browsehappy.com/">upgrade your browser </a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>.</div>
        <![endif]-->

        <div class="main-area row">
        	
			<div class="wrapper">

                <div class="content-full content-404 hfeed">

                    <h2 class="entry-title page-title title-404 row p-name">
                        <?php _e( 'Error 404 : Not Found', 'nano-progga' ); ?>
                    </h2>
                    
                    <div class="entry-content entry-404">
                        <div><?php _e( 'So, it\'s an infinite loop - you are looking for something, and we can\'t find', 'nano-progga' ); ?></div>
                        <span class="fa fa-refresh fa-spin"></span>
                        <div class="error-search">
                            <?php _e( 'Why not have some search?', 'nano-progga' ); ?>
                            <?php get_search_form(); ?>
                        </div>
                    </div>


                </div> <!-- .content -->
                
                <div class="clearfix"></div>

            </div> <!-- .wrapper -->

        </div> <!-- .main-area -->

        <div class="wrapper text-center">
            <h1 class="error-footer-title"><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><span class="fa fa-home"></span> <?php bloginfo( 'name' ) ?></a></h1>
        </div>

        <?php wp_footer(); ?>

    </body>

</html>