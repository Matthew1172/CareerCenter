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
}
?>
