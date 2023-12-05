<?php 

namespace Habib\TrainingCrud\App;

/**
 * Shortcode class
 */
class Shortcode {

    /**
     * Class constructor
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
        add_shortcode( 'tc_crud', [$this, 'tc_crud'] );
        add_shortcode( 'tc_view', [$this, 'tc_view'] );
        add_action( 'wp_ajax_clear_table', [$this, 'clear_table'] );
    }

    /**
     * Clear Table
     */
    public function clear_table() {
        global $wpdb;

        $table_name = TR_CRUD_TABLE;

        $sql = "TRUNCATE TABLE $table_name";

        if( $wpdb->query( $sql ) ) {
            wp_send_json_success();
        }

    }

    /**
     * Main CRUD shortcode
     */
    public function tc_crud() {
        if( is_user_logged_in() ) {
            include_once( TR_CRUD_DIR . "/views/crud/crud-form.php" );
        }
    }

    /**
     * View Table
     */
    public function tc_view() {
        if( is_user_logged_in() ) {
            include_once( TR_CRUD_DIR . "/views/table/main-table.php" );
        }
    }

    /**
     * Load all assets
     */
    public function enqueue_scripts() {

        //Only for front
        if( ! is_admin() ) {
            
            wp_enqueue_style( 'front-css', TR_CRUD_ASSET . '/front/css/front.css', [], time(), 'all'  );
            wp_enqueue_script( 'front-js', TR_CRUD_ASSET . '/front/js/front.js', ['jquery'], time(), true );

            $ajax_url = admin_url( 'admin-ajax.php' );
            wp_localize_script( 'front-js', 'TC', array( 'ajax' => $ajax_url ) );
        }
    }
}