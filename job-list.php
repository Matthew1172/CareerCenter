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
        $('#job-list').append(response);
      }
    }
  });
}
$(document).ready(function() {
  getJobList();
});
$(window).scroll(function () {
  if ($(window).scrollTop() >= $(document).height() - $(window).height() - 900)
  {
    getJobList();
  }
});
</script>
");

echo('
<div class="grid">

<div class="hero1"></div>

<div class="intro py-5"><h1>Welcome to our job board.</h1></div>

<div class="jobListing">
  <div class="container table-responsive">
    <h2>Job Postings</h2>
    <p class="pb-5 pt-3 text-muted">*For the best user experience, view on desktop.</p>
    <table class="table table-hover">
      <thead>
        <tr>
        <th>Date Posted</th>
        <th>Title</th>
        <th>Location</th>
        <th>Contact</th>
        </tr>
      </thead>
      <tbody id="job-list"></tbody>
    </table>
  </div>
</div>

</div>
');

require 'footer.php';
?>
