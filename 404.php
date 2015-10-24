<?php
/**
 * The template for displaying error page 404.
 *
 * @package nano-progga
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<h1 class="site-title sr-only"><?php bloginfo( 'name' ); ?></h1>
		<h2 class="site-description sr-only"><?php bloginfo( 'description' ); ?></h2>

		<section class="error-404 not-found text-center">
			<h1 class="page-title"><?php esc_html_e( 'Lost in darkness!', 'nano-progga' ); ?></h1>
			<div class="page-content">
				<p><?php esc_html_e( 'we are unable to find what you are looking for', 'nano-progga' ); ?></p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

		<?php wp_footer(); ?>

	</body>
</html>
