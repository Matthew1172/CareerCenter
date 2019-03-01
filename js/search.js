$(document).ready(function() {
  $('#search-allWork').keyup(function(){
    var txt = $(this).val();
    if(txt != '')
    {
      $('#all-events-list-section').hide();
      $('#all-events-list-section-search').show();
      $('#all-events-list-section-search').load('php/search-allWork.php', {
        txt: txt
      });
    }
    else{
      $('#all-events-list-section-search').hide();
      $('#all-events-list-section').show();
    }
  });
  $('#search-ownWork').keyup(function(){
    var txt = $(this).val();
    if(txt != '')
    {
      $('#own-events-list-section').hide();
      $('#own-events-list-section-search').show();
      $('#own-events-list-section-search').load('php/search-ownWork.php', {
        txt: txt
      });
    }
    else{
      $('#own-events-list-section-search').hide();
      $('#own-events-list-section').show();
    }
  });
  $('#search-recWork').keyup(function(){
    var txt = $(this).val();
    if(txt != '')
    {
      $('#work-rec-list-section').hide();
      $('#work-rec-list-section-search').show();
      $('#work-rec-list-section-search').load('php/search-recWork.php', {
        txt: txt
      });
    }
    else{
      $('#work-rec-list-section-search').hide();
      $('#work-rec-list-section').show();
    }
  });
  $('#search-recJob').keyup(function(){
    var txt = $(this).val();
    if(txt != '')
    {
      $('#job-rec-list-section').hide();
      $('#job-rec-list-section-search').show();
      $('#job-rec-list-section-search').load('php/search-recJob.php', {
        txt: txt
      });
    }
    else{
      $('#job-rec-list-section-search').hide();
      $('#job-rec-list-section').show();
    }
  });
  $('#search-modWork').keyup(function(){
    var txt = $(this).val();
    if(txt != '')
    {
      $('#mod-event-list-section').hide();
      $('#mod-event-list-section-search').show();
      $('#mod-event-list-section-search').load('php/search-modWork.php', {
        txt: txt
      });
    }
    else{
      $('#mod-event-list-section-search').hide();
      $('#mod-event-list-section').show();
    }
  });
});
