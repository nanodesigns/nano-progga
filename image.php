<?php
/**
 * The template for displaying all single posts.
 *
 * @package nano-progga
 */

get_header(); ?>

	<div id="primary" class="content-area col-sm-9">
		<main id="main" class="site-main" role="main">

		<?php
        // If the image is attached to an article
        $main_article = $post->post_parent;
        if( $main_article != '' ) { ?>
        	<div class="row image-to-article-link">
        		<div class="col-xs-6">
        			<a class="back-to-article" href="<?php echo get_permalink($post->post_parent); ?>">
        				<span class="np-left"></span><?php _e('Get to Main Article', 'nano-progga'); ?>
                    </a>
        		</div>
        		<div class="col-xs-6 text-right">
        			<div class="block-text">
        				<?php _e('This is an image of an article', 'nano-progga'); ?>
        				<span class="np-format-aside"></span>
        			</div>
        		</div>
        	</div>            
        <?php } ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-meta">
						<?php nano_progga_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php if( wp_attachment_is_image( $post->id ) ) {
	                    $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
	                    <div class="attachment">
	                        <a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
	                            <img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-full" alt="<?php $post->post_excerpt; ?>" />
	                        </a>
	                        <?php if( !empty($post->post_excerpt) ) { ?>
	                        <div class="wp-caption attachment-caption">
	                            <span class="wp-caption-text"><?php the_excerpt(); ?></span>
	                        </div>
	                        <?php } ?>
	                    </div>
	                <?php } else { ?>
	                    <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
	                <?php } //endif( wp_attachment_is_image( $post->id ) ) ?>

					<?php the_content(); ?>

					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nano-progga' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

			<?php nano_progga_pagination(); ?>

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
