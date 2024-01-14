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
                foreach( $results as $result ) {
                    $all_month[] = $result->tc_month;
                }

                // Define a custom comparison function
                function crudCompareMonths( $a, $b ) {
                    $monthsOrder = array(
                        "January" => 1,
                        "February" => 2,
                        "March" => 3,
                        "April" => 4,
                        "May" => 5,
                        "June" => 6,
                        "July" => 7,
                        "August" => 8,
                        "September" => 9,
                        "October" => 10,
                        "November" => 11,
                        "December" => 12
                    );

                    return $monthsOrder[$a] - $monthsOrder[$b];
                }

                usort( $all_month, 'crudCompareMonths' );
                $all_month = array_unique( $all_month );

                if( $all_month ) {
                    foreach( $all_month as $month ) {

                        $query = $wpdb->prepare(
                            "SELECT * FROM $table_name WHERE tc_month = %s",
                            $month
                        );
                        
                        $same_res = $wpdb->get_results( $query, OBJECT );
                        if( $same_res ) {
                            $i = 0;
                            foreach( $same_res as $row ) {
                                $i++;
                                ?>
                                    <tr>
                                        <td><?php esc_html_e( $row->id . '.' );?></td>
                                        <?php 
                                            if( $i == 1 ) {
                                                ?>
                                                    <td class="cr-rowspan" >
                                                        <?php 
                                                            esc_html_e( $row->tc_month );
                                                            printf( "<p>%s<p>",date("Y") );
                                                        ?>
                                                    </td>
                                                <?php
                                            }else{
                                                printf( '<script>jQuery(".cr-rowspan").attr("rowspan", %s)</script>', $i );
                                            }
                                        ?>
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
                            }
                        }
                        ?>
                        <?php
                    }
                }
            ?>
        </tbody>
    </table>
</div>