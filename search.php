<?php get_header(); ?>
        <content>

            <?php if( have_posts() ) { ?>

                <?php while( have_posts() ) { ?>
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
                            <?php nano_super_excerpt('nano_excerpt', 'nano_excerpt_more'); ?>
                            <?php wp_link_pages('before=<div class="page-link">' . __( '????????:', 'nano-progga' ) . '&after=</div>') ?>
                        </div><!-- .entry-content + .content-home -->
                    </div> <!-- #post-<?php the_ID(); ?> -->
                <?php } //endwhile ?>
                <?php nano_pagination(); ?>

            <?php } else { ?>

                <div id="blank-search">
                    <h2 class="entry-title"><?php _e( 'কিছুই পাওয়া যায়নি', 'nano-progga'); ?></h2>
                    <div class="entry-content">
                        <?php _e( 'দুঃখিত! অনুসন্ধানে কোনো ফল মেলেনি। অন্য কীওয়ার্ড দিয়ে চেষ্টা করে দেখুন', 'nano-progga'); ?>
                        <?php get_search_form(); ?>
                    </div>
                </div>

            <?php } //endif ?>

        </content>

        <?php get_sidebar(); ?>

    <?php get_footer(); ?>