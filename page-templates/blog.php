<?php
/**
 * Template Name: Blog
 * 
 * The template for displaying blog in different page.
 *
 * @package nano-progga
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-12">
		<main id="main" class="blog-main" role="main">

			<?php if ( have_posts() ) : ?>

				<div id="infinite-scroll-holder" class="row grid">
				<?php
				/* Start the Loop */
				$_counter = 0;

                $temp = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query();
                $posts_per_page = get_option('posts_per_page');
                $wp_query->query( 'showposts='. $posts_per_page .'&paged='. $paged );

                while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

					<?php
					//Determine the pagination
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					//Show widgets only on the first page
					if( 1 === $paged ) :

						//First Widget
						if( $_counter === 3 && is_active_sidebar( 'home_widget_1' ) )
							dynamic_sidebar( 'home_widget_1' );

						//Second Widget
						if( $_counter === 4 && is_active_sidebar( 'home_widget_2' ) )
							dynamic_sidebar( 'home_widget_2' );

						//Third Widget
						if( $_counter === 6 && is_active_sidebar( 'home_widget_3' ) )
							dynamic_sidebar( 'home_widget_3' );

						//Fourth Widget
						if( $_counter === 8 && is_active_sidebar( 'home_widget_4' ) )
							dynamic_sidebar( 'home_widget_4' );

						//Fifth Widget
						if( $_counter === 9 && is_active_sidebar( 'home_widget_5' ) )
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
