<?php get_header(); ?>
        <content>
            
            <?php while ( have_posts() ) : the_post() ?>

                <?php get_template_part( 'content','general' ); ?>

            <?php endwhile; ?>

            <?php nano_pagination(); ?>

        </content>

        <?php get_sidebar(); ?>

    <?php get_footer(); ?>