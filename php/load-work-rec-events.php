<?php
session_start();
if (isset($_SESSION['user_uid']))
{
        include 'connect.php';
        $workRecNewCount = $_POST['workRecNewCount'];
        $worksFound = 0;

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
        $stm2 = $conn->prepare('SELECT * from events ORDER BY dateStamp DESC LIMIT ' . $workRecNewCount . ';');
        $stm2->execute();
        while($eventListing = $stm2->fetch(PDO::FETCH_ASSOC))
        {
          if(
          ($eventListing['isMedical'] == 'true' && $userOccupation['medical'] == 'true') ||
          ($eventListing['isIT'] == 'true' && $userOccupation['IT'] == 'true') ||
          ($eventListing['isHealthcare'] == 'true' && $userOccupation['healthcare'] == 'true') ||
          ($eventListing['isBusiness'] == 'true' && $userOccupation['business'] == 'true') ||
          ($eventListing['isFoodservice'] == 'true' && $userOccupation['foodservice'] == 'true') ||
          ($eventListing['isHospitality'] == 'true' && $userOccupation['hospitality'] == 'true') ||
          ($eventListing['isCulinary'] == 'true' && $userOccupation['culinary'] == 'true')
          )
          {
            echo(
            "<div id='event" . $eventListing['event_id'] . "' class='event my-4'>" .
            "<h3>"                   . $eventListing['title']        . "</h3>" .
            "<b>Type: </b>"          . $eventListing['type']         . "<br/>" .
            "<p>"                    . $eventListing['description']  . "</p><br/><br/>" .
            "<b>Location: </b>"      . $eventListing['location']     . "<br/>" .
            "<b>Date: </b>"          . $eventListing['startTime']    . "<br/>" .
            "<b>Date Posted: </b>"   . $eventListing['dateStamp']    . "<br/>");
            $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
            $stm2->execute([$result['user_id']]);
            $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($map_result))
            {
                    $flag = false;
                    foreach($map_result as $a)
                    {
                        if($a['event_id'] == $eventListing['event_id'])
                        {
                            echo("<button id='" . $eventListing['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                            $flag = true;
                        }
                    }
                    if(!$flag)
                    {
                        echo("<button id='" . $eventListing['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                    }
            }
            else
            {
                    echo("<button id='" . $eventListing['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
            }
            echo("</div><hr>");
            $worksFound += 1;
          }
        }
        if($worksFound <= 0)
        {
          echo("<div class='my-4'><h3>Couldnt find a event for you m8</h3></div>");
        }
}
?>
