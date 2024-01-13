<?php 

    // Access the global $post variable
    global $post;

    if ($post) {
        // Get the post slug
        $current_slug = $post->post_name;
    }

    if( isset( $_POST['tc_submit'] ) ) {

        $tc_month       = $_POST['tc_month'] ?? '';
        $tc_start_date  = $_POST['tc_start_date'] ?? '';
        $tc_end_date    = $_POST['tc_end_date'] ?? '';
        $tc_depart      = $_POST['tc_depart'] ?? '';
        $tc_program     = $_POST['tc_program'] ?? '';
        $tc_number      = $_POST['tc_number'] ?? '';
        $tc_attendance  = $_POST['tc_attendance'] ?? '';

        if( ! in_array( '', [ $tc_month, $tc_start_date, $tc_end_date, $tc_depart, $tc_program, $tc_number, $tc_attendance ] ) ) {
            global $wpdb;

            $table_name = TR_CRUD_TABLE;

            $data_to_insert = array(
                'tc_month'      => $tc_month,
                'tc_start_date' => $tc_start_date,
                'tc_end_date'   => $tc_end_date,
                'tc_depart'     => $tc_depart,
                'tc_program'    => $tc_program,
                'tc_number'     => $tc_number,
                'tc_attendance' => $tc_attendance,
            );

            // Insert data into the table
            $result = $wpdb->insert( $table_name, $data_to_insert );

            if( $result == true ) {

                printf( '<script>window.location.href="%s";</script>', site_url( $current_slug ) );
            }
        }
    }
?>

<form method="POST">
    <p>
        <label for="tc_month">Month:</label>
        <select id="tc_month" name="tc_month" required>
            <option value="" disabled selected>Select Month</option>
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
        </select>
    </p>
    
    <p>
        <label for="tc_start_date">Start Date: </label>
        <input type="date" value="06/12/2023" class="tc-date-format" name="tc_start_date" id="tc_start_date" required>
    </p>

    <p>
        <label for="tc_end_date">Start Date: </label>
        <input type="date" name="tc_end_date" class="tc-date-format" id="tc_end_date" required>
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
        <input type="text" name="tc_number" id="tc_number" required>
    </p>

    <p>
        <label for="tc_attendance">Attendance:</label>
        <input type="text" name="tc_attendance" id="tc_attendance">
    </p>

    <br><br>

    <p>
        <button type="submit" name="tc_submit">Add</button>
    </p>
  
</form>