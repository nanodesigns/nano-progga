<?php
/**
 * nano progga Settings Page.
 *
 * To let the user control site settings from admin panel.
 *
 * @package nano progga
 */


/**
 * Enqueue necessary scripts in admin panel.
 * @return void
 * --------------------------------------------------------------------------
 */
function nano_progga_admin_scripts() {
	global $current_screen;
	if( $current_screen->id === 'toplevel_page_np-settings' ) :

		wp_enqueue_style(
			'np-admin-styles',
			get_template_directory_uri() .'/admin/css/np-admin-styles.css'
		);

		// Load WordPress media uploader to the front-end with backward compatibility
		if ( get_bloginfo('version') >= 3.5 )
			wp_enqueue_media();
		else {
			wp_enqueue_style('thickbox');
			wp_enqueue_script('thickbox');
		}


		//nano progga custom script
		wp_enqueue_script(
			'np-admin-js',
			get_template_directory_uri() .'/admin/js/np-admin-js.js',
			array('jquery'),
			THEME_VERSION,
			true
		);

		//passing PHP var to JS
		wp_localize_script(
			'np-admin-js',
	    	'np',		//the var key in JS
	    	array(
	    		'url'			=> site_url('/'),
	    		'theme_path'	=> get_template_directory_uri()
	    		)
	    );

	endif;
}
add_action( 'admin_enqueue_scripts', 'nano_progga_admin_scripts' );


/**
 * Editor capability enabled.
 * 
 * Add site options page capability to 'Editor'.
 * 
 * @link http://tuts.nanodesignsbd.com/editors-to-access-and-save-theme-options/
 * @param  string $capability
 * @return string
 * --------------------------------------------------------------------------
 */
function options_page_capability( $capability ) {
    return 'edit_theme_options';
}
add_filter( 'option_page_capability_np_settings', 'options_page_capability' );

	//let the 'editor' user role have the 'edit_theme_options' priviledge
	$editor_role = get_role( 'editor' );
	$editor_role -> add_cap( 'edit_theme_options' );


/**
 * The options table field 'np_settings'
 * @return void
 * --------------------------------------------------------------------------
 */
function nano_progga_theme_options_fields_init(){
	register_setting(
		'np_settings',
		'np_settings',
		'np_settings_validate'
	);
}
add_action( 'admin_init', 'nano_progga_theme_options_fields_init' );


/**
 * Create the menu page for settings.
 * @return void
 * --------------------------------------------------------------------------
 */
function nano_progga_theme_options_add_page() {
	add_menu_page(
		__( 'Options', 'nano-progga' ),		// page title
		__( 'Options', 'nano-progga' ),		// menu title
		'edit_theme_options',					// capability
		'np-settings',							// page slug
		'nano_progga_settings',					// callback function
		get_template_directory_uri() .'/images/nano-progga-icon.svg', // icon
		66 										// position
	);
}
add_action( 'admin_menu', 'nano_progga_theme_options_add_page' );


/**
 * Callback function: page view.
 * @return void
 * --------------------------------------------------------------------------
 */
function nano_progga_settings() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<h2><?php echo '<img src="'. get_template_directory_uri() .'/images/nano-progga-icon.svg" alt="nano progga">&nbsp;', wp_get_theme(), '&nbsp;', __( '&mdash; Settings', 'nano-progga' ); ?></h2>
		<p><?php printf( __( "Maintain %s's static part from this options page.", 'nano-progga' ), get_bloginfo( 'name' ) ); ?></p>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div class="updated fade">
				<p><strong><?php _e( 'Settings saved', 'nano-progga' ); ?></strong></p>
			</div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'np_settings' ); ?>
			<?php $options = get_option( 'np_settings' ); ?>

			<!-- CONTROL SITE LOGO -->
			<section class="np-section logo">
				<h3><?php _e( 'Site Logo <small>set a site logo to show on the header of the site</small>', 'nano-progga' ); ?></h3>
				<div class="np-left-column">
					<strong><label for="logo"><?php _e( 'Site Logo', 'nano-progga' ); ?></label></strong><br>
					<input type="text" class="np-file-item" id="np-logo" name="np_settings[logo]" value="<?php echo $options['logo']; ?>" autocomplete="off">
					<button id="site-logo" class="button"><?php _e( 'Upload', 'nano-progga' ); ?></button>
				</div> <!-- /.np-left-column -->
				<div class="np-right-column">
					<div class="np-logo-preview">
						<div class="np-close">&times;</div>
						<img id="logo-preview" src="<?php echo $options['logo'] ? $options['logo'] : get_template_directory_uri() .'/images/placeholder.png'; ?>" alt="nano progga theme - site logo" width="60" height="60">
					</div>
				</div> <!-- /.np-right-column -->
				<div class="clearfix"></div>
			</section> <!-- /.np-section logo -->

			<!-- FEATURED SERIES GALLERY -->
			<section class="np-section featured-series">
				<div class="np-left-column">
					<h3><label><input id="np_settings[showseries]" name="np_settings[showseries]" type="checkbox" value="1" <?php checked( '1', $options['showseries'] ); ?> /> <?php _e( 'Featured Series <small>control which <strong>4</strong> series to show on home page as featured. press <kbd>Ctrl</kbd> and select multiple series. To disable simply uncheck the checkbox</small>', 'nano-progga' ); ?></label></h3>
					<select multiple="multiple" name="np_settings[serieschoice][]">
					<?php
					$series_terms = get_terms( array('series'), array('hide_empty' => false ) );

					foreach ($series_terms as $series) { ?>
						<?php $selected = in_array( $series->term_id, $options['serieschoice'] ) ? ' selected="selected" ' : ''; ?>
						<option value="<?php echo $series->term_id; ?>" <?php echo $selected; ?> ><?php echo $series->name . ' (' . $series->count .')'; ?></option>
					<?php } ?>
					</select>
				</div> <!-- /.np-left-column -->
				<div class="np-right-column">
					<h3><label><input id="np_settings[bangla]" name="np_settings[bangla]" type="checkbox" value="1" <?php checked( '1', $options['bangla'] ); ?> /> <?php _e( 'Enable Bengali<br><small>control whether to enable/disable Bengali (<em>Bangla</em>) support to your blog</small>', 'nano-progga' ); ?></label></h3>

					<h3><label><input id="np_settings[author_bio]" name="np_settings[author_bio]" type="checkbox" value="1" <?php checked( '1', $options['author_bio'] ); ?> /> <?php _e( 'Show Author Bio<br><small>control whether to show/hide author bio in <em>Author archives</em></small>', 'nano-progga' ); ?></label></h3>

					<h3><label><input id="np_settings[related_posts]" name="np_settings[related_posts]" type="checkbox" value="1" <?php checked( '1', $options['related_posts'] ); ?> /> <?php _e( 'Show Related Posts<br><small>control whether to show/hide related posts in post detail page</small>', 'nano-progga' ); ?></label></h3>			
				</div> <!-- /.np-right-column -->
				<div class="clearfix"></div>
			</section> <!-- /.np-section featured-series -->

			<!-- CONTROL HOME PAGE WIDGETS -->
			<section class="np-section home-widgets">
				<h3><?php _e( "Home Page Widgets Control <small>control home page widgets' properties</small>", "nano-progga" ); ?></h3>

				<h3><label><input id="np_settings[widgets_in_pages]" name="np_settings[widgets_in_pages]" type="checkbox" value="1" <?php checked( '1', $options['widgets_in_pages'] ); ?> /> <?php _e( 'Show widgets in paginated pages too <small>home widgets are visible only on the first paginated page of home page. If you want to show them in other pages too, check here</small>', 'nano-progga' ); ?></label></h3>

				<div>
					<p><?php
					$posts_per_page = get_option('posts_per_page');
					printf( __( "You can alter the placement of home page widgets by setting their individual values from below, and you can set places within %s", "nano-progga" ), $posts_per_page ); ?></p>
					<div class="col-2">
						<strong><label for="widget-1-pos"><?php _e( 'Home Widget 1: Position', 'nano-progga' ); ?></label></strong><br>
						<select name="np_settings[widget_1]" id="widget-1-pos">
							<option value="">---</option>
							<?php for( $it = 1; $it <= $posts_per_page; $it++ ) :
								echo '<option value="'. $it .'" '. selected( $it, $options['widget_1'], false ) .'>'. $it .'</option>';
							endfor; ?>
						</select>
					</div>
					<div class="col-2">
						<strong><label for="widget-2-pos"><?php _e( 'Home Widget 2: Position', 'nano-progga' ); ?></label></strong><br>
						<select name="np_settings[widget_2]" id="widget-2-pos">
							<option value="">---</option>
							<?php for( $it = 1; $it <= $posts_per_page; $it++ ) :
								echo '<option value="'. $it .'" '. selected( $it, $options['widget_2'], false ) .'>'. $it .'</option>';
							endfor; ?>
						</select>
					</div>
					<div class="col-2">
						<strong><label for="widget-3-pos"><?php _e( 'Home Widget 3: Position', 'nano-progga' ); ?></label></strong><br>
						<select name="np_settings[widget_3]" id="widget-3-pos">
							<option value="">---</option>
							<?php for( $it = 1; $it <= $posts_per_page; $it++ ) :
								echo '<option value="'. $it .'" '. selected( $it, $options['widget_3'], false ) .'>'. $it .'</option>';
							endfor; ?>
						</select>
					</div>
					<div class="col-2">
						<strong><label for="widget-4-pos"><?php _e( 'Home Widget 4: Position', 'nano-progga' ); ?></label></strong><br>
						<select name="np_settings[widget_4]" id="widget-4-pos">
							<option value="">---</option>
							<?php for( $it = 1; $it <= $posts_per_page; $it++ ) :
								echo '<option value="'. $it .'" '. selected( $it, $options['widget_4'], false ) .'>'. $it .'</option>';
							endfor; ?>
						</select>
					</div>
					<div class="col-2">
						<strong><label for="widget-5-pos"><?php _e( 'Home Widget 5: Position', 'nano-progga' ); ?></label></strong><br>
						<select name="np_settings[widget_5]" id="widget-5-pos">
							<option value="">---</option>
							<?php for( $it = 1; $it <= $posts_per_page; $it++ ) :
								echo '<option value="'. $it .'" '. selected( $it, $options['widget_5'], false ) .'>'. $it .'</option>';
							endfor; ?>
						</select>
					</div>
					<div class="clearfix"></div>
				</div>
			</section> <!-- /.np-section home-widgets -->

			<!-- CONTROL SOCIAL ICONS -->
			<section class="np-section social">
				<h3><?php _e( 'Social Control <small>control each of the social link from here</small>', 'nano-progga' ); ?></h3>
				<div class="np-left-column">
					<strong><label><?php _e( 'Facebook', 'nano-progga' ); ?></label></strong>
					<input type="text" class="np-field-item" id="facebook" name="np_settings[facebook]" placeholder="http://facebook.com/pageurl" value="<?php echo $options['facebook']; ?>" autocomplete="off"><br>

					<strong><label><?php _e( 'Twitter', 'nano-progga' ); ?></label></strong>
					<input type="text" class="np-field-item" id="twitter" name="np_settings[twitter]" placeholder="http://twitter.com/username" value="<?php echo $options['twitter']; ?>" autocomplete="off"><br>

					<strong><label><?php _e( 'LinkedIn', 'nano-progga' ); ?></label></strong>
					<input type="text" class="np-field-item" id="linkedin" name="np_settings[linkedin]" placeholder="http://linkedin.com/pageurl" value="<?php echo $options['linkedin']; ?>" autocomplete="off"><br>

					<strong><label><?php _e( 'Google+', 'nano-progga' ); ?></label></strong>
					<input type="text" class="np-field-item" id="gplus" name="np_settings[gplus]" placeholder="http://plus.google.com/pageurl" value="<?php echo $options['gplus']; ?>" autocomplete="off">
				</div> <!-- /.np-left-column -->
				<div class="np-right-column">
					<strong><label><?php _e( 'Flickr', 'nano-progga' ); ?></label></strong>
					<input type="text" class="np-field-item" id="flickr" name="np_settings[flickr]" placeholder="http://flickr.com/username" value="<?php echo $options['flickr']; ?>" autocomplete="off"><br>

					<strong><label><?php _e( 'Pinterest', 'nano-progga' ); ?></label></strong>
					<input type="text" class="np-field-item" id="pinterest" name="np_settings[pinterest]" placeholder="http://pinterest.com/username" value="<?php echo $options['pinterest']; ?>" autocomplete="off"><br>

					<strong><label><?php _e( 'Tumblr', 'nano-progga' ); ?></label></strong>
					<input type="text" class="np-field-item" id="tumblr" name="np_settings[tumblr]" placeholder="http://tumblr.com/username" value="<?php echo $options['tumblr']; ?>" autocomplete="off"><br>

					<strong><label><?php _e( 'YouTube', 'nano-progga' ); ?></label></strong>
					<input type="text" class="np-field-item" id="youtube" name="np_settings[youtube]" placeholder="http://youtube.com/channel/channelname" value="<?php echo $options['youtube']; ?>" autocomplete="off">
				</div> <!-- /.np-right-column -->
				<div class="clearfix"></div>
			</section> <!-- /.np-section social -->

			<!-- NOFOLLOW CONTENTS -->
			<section class="np-section nofollow">
				<h3><label><input id="np_settings[nofollow]" name="np_settings[nofollow]" type="checkbox" value="1" <?php checked( '1', $options['nofollow'] ); ?> /> <?php _e( 'NoFollow External Links<br><small>control whether to show <code>rel="nofollow"</code> in external links in post/page content</small>', 'nano-progga' ); ?></label></h3>
			</section> <!-- /.np-section nofollow -->

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'nano-progga' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 * --------------------------------------------------------------------------
 */
function np_settings_validate( $input ) {

	// checkboxes: checkbox value is either 0 or 1
	if ( ! isset( $input['showseries'] ) )
		$input['showseries'] = null;
	$input['showseries']	= ( $input['showseries'] == 1 ? 1 : 0 );
	
	if ( ! isset( $input['bangla'] ) )
		$input['bangla'] = null;
	$input['bangla']		= ( $input['bangla'] == 1 ? 1 : 0 );
	
	if ( ! isset( $input['author_bio'] ) )
		$input['author_bio'] = null;
	$input['author_bio']	= ( $input['author_bio'] == 1 ? 1 : 0 );

	if ( ! isset( $input['related_posts'] ) )
		$input['related_posts'] = null;
	$input['related_posts']	= ( $input['related_posts'] == 1 ? 1 : 0 );

	if ( ! isset( $input['widgets_in_pages'] ) )
		$input['widgets_in_pages'] = null;
	$input['widgets_in_pages']	= ( $input['widgets_in_pages'] == 1 ? 1 : 0 );

	if ( ! isset( $input['nofollow'] ) )
		$input['nofollow'] = null;
	$input['nofollow']	= ( $input['nofollow'] == 1 ? 1 : 0 );

	//array
	$serieschoice 			= array( $input['serieschoice'] );

	//textbox
	$input['logo']			= wp_filter_post_kses( $input['logo'] );

	$input['facebook']		= wp_filter_post_kses( $input['facebook'] );
	$input['twitter']		= wp_filter_post_kses( $input['twitter'] );
	$input['linkedin']		= wp_filter_post_kses( $input['linkedin'] );
	$input['googleplus']	= wp_filter_post_kses( $input['googleplus'] );
	$input['flickr'] 		= wp_filter_post_kses( $input['flickr'] );
	$input['pinterest'] 	= wp_filter_post_kses( $input['pinterest'] );
	$input['tubmlr'] 		= wp_filter_post_kses( $input['tubmlr'] );
	$input['youtube'] 		= wp_filter_post_kses( $input['youtube'] );	

	return $input;
}


// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/