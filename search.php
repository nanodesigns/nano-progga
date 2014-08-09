<?php get_header(); ?>
        	
			<div class="wrapper">

                <?php get_sidebar( 'left' ); ?>

                <div class="content archive-content hfeed">

                    <?php if ( have_posts() ) : ?>

                        <h2 class="entry-title page-title search-title row">
                            <span class="fa fa-search"></span>
                            <?php _e( 'Search Results for ', 'nano-progga' ); ?><span class="search-query">"<?php the_search_query(); ?>"</span>
                        </h2>

                        <?php while( have_posts() ) : the_post(); ?>
                
                            <?php get_template_part( 'template-parts/content-archive-post' ); ?>
                
                        <?php endwhile; ?>
                    
                    <?php nano_pagination(); ?>

                    <?php else : ?>
                        
                        <h2 class="entry-title page-title row">
                            <span class="fa fa-frown-o"></span>
                            <?php _e( 'Nothing Found', 'nano-progga' ) ?>
                        </h2>

                        <div class="entry-content">
                            <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'nano-progga' ); ?></p>
                            <?php get_search_form(); ?>                                             
                        </div><!-- .entry-content -->

                    <?php endif; ?>
                </div> <!-- .content -->

                <?php get_sidebar(); ?>

                <div class="clearfix"></div>

            </div> <!-- .wrapper -->

<?php get_footer(); ?>