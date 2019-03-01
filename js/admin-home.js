$(document).ready(function(){
  $('#announ-desc').wysiwyg();
  $('#work-desc').wysiwyg();
  $('#search-user').keyup(function(){
    var txt = $(this).val();
    if(txt != '')
    {
      $('#user-list-section').load('php/search-user.php', {
        txt: txt
      });
    }
    else{
      $('#user-list-section').html('');
    }
  });
  $('#add-work-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to add this event?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var title = $('#work-title').val();
          var description = $('#work-desc').cleanHtml();
          var location = $('#work-loc').val();
          var start_date = $('#work-start-date').val();
          var start_time = $('#work-start-time').val() + ':00';
          var end_date = $('#work-end-date').val();
          var end_time = $('#work-end-time').val() + ':00';

          var med = $('#add-work-med');
          var it = $('#add-work-it');
          var bus = $('#add-work-bus');
          var health = $('#add-work-health');
          var food = $('#add-work-food');
          var hosp = $('#add-work-hosp');
          var cul = $('#add-work-cul');

          var submit = $('#submit-workshop').val();

          $('.form-message').load('php/add-workshop.php', {
            title: title,
            description: description,
            location: location,
            start_date: start_date,
            start_time: start_time,
            end_date: end_date,
            end_time: end_time,
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
  $(document).on('click','.rem-event-btn',function(){
    var x = 'Are you sure you want to remove this event?'
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
            url: 'php/remove-event.php',
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
  $('#add-announ-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to add this announcement?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var title = $('#announ-title').val();
          var description = $('#announ-desc').cleanHtml();
          var submit = $('#submit-announ').val();
          $('.form-message').load('php/add-announ.php', {
            title: title,
            description: description,
            submit: submit
          });
        }
      }
    });
  });
  $(document).on('click','.rem-announ-btn',function(){
    var x = 'Are you sure you want to remove this announcement?'
    var ID = $(this).attr('id');
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          $('#announ'+ID).hide();
          $.ajax({
            type: 'POST',
            url: 'php/remove-announ.php',
            data: {
              ID: ID
            },
            success: function(html){
              $('#announ'+ID).remove();
            }
          });
        }
      }
    });
  });
  $('#timesheet-form').submit(function(event){
    event.preventDefault();
    var formData = new FormData(this);
    var x = 'Are you sure you want to upload this timesheet?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          $.ajax({
            url: 'php/upload-timesheet.php', // Url to which the request is send
            type: 'POST',                 // Type of request to be send, called as method
            data: formData,               // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,           // The content type used when sending data to the server.
            cache: false,                 // To unable request pages to be cached
            processData:false,            // To send DOMDocument or non processed data file it is set to false
            success(response){
              switch(response){
                case '1':
                $('#timesheetToUpload').addClass('input-error');
                $('#timesheet-msg').html('<span class="form-error">Invalid parameters.</span>');
                break;
                case '2':
                $('#timesheetToUpload').addClass('input-error');
                $('#timesheet-msg').html('<span class="form-error">No file sent.</span>');
                break;
                case '3':
                $('#timesheetToUpload').addClass('input-error');
                $('#timesheet-msg').html('<span class="form-error">Exceeded filesize limit.</span>');
                break;
                case '4':
                $('#timesheetToUpload').addClass('input-error');
                $('#timesheet-msg').html('<span class="form-error">Unknown errors.</span>');
                break;
                case '5':
                $('#timesheetToUpload').addClass('input-error');
                $('#timesheet-msg').html('<span class="form-error">Invalid file format.</span>');
                break;
                case '6':
                window.location.reload();
                break;
              }
            }
          });
        }
      }
    });
  });
  $(document).on('click','.rem-time-btn',function(){
    var x = 'Are you sure you want to remove this timesheet?'
    var ID = $(this).attr('id');
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          $('#time'+ID).hide();
          $.ajax({
            type: 'POST',
            url: 'php/remove-time.php',
            data: {
              ID: ID
            },
            success: function(html){
              $('#time'+ID).remove();
            }
          });
        }
      }
    });
  });
  $(document).on('click','.mod-work-btn',function(){
    $('#change-info').hide();
    $('#add-work').hide();
    $('#add-announ').hide();
    $('#user-list').hide();
    $('#timesheet-list').hide();
    $('#mod-event-list').show();
  });
  $(document).on('click','.add-work-btn',function(){
    $('#change-info').hide();
    $('#mod-event-list').hide();
    $('#add-announ').hide();
    $('#user-list').hide();
    $('#timesheet-list').hide();
    $('#add-work').show();
  });
  $(document).on('click','.user-btn',function(){
    $('#change-info').hide();
    $('#mod-event-list').hide();
    $('#add-announ').hide();
    $('#add-work').hide();
    $('#timesheet-list').hide();
    $('#user-list').show();
  });
  $(document).on('click','.add-announ-btn',function(){
    $('#change-info').hide();
    $('#mod-event-list').hide();
    $('#add-work').hide();
    $('#user-list').hide();
    $('#timesheet-list').hide();
    $('#add-announ').show();
  });
  $(document).on('click','.timesheet-btn',function(){
    $('#mod-event-list').hide();
    $('#add-work').hide();
    $('#add-announ').hide();
    $('#user-list').hide();
    $('#change-info').hide();
    $('#timesheet-list').show();
  });
  $(document).on('click','.change-btn',function(){
    $('#mod-event-list').hide();
    $('#add-work').hide();
    $('#add-announ').hide();
    $('#user-list').hide();
    $('#timesheet-list').hide();
    $('#change-info').show();
  });
  $(document).on('click','.change-pw-btn',function(){
    $('#change-phone').hide();
    $('#change-email').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-pw').show();
  });
  $(document).on('click','.change-phone-btn',function(){
    $('#change-email').hide();
    $('#change-pw').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-phone').show();
  });
  $(document).on('click','.change-email-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-email').show();
  });
  $(document).on('click','.upload-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#change-sector-section').hide();
    $('#upload-section').show();
  });
  $(document).on('click','.change-sector-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#upload-section').hide();
    $('#change-sector-section').show();
  });
  $('#drop-selector').on('change',function(){
    var selection = $(this).val();
    switch(selection)
    {
      case 'mod':
      $('#change-info').hide();
      $('#add-work').hide();
      $('#add-announ').hide();
      $('#user-list').hide();
      $('#timesheet-list').hide();
      $('#mod-event-list').show();
      break;
      case 'add-work':
      $('#change-info').hide();
      $('#mod-event-list').hide();
      $('#add-announ').hide();
      $('#user-list').hide();
      $('#timesheet-list').hide();
      $('#add-work').show();
      break;
      case 'user-list':
      $('#change-info').hide();
      $('#mod-event-list').hide();
      $('#add-announ').hide();
      $('#add-work').hide();
      $('#timesheet-list').hide();
      $('#user-list').show();
      break;
      case 'add-announ':
      $('#change-info').hide();
      $('#mod-event-list').hide();
      $('#add-work').hide();
      $('#user-list').hide();
      $('#timesheet-list').hide();
      $('#add-announ').show();
      break;
      case 'update-acc':
      $('#mod-event-list').hide();
      $('#add-work').hide();
      $('#add-announ').hide();
      $('#user-list').hide();
      $('#timesheet-list').hide();
      $('#change-info').show();
      break;
      case 'timesheet':
      $('#mod-event-list').hide();
      $('#add-work').hide();
      $('#add-announ').hide();
      $('#user-list').hide();
      $('#change-info').hide();
      $('#timesheet-list').show();
      break;
      default:
      break;
    }
  });
});
