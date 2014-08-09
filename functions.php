<?php
/**
 * FUNCTIONS for the WordPress Theme
 * @theme: nano progga
 * @developer: Mayeenul Islam (@mayeenulislam)
 */


/**
*   BANGLA SUPPORT TO THE THEME
*/

require_once ( get_template_directory() .'/inc/functions-bangla.php' );


/**
 * ADMIN PANEL - THEME OPTIONS
 * to make the site's feature dynamic for the user
 */
  
require_once ( get_template_directory() . '/admin-panel/theme-options.php' );

function styles_for_admin(){

    wp_register_style( 'admin-style', get_template_directory_uri() . '/css/admin-style.css', '', '', 'screen' );

    wp_enqueue_style( 'admin-style' ); // stylesheet for admin panel
}

add_action( 'admin_enqueue_scripts', 'styles_for_admin' );
  
  
/**
 *  ADD SITE OPTIONS PAGE CAPABILITY TO 'Editor'
 *  Source: http://tuts.nanodesignsbd.com/editors-to-access-and-save-theme-options/
 */
  
function options_page_capability( $capability ) {
    return 'edit_theme_options';
}
add_filter( 'option_page_capability_site_options', 'options_page_capability' );




/**
*   LOAD ALL THE NECESSARY THINGS WITH A SINGLE HOOK
*/
  
add_action('after_setup_theme', 'nano_progga_setup');
  
function nano_progga_setup(){
    /**
    *   MAKE THE THEME TRANSLATION-READY
    *   Thanks: Konstantinos Kouratoras & Robert Treacy
    *   Source:
    *    1. http://wp.smashingmagazine.com/2011/12/29/internationalizing-localizing-wordpress-theme/
    *    2. http://wp.tutsplus.com/tutorials/theme-development/translating-your-theme/
    */
    load_theme_textdomain( 'nano-progga', get_template_directory() . '/lang' );
  
  
    // ADD RSS LINK ON <head> TAG
    add_theme_support( 'automatic-feed-links' );

    // LOAD EDITOR STYLES - Load visual editor styles from editor-style.css to match the theme style
    add_editor_style();


    // SUPPORT FOR POST FORMATS
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery', 'status', 'chat',
    ) );
  
  
    // ENABLE FEATURED IMAGE FEATURE
    add_theme_support( 'post-thumbnails' );
  
    // REGISTER DYNAMIC MENUS
    register_nav_menus(
        array(
            'main-menu'=>__('Main Menu'),
            'footer-menu'=>__('Footer Menu')
        )
    );

    //ENABLING ARROW ON PARENT MENU
    //Source: http://stackoverflow.com/a/3594567/1743124

    class arrow_walker_nav_menu extends walker_nav_menu {
        function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
            $id_field = $this->db_fields['id'];
            if ( !empty( $children_elements[$element->$id_field] ) ) { 
                $element->classes[] = 'arrow'; //CSS classname here
                $element->title .= '<span class="arrow fa fa-caret-down"></span>'; //append html here
            }
            walker_nav_menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }
    } //end class
  
}





/**
 * ENQUEUE ALL THE NECESSARY CSS
 * -------------------------------------------------------------------------------- */
function nano_progga_styles(){  
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/style.css', '', '', 'all' );
    wp_enqueue_style( 'print-style', get_template_directory_uri() . '/print-style.css', '', '', 'print' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
}

add_action( 'wp_enqueue_scripts', 'nano_progga_styles' );





/**
 * ENQUEUE ALL THE NECESSARY JS
 * -------------------------------------------------------------------------------- */
function nano_progga_js(){
    wp_enqueue_script( 'jquery-latest', get_template_directory_uri() . '/js/jquery-1.11.1.min.js' );
    //wp_enqueue_script( 'jquery-latest', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' );
    
    wp_localize_script( 'jquery-fallback', 'styleSheetURL', get_stylesheet_directory_uri() );    
    wp_enqueue_script( 'jquery-fallback', get_template_directory_uri() . '/js/jquery-fallback.js', array( 'jquery-latest' ) );
    wp_enqueue_script( 'mobile-nav-scripts', get_template_directory_uri() . '/js/tinynav.min.js', '', '', true );
    wp_enqueue_script( 'responsive-scripts', get_template_directory_uri() . '/js/respond.min.js', '', '', true );
    wp_enqueue_script( 'nanodesigns-custom', get_template_directory_uri() . '/js/nanoprogga.custom.js', '', '', true );
}

add_action( 'wp_enqueue_scripts', 'nano_progga_js' );


/**
 * SET DEFAULT WIDTH OF THE SITE
 * -------------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) $content_width = 900;




/**
 * REUSABLE POST_META FUNCTION
 */

function has_custom_field( $fieldName = '' ) {
    global $post;
    $fetchedCustomField = get_post_meta($post->ID, $fieldName, true);
    $CFchecker = ($fetchedCustomField == '') ? '0' : '1';
    return (bool) $CFchecker;
}

function custom_field( $fieldName = '' ) {
    global $post;
    $fetchedCustomField = get_post_meta($post->ID, $fieldName, true);
    return $fetchedCustomField;
}



/**
 * GET THE PAGE NUMBER
* -------------------------------------------------------------------------------- */
  
function get_page_number() {
    if (get_query_var('paged')) {
        print ' | ' . __( 'Pages ' , 'nano-progga') . get_query_var('paged');
    }
} // end get_page_number
  
  
/**
 * For category lists on category archives:
 * Returns other categories except the current one (redundant)
 */
  
function cats_meow($glue) {
        $current_cat = single_cat_title( '', false );
        $separator = "\n";
        $cats = explode( $separator, get_the_category_list($separator) );
        foreach ( $cats as $i => $str ) {
                if ( strstr( $str, ">$current_cat<" ) ) {
                        unset($cats[$i]);
                        break;
                }
        }
        if ( empty($cats) )
                return false;
  
        return trim(join( $glue, $cats ));
} // end cats_meow
  
  
/**
 * For tag lists on tag archives:
 * Returns other tags except the current one (redundant)
 * -------------------------------------------------------------------------------- */
  
function tag_ur_it($glue) {
        $current_tag = single_tag_title( '', '',  false );
        $separator = "\n";
        $tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
        foreach ( $tags as $i => $str ) {
                if ( strstr( $str, ">$current_tag<" ) ) {
                        unset($tags[$i]);
                        break;
                }
        }
        if ( empty($tags) )
                return false;
  
        return trim(join( $glue, $tags ));
} // end tag_ur_it
  
  
/**
 * Register widgetized areas
 * -------------------------------------------------------------------------------- */
  
function theme_widgets_init() {
    register_sidebar( array (
        'name' => 'Right Sidebar',
        'id' => 'right_sidebar',
        'description' => __( 'Appears on the right portion of the site', 'nano-progga' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
    ) );

    register_sidebar( array (
        'name' => 'Archive Left Sidebar',
        'id' => 'left_sidebar',
        'description' => __( 'Appears on the left portion of the site only on archive pages', 'nano-progga' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
    ) );
  
} // end theme_widgets_init
  
add_action( 'widgets_init', 'theme_widgets_init', 10 );
  
  
// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
        $commenter = get_comment_author_link();
        if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
                $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
        } else {
                $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
        }
        $avatar_email = get_comment_author_email();
        $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
        echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link
  
  
/**
 * TEMPLATE FOR COMMENTS AND PINGBACKS
*/

if ( ! function_exists( 'nano_comments' ) ) :

    function nano_comments( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php _e( 'Pingback:', 'nano-progga' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '[ Edit ]', 'nano-progga' ), '<span class="edit-link">', '</span>' ); ?></p>
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
                ?>
                <?php // If current post author is also comment author, make it known visually.
                $author_class = ( $comment->user_id === $post->post_author ) ? ' bypostauthor' : ''; ?>
                <li <?php comment_class( array( $author_class ) ); ?> id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" class="comment">
                        <header class="comment-meta comment-author vcard row">
                            <?php
                            echo get_avatar( $comment, 80 );
                            printf( '<cite class="fn">%1$s</cite>',
                                get_comment_author_link()
                            );
                            echo '<br>';
                            printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                get_comment_time( 'c' ),
                                /* translators: 1: date, 2: time */
                                sprintf( __( '%1$s : %2$s', 'nano-progga' ), get_comment_date(), get_comment_time() )
                            );
                            echo '<br>';
                            edit_comment_link( __( '[ edit ]', 'nano-progga' ) );
                            ?>
                        </header><!-- .comment-meta -->

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'nano-progga' ); ?></p>
                        <?php endif; ?>

                        <section class="comment-content comment">
                            <?php comment_text(); ?>
                        </section><!-- .comment-content -->

                        <div class="reply">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'nano-progga' ), 'before' => '<span class="fa fa-arrow-down"></span> ', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div><!-- .reply -->
                    </article><!-- #comment-## -->
                <?php
                break;
        endswitch; // end comment_type check
    }
endif;
  
  
/**
*   Filtering wp_title()
 * -------------------------------------------------------------------------------- */
  
function nano_progga_filter_wp_title( $title ) {
    $site_name = get_bloginfo( 'name' );
    $filtered_title =  $site_name . ' • ' . $title;
    if ( is_front_page() ) {
        $site_description = get_bloginfo( 'description' );
        $filtered_title .= $site_description;
    }
    return $filtered_title;
}
  
add_filter( 'wp_title', 'nano_progga_filter_wp_title' );
  
  
  
  
/**
 * THE EXCERPT FILTERS
 * 
 * This group of functions will make a new controllable excerpt
 *  called nano_excerpt()
 * 
 * Source: Codex - http://codex.wordpress.org/Function_Reference/the_excerpt
 * Secondary Source: WP Spring by Mayeenul Islam (https://github.com/mayeenulislam/WP-CodeSpring)
 * -------------------------------------------------------------------------------- */
  
function nano_excerpt( $limit = 75, $more = true ) {
    if( $more == true ) {
        $limited_excerpts = wp_trim_words( get_the_excerpt(), $limit, new_excerpt_more() );
    } else {
        $limited_excerpts = wp_trim_words( get_the_excerpt(), $limit );
    }
    echo $limited_excerpts;
    return $limited_excerpts;
}

function block_excerpt_more( $readmore = 1 ) {
    if( $readmore == 1 ) {
        $read_more = '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'. __( 'Read More', 'nano-progga' ) .'</a>';
    } else {
        $read_more = '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'. __( 'See Details', 'nano-progga' ) .'</a>';
    }
    
    return $read_more;
}
  
function custom_excerpt_length( $length ) {
    return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
  
  
  
  
/**
 * PAGINATION FUCNTION
 * 
 * A common function to call pagination in archive and attachment/image templates
 * 
 * Thanks to: nanodesigns (http://nanodesignsbd.com) and Mayeenul Islam (@mayeenulislam)
 * Code taken from: nano progga (http://nanoprogga.nanodesignsbd.com)
 * -------------------------------------------------------------------------------- */
  
function nano_pagination() {
  
    if( is_attachment() ) { ?>
  
    <div id="nav-below" class="navigation row">
  
        <div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav fa fa-chevron-left"></span> Older Image', 'nano-progga' ) ) ?></div>
        <div class="nav-next"><?php next_image_link( false, __( 'Latest Image <span class="meta-nav fa fa-chevron-right"></span>', 'nano-progga' ) ) ?></div>
  
        <div style="clear: both;"></div>
  
    </div><!-- #nav-below -->
  
    <?php } else {
  
        global $wp_query;
        $total_pages = $wp_query->max_num_pages;
        if ( $total_pages > 1 ) { ?>
  
            <div id="nav-below" class="navigation row">
  
                <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav fa fa-chevron-left"></span> Older', 'nano-progga' )) ?></div>
                <div class="nav-next"><?php previous_posts_link(__( 'Latest <span class="meta-nav fa fa-chevron-right"></span>', 'nano-progga' )) ?></div>
  
                <div style="clear: both;"></div>
  
            </div><!-- #nav-below -->
  
        <?php } //endif ( $total_pages > 1 )
  
    } //endif( is_attachment() )
}
  
  
  
  
/**
*   LOAD FONT AWESOME ICON ACCORDING TO THE URL PARAMETER
*/
  
function font_awesome_class( $attachment_url = '' ) {
  
    $subString2 = substr( $attachment_url, -2 );
    $subString3 = substr( $attachment_url, -3 );
    $subString4 = substr( $attachment_url, -4 );
  
    if( $subString3 === 'pdf' ) {
        $class = ' fa fa-file-pdf-o';
    } elseif ( $subString3 === 'doc' || $subString4 === 'docx' || $subString3 === 'odt' ) {
        $class = ' fa fa-file-word-o';
    } elseif ( $subString3 === 'xls' || $subString4 === 'xlsx' ) {
        $class = ' fa fa-file-excel-o';
    } elseif ( $subString3 === 'ppt' || $subString4 === 'pptx' || $subString3 === 'pps' || $subString4 === 'ppsx' ) {
        $class = ' fa fa-file-powerpoint-o';
    } elseif( $subString3 === 'txt' ) {
        $class = ' fa fa-file-text-o';
    } elseif ( $subString3 === 'zip' || $subString3 === 'rar' || $subString2 === '7z' ) {
        $class = ' fa fa-file-archive-o';
    } elseif (  $subString3 === 'jpg' || $subString4 === 'jpeg' || $subString3 === 'gif' || $subString3 === 'png' ) {
        $class = ' fa fa-file-image-o';
    } elseif ( $subString3 === 'mp3' || $subString3 === 'm4a' || $subString3 === 'ogg' || $subString3 === 'wav' ) {
        $class = ' fa fa-file-audio-o';
    } elseif ( $subString3 === 'mp4' || $subString3 === 'm4v' || $subString3 === 'mov' || $subString3 === 'wmv' || $subString3 === 'avi' || $subString3 === 'mpg' || $subString3 === 'ogv' || $subString3 === '3gp' || $subString3 === '3g2' ) {
        $class = ' fa fa-file-video-o';
    } else {
        $class = ' fa fa-file-o';
    }
  
    // Fallback
    // if attachment file is not found
    $class = ( $attachment_url == '' ? ' fa fa-align-left' : $class );
  
    return $class;
}
  
  
  
  
/**
*   FORCE SUB-CATEGORIES TO FOLLOW THE PARENT CATEGORY TEMPLATE
*   Thanks: WerdsWords
*   Source: http://werdswords.com/force-sub-categories-use-the-parent-category-template/
*/
  
function new_subcategory_hierarchy() { 
    $category = get_queried_object();
   
    $parent_id = $category->category_parent;
   
    $templates = array();
       
    if ( $parent_id == 0 ) {
        // Use default values from get_category_template()
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
        $templates[] = 'category.php';     
    } else {
        // Create replacement $templates array
        $parent = get_category( $parent_id );
   
        // Current first
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
   
        // Parent second
        $templates[] = "category-{$parent->slug}.php";
        $templates[] = "category-{$parent->term_id}.php";
        $templates[] = 'category.php'; 
    }
    return locate_template( $templates );
}
   
add_filter( 'category_template', 'new_subcategory_hierarchy' );




/**
*   REMOVE rel ATTRIBUTE FROM CATEGORY LIST
*   Credit: Joseph Leedy
*
*   Source:
*   http://josephleedy.me/blog/make-wordpress-category-list-valid-by-removing-rel-attribute/
*/

add_filter( 'wp_list_categories', 'nanodesigns_remove_category_list_rel' );
add_filter( 'the_category', 'nanodesigns_remove_category_list_rel' );

function nanodesigns_remove_category_list_rel( $output ) {

    // Remove rel attribute from the category list
    return str_replace( ' rel="category tag"', '', $output );

}




/**
*   AUTHOR META FIELDS
*/

function nano_progga_author_meta_fields( $methods ) {

    $methods['nano_facebook'] = __('Facebook Profile URL [np]', 'nano-progga');
    $methods['nano_twitter'] = __('Twitter URL [np]', 'nano-progga');
    $methods['nano_google_plus'] = __('Google Plus URL [np]', 'nano-progga');
    $methods['nano_linkedin'] = __('LinkedIn URL [np]', 'nano-progga');
    $methods['nano_pinterest'] = __('Pinterest URL [np]', 'nano-progga');
    $methods['nano_tumblr'] = __('Tumblr URL [np]', 'nano-progga');

    return $methods;
}

add_filter( 'user_contactmethods', 'nano_progga_author_meta_fields' );
  
  
  
/**
 * DEVELOPER TOOLS
 */
  
function my_var_dump( $variable ) {
    echo '<pre>';
        print_r( $variable );
    echo '</pre>';
}

function dequeue_devicepx() {
wp_dequeue_script( 'devicepx' );
}
add_action( 'wp_enqueue_scripts', 'dequeue_devicepx', 20 );