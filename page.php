<?php
/**
 * The template for displaying all pages.
 *
 * @package nano-progga
 */

get_header(); ?>

	<?php $class = is_active_sidebar('right_sidebar') ? ' col-sm-9' : ' col-md-12'; ?>
	<div id="primary" class="content-area <?php echo esc_attr( $class ); ?>">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

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
