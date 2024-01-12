<?php 

    // Access the global $post variable
    global $post;
    global $wpdb;
    $table_name = TR_CRUD_TABLE;

    $tc_task    = $_GET['tc_task'] ?? '';
    $tc_id      = $_GET['id'] ?? '';

    if ($post) {
        // Get the post slug
        $current_slug = $post->post_name;
    }

    if( isset( $_POST['tc_update'] )  ) {

        $tc_month       = $_POST['tc_month'] ?? '';
        $tc_start_date  = $_POST['tc_start_date'] ?? '';
        $tc_end_date    = $_POST['tc_end_date'] ?? '';
        $tc_depart      = $_POST['tc_depart'] ?? '';
        $tc_program     = $_POST['tc_program'] ?? '';
        $tc_number      = $_POST['tc_number'] ?? '';
        $tc_attendance  = $_POST['tc_attendance'] ?? '';

        if( ! in_array( '', [ $tc_month, $tc_start_date, $tc_end_date, $tc_depart, $tc_program, $tc_number ] ) ) {
            global $wpdb;

            $table_name = TR_CRUD_TABLE;

            $tc_update_data = array(
                'tc_month'      => $tc_month,
                'tc_start_date' => $tc_start_date,
                'tc_end_date'   => $tc_end_date,
                'tc_depart'     => $tc_depart,
                'tc_program'    => $tc_program,
                'tc_number'     => $tc_number,
                'tc_attendance' => $tc_attendance,
            );

            $tc_where = array(
                'ID' => $tc_id
            );

            // Update data into the table
            $result = $wpdb->update( $table_name, $tc_update_data, $tc_where);

            if( $result == true ) {

                printf( '<script>window.location.href="%s";</script>', site_url( $current_slug ) );
            }
        }
    }


    if( 'update' == $tc_task && isset( $_GET['id'] ) && $tc_id != '' ) {

        $query = $wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d",
            $tc_id
        );

        $row            = $wpdb->get_row( $query );
        $saved_month    = $row->tc_month;
        ?>

            <form method="POST">
                <p>

                    <label for="tc_month">Month:</label>
                    <select id="tc_month" name="tc_month" required>
                        <option value="" disabled selected>Select Month</option>
                        <option value="January" <?php esc_attr_e( month_exists( 'January', $saved_month ) ); ?> >January</option>
                        <option value="February" <?php esc_attr_e( month_exists( 'February', $saved_month ) ); ?> >February</option>
                        <option value="March" <?php esc_attr_e( month_exists( 'March', $saved_month ) ); ?> >March</option>
                        <option value="April" <?php esc_attr_e( month_exists( 'April', $saved_month ) ); ?> >April</option>
                        <option value="May" <?php esc_attr_e( month_exists( 'May', $saved_month ) ); ?> >May</option>
                        <option value="June" <?php esc_attr_e( month_exists( 'June', $saved_month ) ); ?> >June</option>
                        <option value="July" <?php esc_attr_e( month_exists( 'July', $saved_month ) ); ?> >July</option>
                        <option value="August" <?php esc_attr_e( month_exists( 'August', $saved_month ) ); ?> >August</option>
                        <option value="September" <?php esc_attr_e( month_exists( 'September', $saved_month ) ); ?> >September</option>
                        <option value="October" <?php esc_attr_e( month_exists( 'October', $saved_month ) ); ?> >October</option>
                        <option value="November" <?php esc_attr_e( month_exists( 'November', $saved_month ) ); ?> >November</option>
                        <option value="December" <?php esc_attr_e( month_exists( 'December', $saved_month ) ); ?> >December</option>
                    </select>
                </p>
                
                <p>
                    <label for="tc_start_date">Start Date: </label>
                    <input type="date" value="<?php esc_html_e( $row->tc_start_date ); ?>" name="tc_start_date" id="tc_start_date" required>
                </p>

                <p>
                    <label for="tc_end_date">Start Date: </label>
                    <input type="date" value="<?php esc_html_e( $row->tc_end_date ); ?>" name="tc_end_date" id="tc_end_date" required>
                </p>

                <p>
                    <label for="tc_depart">Department:</label>
                    <select name="tc_depart" id="tc_depart" required>
                        <?php 
                            $tc_depart_setting = get_option( 'tc_depart_setting' );
                            $depart_array = explode( "\n", $tc_depart_setting );
                            foreach( $depart_array as $value ) {
                                printf( "<option value='%s'>%s</option>", $value, $value); 
                            }
                        ?>
                    </select>
                </p>

                <p>
                    <label for="tc_program">Program:</label>
                    <select name="tc_program" id="tc_program" required>
                        <?php 
                            $tc_program_setting = get_option( 'tc_program_setting' );
                            $program_array = explode( "\n", $tc_program_setting );
                            foreach( $program_array as $value ) {
                                printf( "<option value='%s'>%s</option>", $value, $value); 
                            }
                        ?>
                    </select>
                </p>

                <p>
                    <label for="tc_number">Max no. of participants:</label>
                    <input type="text" value="<?php esc_html_e( $row->tc_number ); ?>" name="tc_number" id="tc_number" required>
                </p>

                <p>
                    <label for="tc_attendance">Attendance:</label>
                    <input type="text" value="<?php esc_html_e( $row->tc_attendance ); ?>" name="tc_attendance" id="tc_attendance" required>
                </p>

                <br><br>

                <p>
                    <button type="submit" name="tc_update"><?php esc_html_e( 'Update' ); ?></button>
                </p>
            
            </form>
        <?php
    }
?>



