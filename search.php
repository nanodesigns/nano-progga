<?php
/**
 * The template for displaying search results pages.
 *
 * @package nano-progga
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-9">
		<div class="row">
			<main id="main" class="site-main col-sm-9 pull-right" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title archive-title"><?php printf( esc_html__( 'Search Results for: %s', 'nano-progga' ), '<span>' . get_search_query() . '</span>' ); printf( _n( ' <small>(%s found)</small>', ' <small>(%s found)</small>', absint( $wp_query->found_posts ), 'nano-progga' ), absint( $wp_query->found_posts ) ); ?></h1>
				</header><!-- .page-header -->

				<div class="row">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="article-holder col-md-12">
						<div class="article-area">

							<?php
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );
							?>

						</div> <!-- /.article-area -->

					</div> <!-- /.article-holder col-md-12 -->

				<?php endwhile; ?>
				</div> <!-- /.row -->

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
