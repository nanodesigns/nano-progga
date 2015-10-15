<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package nano-progga
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-12">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<div id="infinite-scroll-holder" class="row grid">
				<?php
				//get the nano progga theme settings from Theme Options page.
				$widgets_positioning = cs_get_option('widgets_positioning');

				/* Start the Loop */
				$_counter = 0;				

				while ( have_posts() ) : the_post(); ?>

					<?php
					//Determine the pagination
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					//Show widgets only on the first page or not
					if( cs_get_option( 'widgets_in_pages' ) || 1 === $paged ) :

						//First Widget
						$widget_1_pos = $widgets_positioning['home_widget_1'] ? (int) $widgets_positioning['home_widget_1'] : 3;
						if( $_counter === $widget_1_pos && is_active_sidebar( 'home_widget_1' ) )
							dynamic_sidebar( 'home_widget_1' );

						//Second Widget
						$widget_2_pos = $widgets_positioning['home_widget_2'] ? (int) $widgets_positioning['home_widget_2'] : 4;
						if( $_counter === $widget_2_pos && is_active_sidebar( 'home_widget_2' ) )
							dynamic_sidebar( 'home_widget_2' );

						//Third Widget
						$widget_3_pos = $widgets_positioning['home_widget_3'] ? (int) $widgets_positioning['home_widget_3'] : 6;
						if( $_counter === $widget_3_pos && is_active_sidebar( 'home_widget_3' ) )
							dynamic_sidebar( 'home_widget_3' );

						//Fourth Widget
						$widget_4_pos = $widgets_positioning['home_widget_4'] ? (int) $widgets_positioning['home_widget_4'] : 8;
						if( $_counter === $widget_4_pos && is_active_sidebar( 'home_widget_4' ) )
							dynamic_sidebar( 'home_widget_4' );

						//Fifth Widget
						$widget_5_pos = $widgets_positioning['home_widget_5'] ? (int) $widgets_positioning['home_widget_5'] : 9;
						if( $_counter === $widget_5_pos && is_active_sidebar( 'home_widget_5' ) )
							dynamic_sidebar( 'home_widget_5' );

					endif;
					?>

					<div <?php post_class("grid-item article-holder col-sm-4"); ?>>
						<div class="article-area">

							<?php
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );
							?>

						</div> <!-- /.article-area -->
					</div> <!-- /.article-holder col-md-6 -->

				<?php
				$_counter++;
				endwhile;
				?>

				</div> <!-- /.row -->
				
				<?php nano_progga_pagination(); ?>

			<?php else : ?>

				<div class="row">
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
				</div> <!-- /.row -->

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
