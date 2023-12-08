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
      $('.tc-popup').show();
    });

    $('#okButton').on('click', function(){
      let currentUrl = window.location.href;
      let pageID     = $('.tc-delete').attr('row-id');
      window.location.href = currentUrl+'?tc_task=delete&id='+pageID;
    });

    $('#CancelButton').on('click', function(){
      $('.tc-popup').hide();
    });
});