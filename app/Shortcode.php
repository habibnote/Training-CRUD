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
        add_shortcode( 'tc_crud', [$this, 'tc_crud'] );
    }

    /**
     * Main CRUD shortcode
     */
    public function tc_crud() {
        
        include_once( TR_CRUD_DIR . "/views/crud/crud-form.php" );
    }


}