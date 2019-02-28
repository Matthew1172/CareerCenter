<?php
session_start();
if (isset($_SESSION['user_uid']))
{
  require 'header.php';
  //include 'php/connect.php';

  echo('<link href="styles/job-page.css" rel="stylesheet" />');

  $sql = $conn->prepare('SELECT * FROM jobs WHERE job_id = ?');
  $sql->execute([$_GET['job-btn-value']]);
  if($sql->rowCount() > 0)
  {
    $jobListing = $sql->fetch();
    $dt = new DateTime($jobListing['dateStamp']);

    echo('<div class="grid">');

    echo('<div class="hero1">');
    echo('</div>');

    echo('<div class="jobPosting">');

    $sql = $conn->prepare('SELECT * FROM employers WHERE employer_id = ?');
    $sql->execute([$jobListing['employer_id']]);
    $employerInfo = $sql->fetch();

    $sql2 = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
    $sql2->execute([$employerInfo['user_id']]);
    $userInfo = $sql2->fetch();


    echo('<div class="section py-3 px-3">');
    echo('<h3>'. $jobListing['job_title'] .'</h3>');
    echo('</div>');

    echo('<div class="section">');
    echo('<p>'. $jobListing['job_description'] .'</p>');
    echo('<p><b>Location:</b> '. $jobListing['job_location'] .'</p>');
    echo('<p><b>Contact:</b> '. $userInfo['user_email'] .'</p>');
    echo('<p><b>Date posted: </b>'. $dt->format('Y-m-d') .'</p>');

    if(isset($employerInfo['employer_web']))
    {
      echo('<p><b>Website:</b> <a href='.$employerInfo['employer_web'].'>'. $employerInfo['employer_web'] .'</a></p>');
    }
    else
    {
      echo('<p>This employer has not added a website</p>');
    }

    echo('<p><b>tags: </b><br/>');
    $tags = getTags($jobListing);
    foreach($tags as $t)
    {
      echo('- ' . $t . '<br/>');
    }
    echo('</p>');

    echo('</div>');
    echo('</div>');

    echo('<div class="intro px-3 py-5">');
    echo('<h1>'. $employerInfo['employer_company'] .'</h1>');
    echo('</div>');

    echo('</div>');
  }
  else
  {
    echo('<div class="grid">');

    echo('<div class="hero1">');
    echo('</div>');

    echo('<div class="intro px-3 py-5">');
    echo('<h1>This job does not exist :(</h1>');
    echo('</div>');

    echo('</div>');
  }
  require 'footer.php';
}
