<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package nano-progga
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( has_post_thumbnail() ) : ?>
		<div class="featured-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php else : ?>
		<div class="default-featured-image"></div>
	<?php endif; ?>
	
	<div class="article-inner">

		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php nano_progga_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	</div> <!-- /.article-inner -->

	<a class="block-readmore text-center text-uppercase" href="<?php the_permalink(); ?>"><?php _e( 'Details', 'nano-progga' ); ?></a>
</article><!-- #post-## -->

