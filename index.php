<?php get_header(); ?>
        	
			<div class="wrapper">

                <div class="content hfeed">
                    <?php if( have_posts() ) : ?>
                        <?php $div_counter = 1; ?>
                        <?php while( have_posts() ) : the_post(); ?>

                            <?php $class = $div_counter % 2 == 1 ? 'first-col' : 'second-col'; ?>
                            
                            <div class="post-columns <?php echo $class; ?>">
                                <?php get_template_part( 'template-parts/content-archive-post', get_post_format() ); ?>
                            </div>

                        <?php $div_counter++; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    
                    <div class="clearfix"></div>
                    <?php nano_pagination(); ?>
                </div> <!-- .content -->
                    
                <?php get_sidebar(); ?>
                
                <div class="clearfix"></div>

            </div> <!-- .wrapper -->

<?php get_footer(); ?>