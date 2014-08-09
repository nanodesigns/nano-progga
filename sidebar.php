<aside id="right-sidebar">

    <h2 class="sidebar-head"><?php _e( 'Sidebar', 'nano-progga' ); ?></h2>

    <?php if( is_active_sidebar('right_sidebar') ) { ?>

        <div id="primary" class="widget-area">
            <ul class="xoxo">
                <?php dynamic_sidebar('right_sidebar'); ?>
            </ul>
        </div><!-- #primary .widget-area -->

    <?php } else { ?>

        <div id="primary" class="widget-area">
            <ul class="xoxo">

                <li id="default-widget-1" class="widget-container default-widgets">
                    <h3 class="widget-title"><?php _e( 'Archives', 'nano-progga' ); ?></h3>
                    <ul>
                        <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                    </ul>
                </li> <!-- #default-widget-1 -->

                <li id="default-widget-2" class="widget-container default-widgets">
                    <h3 class="widget-title"><?php _e( 'Pages', 'nano-progga' ); ?></h3>
                    <ul>
                        <?php wp_list_pages('sort_column=menu_order&title_li='); ?>
                    </ul>
                </li> <!-- #default-widget-2 -->

            </ul> <!-- .xoxo -->
        </div><!-- #primary .widget-area -->

    <?php } //endif( is_active_sidebar ?>

</aside>