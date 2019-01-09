<?php
session_start();
require 'header.php';
include 'php/connect.php';

echo('<link href="styles/job-page.css" rel="stylesheet" />');

$sql = $conn->prepare('SELECT * FROM jobs WHERE job_id = ?');
$sql->execute([$_GET['job-btn-value']]);
if($sql->rowCount() > 0)
{
        $jobListing = $sql->fetch();

        echo('<div class="grid">');

        echo('<div class="hero1">');
        echo('</div>');

        echo('<div class="jobPosting">');

        $sql = $conn->prepare('SELECT * FROM employers WHERE employer_id = ?');
        $sql->execute([$jobListing['employer_id']]);
        $employerInfo = $sql->fetch();

        $sql = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
        $sql->execute([$employerInfo['user_id']]);
        $userInfo = $sql->fetch();


        echo('<div class="section py-3 px-3">');
        echo('<h3>'. $jobListing['job_title'] .'</h3>');
        echo('<p>'. $jobListing['job_position'] .'</p>');
        echo('</div>');

        echo('<div class="section mt-5 py-3 px-3">');
        echo('<p class="">'. $jobListing['job_description'] .'</p>');
        echo('<p>Location: '. $jobListing['job_location'] .'</p>');
        echo('<p>Contact: '. $userInfo['user_email'] .'</p>');

        if(isset($employerInfo['employer_web']))
        {
        echo('<p>Website: <a href='.$employerInfo['employer_web'].'>'. $employerInfo['employer_web'] .'</a></p>');
        }
        else
        {
            echo('<p>This employer has not added a website</p>');
        }
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
?>
