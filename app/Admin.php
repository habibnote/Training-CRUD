<?php

namespace Habib\TrainingCrud\App;

/**
 * Admin Class
 */
class Admin {

    /**
     * class constructor
     */
    public function __construct() {
        
        add_action( 'admin_menu' , [$this, 'add_menuPage'] );
    }

    /**
     * create menu
     */
    public function add_menuPage() {
        
        add_menu_page(
            'Habib',
            'Habib',
            'manage_options',
            'habib',
            function() {
                echo "Hello";
            }
        );
    }

}