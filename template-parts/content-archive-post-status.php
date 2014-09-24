<?php global $authordata; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('archive-article row h-entry') ); ?>>

    <?php if( is_sticky() ) { ?>
        <div class="bookmark-text sr-only"><?php _e('Featured Post', 'nano-progga'); ?></div>
    <?php } ?>

    <h2 class="entry-title row p-name">
        <span title="" class="fa fa-paw"></span>
        <a title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
        <a class="entry-link-icon" title="<?php printf( __('Permalink to %s', 'nano-progga'), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>"><span class="fa fa-link"></span></a>
    </h2>

    <div class="entry-content row e-content">

        <?php the_content( __( 'Read More <span class="meta-nav">&rarr;</span>', 'nano-progga' ) ); ?>
        
    </div> <!-- .entry-content -->

    <?php
    // No need to display same data in the author archive
    if( !is_author() ) :
    ?>
        <cite class="entry-meta-item author vcard">
            <a class="url fn n" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', 'nano-progga' ), $authordata->display_name ); ?>">
                <?php the_author(); ?>
            </a>
        </cite>
        
    <?php endif; ?>
    <br>
    <div class="entry-meta-item entry-date">
        <abbr class="published dt-published" title="<?php the_time('Y-m-d\TH:i:sO') ?>">
            <?php the_time( 'd M Y' ); ?>
        </abbr>
    </div>

</article> <!-- #post-<?php the_ID(); ?> -->