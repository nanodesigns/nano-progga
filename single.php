<?php get_header(); ?>
        	
			<div class="wrapper">

                <div class="content hfeed">
                    <?php if( have_posts() ) : ?>
                        <?php while( have_posts() ) : the_post(); ?>
                
                            <?php get_template_part( 'template-parts/content-page' ); ?>
                            <?php comments_template( '', true ); ?>
                
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div> <!-- .content -->
                    
                <?php get_sidebar(); ?>
                
                <div class="clearfix"></div>

            </div> <!-- .wrapper -->

<?php get_footer(); ?>