<?php
/**
 * nano progga Settings Page.
 *
 * To let the user control site settings from admin panel.
 *
 * @package nano progga
 */

/**
 * Make an <option> array for the admin framework.
 * @return array Array with term_id and term_name with term_count.
 * --------------------------------------------------------------------------
 */
function make_series_options() {
	$series_terms = get_terms( array('series'), array('hide_empty' => false ) );

	$_result = array();
	if( $series_terms && is_array($series_terms) ) :
		foreach( $series_terms as $series ) :
			$_result[$series->term_id] = $series->name ." ({$series->count})";
		endforeach;
	endif;

	return $_result;
}

function home_widgets_positioning_options() {
	$posts_per_page = get_option( 'posts_per_page' );
	
	$_result = array();
	for( $iteration = 1; $iteration <= $posts_per_page; $iteration++ ) :
		$_result[$iteration] = $iteration;
	endfor;

	return $_result;
}

/**
 * Initiating Theme Options Framework.
 *
 * @since  3.0.0
 * 
 * @param  array $settings Options Framework Default Settings array.
 * @return array           Settings as per our need.
 * --------------------------------------------------------------------------
 */
function nano_progga_theme_options_settings( $settings ) {

	$settings      = array(
		'menu_title' => 'Theme Options',
		'menu_type'  => 'add_theme_page',
		'menu_slug'  => 'np-options',
		'ajax_save'  => false,
	);

	return $settings;
}
add_filter( 'cs_framework_settings', 'nano_progga_theme_options_settings' );


/**
 * Theme Options Options Fields.
 * @param  array $options Options Framework Default Option Fields' array.
 * @return array          Options as per our need.
 * --------------------------------------------------------------------------
 */
function nano_progga_theme_options( $options ) {
	$options      = array(); // remove old options

	$options[]    = array(
		'name'      => 'basic_settings',
		'title'     => 'Basic Settings',
		'icon'      => 'fa fa-cogs',
		'fields'    => array(
							array(
								'id'        => 'logo',
								'type'      => 'image',
								'title'     => __( 'Site Logo', 'nano-progga' ),
								'desc'			=> __( 'Set a site logo to show on the header of the site. Upload an image of minimum <code>40px</code> &times; <code>40px</code>', 'nano-progga' ),
								'add_title' => 'Add Logo',
							),
							array(
								'id'     		=> 'bangla',
								'type'   		=> 'switcher',
								'title'  		=> __( 'Enable Bengali', 'nano-progga' ),
								'default'		=> false,
								'label'			=> __( 'Control whether to enable/disable Bengali (<em>Bangla</em>) support to your blog', 'nano-progga' ),
							),
							array(
								'type'  		=> 'notice',
								'class' 		=> 'info',
								'content' 		=> __( '<strong>Featured Post Series</strong> Control the Featured Post Series from here', 'nano-progga' ),
							),
							array(
								'id'     		=> 'showseries',
								'type'   		=> 'switcher',
								'title'  		=> __( 'Show series', 'nano-progga' ),
								'default'		=> false,
								'label'			=> __( 'Control whether to show the featured series on the Home page or not', 'nano-progga' ),
							),
							array(
								'id'     		=> 'serieschoice',
								'type'   		=> 'select',
								'title'  		=> __( 'Choice Featured Series', 'nano-progga' ),
								'desc'			=> __( 'Control which 4 series to show on home page as featured (Select multiple)', 'nano-progga' ),
								'dependency' 	=> array(
													'showseries',
													'==',
													'true'
												), // dependent on switch
								'options'		=> make_series_options(), //custom function
								'attributes' 	=> array(
													'multiple' => 'multiple',
												),
								'class'      => 'chosen',
							),
							array(
								'type'  		=> 'notice',
								'class' 		=> 'info',
								'content' 		=> sprintf( __( '<strong>Home Page Widgets</strong> You can alter the placement of home page widgets by setting their individual values from here, and you can set places within <strong>%s</strong>', 'nano-progga' ), get_option('posts_per_page') ),
							),
							array(
								'id'        => 'widgets_positioning',
								'type'      => 'fieldset',
								'title'     => __( "Widgets' Positioning", 'nano-progga' ),
								'fields'    => array(
													array(
														'id'    => 'home_widget_1',
														'type'  => 'select',
														'title' => __( 'Home Widget 1 : Position', 'nano-progga' ),
														'options' => home_widgets_positioning_options(), //custom function
														'default_option' => 'Select position',
													),
													array(
														'id'    => 'home_widget_2',
														'type'  => 'select',
														'title' => __( 'Home Widget 2 : Position', 'nano-progga' ),
														'options' => home_widgets_positioning_options(), //custom function
														'default_option' => 'Select position',
													),
													array(
														'id'    => 'home_widget_3',
														'type'  => 'select',
														'title' => __( 'Home Widget 3 : Position', 'nano-progga' ),
														'options' => home_widgets_positioning_options(), //custom function
														'default_option' => 'Select position',
													),
													array(
														'id'    => 'home_widget_4',
														'type'  => 'select',
														'title' => __( 'Home Widget 4 : Position', 'nano-progga' ),
														'options' => home_widgets_positioning_options(), //custom function
														'default_option' => 'Select position',
													),
													array(
														'id'    => 'home_widget_5',
														'type'  => 'select',
														'title' => __( 'Home Widget 5 : Position', 'nano-progga' ),
														'options' => home_widgets_positioning_options(), //custom function
														'default_option' => 'Select position',
													),
												),
							),
							array(
								'id'     		=> 'widgets_in_pages',
								'type'   		=> 'switcher',
								'title'  		=> __( 'Show widgets in paginated pages too', 'nano-progga' ),
								'default'		=> false,
								'desc'			=> __( 'Home widgets are visible only on the first paginated page of home page.', 'nano-progga' ),
								'label'			=> __( 'If you want to show them in other pages too, enable here', 'nano-progga' ),
							)
						)
					);

	$options[]    = array(
		'name'      => 'other_settings',
		'title'     => 'Other Settings',
		'icon'      => 'fa fa-wrench',
		'fields'    => array(
							array(
								'id'     		=> 'author_bio',
								'type'   		=> 'switcher',
								'title'  		=> __( 'Show Author Bio', 'nano-progga' ),
								'default'		=> false,
								'label'			=> __( 'Control whether to show/hide author bio in <em>Author</em> archives', 'nano-progga' ),
							),
							array(
								'id'     		=> 'related_posts',
								'type'   		=> 'switcher',
								'title'  		=> __( 'Show Related Posts', 'nano-progga' ),
								'default'		=> false,
								'label'			=> __( 'Control whether to show/hide related posts in post detail page', 'nano-progga' ),
							),
						)
					);

	$options[]    = array(
		'name'      => 'seo_settings',
		'title'     => 'SEO Settings',
		'icon'      => 'fa fa-shield',
		'fields'    => array(
							array(
								'id'     		=> 'nofollow',
								'type'   		=> 'switcher',
								'title'  		=> __( 'NoFollow External Links', 'nano-progga' ),
								'default'		=> false,
								'label'			=> __( 'Control whether to show <code>rel="nofollow"</code> in external links in post/page content', 'nano-progga' ),
							)
						)
					);

	$options[]    = array(
		'name'      => 'social_settings',
		'title'     => 'Social Settings',
		'icon'      => 'fa fa-share-square',
		'fields'    => array(
							array(
								'id'    		=> 'rss',
								'type'  		=> 'text',
								'title' 		=> sprintf( __( '%s RSS Feed URL', 'nano-progga' ), '<span class="fa fa-rss-square"></span>' ),
								'default'		=> get_bloginfo('rss_url'),
							),
							array(
								'id'    		=> 'facebook',
								'type'  		=> 'text',
								'title' 		=> sprintf( __( '%s Facebook URL', 'nano-progga' ), '<span class="fa fa-facebook-official"></span>' ),
								'attributes'    => array(
												'placeholder' => 'http://facebook.com/page-url',
											),
							),
							array(
								'id'    		=> 'twitter',
								'type'  		=> 'text',
								'title' 		=> sprintf( __( '%s Twitter URL', 'nano-progga' ), '<span class="fa fa-twitter-square"></span>' ),
								'attributes'    => array(
												'placeholder' => 'http://twitter.com/username',
											),
							),
							array(
								'id'    		=> 'linkedin',
								'type'  		=> 'text',
								'title' 		=> sprintf( __( '%s LinkedIn Page URL', 'nano-progga' ), '<span class="fa fa-linkedin-square"></span>' ),
								'attributes'    => array(
												'placeholder' => 'http://linkedin.com/pageurl',
											),
							),
							array(
								'id'    		=> 'googleplus',
								'type'  		=> 'text',
								'title' 		=> sprintf( __( '%s Google+ Page URL', 'nano-progga' ), '<span class="fa fa-google-plus-square"></span>' ),
								'attributes'    => array(
												'placeholder' => 'http://plus.google.com/pageurl',
											),
							),
							array(
								'id'    		=> 'flickr',
								'type'  		=> 'text',
								'title' 		=> sprintf( __( '%s Flickr URL', 'nano-progga' ), '<span class="fa fa-flickr"></span>' ),
								'attributes'    => array(
												'placeholder' => 'http://flickr.com/username',
											),
							),
							array(
								'id'    		=> 'pinterest',
								'type'  		=> 'text',
								'title' 		=> sprintf( __( '%s Pinterest Profile URL', 'nano-progga' ), '<span class="fa fa-pinterest-square"></span>' ),
								'attributes'    => array(
												'placeholder' => 'http://pinterest.com/username',
											),
							),
							array(
								'id'    		=> 'tumblr',
								'type'  		=> 'text',
								'title' 		=> sprintf( __( '%s Tumblr Blog URL', 'nano-progga' ), '<span class="fa fa-tumblr-square"></span>' ),
								'attributes'    => array(
												'placeholder' => 'http://tumblr.com/username',
											),
							),
							array(
								'id'    		=> 'youtube',
								'type'  		=> 'text',
								'title' 		=> sprintf( __( '%s YouTube Channel URL', 'nano-progga' ), '<span class="fa fa-youtube-square"></span>' ),
								'attributes'    => array(
												'placeholder' => 'http://youtube.com/channel/channelname',
											),
							),
						)
					);

	return $options;
}
add_filter( 'cs_framework_options', 'nano_progga_theme_options' );