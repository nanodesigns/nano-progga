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
 * @see  nano_enqueue_db_queries()
 * @param  array $array
 * @return string
 */
function nano_dump( $array ) {
    echo '<pre style="z-index:9999999999; position: relative;">';
        print_r( $array );
    echo '</pre><br>';
}

/**
 * JETPACK UNNECESSARY SCRIPT LOAD STOPPER
 */
function nano_dequeue_devicepx() {
	wp_dequeue_script( 'devicepx' );
}
add_action( 'wp_enqueue_scripts', 'nano_dequeue_devicepx', 20 );

/**
 * db QUERIES
 * Prerequisite: define('SAVEQUERIES', true)
 * @uses nano_dump()
 * @return void
 */
function nano_enqueue_db_queries() {
	if ( current_user_can( 'administrator' ) ){
		echo '<h2>'. __('Database Queries') .'</h2>';
		global $wpdb;
		nano_dump( $wpdb->queries );
	}	
}
//add_action( 'wp_footer', 'nano_enqueue_db_queries' );