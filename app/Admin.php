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

        add_action( 'wp_ajax_tc_update_setting', [$this, 'admin_ajax'] );

        $ajax_url = admin_url( 'admin-ajax.php' );
        wp_localize_script( 'admin-js', 'TC_ADMIN', array( 'ajax' => $ajax_url ) );
    }

    /**
     * process admin ajax
     */
    public function admin_ajax() {

        $depart     = $_POST['depart'];
        $program    = $_POST['program'];

        update_option( 'tc_depart_setting', $depart );
        update_option( 'tc_program_setting', $program );

        wp_send_json_success();
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
                <h1>Settings</h1>
                <hr>
                <br>
                <label for="tc_admin_department">Enter Departments:</label>
                <br>
                <textarea id="tc_admin_department" cols="30" rows="10"></textarea>
                <br><br>
                <label for="tc_admin_program">Enter Programs:</label>
                <br>
                <textarea id="tc_admin_program" cols="30" rows="10"></textarea>
                <br><br>
                <button class="button button-primary" type="button" id="tc_admin_save_button">Save</button>
            </div>
        <?php
    }

}