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
            'CRUD',
            'CRUD',
            'manage_options',
            'traning-crud',
            [$this, 'crud_callback'],
            'dashicons-list-view',
            10
        );
    }

    /**
     * crud menu call back
     */
    public function crud_callback() {
        ?>
            <div class="wrap">
                
            </div>
        <?php
    }

}