$(document).ready(function() {
  var jobRecCount = 2;
  var workRecCount = 2;
  var allEventCount = 2;
  var ownEventCount = 2;
  $('#more-job-rec-button').click(function(){
    jobRecCount += 2;
    $('#job-rec-list-section').load('php/load-job-rec-events.php', {
      jobRecNewCount: jobRecCount
    });
  });
  $(document).on('click','.all-btn',function(){
    $('#all-events-list-section').load('php/load-all-events.php', {
      allEventNewCount: allEventCount
    });
    $('#own-events-list').hide();
    $('#change-info').hide();
    $('#work-rec-list').hide();
    $('#job-rec-list').hide();
    $('#all-events-list').show();
  });
  $(document).on('click','.own-btn',function(){
    $('#own-events-list-section').load('php/load-own-events.php', {
      ownEventNewCount: ownEventCount
    });
    $('#all-events-list').hide();
    $('#change-info').hide();
    $('#work-rec-list').hide();
    $('#job-rec-list').hide();
    $('#own-events-list').show();
  });
  $(document).on('click','.work-rec-btn',function(){
    $('#work-rec-list-section').load('php/load-work-rec-events.php', {
      workRecNewCount: workRecCount
    });
    $('#all-events-list').hide();
    $('#change-info').hide();
    $('#own-events-list').hide();
    $('#job-rec-list').hide();
    $('#work-rec-list').show();
  });
  $(document).on('click','.job-rec-btn',function(){
    $('#job-rec-list-section').load('php/load-job-rec-events.php', {
      jobRecNewCount: jobRecCount
    });
    $('#all-events-list').hide();
    $('#change-info').hide();
    $('#own-events-list').hide();
    $('#work-rec-list').hide();
    $('#job-rec-list').show();
  });
  $(document).on('click','.change-btn',function(){
    $('#all-events-list').hide();
    $('#own-events-list').hide();
    $('#work-rec-list').hide();
    $('#job-rec-list').hide();
    $('#change-info').show();
  });
  $(document).on('click','.change-pw-btn',function(){
    $('#change-phone').hide();
    $('#change-email').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-unemp-section').hide();
    $('#change-pw').show();
  });
  $(document).on('click','.change-phone-btn',function(){
    $('#change-email').hide();
    $('#change-pw').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-unemp-section').hide();
    $('#change-phone').show();
  });
  $(document).on('click','.change-email-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-unemp-section').hide();
    $('#change-email').show();
  });
  $(document).on('click','.upload-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#change-sector-section').hide();
    $('#change-unemp-section').hide();
    $('#upload-section').show();
  });
  $(document).on('click','.change-sector-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#upload-section').hide();
    $('#change-unemp-section').hide();
    $('#change-sector-section').show();
  });
  $(document).on('click','.change-unemp-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-unemp-section').show();
  });
  $('#upload-form').submit(function(event){
    event.preventDefault();
    var formData = new FormData(this);
    var x = 'Are you sure you want to upload this resume? (This will override your previous resume.)'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          $.ajax({
            url: 'php/upload-resume.php', // Url to which the request is send
            type: 'POST',                 // Type of request to be send, called as method
            data: formData,               // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,           // The content type used when sending data to the server.
            cache: false,                 // To unable request pages to be cached
            processData:false            // To send DOMDocument or non processed data file it is set to false
          });
        }
      }
    });
  });
  $('#change-unemp-form').submit(function(event){
    event.preventDefault();
    var x = 'Are you sure you want to change your state unemployment number?'
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(result){
        if(result)
        {
          var change_unemp = $('#change-unemp-input').val();
          var change_unemp2 = $('#change-unemp2-input').val();
          var submit = $('#change-unemp-submit').val();
          $('.form-message').load('php/reset-unemp.php', {
            change_unemp: change_unemp,
            change_unemp2: change_unemp2,
            submit: submit
          });
        }
      }
    });
  });
  $('#drop-selector').on('change',function(){
    var selection = $(this).val();
    switch(selection)
    {
      case 'all':
      $('#all-events-list-section').load('php/load-all-events.php', {
        allEventNewCount: allEventCount
      });
      $('#own-events-list').hide();
      $('#change-info').hide();
      $('#work-rec-list').hide();
      $('#job-rec-list').hide();
      $('#all-events-list').show();
      break;
      case 'own-work':
      $('#own-events-list-section').load('php/load-own-events.php', {
        ownEventNewCount: ownEventCount
      });
      $('#all-events-list').hide();
      $('#change-info').hide();
      $('#work-rec-list').hide();
      $('#job-rec-list').hide();
      $('#own-events-list').show();
      break;
      case 'rec-work':
      $('#work-rec-list-section').load('php/load-work-rec-events.php', {
        workRecNewCount: workRecCount
      });
      $('#all-events-list').hide();
      $('#change-info').hide();
      $('#own-events-list').hide();
      $('#job-rec-list').hide();
      $('#work-rec-list').show();
      break;
      case 'rec-job':
      $('#job-rec-list-section').load('php/load-job-rec-events.php', {
        jobRecNewCount: jobRecCount
      });
      $('#all-events-list').hide();
      $('#change-info').hide();
      $('#own-events-list').hide();
      $('#work-rec-list').hide();
      $('#job-rec-list').show();
      break;
      case 'update-acc':
      $('#all-events-list').hide();
      $('#own-events-list').hide();
      $('#work-rec-list').hide();
      $('#job-rec-list').hide();
      $('#change-info').show();
      break;
      default:
      break;
    }
  });
});
