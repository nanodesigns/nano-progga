<?php get_header(); ?>
        <content>
            <?php the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php global $authordata; ?>

                <div class="meta-prep meta-prep-entry-date">
                    <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
                        <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>">
                            <span class="entry-date"><?php the_time( 'd' ); ?></span><br/>
                            <?php the_time( 'm/Y' ); ?>
                        </abbr>
                    </a>
                </div>

                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>

                <div class="entry-content">

                    <?php if( wp_attachment_is_image( $post->id ) ) {
                        $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
                        <p class="attachment">
                            <a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
                                <img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-full" alt="<?php $post->post_excerpt; ?>" />
                            </a>
                        </p>
                    <?php } else { ?>
                        <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
                    <?php } //endif( wp_attachment_is_image( $post->id ) ) ?>

                    <div class="wp-caption">
                        <span class="wp-caption-text"><?php if ( !empty($post->post_excerpt) ) the_excerpt() ?></span>
                    </div>
                    <?php the_content(); ?>
                    <?php wp_link_pages('before=<div class="page-link">' . __( 'পাতাসমূহ:', 'nano-progga' ) . '&after=</div>') ?>

                </div> <!-- .entry-content -->

                <div class="meta-prep meta-prep-author">
                    <span class="entry-utility-prep">
                        <strong><?php _e( 'প্রস্তুতকারক: ', 'nano-progga' ); ?></strong>
                    </span>
                    <span class="author vcard">
                        <a class="url fn n" href="<?php echo get_author_posts_url( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'nano-progga' ), $authordata->display_name ); ?>">
                            <?php the_author(); ?>
                        </a>
                    </span>
                </div>

            </div>

            <?php nano_pagination(); ?>

            <?php comments_template( '', true ); ?>

        </content>

        <?php get_sidebar(); ?>

    <?php get_footer(); ?>