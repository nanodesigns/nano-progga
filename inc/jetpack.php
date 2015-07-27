<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package nano-progga
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function nano_progga_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'infinite-scroll-holder',
		'render'    => 'nano_progga_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'	=> true
	) );
} // end function nano_progga_jetpack_setup
add_action( 'after_setup_theme', 'nano_progga_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function nano_progga_infinite_scroll_render() {
	while ( have_posts() ) { ?>
		<div <?php post_class('col-md-4 article-holder'); ?>>
			<div class="article-area">
				<?php
				the_post();
				get_template_part( 'template-parts/content', get_post_format() );
				?>
			</div> <!-- /.article-area -->
		</div> <!-- /.col-md-4 article-holder -->
		<?php
	}
} // end function nano_progga_infinite_scroll_render
