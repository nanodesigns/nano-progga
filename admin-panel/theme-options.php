<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'site_options', 'site_options', 'site_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'nano-progga' ), __( 'Theme Options', 'nano-progga' ), 'edit_theme_options', 'site_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php echo '<h2>'; echo '<span class="dashicons dashicons-menu nano-admin-icon"></span> ' ; echo wp_get_theme(); _e( ' &mdash; Theme Options', 'nano-progga' ); echo '</h2>'; ?>
		<?php echo '<p>' . __( 'Maintain your blog\'s static part from this theme options page.', 'nano-progga' ); ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Settings saved', 'nano-progga' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'site_options' ); ?>
			<?php $options = get_option( 'site_options' ); ?>

			<table class="form-table site-options-table">

				<?php
				/**
				 * Enable Bengali Support
				 */
				?>
				<tr valign="top">
					<th scope="row"><?php _e( 'Enable Bengali (<em>Bangla</em>)', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[bangla]" name="site_options[bangla]" type="checkbox" value="1" <?php checked( '1', $options['bangla'] ); ?> />
							<label class="description" for="site_options[bangla]"><?php _e( 'Control whether to enable/disable Bengali (<em>Bangla</em>) support to your blog', 'nano-progga' ); ?></label>
						</div> <!-- .options-col-left -->
						
					</td>
				</tr>
				<tr>
					<td class="seperator-td" colspan="2"><hr><td>
				</tr>

				<?php
				/**
				 * AUTHOR BIO in Author Archives
				 */
				?>
				<tr valign="top">
					<th scope="row"><?php _e( 'Show Author Bio', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[author_bio]" name="site_options[author_bio]" type="checkbox" value="1" <?php checked( '1', $options['author_bio'] ); ?> />
							<label class="description" for="site_options[author_bio]"><?php _e( 'Control whether to show/hide author bio in <em>Author archives</em>', 'nano-progga' ); ?></label>
						</div> <!-- .options-col-left -->
						
					</td>
				</tr>
				<tr>
					<td class="seperator-td" colspan="2"><hr><td>
				</tr>

				<?php
				/**
				 * SOCIAL SOCIAL LINKS
				 */
				?>
				<tr valign="top">
					<th scope="row"><?php _e( 'Facebook Page URL', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[facebookURL]" class="regular-text" type="text" placeholder="http://facebook.com/pagename" name="site_options[facebookURL]" value="<?php echo esc_attr( $options['facebookURL'] ); ?>" />
						</div> <!-- .options-col-left -->
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e( 'Twitter Account URL', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[twitterURL]" class="regular-text" type="text" placeholder="http://twitter.com/username" name="site_options[twitterURL]" value="<?php echo esc_attr( $options['twitterURL'] ); ?>" />
						</div> <!-- .options-col-left -->
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e( 'LinkedIn Page URL', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[linkedinURL]" class="regular-text" type="text" placeholder="http://linkedin.com/company/pagename" name="site_options[linkedinURL]" value="<?php echo esc_attr( $options['linkedinURL'] ); ?>" />
						</div> <!-- .options-col-left -->
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e( 'Google+ Page URL', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[googleplusURL]" class="regular-text" type="text" placeholder="http://plus.google.com/+PageName" name="site_options[googleplusURL]" value="<?php echo esc_attr( $options['googleplusURL'] ); ?>" />
						</div> <!-- .options-col-left -->
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e( 'Flickr Account URL', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[flickrURL]" class="regular-text" type="text" placeholder="http://flickr.com/username" name="site_options[flickrURL]" value="<?php echo esc_attr( $options['flickrURL'] ); ?>" />
						</div> <!-- .options-col-left -->
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e( 'Pinterest Account URL', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[pinterestURL]" class="regular-text" type="text" placeholder="http://pinterest.com/username" name="site_options[pinterestURL]" value="<?php echo esc_attr( $options['pinterestURL'] ); ?>" />
						</div> <!-- .options-col-left -->
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e( 'Tumblr Blog URL', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[tubmlrURL]" class="regular-text" type="text" placeholder="http://tumblr.com/username" name="site_options[tubmlrURL]" value="<?php echo esc_attr( $options['tubmlrURL'] ); ?>" />
						</div> <!-- .options-col-left -->
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e( 'YouTube Channel URL', 'nano-progga' ); ?></th>
					<td>
						<div class="options-col-left">
							<input id="site_options[youtubeURL]" class="regular-text" type="text" placeholder="http://youtube.com/channel/channelname" name="site_options[youtubeURL]" value="<?php echo esc_attr( $options['youtubeURL'] ); ?>" />
						</div> <!-- .options-col-left -->
					</td>
				</tr>				

			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'nano-progga' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function site_options_validate( $input ) {
	
	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['author_bio'] ) )
		$input['author_bio'] = null;
	$input['author_bio'] = ( $input['author_bio'] == 1 ? 1 : 0 );

	if ( ! isset( $input['bangla'] ) )
		$input['bangla'] = null;
	$input['bangla'] = ( $input['bangla'] == 1 ? 1 : 0 );

	$input['facebookURL'] = wp_filter_post_kses( $input['facebookURL'] );
	$input['twitterURL'] = wp_filter_post_kses( $input['twitterURL'] );
	$input['linkedinURL'] = wp_filter_post_kses( $input['linkedinURL'] );
	$input['googleplusURL'] = wp_filter_post_kses( $input['googleplusURL'] );
	$input['flickrURL'] = wp_filter_post_kses( $input['flickrURL'] );
	$input['pinterestURL'] = wp_filter_post_kses( $input['pinterestURL'] );
	$input['tubmlrURL'] = wp_filter_post_kses( $input['tubmlrURL'] );
	$input['youtubeURL'] = wp_filter_post_kses( $input['youtubeURL'] );	

	return $input;
}


// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/