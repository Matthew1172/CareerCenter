$(document).ready(function(){
  var workRecCount = 2;
  var allEventCount = 2;
  var ownEventCount = 2;
  var jobCount = 2;
  $('#postJob-description').wysiwyg();
  $('#search-work').keyup(function(){
    var txt = $(this).val();
    if(txt != '')
    {
      $('#user-list-section').load('php/search-user.php', {
        txt: txt
      });
    }
    else{
      //$('#user-list-section').html('');
    }
  });
  $('#postJob-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to post this job?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {

          var title = $('#postJob-title').val();
          var description = $('#postJob-description').cleanHtml();
          var location = $('#postJob-location').val();

          var med = $('#postJob-med');
          var it = $('#postJob-it');
          var bus = $('#postJob-bus');
          var health = $('#postJob-health');
          var food = $('#postJob-food');
          var hosp = $('#postJob-hosp');
          var cul = $('#postJob-cul');

          var submit = $('#submit').val();

          $('.form-message').load('php/add-job.php', {
            title: title,
            description: description,
            location: location,
            med: med.prop('checked'),
            it: it.prop('checked'),
            bus: bus.prop('checked'),
            health: health.prop('checked'),
            food: food.prop('checked'),
            hosp: hosp.prop('checked'),
            cul: cul.prop('checked'),
            submit: submit
          });
        }
      }
    });
  });
  $(document).on('click','.rem-btn',function(){
    var x = 'Are you sure you want to remove this job?'
    var ID = $(this).attr('id');
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          $('#job'+ID).hide();
          $.ajax({
            type: 'POST',
            url: 'php/remove-job.php',
            data: {
              ID: ID
            },
            success: function(html){
              $('#job'+ID).remove();
            }
          });
        }
      }
    });
  });
  $(document).on('click','.all-btn',function(){
    $('#own-events-list').hide();
    $('#change-info').hide();
    $('#job-list').hide();
    $('#post-job').hide();
    $('#work-rec-list').hide();
    $('#all-events-list').show();
  });
  $(document).on('click','.own-btn',function(){
    $('#all-events-list').hide();
    $('#change-info').hide();
    $('#job-list').hide();
    $('#post-job').hide();
    $('#work-rec-list').hide();
    $('#own-events-list').show();
  });
  $(document).on('click','.job-list-btn',function(){
    $('#all-events-list').hide();
    $('#change-info').hide();
    $('#own-events-list').hide();
    $('#post-job').hide();
    $('#work-rec-list').hide();
    $('#job-list').show();
  });
  $(document).on('click','.work-rec-btn',function(){
    $('#all-events-list').hide();
    $('#change-info').hide();
    $('#own-events-list').hide();
    $('#post-job').hide();
    $('#job-list').hide();
    $('#work-rec-list').show();
  });
  $(document).on('click','.post-job-btn',function(){
    $('#all-events-list').hide();
    $('#own-events-list').hide();
    $('#job-list').hide();
    $('#change-info').hide();
    $('#work-rec-list').hide();
    $('#post-job').show();
  });
  $(document).on('click','.change-btn',function(){
    $('#all-events-list').hide();
    $('#own-events-list').hide();
    $('#job-list').hide();
    $('#post-job').hide();
    $('#work-rec-list').hide();
    $('#change-info').show();
  });
  $(document).on('click','.change-pw-btn',function(){
    $('#change-phone').hide();
    $('#change-email').hide();
    $('#change-sector-section').hide();
    $('#change-web').hide();
    $('#change-unemp').hide();
    $('#change-tax').hide();
    $('#change-pw').show();
  });
  $(document).on('click','.change-phone-btn',function(){
    $('#change-email').hide();
    $('#change-pw').hide();
    $('#change-sector-section').hide();
    $('#change-web').hide();
    $('#change-unemp').hide();
    $('#change-tax').hide();
    $('#change-phone').show();
  });
  $(document).on('click','.change-email-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-sector-section').hide();
    $('#change-web').hide();
    $('#change-unemp').hide();
    $('#change-tax').hide();
    $('#change-email').show();
  });
  $(document).on('click','.change-sector-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#change-web').hide();
    $('#change-unemp').hide();
    $('#change-tax').hide();
    $('#change-sector-section').show();
  });
  $(document).on('click','.change-web-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#change-sector-section').hide();
    $('#change-unemp').hide();
    $('#change-tax').hide();
    $('#change-web').show();
  });
  $(document).on('click','.change-tax-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#change-sector-section').hide();
    $('#change-web').hide();
    $('#change-unemp').hide();
    $('#change-tax').show();
  });
  $(document).on('click','.change-unemp-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#change-sector-section').hide();
    $('#change-web').hide();
    $('#change-tax').hide();
    $('#change-unemp').show();
  });
  $('#drop-selector').on('change',function(){
    var selection = $(this).val();
    switch(selection)
    {
      case 'all':
      $('#own-events-list').hide();
      $('#change-info').hide();
      $('#job-list').hide();
      $('#post-job').hide();
      $('#work-rec-list').hide();
      $('#all-events-list').show();
      break;
      case 'own-work':
      $('#all-events-list').hide();
      $('#change-info').hide();
      $('#job-list').hide();
      $('#post-job').hide();
      $('#work-rec-list').hide();
      $('#own-events-list').show();
      break;
      case 'rec-work':
      $('#all-events-list').hide();
      $('#change-info').hide();
      $('#own-events-list').hide();
      $('#post-job').hide();
      $('#job-list').hide();
      $('#work-rec-list').show();
      break;
      case 'own-job':
      $('#all-events-list').hide();
      $('#change-info').hide();
      $('#own-events-list').hide();
      $('#post-job').hide();
      $('#work-rec-list').hide();
      $('#job-list').show();
      break;
      case 'post-job':
      $('#all-events-list').hide();
      $('#own-events-list').hide();
      $('#job-list').hide();
      $('#change-info').hide();
      $('#work-rec-list').hide();
      $('#post-job').show();
      break;
      case 'update-acc':
      $('#all-events-list').hide();
      $('#own-events-list').hide();
      $('#job-list').hide();
      $('#post-job').hide();
      $('#work-rec-list').hide();
      $('#change-info').show();
      break;
      default:
      break;
    }
  });
});
