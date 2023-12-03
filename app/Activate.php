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
        
    }
}