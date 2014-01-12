<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php global $authordata; ?>
    <?php if( is_single() ) { ?>

        <div class="meta-prep meta-prep-entry-date">
        <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
            <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>">
                <span class="entry-date"><?php the_time( 'd' ); ?></span><br/>
                <?php the_time( 'm/Y' ); ?>
            </abbr>
        </a>
        </div>

    <?php } //endif( is_single() ) ?>

    <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h2>

    <div class="entry-content">
        <?php the_post_thumbnail(); ?>
        <?php the_content(); ?>
        <?php wp_link_pages('before=<div class="page-link">' . __( 'পাতাসমূহ:', 'nano-progga' ) . '&after=</div>') ?>
        <?php edit_post_link( __( '[ সম্পাদনা মোডে খোলো ]', 'nano-progga' ), "<div class=\"edit-link\">", "</div>" ) ?>
    </div> <!-- .entry-content -->

    <?php if( is_single() ) { ?>

    <div class="entry-meta">

        <div class="comments-link">
        <?php
        $css_class = 'zero-comment';
        $number    = (int) get_comments_number( get_the_ID() );
        if ( comments_open() ) :
            if ( 1 === $number ):
                $css_class = 'one-comment';
            elseif ( 1 < $number ):
                $css_class = 'multiple-comments';
            endif;
        else: //when comment is OFF
            $css_class = 'no-comment';
        endif;

        comments_popup_link(
            __( '', 'nano-progga' ),
            __( '১', 'nano-progga' ),
            __( '%', 'nano-progga' ),
            $css_class,
            __( '', 'nano-progga' )
        );
        ?>
    </div>
        <div class="meta-prep meta-prep-author">
                <span class="entry-utility-prep">
                    <?php if( is_attachment() ) { ?>
                        <strong><?php _e( 'প্রস্তুতকারক: ', 'nano-progga' ); ?></strong>
                    <?php } else { ?>
                        <strong><?php _e( 'লিখেছেন: ', 'nano-progga' ); ?></strong>
                    <?php } ?>
                </span>
                <span class="author vcard">
                    <a class="url fn n" href="<?php echo get_author_posts_url( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'nano-progga' ), $authordata->display_name ); ?>">
                        <?php the_author(); ?>
                    </a>
                </span>
    </div>
        <div class="cat-links">
                    <span class="entry-utility-prep entry-utility-prep-cat-links">
                        <strong><?php _e( 'ক্যাটাগরি:', 'nano-progga' ); ?></strong>
                    </span>
            <?php echo get_the_category_list(', '); ?>
        </div>
        <div class="tag-links">
            <?php the_tags( '<span class="tag-links"><strong><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('বিষয়বস্তু: ', 'nano-progga' ) . '</strong></span>', ", ", "</span>" ) ?>
        </div>

    </div> <!--. entry-meta -->

    <?php } //endif( is_single() ) ?>

</div>