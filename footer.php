        </div> <!-- .main-area -->

        <div class="text-center scroll-area">
        	<a class="scroll-to-top" href="#top">
        		<div class="fa fa-chevron-up"></div>
        		<div><?php _e('GET TO TOP','nano-progga'); ?></div>
        	</a>
        </div>

        <footer class="row" role="contentinfo">
			<div class="wrapper">
				<div class="footer-columns footer-col-left alt-border">
                    <h4>Widget Title</h4>
                    Footer Col Left
                </div>
                <div class="footer-columns footer-col-middle alt-border">
                    <h4>Widget Title</h4>
                    Footer Col Middle
                </div>
                <div class="footer-columns footer-col-right alt-border">
                    <h4>Widget Title</h4>
                    Footer Col Right
                </div>
                <div class="clearfix"></div>
			</div>

            <div class="developer-info text-center">
                <?php _e( 'Powered by <a href="http://wordpress.org/" title="WordPress" rel="generator">WordPress</a> and the theme ', 'nano-progga' ); ?>
                <strong><?php echo wp_get_theme(); ?></strong>
                <?php _e(' is developed by <a href="http://nanodesignsbd.com/" title="Developed by nanodesigns, Bangladesh" rel="designer"><strong>nano</strong>designs</a>', 'nano-progga'); ?>
            </div>
		</footer>

        <?php wp_footer(); ?>

    </body>

</html>