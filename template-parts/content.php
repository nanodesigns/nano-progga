<?php
/**
 * Template part for displaying posts.
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

		<?php if( is_home() || is_archive() ) : ?>

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div> <!-- /.entry-summary -->

		<?php else : ?>

			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'nano-progga' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nano-progga' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

		<?php endif; ?>

		<?php if( is_single() ) : ?>
			<footer class="entry-footer">
				<?php nano_progga_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>

	</div> <!-- /.article-inner -->

	<?php if( is_home() || is_archive() ) : ?>
		<a class="block-readmore text-center text-uppercase" href="<?php the_permalink(); ?>"><?php _e( 'Details', 'nano-progga' ); ?></a>
	<?php endif; ?>
</article><!-- #post-## -->
