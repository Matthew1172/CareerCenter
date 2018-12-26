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
        $('#job-list').load('php/load-jobs.php', {
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

<div class="jobList">

<div class="container">
  <h4 class="pb-5">Job Postings</h4>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Position</th>
        <th>Title</th>
        <th>Location</th>
        <th>Contact</th>
      </tr>
    </thead>
    <tbody id="job-list">
');

$sql = $conn->prepare('SELECT * FROM jobs LIMIT 2');
$sql->execute();
while($jobResult = $sql->fetch(PDO::FETCH_ASSOC))
{
    echo('<tr>');
    echo('
    <td>'. $jobResult['job_position'] .'</td>
    <td>'. $jobResult['job_title'] .'</td>
    <td>'. $jobResult['job_location'] .'</td>
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

echo('
    </tbody>
  </table>
</div>
');
echo("<div class='show-more-container'>");
echo("<button id='more-job-button' class='btn btn-primary more-btn mt-2'>Show more</button>");
echo("</div>");

echo('
</div>

</div>
');

require 'footer.php';
?>
