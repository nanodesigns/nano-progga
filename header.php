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
    <title>	<?php wp_title('',true,'right'); ?></title>

    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, minimumscale=1.0, maximum-scale=1.0">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!--[if lt IE 9]>
<div class="chromeframe">Your browser is out of date. Please <a href="http://browsehappy.com/">upgrade your browser </a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>.</div>
<![endif]-->

<div id="access">
    <div class="skip-link">
        <a href="#content" title="<?php _e( 'মূল লেখায় চলো', 'nano-progga' ) ?>"><?php _e( 'মূল লেখায় চলো', 'nano-progga' ) ?></a>
        <script type="text/javascript">
            function show_menu(){
                var menu = document.getElementById( 'hide-menu' );

                if( menu.style.display == 'none' || menu.style.display == '' ){
                    menu.style.display = 'block';
                } else {
                    menu.style.display = 'none';
                }
            }
        </script>
        <div id="menu-toggle" onclick="show_menu()"></div>
    </div> <!-- .skip-link -->
    <div class="main-menu wrapper">
        <div id="hide-menu">
            <?php wp_nav_menu ( array ( 'theme_location'=>'menu_top', 'fallback_cb'=>'') ); ?>
        </div>
    </div>
</div> <!-- #access -->

<div class="clear"></div>

<?php $header_image = get_header_image(); ?>
<?php /*  if ( !empty( $header_image ) ) : ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
<?php endif; */ ?>

<header id="branding" role="banner"
        <?php if ( !empty( $header_image ) ) : ?>
            style="background: url('<?php echo $header_image; ?>') no-repeat center center;"
        <?php endif; ?>
    >
    <div id="header" class="wrapper">
        <hgroup>
            <h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 id="site-description"><?php bloginfo( 'description' ) ?></h2>
        </hgroup>
    </div> <!-- #header -->
</header> <!-- #branding -->

<div class="clear"></div>

<div id="content" class="wrapper area hfeed">

