<?php global $authordata; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('archive-article row h-entry') ); ?>>

    <?php if( is_sticky() ) { ?>
        <div class="bookmark-text sr-only"><?php _e('Featured Post', 'nano-progga'); ?></div>
    <?php } ?>

    <?php if( has_post_thumbnail() ) { ?>
        <div class="featured-image">
            <a title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
    <?php } ?>

    <h2 class="entry-title row p-name">
        <span title="" class="fa fa-th-large"></span>
        <a title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
        <a class="entry-link-icon" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>"><span class="fa fa-link"></span></a>
    </h2>

    <div class="entry-meta entry-meta-top row">
        <?php
        // No need to display same data in the author archive
        if( !is_author() ) :
        ?>
            <span class="entry-meta-item author vcard">
                <span class="fa fa-user" title="<?php _e( 'Author', 'nano-progga' ); ?>"></span>
                <a class="url fn n" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'nano-progga' ), $authordata->display_name ); ?>">
                    <?php the_author(); ?>
                </a>
            </span>

            <span class="seperator-v">|</span>
        <?php endif; ?>

        <span class="entry-meta-item entry-date">
            <span class="fa fa-clock-o" title="<?php _e( 'Published on', 'nano-progga' ); ?>"></span>
            <abbr class="published dt-published" title="<?php the_time('Y-m-d\TH:i:sO') ?>">
                <?php the_time( 'd M Y' ); ?>
            </abbr>
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

    </div> <!-- .entry-meta .entry-meta-top -->

    <div class="entry-content row e-content">

        <?php the_content( __( 'Read More <span class="meta-nav">&rarr;</span>', 'nano-progga' ) ); ?>

        <div class="clearfix"></div>
        <?php
        wp_link_pages( array(
                'before'      => '<div class="page-links">' . __( 'Pages: ', 'nano-progga' ),
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
        ?>
        
    </div> <!-- .entry-content -->

</article> <!-- #post-<?php the_ID(); ?> -->