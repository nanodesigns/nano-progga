<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package nano-progga
 */

?>

			</div> <!-- /.row (started in header.php) -->
		</div> <!-- /.container-fluid container1200 (started in header.php) -->
	</div><!-- #content -->

	<?php $footer_class = !is_active_sidebar('footer_sidebar') ? 'no-footer-widgets' : ''; ?>

	<footer id="colophon" class="site-footer text-center <?php echo $footer_class; ?>" role="contentinfo">
		<div class="container-fluid container1200">

			<?php if ( is_active_sidebar( 'footer_sidebar' ) ) { ?>
				<div id="footer-widgets" class="widget-area footer-widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer_sidebar' ); ?>
				</div><!-- #footer-widgets -->
			<?php } ?>

			<div class="site-info <?php echo $footer_class; ?>">
				<?php printf( __('Powered by %1s and the theme <strong>%2s</strong> is developed by %3s', 'nano-progga'), '<a href="http://wordpress.org/" title="WordPress">WordPress</a>', wp_get_theme(), '<a href="http://nanodesignsbd.com/" title="Developed by nanodesigns, Bangladesh"><strong>nano</strong>designs</a>' ); ?>
			</div><!-- .site-info -->
		</div> <!-- /.container-fluid container1200 -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<!-- SOCIAL LINKS ON THE BOTTOM -->
<div class="social-footer-bar">
	<?php
	//dynamic values from the Theme Options page.	
	$rss		= cs_get_option( 'rss' );
	$facebook	= cs_get_option( 'facebook' );
	$twitter	= cs_get_option( 'twitter' );
	$linkedin	= cs_get_option( 'linkedin' );
	$gplus		= cs_get_option( 'googleplus' );
	$flickr		= cs_get_option( 'flickr' );
	$pinterest	= cs_get_option( 'pinterest' );
	$tumblr		= cs_get_option( 'tumblr' );
	$youtube	= cs_get_option( 'youtube' );
	?>
	<div class="social-handle"><span class="np-toggle"></span></div>
	<div class="socials">
	    <?php
	    echo $rss ? '<a href="'. $rss .'" class="social-icons s-rss" target="_blank"><span class="np-rss"></span></a>' : '';
	    echo $facebook ? '<a href="'. $facebook .'" class="social-icons s-facebook" target="_blank"><span class="np-facebook"></span></a>' : '';
	    echo $twitter ? '<a href="'. $twitter .'" class="social-icons s-twitter" target="_blank"><span class="np-twitter"></span></a>' : '';
	    echo $linkedin ? '<a href="'. $linkedin .'" class="social-icons s-linkedin" target="_blank"><span class="np-linkedin"></span></a>' : '';
	    echo $gplus ? '<a href="'. $gplus .'" class="social-icons s-gplus" target="_blank"><span class="np-google-plus"></span></a>' : '';
	    echo $flickr ? '<a href="'. $flickr .'" class="social-icons s-flickr" target="_blank"><span class="np-flickr"></span></a>' : '';
	    echo $pinterest ? '<a href="'. $pinterest .'" class="social-icons s-pinterest" target="_blank"><span class="np-pinterest"></span></a>' : '';
	    echo $tumblr ? '<a href="'. $tumblr .'" class="social-icons s-tumblr" target="_blank"><span class="np-tumblr"></span></a>' : '';
	    echo $youtube ? '<a href="'. $youtube .'" class="social-icons s-youtube" target="_blank"><span class="np-youtube"></span></a>' : '';
	    ?>
    </div>
</div> <!-- .social-footer-bar -->

<!-- BACK TO TOP BUTTON -->
<div id="backtotop">
    <a id="to-top" href="#" onClick="return false" title="<?php esc_attr__( 'Back to Top', 'nano-progga' ); ?>">
        <span class="np-up"></span>
    </a>
</div>

<?php wp_footer(); ?>

</body>
</html>
