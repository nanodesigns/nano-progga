<?php
/**
 * nano-progga functions and definitions
 *
 * @package nano-progga
 */

/**
 * Set some basic globals
 */
define( 'PREFIX', 'np_');
define( 'THEME_VERSION', '3.0');

/**
 * Enable only when developing the site.
 * nanodesigns
 * @author  Mayeenul Islam <wz.islam@gmail.com>
 */
if( WP_DEBUG === true ) {
	require get_template_directory() .'/__development/development.php';	
}


/**
 * Bengali Support to the Theme.
 * @package nano progga
 */
$option = get_option( 'np_settings' ); //retrieve theme options settings

if( $option['bangla'] == 1 )
	require get_template_directory() . '/inc/functions-bangla.php';



if ( ! function_exists( 'nano_progga_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 * ------------------------------------------------------------------------------
 */
function nano_progga_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on nano-progga, use a find and replace
	 * to change 'nano-progga' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'nano-progga', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array( 'main_menu' => esc_html__( 'Main Menu', 'nano-progga' ) ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'nano_progga_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // nano_progga_setup
add_action( 'after_setup_theme', 'nano_progga_setup' );

/**
 * Bootstrap Nav Walker Class
 * @author  Edward McIntyre
 * @link https://github.com/twittem/wp-bootstrap-navwalker
 */
require get_template_directory() .'/libs/wp-bootstrap-navwalker.php';

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 * ------------------------------------------------------------------------------
 */
function nano_progga_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nano_progga_content_width', 700 );
}
add_action( 'after_setup_theme', 'nano_progga_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 * ------------------------------------------------------------------------------
 */
function nano_progga_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget 1', 'nano-progga' ),
		'id'            => 'home_widget_1',
		'description'   => esc_html__( 'Appears on the home page within the grid', 'nano-progga' ),
		'before_widget' => '<aside id="%1$s" class="grid-item widget-holder col-sm-4 %2$s"><div class="grid-widget home-widget-1">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget 2', 'nano-progga' ),
		'id'            => 'home_widget_2',
		'description'   => esc_html__( 'Appears on the home page within the grid', 'nano-progga' ),
		'before_widget' => '<aside id="%1$s" class="grid-item widget-holder col-sm-4 %2$s"><div class="grid-widget home-widget-2">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget 3', 'nano-progga' ),
		'id'            => 'home_widget_3',
		'description'   => esc_html__( 'Appears on the home page within the grid', 'nano-progga' ),
		'before_widget' => '<aside id="%1$s" class="grid-item widget-holder col-sm-4 %2$s"><div class="grid-widget home-widget-3">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget 4', 'nano-progga' ),
		'id'            => 'home_widget_4',
		'description'   => esc_html__( 'Appears on the home page within the grid', 'nano-progga' ),
		'before_widget' => '<aside id="%1$s" class="grid-item widget-holder col-sm-4 %2$s"><div class="grid-widget home-widget-4">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget 5', 'nano-progga' ),
		'id'            => 'home_widget_5',
		'description'   => esc_html__( 'Appears on the home page within the grid', 'nano-progga' ),
		'before_widget' => '<aside id="%1$s" class="grid-item widget-holder col-sm-4 %2$s"><div class="grid-widget home-widget-5">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'nano-progga' ),
		'id'            => 'right_sidebar',
		'description'   => esc_html__( 'Appears on the right portion of the site', 'nano-progga' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Archive Left Sidebar', 'nano-progga' ),
		'id'            => 'left_sidebar',
		'description'   => esc_html__( 'Appears on the left portion of the site only on archive pages', 'nano-progga' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'nano-progga' ),
		'id'            => 'footer_sidebar',
		'description'   => esc_html__( 'Appears on the footer portion of the site', 'nano-progga' ),
		'before_widget' => '<div class="col-sm-4"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'nano_progga_widgets_init' );

/**
 * Enqueue scripts and styles.
 * ------------------------------------------------------------------------------
 */
function nano_progga_scripts() {
	wp_enqueue_style( 'bootstrap-styles', get_template_directory_uri() .'/css/bootstrap.min.css' );
	//wp_enqueue_style( 'bootstrap-map', get_template_directory_uri() .'/css/bootstrap.css.map' );
	wp_enqueue_style( 'nano-progga-style', get_stylesheet_uri() );

	wp_enqueue_script( 'modernizr-js', get_template_directory_uri() .'/js/modernizr-2.8.3.min.js', array(), '2.8.3' ); //in head
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() .'/js/bootstrap.min.js', array('jquery'), '3.3.4', true );
	wp_enqueue_script( 'nano-progga-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if( is_home() || is_page_template('page-templates/blog.php') )
		wp_enqueue_script( 'masonry-grid-js', get_template_directory_uri() .'/js/masonry.pkgd.min.js', array('jquery'), '3.3.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script( 'jQuery-matchHeight-js', get_template_directory_uri() .'/js/jquery.matchHeight.min.js', array('jquery'), '0.6.0', true );
	
	wp_enqueue_script( 'nano-progga-js', get_template_directory_uri() .'/js/nano-progga.min.js', array('jquery'), THEME_VERSION, true );

	//passing PHP var to JS
	wp_localize_script(
		'nano-progga-js',
    	'np',		//the var key in JS
    	array(
    		'url'			=> site_url('/'),
    		'theme_path'	=> get_template_directory_uri()
    		)
    );
}
add_action( 'wp_enqueue_scripts', 'nano_progga_scripts' );


/**
 * Require Necessary Functions.
 * ------------------------------------------------------------------------------
 */
require get_template_directory() . '/inc/custom-header.php';		//custom header
require get_template_directory() . '/inc/template-tags.php';		//template tags
require get_template_directory() . '/inc/extras.php';				//theme extras
require get_template_directory() . '/inc/customizer.php';			//WP Customizer API
require get_template_directory() . '/inc/jetpack.php';				//Jetpack compatibility
require get_template_directory() . '/inc/functions-series.php';		//Posts Series
require get_template_directory() . '/inc/framework/helpers.php';	//Helper Functions
require get_template_directory() . '/inc/framework/shortcodes.php';	//Shortcodes

// Admin Panel Options
require get_template_directory() . '/admin/nano-progga-settings.php';


/**
 * The excerpt filters
 * @param  (string) $more
 * @return (string)       ... instead of [...]
 * ------------------------------------------------------------------------------
 */
function nano_progga_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'nano_progga_excerpt_more' );


/**
 * Dimox Breadcrumbs
 * http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 * Since ver 1.0
 * Add this to any template file by calling nano_progga_breadcrumbs()
 * Changes: MC added taxonomy support
 */
function nano_progga_breadcrumbs(){
  	/* === OPTIONS === */
	$text['home']     = __('Home', 'nano-progga'); // text for the 'Home' link
	$text['category'] = __('Category: "%s"', 'nano-progga'); // text for a category page
	$text['tax'] 	  = __('Archive: "%s"', 'nano-progga'); // text for a taxonomy page
	$text['search']   = __('Search Results: "%s"', 'nano-progga'); // text for a search results page
	$text['tag']      = __('Tagged: "%s"', 'nano-progga'); // text for a tag page
	$text['author']   = __('Author: %s', 'nano-progga'); // text for an author page
	$text['404']      = __('Error 404', 'nano-progga'); // text for the 404 page

	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ' &raquo; '; // delimiter between crumbs
	$before      = '<span class="current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$homeLink = get_bloginfo('url') . '/';
	$linkBefore = '<span typeof="v:Breadcrumb">';
	$linkAfter = '</span>';
	$linkAttr = ' rel="v:url" property="v:title"';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

	if (is_home() || is_front_page()) {

		if ($showOnHome == 1) echo '<div id="breadcrumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<div id="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

		
		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif( is_tax() ){
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;
		
		}elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				//$cat = get_the_category(); $cat = $cat[0];
				//$cats = get_category_parents($cat, TRUE, $delimiter);
				//if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				//$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				//$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				//echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo $delimiter;
			}
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div> <!-- #breadcrumbs -->';

	}
} // end nano_progga_breadcrumbs()


/**
 * Show user meta fields.
 * @param  array $methods default user contact methods.
 * @return array          nano progga contact methods.
 */
function nano_progga_author_meta_fields( $methods ) {
    $methods['nano_facebook']		= __('Facebook Profile URL [np]', 'nano-progga');
    $methods['nano_twitter']		= __('Twitter URL [np]', 'nano-progga');
    $methods['nano_google_plus']	= __('Google+ Profile URL [np]', 'nano-progga');
    $methods['nano_linkedin']		= __('LinkedIn URL [np]', 'nano-progga');
    $methods['nano_pinterest']		= __('Pinterest URL [np]', 'nano-progga');
    $methods['nano_tumblr']			= __('Tumblr URL [np]', 'nano-progga');

    return $methods;
}
if( $option['author_bio'] == 1 )
	add_filter( 'user_contactmethods', 'nano_progga_author_meta_fields' );


/**
 * Get Related Posts
 * @param  integer  $post_id
 * @param  integer $numberposts default is set to 3
 * @return void
 * --------------------------------------------------------------------------
 */
function nano_progga_get_related_posts( $post_id = null, $numberposts = 3 ) {
	if( is_single() ) {

		$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

		$total_fetched = 0;

		echo '<div class="related-posts">';
			echo '<h3 class="page-title inner-title"><span>'. __( 'Related Posts', 'nano-progga' ) .'</span></h3>';
			echo '<div class="row">';

			$categories = wp_get_post_categories( $post_id );
		    $args = array(
	    		'post_type' 			=> 'post',
	    		'post_status'			=> 'publish',
	    		'posts_per_page'		=> $numberposts, //default 3
	    		'post__not_in'			=> array( $post_id ),
	    		'orderby'				=> 'rand',
	    		'category__in'			=> $categories,
	    		'ignore_sticky_posts'	=> 1
	    	);
			$related_posts_per_categories = new WP_Query( $args );

			while( $related_posts_per_categories->have_posts() ) :
				$related_posts_per_categories->the_post(); ?>

				<div class="col-xs-4 related-post-col">
					<div class="related-post related-post-<?php the_ID(); ?>">
						<?php if( has_post_thumbnail() ) : ?>
							<div class="featured-image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail(); ?>
								</a>
							</div>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<?php else : ?>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<div class="entry-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>
						<?php endif; ?>
					</div>
				</div> <!-- /.col-xs-4 related-post-col -->
				
				<?php
				$total_fetched++; //update total fetched count on each found posts

			endwhile;
			wp_reset_postdata();


			//alternative if necessary
			if( $total_fetched < $numberposts ) {
				$get_total = $numberposts - $total_fetched;

				$tags = wp_get_post_tags( $post_id );
				$tag_ids = array();
				foreach( $tags as $indv_tag ) :
					$tag_ids[] = $indv_tag->term_id;
				endforeach;

			    $args = array(
			    		'post_type' 			=> 'post',
			    		'post_status'			=> 'publish',
			    		'posts_per_page'		=> $get_total, //only the remaining
			    		'post__not_in'			=> array( $post_id ),
			    		'orderby'				=> 'rand',
			    		'tag__in'				=> $tag_ids,
			    		'ignore_sticky_posts'	=> 1
			    	);
				$related_posts_per_tags = new WP_Query( $args );

				while( $related_posts_per_tags->have_posts() ) :
					$related_posts_per_tags->the_post(); ?>

					<div class="col-xs-4 related-post-col">
						<div class="related-post related-post-<?php the_ID(); ?>">
							<?php if( has_post_thumbnail() ) : ?>
								<div class="featured-image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
								</div>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<?php else : ?>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<div class="entry-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>
							<?php endif; ?>
						</div>
					</div> <!-- /.col-xs-4 related-post-col -->

					<?php
					$total_fetched++; //update total fetched count on each found posts

				endwhile;
				wp_reset_postdata();
			}

			echo '</div> <!-- .row -->';
		echo '</div> <!-- .related-posts -->';

	} //endif( is_single() )
}



/**
 * Nofollow External Links.
 * Modifying post_content where <a rel="nofollow"> is added to all the external links only.
 *
 * @author  Christine Cooper
 * @link http://wordpress.stackexchange.com/a/169029
 * 
 * @param  string $content post_content.
 * @return string          post_content modified.
 */
function nano_progga_nofollow_enternal_links( $content ) {

    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
    if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
        if( !empty($matches) ) {

            $srcUrl = get_option('home');
            for ($i=0; $i < count($matches); $i++)
            {

                $tag = $matches[$i][0];
                $tag2 = $matches[$i][0];
                $url = $matches[$i][0];

                $noFollow = '';

                $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' rel="nofollow" ';

                $pos = strpos($url,$srcUrl);
                if ($pos === false) {
                    $tag = rtrim ($tag,'>');
                    $tag .= $noFollow.'>';
                    $content = str_replace($tag2,$tag,$content);
                }
            }
        }
    }

    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;

}

$options = get_option('np_settings');

if( $options['nofollow'] == '1' )
	add_filter( 'the_content', 'nano_progga_nofollow_enternal_links');