<?php
session_start();
require 'header.php';
include 'php/connect.php';

echo('<link href="styles/job-list.css" rel="stylesheet" />');

echo("
<script>
$(document).ready(function() {
    var jobCount = 2;

    $('#more-job-button').click(function(){
        jobCount += 2;
        $('#job-listing').load('php/load-jobs.php', {
            jobNewCount: jobCount
        });
    });
});
</script>
");

echo('
<div class="grid">

<div class="hero1">
</div>

<div class="intro py-5">
<h1>Welcome to our job board.</h1>
</div>

<div class="jobListing">

<div class="container">
  <h2>Job Postings</h2>
  <p class="pb-5 pt-3 text-muted">*For the best user experience, view on desktop.</p>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Position</th>
        <th>Title</th>
        <th>Location</th>
        <th>Contact</th>
      </tr>
    </thead>
    <tbody id="job-listing">
');

$sql = $conn->prepare('SELECT * FROM jobs ORDER BY dateStamp DESC LIMIT 2');
$sql->execute();
while($jobResult = $sql->fetch(PDO::FETCH_ASSOC))
{
    echo('<tr>');
    echo('
    <td><p>'. $jobResult['job_position']   .'</p></td>
    <td><p>'. $jobResult['job_title']      .'</p></td>
    <td><p>'. $jobResult['job_location']   .'</p></td>
    ');
    if(isset($_SESSION['user_uid']))
    {
        echo("<td><form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobResult['job_id'] . "' class='btn btn-primary job-btn' type='submit'>View</button></form></td>");
    }
    else
    {
        echo('<td>Login to view this job</td>');
    }
    echo('</tr>');
}

echo("
    </tbody>
  </table>

<div class='show-more-container'>
<button id='more-job-button' class='btn btn-primary more-btn mt-2'>Show more</button>
</div>
</div>

</div>

</div>
");

require 'footer.php';
?>
