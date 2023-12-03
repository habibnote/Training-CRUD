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
                        <tr>
                            <td>Month</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Department</td>
                            <td>Program</td>
                            <td>Max no. of participants</td>
                            <td>
                                <a href="#">Edit</a> |
                                <a href="#">Update</a> |
                                <a href="#">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
        ?>
    </div>
</div>