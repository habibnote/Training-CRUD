<?php
    
    global $wpdb;
    $table_name = TR_CRUD_TABLE;

    $query = "SELECT * FROM $table_name";

    // Retrieve data from the table
    $results = $wpdb->get_results( $query );
?>

<div class="tc_view_table">
    <table>
        <thead>
            <tr>
                <th rowspan="2">S1 No.</th>
                <th rowspan="2">Month & Year</th>
                <th colspan="2">Date</th>
                <th rowspan="2">No. of Days</th>
                <th rowspan="2">Department</th>
                <th rowspan="2">Title of the Traning/Workshop</th>
                <th rowspan="2">Max. No. Participants</th>
            </tr>
            <tr>
                <th>Form</th>
                <th>To</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $all_month = [];
                if( $results ) {
                    foreach( $results as $row ) {
                        ?>
                        <tr>
                            <td><?php esc_html_e( $row->id . '.' );?></td>
                            <? $all_month[] = $row->tc_month; ?>
                            <td>
                                <?php 
                                    esc_html_e( $row->tc_month );
                                    printf( "<p>%s<p>",date("Y") );
                                ?>
                            </td>
                            <td><?php esc_html_e( $row->tc_start_date );?></td>
                            <td><?php esc_html_e( $row->tc_end_date );?></td>
                            <td> 
                                <?php 
                                    $start_date = $row->tc_start_date;
                                    $end_date   = $row->tc_end_date;

                                    $date1 = new DateTime( $start_date );
                                    $date2 = new DateTime( $end_date );
                
                                    $interval   = $date1->diff( $date2 );
                                    echo $interval->days + 1 . ' days';
                                ?> 
                            </td>
                            <td><?php esc_html_e( $row->tc_depart );?></td>
                            <td><?php esc_html_e( $row->tc_program );?></td>
                            <td><?php esc_html_e( $row->tc_number );?></td>
                        </tr>
                        <?php
                        $temp_month = $row->tc_month;
                    }
                }
            ?>
        </tbody>
    </table>
</div>