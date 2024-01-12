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
        add_shortcode( 'tc_upcomming_course', [$this, 'tc_upcomming'] );
        add_action( 'wp_ajax_clear_table', [$this, 'clear_table'] );
    }

    /**
     * Display all Upcomming Course
     */
    public function tc_upcomming() {
        global $wpdb;
        $table_name = TR_CRUD_TABLE;

        $query = "SELECT * FROM $table_name";

        // Retrieve data from the table
        $results = $wpdb->get_results( $query );

        //get current date
        $currentDate = date('Y-m-d');
        $currentDate = strtotime( $currentDate );

        //get all result length
        $result_length = count( $results );

        //inital a empty array
        $_results = [];

        for( $i = 0; $i < $result_length; $i++ ) {
            if( $currentDate < strtotime( $results[$i]->tc_start_date ) ) {
                $_results[$i] = $results[$i];
            }
        }

        ?>
        <marquee direction="up" scrollamount="3">
        <?php 
            // Check if there are results
            if ( $_results ) {
                foreach ( $_results as $row ) {
                    ?>
                    <ul class="tr-upcomming-lists">
                        <li class="tr-upcomming-list">
                            <?php
                                printf( "<img src='%s' />", TR_CRUD_ASSET . '/img/right_news.png' );
                                esc_html_e( $row->tc_program ); 
                                printf( "<span>( %s : %s )</span>", __( 'Release Date', 'tr-crud' ), $row->tc_start_date );
                            ?>
                        </li>
                    </ul>
                    <?php
                }
            }
        ?>
        </marquee>
        <?php 
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
        include_once( TR_CRUD_DIR . "/views/table/main-table.php" );
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
            wp_localize_script( 'front-js', 'TC', array( 
                'ajax' => $ajax_url,
            ) );
        }
    }
}