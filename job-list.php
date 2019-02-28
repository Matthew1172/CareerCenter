<?php
session_start();
require 'header.php';
echo('<link href="styles/job-list.css" rel="stylesheet" />');
echo("
<script>
var start_job = 0;
var limit_job = 0;
var reachedMax_job = false;
function getJobList() {
  if (reachedMax_job){
    return;
  }
  start_job += limit_job;
  limit_job += 5;
  $.ajax({
    url: 'php/getJobList.php',
    method: 'POST',
    dataType: 'text',
    data: {
      getData: 1,
      start: start_job,
      limit: limit_job
    },
    success: function(response) {
      if (response == 'reachedMax'){
        reachedMax_job = true;
      }
      else {
        $('#job-list-all').append(response);
      }
    }
  });
}
$(document).ready(function() {
  getJobList();
  $('#search-jobList').keyup(function(){
    var txt = $(this).val();
    if(txt != '')
    {
      $('#allList').hide();
      $('#searchList').show();
      $('#job-list-search').load('php/search-jobList.php', {
        txt: txt
      });
    }
    else{
      $('#searchList').hide();
      $('#allList').show();
    }
  });
});
$(window).scroll(function () {
  if ($(window).scrollTop() >= $(document).height() - $(window).height() - 900)
  {
    getJobList();
  }
});
</script>
");

echo('<div class="grid">');

echo('<div class="hero1"></div>');

echo('<div class="intro py-5"><h1>Welcome to our job board.</h1></div>');


echo('
<div class="jobListing">

<h2>Job Postings</h2>
<p class="pb-5 pt-3 text-muted">*For the best user experience, view on desktop.</p>
<input type="text" name="search-jobList" id="search-jobList" placeholder="search jobs" class="form-control my-5"/>

<div class="container table-responsive" id="allList">
<table class="table table-hover">
<thead>
<tr>
<th>Date Posted</th>
<th>Title</th>
<th>Location</th>
<th>Contact</th>
</tr>
</thead>
<tbody id="job-list-all"></tbody>
</table>
</div>

<div class="container table-responsive" id="searchList" style="display: none;">
<table class="table table-hover">
<thead>
<tr>
<th>Date Posted</th>
<th>Title</th>
<th>Location</th>
<th>Contact</th>
</tr>
</thead>
<tbody id="job-list-search"></tbody>
</table>
</div>


</div>
');

echo('</div>');

require 'footer.php';
?>
