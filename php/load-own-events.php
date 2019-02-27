<?php
session_start();
if (isset($_SESSION['user_uid']))
{
        include 'connect.php';
        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        $ownEventNewCount = $_POST['ownEventNewCount'];
        $myOwnEventList = getOwnEventList($conn, $result['user_id']);
        $check = sizeof($myOwnEventList) % 2;
        
        if(sizeof($myOwnEventList) == 0)      
        {              
            echo("<div class='my-4'><h3>You are not subscribed to any workshops yet.</h3></div>");
        }
        else if($check == 0)
        {
            if($ownEventNewCount <= sizeof($myOwnEventList))
            {
                for($i = 0; $i < $ownEventNewCount; $i++)
                {
                                    echo(
                                    "<div id='event"         . $myOwnEventList[$i]->getID()  . "' class='event my-4'>" .
                                    "<h3>"                   . $myOwnEventList[$i]->getTitle()        . "</h3>" .
                                    "<p>"                    . $myOwnEventList[$i]->getDesc()  . "</p><br/><br/>" .
                                    "<b>Location: </b>"      . $myOwnEventList[$i]->getLoc()     . "<br/>" .
                                    "<b>Date: </b>"          . $myOwnEventList[$i]->getStart()    . "<br/>" .
                                    "<b>Date Posted: </b>"   . $myOwnEventList[$i]->getDateStamp()    . "<br/>");
                                    $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                    $stm2->execute([$result['user_id']]);
                                    $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                    if(!empty($map_result))
                                    {
                                            $flag = false;
                                            foreach($map_result as $a)
                                            {
                                                if($a['event_id'] == $myOwnEventList[$i]->getID())
                                                {
                                                    echo("<button id='" . $myOwnEventList[$i]->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                    $flag = true;
                                                }
                                            }
                                            if(!$flag)
                                            {
                                                echo("<button id='" . $myOwnEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                            }
                                    }
                                    else
                                    {
                                            echo("<button id='" . $myOwnEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                    }
                                    echo("</div><hr>");   
                }
            }
            else
            {
                foreach($myOwnEventList as $e)
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
            if($ownEventNewCount - 1 <= sizeof($myOwnEventList))
            {
                for($i = 0; $i < $ownEventNewCount - 1; $i++)
                {
                                        echo(
                                        "<div id='event"         . $myOwnEventList[$i]->getID()  . "' class='event my-4'>" .
                                        "<h3>"                   . $myOwnEventList[$i]->getTitle()        . "</h3>" .
                                        "<p>"                    . $myOwnEventList[$i]->getDesc()  . "</p><br/><br/>" .
                                        "<b>Location: </b>"      . $myOwnEventList[$i]->getLoc()     . "<br/>" .
                                        "<b>Date: </b>"          . $myOwnEventList[$i]->getStart()    . "<br/>" .
                                        "<b>Date Posted: </b>"   . $myOwnEventList[$i]->getDateStamp()    . "<br/>");
                                        $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                        $stm2->execute([$result['user_id']]);
                                        $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                        if(!empty($map_result))
                                        {
                                                $flag = false;
                                                foreach($map_result as $a)
                                                {
                                                    if($a['event_id'] == $myOwnEventList[$i]->getID())
                                                    {
                                                        echo("<button id='" . $myOwnEventList[$i]->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                        $flag = true;
                                                    }
                                                }
                                                if(!$flag)
                                                {
                                                    echo("<button id='" . $myOwnEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                                }
                                        }
                                        else
                                        {
                                                echo("<button id='" . $myOwnEventList[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                        }
                                        echo("</div><hr>");             
                }
            }
            else
            {
                foreach($myOwnEventList as $e)
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