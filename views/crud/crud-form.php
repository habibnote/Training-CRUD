<?php
    // Access the global $post variable
    global $post;

    if ($post) {
        // Get the post slug
        $current_slug = $post->post_name;

        $add_new_url    = add_query_arg( 'tc_task', 'add', site_url( $current_slug ) );
    }

    $tc_task = $_GET['tc_task'] ?? '';

?>
<div class="tc-admin-container">
    <h2><?php printf( "%s %s", esc_html__( 'Year' ), date("Y") ); ?></h2>
    <div class="tc-admin-table-warpper">

        <p class="tc-addnew"><a href="<?php echo esc_url( $add_new_url ); ?>"><?php esc_html_e( 'Add New Item' ); ?></a></p>
        <?php 
            if( isset( $tc_task ) && 'add' == $tc_task ) {
                
                ob_start();
                include_once( TR_CRUD_DIR . "/views/form/add-new.php" );
                ob_end_flush();

            }else{
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Department</th>
                            <th>Program</th>
                            <th>Max no. of participants</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            global $wpdb;
                            $table_name = TR_CRUD_TABLE;
                            // SQL query to select all data from the table
                            $query = "SELECT * FROM $table_name";

                            // Retrieve data from the table
                            $results = $wpdb->get_results( $query );

                            // Check if there are results
                            if ( $results ) {
                                foreach ( $results as $row ) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php esc_html_e( $row->tc_month ); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e( $row->tc_start_date ); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e( $row->tc_end_date ); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e( $row->tc_depart ); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e( $row->tc_program ); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e( $row->tc_number ); ?>
                                        </td>
                                        <td>
                                            <?php 
                                                printf( 
                                                    '<a href="%s">%s</a>',
                                                    add_query_arg( ['tc_task' => 'edit', 'id' => $row->id ], site_url( $current_slug ) ),
                                                    esc_html__( 'Edit' )
                                                ); 
                                            ?>
                                             |
                                            <?php 
                                                printf( 
                                                '<a href="%s">%s</a>',
                                                    add_query_arg( ['tc_task' => 'update', 'id' => $row->id ], site_url( $current_slug ) ),
                                                    esc_html__( 'Update' )
                                                );
                                            ?>
                                            |
                                            <?php 
                                                printf( 
                                                    '<a href="%s">%s</a>',
                                                        add_query_arg( ['tc_task' => 'delete', 'id' => $row->id ], site_url( $current_slug ) ),
                                                        esc_html__( 'Delete' )
                                                );
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <?php
            }
        ?>
    </div>
</div>