<?php
/**
 * All the functions for the theme "NANO PROGGA"
 */

/**
 * ENABLE ADMIN PANEL
 */

get_template_part('admin/nano', 'admin');



/**
 * CHANGE THE 'WPLANG' IN wp-config.php TO bn_BD ON THEME SWITCHING
 * Thanks: toscho
 * Source: http://wordpress.stackexchange.com/a/121136/22728
-------------------------------------------------- */

add_filter( 'locale', 'toscho_change_language' );

function toscho_change_language( $locale ) {
    return 'bn_BD';
}



/**
 * MAKE THE THEME TRANSLATION-READY
 * Thanks: Konstantinos Kouratoras & Robert Treacy
 * Source:
 * 1. http://wp.smashingmagazine.com/2011/12/29/internationalizing-localizing-wordpress-theme/
 * 2. http://wp.tutsplus.com/tutorials/theme-development/translating-your-theme/
-------------------------------------------------- */

add_action('after_setup_theme', 'nanoprogga_setup');

function nanoprogga_setup(){
    load_theme_textdomain('nano-progga', get_template_directory() . '/languages');
}



/**
 * ENQUEUE STYLES
-------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'nanoprogga_styles' );

function nanoprogga_styles(){

    wp_register_style( 'site-styles', get_template_directory_uri() . '/style.css', '', '', 'screen' );
    wp_register_style( 'menu-styles', get_template_directory_uri() . '/css/menu.css', '', '', 'screen and (min-device-width: 800px)' );
    wp_register_style( 'mobile-menu-styles', get_template_directory_uri() . '/css/mobile-menu.css', '', '', 'screen and (max-device-width: 799px)' );

    wp_enqueue_style( 'site-styles' );
    wp_enqueue_style( 'menu-styles' );
    wp_enqueue_style( 'mobile-menu-styles' );

}



/**
 * ENQUEUE SCRIPTS
-------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'nanoprogga_js' );

function nanoprogga_js(){
    wp_register_script( 'responsive-scripts', get_template_directory_uri() . '/js/respond.min.js' );

    wp_enqueue_script( 'responsive-scripts' );
}



/**
 * ENABLING CUSTOM HEADER
-------------------------------------------------- */

$args = array(
    // default things
    'default-text-color' => '606176',

    // assign sizes
    'width' => 1600,
    'height'=> 317,
    'max-height' => 317,
    'max-width' => 2000,

    //callback functions
    'wp-head-callback' => 'nanodesigns_header_style',
);

add_theme_support( 'custom-header', $args );


function nanodesigns_header_style() {
    $text_color = get_header_textcolor();

    // If no custom options for text are set, let's bail
    if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
        return;

        ?>
    <style type="text/css" id="nanodesigns-header-css">

        <?php if ( ! display_header_text() ) { ?>

            h1#site-title,
            h2#site-description{
                position: absolute;
                clip: rect(1px 1px 1px 1px); /* IE7 */
                clip: rect(1px, 1px, 1px, 1px);
            }

        header{
            min-height: 100px;
        }

        <?php } else { ?>

            h1#site-title a,
            h2#site-description{
                color: #<?php echo $text_color; ?>;
            }

        <?php } ?>
    </style>
    <?php
}



/**
 * ENABLING CUSTOM MENUS
-------------------------------------------------- */

register_nav_menus(
    array(
        'menu_top'=>__('Top Menu')
    )
);


/**
 * CUSTOM WIDTH
-------------------------------------------------- */

if ( ! isset( $content_width ) ) $content_width = 1000;


/**
 * AUTOMATIC FEED LINKS
-------------------------------------------------- */

add_theme_support( 'automatic-feed-links'  );



/**
 * CUSTOM EDITOR STYLES
-------------------------------------------------- */
// This theme styles the visual editor with editor-style.css to match the theme style.

add_editor_style();



/**
 * FEATURED IMAGE SUPPORT
-------------------------------------------------- */

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 705, 9999 ); // Unlimited height, soft crop



/**
 * ENABLING THE PAGINATION
-------------------------------------------------- */

function get_page_number() {
    if( get_query_var( 'paged' ) ) {
        print ' | ' . __( 'Page ' , 'nano-progga') . get_query_var('paged');
    }
} // end get_page_number


function nano_pagination() {

    if( is_attachment() ) { ?>

    <div id="nav-below" class="navigation">

        <div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&laquo;</span> আগের ছবি', 'nano-progga' ) ) ?></div>
        <div class="nav-next"><?php next_image_link( false, __( 'পরের ছবি <span class="meta-nav">&raquo;</span>', 'nano-progga' ) ) ?></div>

    </div><!-- #nav-below -->

    <?php } else {

        global $wp_query;
        $total_pages = $wp_query->max_num_pages;
        if ( $total_pages > 1 ) { ?>

            <div id="nav-below" class="navigation">

                <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> পুরোন পোস্টসমূহ', 'nano-progga' )) ?></div>
                <div class="nav-next"><?php previous_posts_link(__( 'সাম্প্রতিক পোস্টসমূহ <span class="meta-nav">&raquo;</span>', 'nano-progga' )) ?></div>

            </div><!-- #nav-below -->

        <?php } //endif ( $total_pages > 1 )

    } //endif( is_attachment() )
}



/**
 * REGISTER WIDGET AREAS
-------------------------------------------------- */

add_action( 'init', 'nano_widgets_init' );

function nano_widgets_init() {
    // Sidebar Widgets Area
    register_sidebar(
        array (
        'name' => 'Right Sidebar',
        'id' => 'right_sidebar',
        'description' => 'Assign necessary widgets to show into the right sidebar of the website.',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        )
    );

    // Footer Widgets Area
    register_sidebar(
        array (
            'name' => 'Footer Widgets Area',
            'id' => 'footer_widgets_area',
            'description' => 'Assign Maximum 4 (Four) widgets into this footer widget area to show at the bottom of the website',
            'class' => 'theClass',
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => "</li>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        )
    );
} // end nano_widgets_init




/**
 * CUSTOM SEARCH FORM
-------------------------------------------------- */

add_action('pre_get_search_form', 'search_form_no_filters');

function search_form_no_filters() {
    // look for local searchform template
    $search_form_template = locate_template( 'searchform.php' );
    if ( '' !== $search_form_template ) {
        // searchform.php exists, remove all filters
        remove_all_filters('get_search_form');
    }
}




/**
 * TRUNCK STRING TO SHORTEN THE STRING
-------------------------------------------------- */

function trunck_string($str = "", $len = 150, $more = 'true') {

    if ($str == "") return $str;
    if (is_array($str)) return $str;
    $str = strip_tags($str);
    $str = trim($str);
    // if it's les than the size given, then return it

    if (strlen($str) <= $len) return $str;

    // else get that size of text
    $str = substr($str, 0, $len);
    // backtrack to the end of a word
    if ($str != "") {
        // check to see if there are any spaces left
        if (!substr_count($str , " ")) {
            if ($more == 'true') $str .= "...";
            return $str;
        }
        // backtrack
        while(strlen($str) && ($str[strlen($str)-1] != " ")) {
            $str = substr($str, 0, -1);
        }
        $str = substr($str, 0, -1);
        if ($more == 'true') $str .= "...";
        if ($more != 'true' and $more != 'false') $str .= $more;
    }
    return $str;
}



/**
 * GRAB THE FIRST IMAGE FROM THE POST CONTENT
 * Get the_content() but exclude <img> or <img/>
 * tags then echo the_content()
-------------------------------------------------- */

/*function nano_excerpt( $Trunckvalue = '1000' ) {
    $our_excerpt = get_the_excerpt();
    echo trunck_string( $our_excerpt, $Trunckvalue, true ); ?>
    <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php _e( 'বিস্তারিত&raquo;', 'nano-progga'); ?></a>
<?php
}*/



class Excerpt {

    // Default length (by WordPress)
    public static $length = 55;

    // So you can call: nano_excerpt('short');
    public static $types = array(
        'short' => 25,
        'regular' => 55,
        'long' => 100
    );

    /**
     * Sets the length for the excerpt,
     * then it adds the WP filter
     * And automatically calls the_excerpt();
     *
     * @param string $new_length
     * @return void
     * @author Baylor Rae'
     * SOURCE: http://stackoverflow.com/questions/4082662/multiple-excerpt-lengths-in-wordpress
     */
    public static function length($new_length = 55) {
        Excerpt::$length = $new_length;

        add_filter('excerpt_length', 'Excerpt::new_length');

        Excerpt::output();
    }

    // Tells WP the new length
    public static function new_length() {
        if( isset(Excerpt::$types[Excerpt::$length]) )
            return Excerpt::$types[Excerpt::$length];
        else
            return Excerpt::$length;
    }

    // Echoes out the excerpt
    public static function output() {
        the_excerpt(); ?>
        <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php _e( 'বিস্তারিত&raquo;', 'nano-progga'); ?></a>
    <?php
    }

}

/* An alias to the class
function nano_excerpt($length = 70) {
    Excerpt::length($length);
}
*/

function nano_super_excerpt( $length_callback = '', $more_callback = '' ) {

    if ( function_exists( $length_callback ) )
        add_filter( 'excerpt_length', $length_callback );

    if ( function_exists( $more_callback ) )
        add_filter( 'excerpt_more', $more_callback );

    $output = get_the_excerpt();
    $output = apply_filters( 'wptexturize', $output );
    $output = apply_filters( 'convert_chars', $output );
    $output = '<p>' . $output . '</p>';
    echo $output;
}

function nano_excerpt_more( $more ) {
    return '<a class="read-more" href="' . get_permalink() . '" title="' . get_the_title() . '"rel="bookmark"> বিস্তারিত&raquo;</a>';
}

function nano_excerpt( $length ) {
    return 95;
}




/**
 * REMOVE rel ATTRIBUTE FROM CATEGORY LIST
 * Credit: Joseph
 * Link: http://josephleedy.me/blog/make-wordpress-category-list-valid-by-removing-rel-attribute/
-------------------------------------------------- */

add_filter('wp_list_categories', 'frank_remove_category_list_rel');
add_filter('the_category', 'frank_remove_category_list_rel');

function frank_remove_category_list_rel( $output ) {
    $output = str_replace(' rel="category tag"', '', $output);
    return $output;
}




/**
 * GRAB THE FIRST IMAGE FROM THE POST CONTENT
-------------------------------------------------- */

function grab_first_image() {
    global $post;
    $first_image = '';
    ob_start();
    ob_end_clean();
    if( $the_output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches) )
    $first_image = $matches[1][0];

    return $first_image;
}



/**
 * TEMPLATE FOR COMMENTS AND PINGBACKS
-------------------------------------------------- */

if ( ! function_exists( 'nano_comments' ) ) :

    function nano_comments( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php _e( 'পিংব্যাক:', 'nano-progga' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(সম্পাদনা)', 'nano-progga' ), '<span class="edit-link">', '</span>' ); ?></p>
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" class="comment">
                        <header class="comment-meta comment-author vcard">
                            <?php
                            echo get_avatar( $comment, 50 );
                            printf( '<cite class="fn">%1$s %2$s</cite>',
                                get_comment_author_link(),
                                // If current post author is also comment author, make it known visually.
                                ( $comment->user_id === $post->post_author ) ? '<sup class="the-author"> ' . __( 'লেখক', 'nano-progga' ) . '</sup>' : ''
                            );
                            printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                get_comment_time( 'c' ),
                                /* translators: 1: date, 2: time */
                                sprintf( __( '%1$s : %2$s', 'nano-progga' ), get_comment_date(), get_comment_time() )
                            );
                            edit_comment_link( __( '[ সম্পাদনা ]', 'nano-progga' ) );
                            ?>
                        </header><!-- .comment-meta -->

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="comment-awaiting-moderation"><?php _e( 'আপনার মন্তব্যটি প্রকাশের অনুমতির অপেক্ষায় রয়েছে।', 'nano-progga' ); ?></p>
                        <?php endif; ?>

                        <section class="comment-content comment">
                            <?php comment_text(); ?>
                        </section><!-- .comment-content -->

                        <div class="reply">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'প্রত্যুত্তর', 'nano-progga' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div><!-- .reply -->
                    </article><!-- #comment-## -->
                <?php
                break;
        endswitch; // end comment_type check
    }
endif;



/**
 * REMOVE UNNECESSARY HEADER INFO
-------------------------------------------------- */

function remove_header_info() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link');         // for WordPress <  3.0
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // for WordPress >= 3.0
}
add_action('init', 'remove_header_info');



/**
 * BANGLA NUMBERS, DATES, DAYS AND MONTHS
 * i.e. ২৮ নভেম্বর১৯৮৬
-------------------------------------------------- */

function make_bangla_number($str)
{
    $engNumber = array('0','1','2','3','4','5','6','7','8','9');
    $bangNumber = array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
    $converted = str_replace($engNumber, $bangNumber, $str);

    return $converted;
}
function make_bangla_day($strDay)
{
    $engDay = array('Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
    $bangDay = array('শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহঃস্পতিবার','শুক্রবার');
    $convertedDay = str_replace($engDay, $bangDay, $strDay);

    return $convertedDay;
}
function make_bangla_months($strM)
{
    $engM = array('January','February','March','April','May','June','July','August','September','October','November','December','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    $bangM = array('জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর');
    $convertedM = str_replace($engM, $bangM, $strM);

    return $convertedM;
}


add_filter( 'get_the_time', 'make_bangla_number' );
add_filter( 'the_date', 'make_bangla_number' );
add_filter( 'get_the_date', 'make_bangla_number' );

add_filter( 'comments_number', 'make_bangla_number' ); // comment form and all comments
add_filter( 'get_comment_date', 'make_bangla_number' ); // comment form and all comments
add_filter( 'get_comment_date', 'make_bangla_months' ); // comment form and all comments
add_filter( 'get_comment_time', 'make_bangla_number' ); // comment form and all comments

add_filter( 'the weekday', 'make_bangla_day' );



/**
 * LOAD SPECIAL CLASS TO THE FOOTER WIDGETS
-------------------------------------------------- */
function widget_display_callback( $params ) {

    global $wp_registered_widgets;
    global $my_widget_num; // Global a counter array

    $id = $params[0]['widget_id'];
    $sidebar_id = $params[0]['id'];

    /*  Set some count for each widgets  */
    if( !$my_widget_num ) { // If the counter array doesn't exist, create it
        $my_widget_num = array();
    }

    if( isset( $my_widget_num[ $sidebar_id ] ) ) { // See if the counter array has an entry for this sidebar
        $my_widget_num[ $sidebar_id ] ++;
    } else { // If not, create it starting with 1
        $my_widget_num[ $sidebar_id ] = 1;
    }

    $widget_counter = $my_widget_num[ $sidebar_id ];
    if( $widget_counter == 1 ) {
        $the_class = ' footer-widget-1 ';
    } elseif( $widget_counter == 2 ){
        $the_class = ' footer-widget-2 ';
    } elseif( $widget_counter == 3 ){
        $the_class = ' footer-widget-3 ';
    } else {
        $the_class = ' footer-widget-4 ';
    }

    if ( !empty( $sidebar_id ) && $sidebar_id == 'footer_widgets_area' && !empty( $the_class ) ) {
        // add  your classes
        $classe_to_add = $the_class; // make sure you leave a space at the end
        $classe_to_add = 'class=" ' . $classe_to_add;
        $params[0]['before_widget'] = str_replace( 'class="', $classe_to_add, $params[0]['before_widget'] );
    }
    return $params;
}
add_filter( 'dynamic_sidebar_params', 'widget_display_callback', 10 );




/**
 * FILTERING wp_title()
-------------------------------------------------- */

function nanodesigns_filter_wp_title( $title ) {
    // Get the Site Name
    $site_name = get_bloginfo( 'name' );
    // Prepend it to the default output
    $filtered_title =  $site_name . ' -- ' . $title;
    // If site front page, append description
    if ( is_front_page() ) {
        // Get the Site Description
        $site_description = get_bloginfo( 'description' );
        // Append Site Description to title
        $filtered_title .= $site_description;
    }
    // Return the modified title
    return $filtered_title;
}
// Hook into 'wp_title'
add_filter( 'wp_title', 'nanodesigns_filter_wp_title' );