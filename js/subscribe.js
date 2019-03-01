$(document).ready(function(){
  $(document).on('click','.event-btn',function(){
    var x = 'Are you sure you want to subscribe?'
    var ID = $(this).attr('id');
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          $('#event'+ID).hide();
          $.ajax({
            type: 'POST',
            url: 'php/subscribe.php',
            data: {
              ID: ID
            },
            success: function(response){
              if(response == 'error100')
              {
                bootbox.alert({
                  size: 'small',
                  message: 'You are already subscribed for this workshop.'
                });
              }
              else
              {
                $('#event'+ID).remove();
                bootbox.alert({
                  size: 'small',
                  message: 'You have subscribed for this workshop.'
                });
              }
            }
          });
        }
      }
    });
  });
  $(document).on('click','.sub-event-btn',function(){
    var x = 'Are you sure you want to un-subscribe?'
    var ID = $(this).attr('id');
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          $('#event'+ID).hide();
          $.ajax({
            type: 'POST',
            url: 'php/unsubscribe.php',
            data: {
              ID: ID
            },
            success: function(html){
              $('#event'+ID).remove();
            }
          });
        }
      }
    });
  });
});
