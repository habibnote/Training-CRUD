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
    }

    /**
     * Main CRUD shortcode
     */
    public function tc_crud() {
        
        include_once( TR_CRUD_DIR . "/views/crud/crud-form.php" );
    }

    /**
     * Load all assets
     */
    public function enqueue_scripts() {

        //Only for front
        if( ! is_admin() ) {
            
            wp_enqueue_style( 'front-css', TR_CRUD_ASSET . '/front/css/front.css', [], time(), 'all'  );
            wp_enqueue_script( 'front-js', TR_CRUD_ASSET . '/front/js/front.js', ['jquery'], time(), true );
        }
    }
}