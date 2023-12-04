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

/**
 * check which month is selected
 */
if( ! function_exists( 'month_exists' ) ) {

    function month_exists( $current_month, $saved_month ) {

        if( $current_month == $saved_month ) {
            return 'selected';
        }
    }
}