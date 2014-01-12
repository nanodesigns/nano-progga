<?php get_header(); ?>
        <content>
            <?php the_post(); ?>

            <?php get_template_part( 'content', 'page' ); ?>
            <?php comments_template( '', true ); ?>

        </content>

        <?php get_sidebar(); ?>

    <?php get_footer(); ?>