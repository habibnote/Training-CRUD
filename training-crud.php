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
    function __construct() {
        
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