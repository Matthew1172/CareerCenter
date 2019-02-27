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
                  echo('<p>'. $j->getDesc() .'</p>');
                  echo('<p>Location: '. $j->getLoc() .'</p>');
                  echo("<form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $j->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form>");
                  echo("</div><hr>");
                }
                echo("<div>There are no more recommendations</div>");
            }
        }
}
?>
