<?php
session_start();
if (isset($_SESSION['user_uid']))
{
        include 'connect.php';
        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        $recNewCount = $_POST['workRecNewCount'];
        $recEventList = getWorkRecList($conn, $result['user_id']);
        $check = sizeof($recEventList) % 2;
        
        if(sizeof($recEventList) == 0)      
        {              
            echo("<div class='my-4'><h3>We dont have any recommondations right now.</h3></div>");
        }
        else if($check == 0)
        {
            if($recNewCount <= sizeof($recEventList))
            {
                for($i = 0; $i < $recNewCount; $i++)
                {
                                    echo(
                                    "<div id='event"         . $recEventList[$i]->getID()  . "' class='event my-4'>" .
                                    "<h3>"                   . $recEventList[$i]->getTitle()        . "</h3>" .
                                    "<p>"                    . $recEventList[$i]->getDesc()  . "</p><br/><br/>" .
                                    "<b>Location: </b>"      . $recEventList[$i]->getLoc()     . "<br/>" .
                                    "<b>Date: </b>"          . $recEventList[$i]->getStart()    . "<br/>" .
                                    "<b>Date Posted: </b>"   . $recEventList[$i]->getDateStamp()    . "<br/>");
                                    $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                    $stm2->execute([$result['user_id']]);
                                    $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                    if(!empty($map_result))
                                    {
                                            $flag = false;
                                            foreach($map_result as $a)
                                            {
                                                if($a['event_id'] == $recEventList[$i]->getID())
                                                {
                                                    echo("<button id='" . $recEventList[$i]->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                    $flag = true;
                                                }
                                            }
                                            if(!$flag)
                                            {
                                                echo("<button id='" . $recEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                            }
                                    }
                                    else
                                    {
                                            echo("<button id='" . $recEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                    }
                                    echo("</div><hr>");   
                }
            }
            else
            {
                foreach($recEventList as $e)
                {
                                        echo(
                                        "<div id='event"         . $e->getID()  . "' class='event my-4'>" .
                                        "<h3>"                   . $e->getTitle()        . "</h3>" .
                                        "<p>"                    . $e->getDesc()  . "</p><br/><br/>" .
                                        "<b>Location: </b>"      . $e->getLoc()     . "<br/>" .
                                        "<b>Date: </b>"          . $e->getStart()    . "<br/>" .
                                        "<b>Date Posted: </b>"   . $e->getDateStamp()    . "<br/>");
                                        $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                        $stm2->execute([$result['user_id']]);
                                        $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                        if(!empty($map_result))
                                        {
                                                $flag = false;
                                                foreach($map_result as $a)
                                                {
                                                    if($a['event_id'] == $e->getID())
                                                    {
                                                        echo("<button id='" . $e->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                        $flag = true;
                                                    }
                                                }
                                                if(!$flag)
                                                {
                                                    echo("<button id='" . $e->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                                }
                                        }
                                        else
                                        {
                                                echo("<button id='" . $e->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                        }
                                        echo("</div><hr>");
                }
                echo("<div>There are no more events</div>");
            }
        }
        else 
        {
            if($recNewCount - 1 <= sizeof($recEventList))
            {
                for($i = 0; $i < $recNewCount - 1; $i++)
                {
                                    echo(
                                    "<div id='event"         . $recEventList[$i]->getID()  . "' class='event my-4'>" .
                                    "<h3>"                   . $recEventList[$i]->getTitle()        . "</h3>" .
                                    "<p>"                    . $recEventList[$i]->getDesc()  . "</p><br/><br/>" .
                                    "<b>Location: </b>"      . $recEventList[$i]->getLoc()     . "<br/>" .
                                    "<b>Date: </b>"          . $recEventList[$i]->getStart()    . "<br/>" .
                                    "<b>Date Posted: </b>"   . $recEventList[$i]->getDateStamp()    . "<br/>");
                                    $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                    $stm2->execute([$result['user_id']]);
                                    $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                    if(!empty($map_result))
                                    {
                                            $flag = false;
                                            foreach($map_result as $a)
                                            {
                                                if($a['event_id'] == $recEventList[$i]->getID())
                                                {
                                                    echo("<button id='" . $recEventList[$i]->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                    $flag = true;
                                                }
                                            }
                                            if(!$flag)
                                            {
                                                echo("<button id='" . $recEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                            }
                                    }
                                    else
                                    {
                                            echo("<button id='" . $recEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                    }
                                    echo("</div><hr>");   
                }
            }
            else
            {
                foreach($recEventList as $e)
                {
                                        echo(
                                        "<div id='event"         . $e->getID()  . "' class='event my-4'>" .
                                        "<h3>"                   . $e->getTitle()        . "</h3>" .
                                        "<p>"                    . $e->getDesc()  . "</p><br/><br/>" .
                                        "<b>Location: </b>"      . $e->getLoc()     . "<br/>" .
                                        "<b>Date: </b>"          . $e->getStart()    . "<br/>" .
                                        "<b>Date Posted: </b>"   . $e->getDateStamp()    . "<br/>");
                                        $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                        $stm2->execute([$result['user_id']]);
                                        $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                        if(!empty($map_result))
                                        {
                                                $flag = false;
                                                foreach($map_result as $a)
                                                {
                                                    if($a['event_id'] == $e->getID())
                                                    {
                                                        echo("<button id='" . $e->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                        $flag = true;
                                                    }
                                                }
                                                if(!$flag)
                                                {
                                                    echo("<button id='" . $e->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                                }
                                        }
                                        else
                                        {
                                                echo("<button id='" . $e->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                        }
                                        echo("</div><hr>");
                }
                echo("<div>There are no more events</div>");
            }
        }
}