<?php
session_start();
if (isset($_SESSION['user_uid']))
{
        include 'connect.php';
        $allEventNewCount = $_POST['allEventNewCount'];

        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        $stm = $conn->prepare('SELECT * FROM events LIMIT ' . $allEventNewCount . ';');
        $stm->execute();
        while($event = $stm->fetch(PDO::FETCH_ASSOC))
        {
                echo(
                "<div id='event" . $event['event_id'] . "' class='row event my-4 p-2'>" .
                "<div class='col-xs-9 col-sm-9 col-md-10 col-lg-10'>" .
                "<h3>"                   . $event['title']        . "</h3>" .
                "<b>Type: </b>"          . $event['type']         . "<br/>" .
                "<p>"                    . $event['description']  . "</p><br/><br/>" .
                "<b>Location: </b>"      . $event['location']     . "<br/>" .
                "<b>Date: </b>"          . $event['startTime']    . "<br/>" .
                "<b>Date Posted: </b>"   . $event['dateStamp']    . "<br/>" .
                "</div>");
                echo("<div class='col-xs-3 col-sm-3 col-md-2 col-lg-2'>");
                $stm2 = $conn->prepare('SELECT event_id FROM user_event WHERE user_id = ?');
                $stm2->execute([$result['user_id']]);
                $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($map_result))
                {
                    $flag = false;
                        foreach($map_result as $a)
                        {
                            if($a['event_id'] == $event['event_id'])
                            {
                                echo("<button id='" . $event['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                $flag = true;
                            }
                        }
                        if(!$flag)
                        {
                            echo("<button id='" . $event['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                        }
                }
                else
                {
                        echo("<button id='" . $event['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                }
                echo("</div></div><hr>");
        }
}
?>
