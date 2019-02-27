<?php
session_start();
if (isset($_SESSION['user_uid']))
{
  include 'connect.php';

  $announNewCount = $_POST['announNewCount'];
  $announList = getAnnounList($conn);
  $check = sizeof($announList) % 2;

  if(sizeof($announList) == 0)
  {
    echo("<div class='my-4'><h3>There are no announcements yet.</h3></div>");
  }
  else if($check == 0)
  {
    if($announNewCount <= sizeof($announList))
    {
      for($i = 0; $i < $announNewCount; $i++)
      {
        echo("<div id='announ" . $announList[$i]->getID() . "' class='event my-4'>");
        echo("<h4>" . $announList[$i]->getTitle() . "</h4>");
        echo("<p>" . $announList[$i]->getDesc());
        echo("<br />");
        echo("<br />");
        echo("<b>Date posted: </b>" . $announList[$i]->getDate());
        echo("<br />");
        echo("<button id='" . $announList[$i]->getID() . "' class='btn btn-danger rem-announ-btn'>Remove</button>");
        echo("</p></div><hr>");
      }
    }
    else
    {
      foreach($announList as $a)
      {
        echo("<div id='announ" . $a->getID() . "' class='event my-4'>");
        echo("<h4>" . $a->getTitle() . "</h4>");
        echo("<p>" . $a->getDesc());
        echo("<br />");
        echo("<br />");
        echo("<b>Date posted: </b>" . $a->getDate());
        echo("<br />");
        echo("<button id='" . $a->getID() . "' class='btn btn-danger rem-announ-btn'>Remove</button>");
        echo("</p></div><hr>");
      }
      echo("<div>There are no more announcements</div>");
    }
  }
  else
  {
    if($announNewCount - 1 <= sizeof($announList))
    {
      for($i = 0; $i < $announNewCount - 1; $i++)
      {
        echo("<div id='announ" . $announList[$i]->getID() . "' class='event my-4'>");
        echo("<h4>" . $announList[$i]->getTitle() . "</h4>");
        echo("<p>" . $announList[$i]->getDesc());
        echo("<br />");
        echo("<br />");
        echo("<b>Date posted: </b>" . $announList[$i]->getDate());
        echo("<br />");
        echo("<button id='" . $announList[$i]->getID() . "' class='btn btn-danger rem-announ-btn'>Remove</button>");
        echo("</p></div><hr>");
      }
    }
    else
    {
      foreach($announList as $a)
      {
        echo("<div id='announ" . $a->getID() . "' class='event my-4'>");
        echo("<h4>" . $a->getTitle() . "</h4>");
        echo("<p>" . $a->getDesc());
        echo("<br />");
        echo("<br />");
        echo("<b>Date posted: </b>" . $a->getDate());
        echo("<br />");
        echo("<button id='" . $a->getID() . "' class='btn btn-danger rem-announ-btn'>Remove</button>");
        echo("</p></div><hr>");
      }
      echo("<div>There are no more announcements</div>");
    }
  }
}
?>
