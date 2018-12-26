<?php
session_start();

    include 'connect.php';
    $jobNewCount = $_POST['jobNewCount'];

    $sql = $conn->prepare('SELECT * FROM jobs LIMIT ' . $jobNewCount . ';');
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

?>
