<?php
session_start();
if (isset($_SESSION['user_uid']))
{
    include 'connect.php';
    $eventNewCount = $_POST['eventNewCount'];

    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
    $sql->execute([$_SESSION['user_uid']]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    echo("<h2>Your Workshops: </h2><hr>");
    echo("<div id='event-list' class='container'>");


        $stm = $conn->prepare('SELECT * FROM user_event WHERE user_id = ?');
        $stm->execute([$result['user_id']]);
        while($map_result = $stm->fetch(PDO::FETCH_ASSOC))
        {
            $stm2 = $conn->prepare('SELECT * from events WHERE event_id = ?');
            $stm2->execute([$map_result['event_id']]);
            while($event = $stm2->fetch(PDO::FETCH_ASSOC))
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
                echo("<button id='" . $event['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                echo("</div></div><hr>");
            }
        }
}
?>
