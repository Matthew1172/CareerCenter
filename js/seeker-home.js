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
    $('#change-stateNum-section').hide();
    $('#change-pw').show();
  });
  $(document).on('click','.change-phone-btn',function(){
    $('#change-email').hide();
    $('#change-pw').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-stateNum-section').hide();
    $('#change-phone').show();
  });
  $(document).on('click','.change-email-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-stateNum-section').hide();
    $('#change-email').show();
  });
  $(document).on('click','.upload-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#change-sector-section').hide();
    $('#change-stateNum-section').hide();
    $('#upload-section').show();
  });
  $(document).on('click','.change-sector-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#upload-section').hide();
    $('#change-stateNum-section').hide();
    $('#change-sector-section').show();
  });
  $(document).on('click','.change-stateNum-btn',function(){
    $('#change-phone').hide();
    $('#change-pw').hide();
    $('#change-email').hide();
    $('#upload-section').hide();
    $('#change-sector-section').hide();
    $('#change-stateNum-section').show();
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
