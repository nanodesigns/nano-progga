<?php get_header(); ?>

        <?php the_post(); ?>

        <h1 class="page-title"><?php _e( 'Tag Archives:', 'nanodesigns' ) ?> <span><?php single_tag_title() ?></span></h1>

        <content>
            <?php rewind_posts(); ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content','general' ); ?>

            <?php endwhile; ?>

            <?php nano_pagination(); ?>

        </content>

        <?php get_sidebar(); ?>

    <?php get_footer(); ?>