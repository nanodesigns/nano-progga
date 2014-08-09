<?php get_header(); ?>

    <?php the_post(); ?>
        	
	<div class="wrapper">

        <?php global $authordata; ?>

        <div class="content hfeed">
            <article id="post-<?php the_ID(); ?>" <?php post_class(array('row') ); ?>>

                <?php
                // If the image is attached to an article
                $main_article = $post->post_parent;
                if( $main_article != '' ) { ?>
                    <div class="image-to-article-link">
                        <div class="block-left">
                            <a class="back-to-article" href="<?php echo get_permalink($post->post_parent); ?>">
                                <div class="block-icon"><span class="fa fa-chevron-left"></span></div>
                                <div class="block-text"><?php _e('Get to Main Article', 'nano-progga'); ?></div>
                                <div class="clearfix"></div>
                            </a>
                        </div>
                        <div class="block-right">
                            <div class="block-text"><?php _e('This is an image of an article', 'nano-progga'); ?></div>
                            <div class="block-icon"><span class="fa fa-file-text-o"></span></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                <?php } ?>

                <h2 class="entry-title page-title row">
                    <span class="fa fa-image"></span>
                    <?php the_title(); ?>
                    <a class="entry-link-icon" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>"><span class="fa fa-link"></span></a>
                </h2>

                <div class="entry-content row">

                    <?php if( wp_attachment_is_image( $post->id ) ) {
                        $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
                        <div class="attachment">
                            <a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
                                <img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-full" alt="<?php $post->post_excerpt; ?>" />
                            </a>
                            <?php if( !empty($post->post_excerpt) ) { ?>
                            <div class="wp-caption attachment-caption">
                                <span class="wp-caption-text"><?php the_excerpt(); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
                    <?php } //endif( wp_attachment_is_image( $post->id ) ) ?>

                    <?php the_content(); ?>
                    <div class="clearfix"></div>
                    <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'nano-progga' ) . '&after=</div>') ?>

                    <?php nano_pagination(); ?>
                    
                </div> <!-- .entry-content -->

                <div class="entry-meta entry-meta-bottom row">
                    <span class="entry-meta-item author vcard">
                        <span class="fa fa-user" title="<?php _e( 'Author', 'nano-progga' ); ?>"></span>
                        <a class="url fn n" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'nano-progga' ), $authordata->display_name ); ?>">
                            <?php the_author(); ?>
                        </a>
                    </span>

                    <span class="seperator-v">|</span>

                    <span class="entry-meta-item entry-date">
                        <span class="fa fa-clock-o" title="<?php _e( 'Published on', 'nano-progga' ); ?>"></span>
                        <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
                            <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>">
                                <?php the_time( 'd M Y' ); ?>
                            </abbr>
                        </a>
                    </span>

                    <span class="seperator-v">|</span>

                    <span class="comments-link">
                        <?php
                        if ( comments_open() ) :
                            $comment_class = 'comment-enabled';
                            $other_class = 'enabled-comment';
                        else: //when comment is OFF
                            $comment_class = 'comment-disabled';
                            $other_class = 'disabled-comment';
                        endif;
                        ?>
                        <span class="fa fa-comment <?php echo $comment_class; ?>" title="<?php _e( 'Comments', 'nano-progga' ); ?>"></span>
                        <?php comments_popup_link( __( 'Comment Here', 'nano-progga' ), __( '1 Comment', 'nano-progga' ), __( '% Comments', 'nano-progga' ), $other_class, __( 'Comment Closed', 'nano-progga' ) ) ?>
                    </span> <!-- .comments-link -->

                    <?php edit_post_link( __( '[edit this image]', 'nano-progga' ), '<span class="post-edit-link">', '</span>' ) ?>

                </div> <!-- .entry-meta .entry-meta-bottom -->

            </article> <!-- #post-<?php the_ID(); ?> -->

            <?php comments_template( '', true ); ?>

        </div> <!-- .content -->
            
        <?php get_sidebar(); ?>
        
        <div class="clearfix"></div>

    </div> <!-- .wrapper -->

<?php get_footer(); ?>