<?php
session_start();
if (isset($_SESSION['user_uid']))
{
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
}
?>
