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

    //delete alert
    $('.tc-delete').on('click', function(event){
      event.preventDefault(); 
      
    });

    
});