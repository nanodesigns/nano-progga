<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package nano-progga
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-9">
		<div class="row">
			<main id="main" class="site-main col-sm-9 pull-right" role="main">

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
