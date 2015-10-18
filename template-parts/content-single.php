<?php
/**
 * Template part for displaying single posts.
 *
 * @package nano-progga
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( get_post_format() !== 'image' && get_post_format() !== 'status' ) : ?>
		<?php if( has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php else : ?>
			<div class="default-featured-image"></div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="article-inner">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-meta">
				<?php nano_progga_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nano-progga' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</div> <!-- /.article-inner -->

	<?php if ( 'post' == get_post_type() ) : ?>
	<footer class="entry-footer">
		<?php nano_progga_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
	
</article><!-- #post-## -->

