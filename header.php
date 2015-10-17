<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package nano-progga
 */

?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<!--[if lt IE 8]>
	        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	    <![endif]-->
	    
		<div id="page" class="hfeed site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nano-progga' ); ?></a>

			<header id="masthead" class="site-header" role="banner">
                <nav class="navbar navbar-default navbar-inverse nano-progga-nav" role="navigation">
					<div class="container-fluid container1200">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-nano-progga-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
						<?php
						$img_id = cs_get_option('logo');
                        if( $img_id ): ?>
	                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" rel="home">
	                        	<?php $img_src = wp_get_attachment_image_src( $img_id, 'full' ); ?>
	                        	<img src="<?php echo esc_url( $img_src[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="40" height="40">
	                        </a>
                    	<?php endif; ?>
                    </div> <!-- /.navbar-header -->
                    <div id="navbar-nano-progga-collapse" class="collapse navbar-collapse">
                    	<h1 class="site-title navbar-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    	<h2 class="site-description sr-only"><?php bloginfo( 'description' ); ?></h2>
                        <?php wp_nav_menu( array(
							'theme_location'	=> 'main_menu',
							'menu'				=> 'primary',
							'depth'				=> 2,
							'container'			=> false,
							'menu_class'		=> 'nav navbar-nav navbar-right',
							'menu_id'			=> '',
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							'walker'			=> new wp_bootstrap_navwalker()
							) );
						?>
                    </div>
    				</div> <!-- /.container-fluid container1200 -->
				</nav> <!-- /.navbar navbar-default -->

				<div class="site-branding">
					<div class="container-fluid container1200">
						<?php
						/**
						 * Breadcrumbs
						 * @since 3.0.0
						 */
						nano_progga_breadcrumbs(); ?>

						<?php if( is_home() ) : ?>
							<?php
							/**
							 * Featured Series
							 * @since  3.0.0
							 */
						    if( cs_get_option('showseries') ) :
							?>
							<section id="series-showcase">
								<?php
								$series_ids = array(); //default
							    $series_ids = cs_get_option('serieschoice');
								if( $series_ids ) : ?>
									<div class="row">
										<div class="col-md-12">
											<h2 class="inner-title"><span><?php _e( 'Popular Series', 'nano-progga' ); ?></span></h2>
										</div> <!-- /.col-md-12 -->
										<?php
										foreach ( $series_ids as $series_id ) :
											$featured_series = get_term_by( 'id', (int) $series_id, 'series' );
											$img_src = nano_get_tax_meta_img_src( $series_id, 'series_cover', $size = 'medium' );
											$series_link = get_term_link( (int) $series_id, 'series' ); ?>
											<div class="col-sm-3 col-xs-6 series-block">
												<a href="<?php echo esc_url( $series_link ); ?>">
													<?php if( $img_src ) : ?>
														<img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo esc_attr( $featured_series->name ); ?>">
														<div class="image-hover">
															<div class="behave-table">
																<div class="behave-table-cell expand-icon">
																	<h3><?php echo esc_html( $featured_series->name ); ?></h3>
																</div>
															</div>
														</div>
													<?php else : ?>
														<h3 class="text-center"><?php echo esc_html( $featured_series->name ); ?></h3>
													<?php endif; ?>
												</a>
											</div> <!-- /.col-sm-3 col-xs-6 -->
										<?php
										endforeach;
										?>
									</div> <!-- /.row -->
									<hr class="dark">
								<?php
								endif;
								?>
							</section> <!-- /#series-showcase -->
							<?php
							endif; //showseries
						endif; //is_home() ?>

		        	</div> <!-- /.container-fluid container1200 -->
				</div> <!-- .site-branding -->

			</header><!-- #masthead -->



			<div id="content" class="site-content">
				<div class="container-fluid container1200">
					<div class="row">
