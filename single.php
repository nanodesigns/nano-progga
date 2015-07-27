<?php
/**
 * The template for displaying all single posts.
 *
 * @package nano-progga
 */

get_header(); ?>

	<div id="primary" class="content-area col-sm-9">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php nano_progga_pagination(); ?>

			<?php
			//Show related posts if enabled
			$option = get_option('np_settings');
			if( $option['related_posts'] == 1 )
				echo nano_progga_get_related_posts( get_the_ID() ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
