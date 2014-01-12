<?php get_header(); ?>

        <?php the_post(); ?>

        <h1 class="page-title"><?php _e( 'Category Archives:', 'nanodesigns' ) ?> <span><?php single_cat_title() ?></span></span></h1>
        <?php $categorydesc = category_description(); if ( !empty($categorydesc) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>

        <content>
            <?php rewind_posts(); ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content','general' ); ?>

            <?php endwhile; ?>

            <?php nano_pagination(); ?>

        </content>

        <?php get_sidebar(); ?>

    <?php get_footer(); ?>