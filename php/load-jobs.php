<?php
session_start();

    include 'connect.php';
    $jobNewCount = $_POST['jobNewCount'];

    $sql = $conn->prepare('SELECT * FROM jobs ORDER BY dateStamp DESC LIMIT ' . $jobNewCount . ';');
    $sql->execute();
    while($jobResult = $sql->fetch(PDO::FETCH_ASSOC))
    {
        echo('<tr>');
        echo('
        <td><p>'. $jobResult['job_position']     .'</p></td>
        <td><p>'. $jobResult['job_title']        .'</p></td>
        <td><p>'. $jobResult['job_location']     .'</p></td>
        ');
        if(isset($_SESSION['user_uid']))
        {
            echo("<td><form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobResult['job_id'] . "' class='btn btn-primary job-btn' type='submit'>View</button></form></td>");
        }
        else
        {
            echo('<td><p>Login to view this job</p></td>');
        }
        echo('</tr>');
    }

?>
