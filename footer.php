        </div> <!-- .main-area -->

        <div class="text-center scroll-area">
        	<a class="scroll-to-top" href="#top">
        		<div class="fa fa-chevron-up"></div>
        		<div><?php _e('GET TO TOP','nano-progga'); ?></div>
        	</a>
        </div>

        <?php $footerClass = !is_active_sidebar('footer_sidebar') ? 'no-footer-widgets' : ''; ?>

        <footer class="row <?php echo $footerClass; ?>" role="contentinfo">
			<div class="wrapper">
                <?php if( is_active_sidebar('footer_sidebar') ) { ?>
                    <ul class="footer-ul xoxo row">
                        <?php dynamic_sidebar('footer_sidebar'); ?>
                    </ul>
                <?php } ?>
			</div>

            <div class="developer-info text-center <?php echo $footerClass; ?>">
                <?php _e( 'Powered by <a href="http://wordpress.org/" title="WordPress">WordPress</a> and the theme ', 'nano-progga' ); ?>
                <strong><?php echo wp_get_theme(); ?></strong>
                <?php _e(' is developed by <a href="http://nanodesignsbd.com/" title="Developed by nanodesigns, Bangladesh"><strong>nano</strong>designs</a>', 'nano-progga'); ?>
            </div>
		</footer>

        <?php wp_footer(); ?>

    </body>

</html>