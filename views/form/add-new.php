<?php 

    if( isset( $_POST['tc_submit'] ) ) {

        $tc_month       = $_POST['tc_month'] ?? '';
        $tc_start_date  = $_POST['tc_start_date'] ?? '';
        $tc_end_date    = $_POST['tc_end_date'] ?? '';
        $tc_depart      = $_POST['tc_depart'] ?? '';
        $tc_program     = $_POST['tc_program'] ?? '';
        $tc_number      = $_POST['tc_number'] ?? '';

        if( ! in_array( '', [ $tc_month, $tc_start_date, $tc_end_date, $tc_depart, $tc_program, $tc_number ] ) ) {
            global $wpdb;

            $table_name = TR_CRUD_TABLE;

            $data_to_insert = array(
                'tc_month'      => $tc_month,
                'tc_start_date' => $tc_start_date,
                'tc_end_date'   => $tc_end_date,
                'tc_depart'     => $tc_depart,
                'tc_program'    => $tc_program,
                'tc_number'     => $tc_number,
            );

            // Insert data into the table
            $wpdb->insert( $table_name, $data_to_insert );
        }
    }
?>

<form method="POST">
    <label for="tc_month">Month:</label>
    <select id="tc_month" name="tc_month" required>
        <option value="" disabled selected>Select Month</option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>
    
    <label for="tc_start_date">Start Date: </label>
    <input type="date" name="tc_start_date" id="tc_start_date" required>

    <label for="tc_end_date">Start Date: </label>
    <input type="date" name="tc_end_date" id="tc_end_date" required>

    <label for="tc_depart">Department:</label>
    <input type="text" name="tc_depart" id="tc_depart" required>

    <label for="tc_program">Program:</label>
    <input type="text" name="tc_program" id="tc_program" required>

    <label for="tc_number">Max no. of participants:</label>
    <input type="text" name="tc_number" id="tc_number" required>

    <br><br>

    <button type="submit" name="tc_submit">Add</button>
  
</form>