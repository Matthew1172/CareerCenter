<?php
session_start();
if (isset($_SESSION['user_uid']))
{
        include 'connect.php';
        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        $jobNewCount = $_POST['jobNewCount'];
        $jobList = getOwnJobList($conn, $_SESSION['user_uid']);
        $check = sizeof($jobList) % 2;
        
        if(sizeof($jobList) == 0)      
        {              
            echo("<div class='my-4'><h3>You have not posted any jobs yet.</h3></div>");
        }
        else if($check == 0)
        {
            if($jobNewCount <= sizeof($jobList))
            {
                for($i = 0; $i < $jobNewCount; $i++)
                {
                      echo (
                      "<div id='job" . $jobList[$i]->getID() . "' class='event my-4'>" .
                      "<h3>"                   . htmlspecialchars($jobList[$i]->getTitle())        . "</h3>" .
                      "<b>Position: </b>"      . htmlspecialchars($jobList[$i]->getPos())         . "</p>" .
                      "<p>"                    . htmlspecialchars($jobList[$i]->getDesc())  . "<br/><br/>" .
                      "<b>Location: </b>"      . htmlspecialchars($jobList[$i]->getLoc())     . "<br/>" .
                      "<b>Contact: </b>"       . htmlspecialchars($result['user_email'])     . "<br/>");
                      echo("<button id='" . $jobList[$i]->getID() . "' class='btn btn-primary rem-btn'>Remove</button>");
                      echo("</div><hr>");  
                }
            }
            else
            {
                foreach($jobList as $j)
                {
                      echo (
                      "<div id='job" . $j->getID() . "' class='event my-4'>" .
                      "<h3>"                   . htmlspecialchars($j->getTitle())        . "</h3>" .
                      "<b>Position: </b>"      . htmlspecialchars($j->getPos())         . "</p>" .
                      "<p>"                    . htmlspecialchars($j->getDesc())  . "<br/><br/>" .
                      "<b>Location: </b>"      . htmlspecialchars($j->getLoc())     . "<br/>" .
                      "<b>Contact: </b>"       . htmlspecialchars($result['user_email'])     . "<br/>");
                      echo("<button id='" . $j->getID() . "' class='btn btn-primary rem-btn'>Remove</button>");
                      echo("</div><hr>");  
                }
                echo("<div>There are no more events</div>");
            }
        }
        else 
        {
            if($jobNewCount - 1 <= sizeof($jobList))
            {
                for($i = 0; $i < $jobNewCount - 1; $i++)
                {
                      echo (
                      "<div id='job" . $jobList[$i]->getID() . "' class='event my-4'>" .
                      "<h3>"                   . htmlspecialchars($jobList[$i]->getTitle())        . "</h3>" .
                      "<b>Position: </b>"      . htmlspecialchars($jobList[$i]->getPos())         . "</p>" .
                      "<p>"                    . htmlspecialchars($jobList[$i]->getDesc())  . "<br/><br/>" .
                      "<b>Location: </b>"      . htmlspecialchars($jobList[$i]->getLoc())     . "<br/>" .
                      "<b>Contact: </b>"       . htmlspecialchars($result['user_email'])     . "<br/>");
                      echo("<button id='" . $jobList[$i]->getID() . "' class='btn btn-primary rem-btn'>Remove</button>");
                      echo("</div><hr>");  
                }
            }
            else
            {
                foreach($jobList as $j)
                {
                      echo (
                      "<div id='job" . $j->getID() . "' class='event my-4'>" .
                      "<h3>"                   . htmlspecialchars($j->getTitle())        . "</h3>" .
                      "<b>Position: </b>"      . htmlspecialchars($j->getPos())         . "</p>" .
                      "<p>"                    . htmlspecialchars($j->getDesc())  . "<br/><br/>" .
                      "<b>Location: </b>"      . htmlspecialchars($j->getLoc())     . "<br/>" .
                      "<b>Contact: </b>"       . htmlspecialchars($result['user_email'])     . "<br/>");
                      echo("<button id='" . $j->getID() . "' class='btn btn-primary rem-btn'>Remove</button>");
                      echo("</div><hr>");  
                }
                echo("<div>There are no more events</div>");
            }
        }

    /*
        include 'connect.php';
        $jobNewCount = $_POST['jobNewCount'];

        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        $stm = $conn->prepare('SELECT * FROM employers WHERE user_id = ?');
        $stm->execute([$result['user_id']]);
        $employerResult = $stm->fetch();
        $stm = $conn->prepare('SELECT * FROM jobs WHERE employer_id = ? ORDER BY dateStamp DESC LIMIT ' . $jobNewCount . ';');
        $stm->execute([$employerResult['employer_id']]);
        if($stm->rowCount() > 0)
        {
            while($event = $stm->fetch(PDO::FETCH_ASSOC))
            {
                        echo (
                        "<div id='job" . $event['job_id'] . "' class='event my-4'>" .
                        "<h3>"                   . htmlspecialchars($event['job_title'])        . "</h3>" .
                        "<b>Position: </b>"      . htmlspecialchars($event['job_position'])         . "</p>" .
                        "<p>"                    . htmlspecialchars($event['job_description'])  . "<br/><br/>" .
                        "<b>Location: </b>"      . htmlspecialchars($event['job_location'])     . "<br/>" .
                        "<b>Contact: </b>"       . htmlspecialchars($result['user_email'])     . "<br/>");
                        echo("<button id='" . $event['job_id'] . "' class='btn btn-primary rem-btn'>Remove</button>");
                        echo("</div><hr>");
            }
        }
        else
        {
            echo("<div class='my-4'><h3>You have no job postings yet!</h3></div>");
        }
     * 
     */
}
?>
