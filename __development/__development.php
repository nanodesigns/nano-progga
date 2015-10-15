<?php
/**
 * DEVELOPER HELPER FUNCTIONS.
 * Used only when development.
 * Must Turn off when live.
 *
 * @author  Mayeenul Islam <wz.islam@gmail.com>
 */

/**
 * CUSTOM var_dump()
 * @param  array $array
 * @return string
 * --------------------------------------------------------------------------
 */
function nano_dump( $array ) {
    echo '<pre>';
        print_r( $array );
    echo '</pre><br>';
}

/**
 * Jetpack unnecessary script load stopper
 * --------------------------------------------------------------------------
 */
function nano_dequeue_devicepx() {
	wp_dequeue_script( 'devicepx' );
}
add_action( 'wp_enqueue_scripts', 'nano_dequeue_devicepx', 20 );

/**
 * db QUERIES
 * Prerequisite: define('SAVEQUERIES', true)
 * --------------------------------------------------------------------------
 */
function nano_enqueue_db_queries() {
	global $wpdb;
	echo '<h2>Database Last Query</h2>';
		echo $wpdb->last_query;
	echo '<hr>';
	echo '<h2>Database Queries</h2>';
		nano_dump( $wpdb->queries );
}
if( current_user_can( 'administrator' ) )
	add_action( 'wp_footer', 'nano_enqueue_db_queries' );