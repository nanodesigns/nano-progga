<?php
/**
 * FUNCTIONS SPECIFIC TO A THEME OPTIONS PAGE
 * @package: nano progga
 * @developer: nanodesigns
 *
 */

function nanodesigns_theme_options() {

    add_theme_page(
        '<strong>nano</strong>progga',  // Page tile
        '<strong>nano</strong>progga',  // Menu title
        'administrator',                // User role
        'nano_progga_options',          // id/slug
        'nano_progga_page_display'      // callback function
    );
}

add_action( 'admin_menu', 'nanodesigns_theme_options' );

function nano_progga_page_display() { ?>
    <div class="wrap">
        <div id="icon-themes" class="icon32"></div>
        <h2><strong>nano</strong>progga - <strong>admin</strong>panel</h2>
        <p class="description">The theme options page for nano progga</p>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
            <?php settings_fields('nanodesigns_theme_display_options'); ?>
            <?php do_settings_sections('nanodesigns_theme_display_options'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
} // end nano_progga_page_display


/**
 * Register the settings
 */

function nanodesigns_initialize_theme_options(){

    if( false == get_option( 'nanodesigns_theme_display_options' ) ) {
        add_option( 'nanodesigns_theme_display_options' );
    } // endif( false == get_option

    add_settings_section(
        'social_section',           // ID/Slug
        'Social Icons',             // Name
        'nanodesigns_social_section_callback',          // Callback
        'nanodesigns_theme_display_options'                   // Page on which to add this section of options
    );

    /*
     * Add the settings FIELDs
     */

    add_settings_field(
        'rss',
        'RSS',
        'nanodesigns_rss_field_callback',
        'nanodesigns_theme_display_options',
        'social_section'
    );

    add_settings_field(
        'facebook',
        'Facebook',
        'nanodesigns_facebook_field_callback',
        'nanodesigns_theme_display_options',
        'social_section'
    );

    add_settings_field(
        'googleplus',
        'Google+',
        'nanodesigns_googleplus_field_callback',
        'nanodesigns_theme_display_options',
        'social_section'
    );

    add_settings_field(
        'twitter',
        'Twitter',
        'nanodesigns_twitter_field_callback',
        'nanodesigns_theme_display_options',
        'social_section'
    );

    add_settings_field(
        'youtube',
        'YouTube',
        'nanodesigns_youtube_field_callback',
        'nanodesigns_theme_display_options',
        'social_section'
    );

    add_settings_field(
        'linkedin',
        'Linked in',
        'nanodesigns_linkedin_field_callback',
        'nanodesigns_theme_display_options',
        'social_section'
    );

    add_settings_field(
        'pinterest',
        'Pinterest',
        'nanodesigns_pinterest_field_callback',
        'nanodesigns_theme_display_options',
        'social_section'
    );

    add_settings_field(
        'flickr',
        'Flickr',
        'nanodesigns_flickr_field_callback',
        'nanodesigns_theme_display_options',
        'social_section'
    );

    add_settings_field(
        'tumblr',
        'Tumblr',
        'nanodesigns_tumblr_field_callback',
        'nanodesigns_theme_display_options',
        'social_section'
    );

    register_setting(
        'nanodesigns_theme_display_options',
        'nanodesigns_theme_display_options',
        'nanodesigns_theme_sanitize_social'
    );

}

add_action( 'admin_init', 'nanodesigns_initialize_theme_options' );

// SECTION CALLBACK
function nanodesigns_social_section_callback() {
    echo '<p>Fill the fields with proper URL of your Social links:</p>';
    echo '<p><strong>NOTE:</strong> if any of the field is field here under, the "Social Bar" will be visible at the bottom of the page at the front-end.</p>';
}

// FIELD CALLBACK

//RSS
function nanodesigns_rss_field_callback( $args ) {
    $options = get_option('nanodesigns_theme_display_options');

    $url = '';
    if( isset( $options['rss'] ) ) {
        $url = $options['rss'];
    } // end if

    echo '<input type="text" id="rss" name="nanodesigns_theme_display_options[rss]" value="' . $options['rss'] . '" />';
}

//facebook
function nanodesigns_facebook_field_callback( $args ) {
    $options = get_option('nanodesigns_theme_display_options');

    $url = '';
    if( isset( $options['facebook'] ) ) {
        $url = $options['facebook'];
    } // end if

    echo '<input type="text" id="facebook" name="nanodesigns_theme_display_options[facebook]" value="' . $options['facebook'] . '" />';
}

//googleplus
function nanodesigns_googleplus_field_callback( $args ) {
    $options = get_option('nanodesigns_theme_display_options');

    $url = '';
    if( isset( $options['googleplus'] ) ) {
        $url = $options['googleplus'];
    } // end if

    echo '<input type="text" id="googleplus" name="nanodesigns_theme_display_options[googleplus]" value="' . $options['googleplus'] . '" />';
}

//twitter
function nanodesigns_twitter_field_callback( $args ) {
    $options = get_option('nanodesigns_theme_display_options');

    $url = '';
    if( isset( $options['twitter'] ) ) {
        $url = $options['twitter'];
    } // end if

    echo '<input type="text" id="twitter" name="nanodesigns_theme_display_options[twitter]" value="' . $options['twitter'] . '" />';
}

//youtube
function nanodesigns_youtube_field_callback( $args ) {
    $options = get_option('nanodesigns_theme_display_options');

    $url = '';
    if( isset( $options['youtube'] ) ) {
        $url = $options['youtube'];
    } // end if

    echo '<input type="text" id="youtube" name="nanodesigns_theme_display_options[youtube]" value="' . $options['youtube'] . '" />';
}

//linkedin
function nanodesigns_linkedin_field_callback( $args ) {
    $options = get_option('nanodesigns_theme_display_options');

    $url = '';
    if( isset( $options['linkedin'] ) ) {
        $url = $options['linkedin'];
    } // end if

    echo '<input type="text" id="linkedin" name="nanodesigns_theme_display_options[linkedin]" value="' . $options['linkedin'] . '" />';
}

//pinterest
function nanodesigns_pinterest_field_callback( $args ) {
    $options = get_option('nanodesigns_theme_display_options');

    $url = '';
    if( isset( $options['pinterest'] ) ) {
        $url = $options['pinterest'];
    } // end if

    echo '<input type="text" id="pinterest" name="nanodesigns_theme_display_options[pinterest]" value="' . $options['pinterest'] . '" />';
}

//flickr
function nanodesigns_flickr_field_callback( $args ) {
    $options = get_option('nanodesigns_theme_display_options');

    $url = '';
    if( isset( $options['flickr'] ) ) {
        $url = $options['flickr'];
    } // end if

    echo '<input type="text" id="flickr" name="nanodesigns_theme_display_options[flickr]" value="' . $options['flickr'] . '" />';
}

//tumblr
function nanodesigns_tumblr_field_callback( $args ) {
    $options = get_option('nanodesigns_theme_display_options');

    $url = '';
    if( isset( $options['tumblr'] ) ) {
        $url = $options['tumblr'];
    } // end if

    echo '<input type="text" id="tumblr" name="nanodesigns_theme_display_options[tumblr]" value="' . $options['tumblr'] . '" />';
}


/*
 * Sanitize the input
 */
function nanodesigns_theme_sanitize_social( $input ) {
    $output = array();

    foreach( $input as $key => $val ) {

        if( isset ( $input[$key] ) ) {
            $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
        }

    } // end foreach

    return apply_filters( 'nanodesigns_theme_sanitize_social', $output, $input );
}