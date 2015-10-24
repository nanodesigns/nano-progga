<?php
/**
 * The template for displaying archive pages.
 *
 * @package nano-progga
 */

get_header(); ?>

	<?php
	$class = is_active_sidebar('right_sidebar') ? ' col-sm-9' : ' col-md-12'; ?>
	<section id="primary" class="content-area <?php echo esc_attr( $class ); ?>">
		<div class="row">
			<?php $template_class = is_active_sidebar('left_sidebar') ? ' col-sm-9' : ' col-md-12'; ?>
			<main id="main" class="site-main pull-right<?php echo esc_attr($template_class); ?>" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				
				<div class="row">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="article-holder col-md-12">
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

					</div> <!-- /.article-holder col-md-12 -->

				<?php endwhile; ?>

				<?php nano_progga_pagination(); ?>

			<?php else : ?>

				<div class="row">
					<?php get_template_part( 'template-parts/content', 'archive-none' ); ?>
				</div> <!-- /.row -->

			<?php endif; ?>

			</main><!-- #main -->

			<?php get_sidebar( 'left' ); ?>

		</div> <!-- .row -->
		
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
