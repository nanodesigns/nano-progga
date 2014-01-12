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

    <div class="entry-content content-home">
        <?php if( has_post_thumbnail() || grab_first_image() ) { ?>

            <div class="featured-image">
                <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
                    <?php
                    if( has_post_thumbnail() ) {
                        the_post_thumbnail( array( 250,188 ) );
                    } else {
                        echo '<img src="' . grab_first_image() . '"/>';
                    }
                    ?>
                </a>
            </div>

        <?php } ?>

        <?php nano_super_excerpt('nano_excerpt', 'nano_excerpt_more'); ?>
        <?php wp_link_pages('before=<div class="page-link">' . __( 'পাতাসমূহ:', 'nano-progga' ) . '&after=</div>') ?>
    </div><!-- .entry-content + .content-home -->
    <div class="entry-aside">
        <div class="meta-prep meta-prep-author">
            <span class="entry-utility-prep">
                <?php _e( 'লিখেছেন', 'nano-progga' ); ?>
            </span><br/>
            <span class="author vcard">
                <a class="url fn n" href="<?php echo get_author_posts_url( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'nano-progga' ), $authordata->display_name ); ?>">
                    <?php the_author(); ?>
                </a>
            </span>
        </div>
        <div class="cat-links">
            <span class="entry-utility-prep entry-utility-prep-cat-links">
                <?php _e( 'ক্যাটাগরি', 'nano-progga' ); ?>
            </span><br/>
            <?php echo get_the_category_list(', '); ?>
        </div>
        <!--
        <div class="tag-links">
            <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('বিষয়বস্তু', 'nano-progga' ) . '</span><br/>', ", ", "</span>" ) ?>
        </div> --> <!-- .tag-links -->
        <div class="comments-link">
            <?php
            if ( comments_open() ) :
                $comment_class = 'comment-img';
                $other_class = 'enabled-comment';
            else: //when comment is OFF
                $comment_class = 'comment-disabled';
                $other_class = 'disabled-comment';
            endif;
            ?>
            <span class="<?php echo $comment_class; ?>"></span>
            <?php comments_popup_link( __( 'মন্তব্য করুন', 'nano-progga' ), __( '১টি মন্তব্য', 'nano-progga' ), __( '%টি মন্তব্য', 'nano-progga' ), $other_class, __( 'মন্তব্য স্থগিত', 'nano-progga' ) ) ?>
        </div>
    </div>
</div> <!-- #post-<?php the_ID(); ?> -->