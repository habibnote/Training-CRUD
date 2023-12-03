<?php 

namespace Habib\TrainingCrud\App;

/**
 * Activate class
 */
class Activate {

    /**
     * Class contructor
     */
    public function __construct() {
        register_activation_hook( TR_CRUD, [$this, 'activate'] );
    }

    /**
     * this function run when plugin is activate
     */
    public function activate() {
        global $wpdb;

        //table name
        $table_name = TR_CRUD_TABLE;
        
        // Get the default character set and collation for the database
        $charset_collate = $wpdb->get_charset_collate();

        /**
         * Check table already exist or not
         */
        if( ! is_table_exists( $table_name ) ) {

            // Define the table structure
            $sql = "CREATE TABLE $table_name (
                id INT NOT NULL AUTO_INCREMENT,
                tc_month VARCHAR(255) NOT NULL,
                tc_start_date VARCHAR(255) NOT NULL,
                tc_end_date VARCHAR(255) NOT NULL,
                tc_depart VARCHAR(255) NOT NULL,
                tc_program VARCHAR(255) NOT NULL,
                tc_number VARCHAR(255) NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            // Include the upgrade file for dbDelta
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

            // Run dbDelta
            dbDelta($sql);
        }
    }
}