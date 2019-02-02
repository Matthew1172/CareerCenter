<?php
session_start();
if (isset($_SESSION['user_uid']))
{
        include 'connect.php';
        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        $recNewCount = $_POST['jobRecNewCount'];
        $jobEventList = getJobRecList($conn, $_SESSION['user_uid']);
        $check = sizeof($jobEventList) % 2;
        
        if(sizeof($jobEventList) == 0)      
        {              
            echo("<div class='my-4'><h3>We dont have any recommendations right now.</h3></div>");
        }
        else if($check == 0)
        {
            if($recNewCount <= sizeof($jobEventList))
            {
                for($i = 0; $i < $recNewCount; $i++)
                {
                  echo("<div id='job" . $jobEventList[$i]->getID() . "' class='event my-4'>");
                  echo('<h3>'. $jobEventList[$i]->getTitle() .'</h3>');
                  echo('<p>'. $jobEventList[$i]->getPos() .'</p>');
                  echo('<p>'. $jobEventList[$i]->getDesc() .'</p>');
                  echo('<p>Location: '. $jobEventList[$i]->getLoc() .'</p>');
                  echo("<form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobEventList[$i]->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form>");
                  echo("</div><hr>");
                }
            }
            else
            {
                foreach($jobEventList as $j)
                {
                  echo("<div id='job" . $j->getID() . "' class='event my-4'>");
                  echo('<h3>'. $j->getTitle() .'</h3>');
                  echo('<p>'. $j->getPos() .'</p>');
                  echo('<p>'. $j->getDesc() .'</p>');
                  echo('<p>Location: '. $j->getLoc() .'</p>');
                  echo("<form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $j->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form>");
                  echo("</div><hr>");
                }
                echo("<div>There are no more recommendations</div>");
            }
        }
        else 
        {
            if($recNewCount - 1 <= sizeof($jobEventList))
            {
                for($i = 0; $i < $recNewCount - 1; $i++)
                {
                  echo("<div id='job" . $jobEventList[$i]->getID() . "' class='event my-4'>");
                  echo('<h3>'. $jobEventList[$i]->getTitle() .'</h3>');
                  echo('<p>'. $jobEventList[$i]->getPos() .'</p>');
                  echo('<p>'. $jobEventList[$i]->getDesc() .'</p>');
                  echo('<p>Location: '. $jobEventList[$i]->getLoc() .'</p>');
                  echo("<form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobEventList[$i]->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form>");
                  echo("</div><hr>");  
                }
            }
            else
            {
                foreach($jobEventList as $j)
                {
                  echo("<div id='job" . $j->getID() . "' class='event my-4'>");
                  echo('<h3>'. $j->getTitle() .'</h3>');
                  echo('<p>'. $j->getPos() .'</p>');
                  echo('<p>'. $j->getDesc() .'</p>');
                  echo('<p>Location: '. $j->getLoc() .'</p>');
                  echo("<form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $j->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form>");
                  echo("</div><hr>");
                }
                echo("<div>There are no more recommendations</div>");
            }
        }
    
    
    
    
    
    /*
        include 'connect.php';
        $jobRecNewCount = $_POST['jobRecNewCount'];
        $jobsFound = 0;

        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        $stm = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
        $stm->execute([$result['user_id']]);
        $userOccupation = $stm->fetch(PDO::FETCH_ASSOC);

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
        */
}
?>
