<?php
session_start();
if (isset($_SESSION['user_uid']))
{
        include 'connect.php';
        $jobRecNewCount = $_POST['jobRecNewCount'];
        $jobsFound = 0;

        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        /*
        Get the users occupations
        */
        $stm = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
        $stm->execute([$result['user_id']]);
        $userOccupation = $stm->fetch(PDO::FETCH_ASSOC);
        /*
        Get the users occupations
        */
        $stm2 = $conn->prepare('SELECT * from jobs ORDER BY dateStamp DESC LIMIT ' . $jobRecNewCount . ';');
        $stm2->execute();
        while($jobListing = $stm2->fetch(PDO::FETCH_ASSOC))
        {
            if(
            ($jobListing['isMedical'] == 'true' && $userOccupation['medical'] == 'true') ||
            ($jobListing['isIT'] == 'true' && $userOccupation['IT'] == 'true') ||
            ($jobListing['isHealthcare'] == 'true' && $userOccupation['healthcare'] == 'true') ||
            ($jobListing['isBusiness'] == 'true' && $userOccupation['business'] == 'true') ||
            ($jobListing['isFoodservice'] == 'true' && $userOccupation['foodservice'] == 'true') ||
            ($jobListing['isHospitality'] == 'true' && $userOccupation['hospitality'] == 'true') ||
            ($jobListing['isCulinary'] == 'true' && $userOccupation['culinary'] == 'true')
            )
            {
                echo("<div id='job" . $jobListing['job_id'] . "' class='event my-4'>");
                echo('<h3>'. $jobListing['job_title'] .'</h3>');
                echo('<p>'. $jobListing['job_position'] .'</p>');
                echo('<p>'. $jobListing['job_description'] .'</p>');
                echo('<p>Location: '. $jobListing['job_location'] .'</p>');
                echo("</div><hr>");
                $jobsFound += 1;
            }
        }
        if($jobsFound <= 0)
        {
          echo("<div class='my-4'><h3>Couldnt find a job for you m8</h3></div>");
        }
}
?>
