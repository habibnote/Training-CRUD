<?php 

/**
 * Check is table exist or not
 */
if( ! function_exists( 'is_table_exists' ) ) {

    function is_table_exists( $table_name ) {
        global $wpdb;
        $sql = "SHOW TABLES LIKE %s";
        $table_exists = $wpdb->get_var( $wpdb->prepare( $sql, $table_name ) );
    
        return $table_exists;
    }
}