<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @package nano-progga
 * ------------------------------------------------------------------------------
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses nano_progga_header_style()
 * @uses nano_progga_admin_header_style()
 * ------------------------------------------------------------------------------
 */
function nano_progga_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'nano_progga_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '049372',
		'width'                  => 1200,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'nano_progga_header_style',
		'admin-head-callback'    => 'nano_progga_admin_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'nano_progga_custom_header_setup' );

if ( ! function_exists( 'nano_progga_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see nano_progga_custom_header_setup().
 * ------------------------------------------------------------------------------
 */
function nano_progga_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // nano_progga_header_style

if ( ! function_exists( 'nano_progga_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see nano_progga_custom_header_setup().
 * ------------------------------------------------------------------------------
 */
function nano_progga_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // nano_progga_admin_header_style