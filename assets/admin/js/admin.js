jQuery(function($){
    $('#tc_admin_save_button').on('click', function(){
        
        $tc_admin_department = $('#tc_admin_department').val();
        $tc_admin_program    = $('#tc_admin_program').val();

        if( $tc_admin_department == '' && $tc_admin_program == '' ) {
            alert("Field not be empty");
        }else{
            $.ajax({
                type: 'POST',
                url: TC.ajax,
                data: {
                    action: 'tc_update_setting',
                    depart: $tc_admin_department,
                    program: $tc_admin_program, 
                },
                success: function(response) {
                    console.log( response );
                }
            });
        }
    });
});