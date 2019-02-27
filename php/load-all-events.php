<?php
session_start();
if (isset($_SESSION['user_uid']))
{
        include 'connect.php';
        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        $allEventNewCount = $_POST['allEventNewCount'];
        $allEventList = getEventList($conn);
        $check = sizeof($allEventList) % 2;
        
        if(sizeof($allEventList) == 0)      
        {              
            echo("<div class='my-4'><h3>There are no events.</h3></div>");
        }
        else if($check == 0)
        {
            if($allEventNewCount <= sizeof($allEventList))
            {
                for($i = 0; $i < $allEventNewCount; $i++)
                {
                                    echo(
                                    "<div id='event"         . $allEventList[$i]->getID()  . "' class='event my-4'>" .
                                    "<h3>"                   . $allEventList[$i]->getTitle()        . "</h3>" .
                                    "<p>"                    . $allEventList[$i]->getDesc()  . "</p><br/><br/>" .
                                    "<b>Location: </b>"      . $allEventList[$i]->getLoc()     . "<br/>" .
                                    "<b>Date: </b>"          . $allEventList[$i]->getStart()    . "<br/>" .
                                    "<b>Date Posted: </b>"   . $allEventList[$i]->getDateStamp()    . "<br/>");
                                    $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                    $stm2->execute([$result['user_id']]);
                                    $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                    if(!empty($map_result))
                                    {
                                            $flag = false;
                                            foreach($map_result as $a)
                                            {
                                                if($a['event_id'] == $allEventList[$i]->getID())
                                                {
                                                    echo("<button id='" . $allEventList[$i]->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                    $flag = true;
                                                }
                                            }
                                            if(!$flag)
                                            {
                                                echo("<button id='" . $allEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                            }
                                    }
                                    else
                                    {
                                            echo("<button id='" . $allEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                    }
                                    echo("</div><hr>");   
                }
            }
            else
            {
                foreach($allEventList as $e)
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
            if($allEventNewCount - 1 <= sizeof($allEventList))
            {
                for($i = 0; $i < $allEventNewCount - 1; $i++)
                {
                                    echo(
                                    "<div id='event"         . $allEventList[$i]->getID()  . "' class='event my-4'>" .
                                    "<h3>"                   . $allEventList[$i]->getTitle()        . "</h3>" .
                                    "<p>"                    . $allEventList[$i]->getDesc()  . "</p><br/><br/>" .
                                    "<b>Location: </b>"      . $allEventList[$i]->getLoc()     . "<br/>" .
                                    "<b>Date: </b>"          . $allEventList[$i]->getStart()    . "<br/>" .
                                    "<b>Date Posted: </b>"   . $allEventList[$i]->getDateStamp()    . "<br/>");
                                    $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                    $stm2->execute([$result['user_id']]);
                                    $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                    if(!empty($map_result))
                                    {
                                            $flag = false;
                                            foreach($map_result as $a)
                                            {
                                                if($a['event_id'] == $allEventList[$i]->getID())
                                                {
                                                    echo("<button id='" . $allEventList[$i]->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                    $flag = true;
                                                }
                                            }
                                            if(!$flag)
                                            {
                                                echo("<button id='" . $allEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                            }
                                    }
                                    else
                                    {
                                            echo("<button id='" . $allEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                    }
                                    echo("</div><hr>");   
                }
            }
            else
            {
                foreach($allEventList as $e)
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