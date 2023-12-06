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

        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );
        add_action( 'admin_menu' , [$this, 'add_menuPage'] );
    }

    /**
     * Admin script
     */
    public function admin_enqueue_scripts() {
        wp_enqueue_style( 'admin-css', TR_CRUD_ASSET . '/admin/css/admin.css', [], time(), 'all'  );
        wp_enqueue_script( 'admin-js', TR_CRUD_ASSET . '/admin/js/admin.js', ['jquery'], time(), true );

        $ajax_url = admin_url( 'admin-ajax.php' );
        wp_localize_script( 'admin-js', 'TC_ADMIN', array( 'ajax' => $ajax_url ) );
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