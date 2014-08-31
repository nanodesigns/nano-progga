<?php get_header(); ?>
        	
			<div class="wrapper">

                <?php the_post(); ?>

                <div class="archive-wrapper">

                    <div class="content archive-content hfeed">
                        <h2 class="entry-title archive-title row">
                        <?php if ( is_day() ) : ?>
                            <span class="fa fa-archive" title="<?php _e( 'Daily Archives', 'nano-progga' ); ?>"></span> <?php echo get_the_time(get_option('date_format') ); ?>
                        <?php elseif ( is_month() ) : ?>
                            <span class="fa fa-archive" title="<?php _e( 'Monthly Archives', 'nano-progga' ); ?>"></span> <?php echo get_the_time(get_the_time('F Y')); ?>
                        <?php elseif ( is_year() ) : ?>
                            <span class="fa fa-archive" title="<?php _e( 'Yearly Archives', 'nano-progga' ); ?>"></span> <?php echo get_the_time(get_the_time('Y')); ?>
                        <?php elseif ( is_category() ) : ?>
                             <span class="fa fa-folder-open-o" title="<?php _e( 'Categories Archive', 'nano-progga' ); ?>"></span> <?php single_cat_title(); ?>
                             <?php $categorydesc = category_description();
                            if ( !empty($categorydesc) )
                                echo apply_filters( 'archive_meta', '<span class="archive-meta">' . $categorydesc . '</span>' ); ?>
                        <?php elseif ( is_tag() ) : ?>
                            <span class="fa fa-tags" title="<?php _e( 'Tags Archive', 'nano-progga' ); ?>"></span> <?php single_tag_title(); ?>
                                 <?php $tagdesc = tag_description();
                                if ( !empty($tagdesc) )
                                    echo apply_filters( 'archive_meta', '<span class="archive-meta">' . $tagdesc . '</span>' ); ?>
                        <?php elseif ( is_author() ) : ?>
                            <span class="fa fa-user" title="<?php _e( 'User Archive', 'nano-progga' ); ?>"></span> <?php printf( __( '<span class="vcard">%s</span>', 'nano-progga' ), "<a class='url fn n' href='$authordata->user_url' title='$authordata->display_name' rel='me'>$authordata->display_name</a>" ); ?>
                        <?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
                            <?php _e( 'Blog Archives', 'nano-progga' ); ?>
                        <?php endif; ?>
                        </h2>

                        <?php rewind_posts(); ?>

                            <?php while( have_posts() ) : the_post(); ?>
                    
                                <?php get_template_part( 'template-parts/content-archive-post', get_post_format() ); ?>
                    
                            <?php endwhile; ?>
                        
                        <?php nano_pagination(); ?>
                    </div> <!-- .content -->

                    <?php get_sidebar( 'left' ); ?>

                </div> <!-- .archive-wrapper -->

                <?php get_sidebar(); ?>

                <div class="clearfix"></div>

            </div> <!-- .wrapper -->

<?php get_footer(); ?>