<?php 
/*
 * Plugin Name:       Training CRUD
 * Plugin URI:        https://github.com/habibnote/political-corruption
 * Description:       
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Md. Habib
 * Author URI:        https://me.habibnote.com
 * Text Domain:       tr-crud
*/

namespace Habib\TrainingCrud;

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Plugin Main Class
 */
final class Training_CRUD {
    static $instance = false;

    /**
     * Class Constructor
     */
    private function __construct() {

        $this->include();
        $this->define();
        $this->hooks();
    }

    /**
     * Include all needed files
     */
    private function include() {
        require_once( dirname( __FILE__ ) . '/inc/functions.php' );
        require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
    }

    /**
     * define all constant
     */
    private function define() {
        global $wpdb;
        define( 'TR_CRUD', __FILE__ );
        define( 'TR_CRUD_DIR', dirname( TR_CRUD ) );
        define( 'TR_CRUD_ASSET', plugins_url( 'assets', TR_CRUD ) );
        define( 'TR_CRUD_TABLE', $wpdb->prefix . 'tc_habib' );
    }

    /**
     * All hooks
     */
    private function hooks() {
        new App\Shortcode();
        new App\Activate();
    }


    /**
     * Singleton Instance
    */
    static function get_tr_crud() {
        
        if( ! self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

/**
 * Cick off the plugins 
 */
Training_CRUD::get_tr_crud();