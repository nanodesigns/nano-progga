<?php
/**
 * The template part for displaying a message that posts cannot be found
 * on archive and search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package nano-progga
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<?php
			the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header><!-- .page-header -->

	<div class="page-content">

		<?php if ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'nano-progga' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'Sorry, the topic is here, but the content for the topic is absent now. Better try with some keywords to find something you desired.', 'nano-progga' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
		
	</div><!-- .page-content -->
</section><!-- .no-results -->
