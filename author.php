<?php get_header(); ?>

        <?php the_post(); ?>

        <h1 class="page-title author">
            <?php
            printf( __( '<span class="vcard">%s</span>-এর সকল পোস্ট', 'nano-progga' ), "<a class='url fn n' href='$authordata->user_url' title='$authordata->display_name' rel='me'>$authordata->display_name</a>" ) ?>
        </h1>
        <?php
        // author description
        $authordesc = $authordata->user_description;
        if ( !empty($authordesc) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $authordesc . '</div>' );
        ?>

        <content>
                <?php rewind_posts(); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content','general' ); ?>

            <?php endwhile; ?>

            <?php nano_pagination(); ?>

        </content>

        <?php get_sidebar(); ?>

    <?php get_footer(); ?>