jQuery(function($){
    $('#tc-clear-button').on('click', function(){
        $.ajax({
            type: 'POST',
            url: TC.ajax,
            data: {
              action: 'clear_table',
            },
            success: function(response) {
                location.reload();
            }
          });
    });

    
});