<?php
session_start();
if (isset($_SESSION['user_uid']))
{
  include 'connect.php';

  $currentNewCount = $_POST['currentNewCount'];
  $currentList = getEventList($conn);
  $check = sizeof($currentList) % 2;

  if(sizeof($currentList) == 0)
  {
    echo("<div class='my-4'><h3>There are no events yet.</h3></div>");
  }
  else if($check == 0)
  {
    if($currentNewCount <= sizeof($currentList))
    {
      for($i = 0; $i < $currentNewCount; $i++)
      {
        echo(
          "<div id='event" . $currentList[$i]->getID() . "' class='event my-4'>" .
          "<h3>" . $currentList[$i]->getTitle() . "</h3>" .
          "<p>" . $currentList[$i]->getDesc() . "</p><br/><br/>" .
          "<b>Location: </b>" . $currentList[$i]->getLoc() . "<br/>" .
          "<b>Date: </b>" . $currentList[$i]->getStart() . "<br/>" .
          "<b>Date Posted: </b>" . $currentList[$i]->getDateStamp() . "<br/>");
          echo("</div><hr>");
      }
    }
    else
    {
      foreach($currentList as $c)
      {
        echo(
          "<div id='event" . $c->getID() . "' class='event my-4'>" .
          "<h3>" . $c->getTitle() . "</h3>" .
          "<p>" . $c->getDesc() . "</p><br/><br/>" .
          "<b>Location: </b>" . $c->getLoc() . "<br/>" .
          "<b>Date: </b>" . $c->getStart() . "<br/>" .
          "<b>Date Posted: </b>" . $c->getDateStamp() . "<br/>");
          echo("</div><hr>");
      }
      echo("<div>There are no more events</div>");
    }
  }
  else
  {
    if($currentNewCount - 1 <= sizeof($currentList))
    {
      for($i = 0; $i < $currentNewCount - 1; $i++)
      {
        echo(
          "<div id='event" . $currentList[$i]->getID() . "' class='event my-4'>" .
          "<h3>" . $currentList[$i]->getTitle() . "</h3>" .
          "<p>" . $currentList[$i]->getDesc() . "</p><br/><br/>" .
          "<b>Location: </b>" . $currentList[$i]->getLoc() . "<br/>" .
          "<b>Date: </b>" . $currentList[$i]->getStart() . "<br/>" .
          "<b>Date Posted: </b>" . $currentList[$i]->getDateStamp() . "<br/>");
          echo("</div><hr>");
      }
    }
    else
    {
      foreach($currentList as $c)
      {
        echo(
          "<div id='event" . $c->getID() . "' class='event my-4'>" .
          "<h3>" . $c->getTitle() . "</h3>" .
          "<p>" . $c->getDesc() . "</p><br/><br/>" .
          "<b>Location: </b>" . $c->getLoc() . "<br/>" .
          "<b>Date: </b>" . $c->getStart() . "<br/>" .
          "<b>Date Posted: </b>" . $c->getDateStamp() . "<br/>");
          echo("</div><hr>");
      }
      echo("<div>There are no more events</div>");
    }
  }
}
?>
