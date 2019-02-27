<?php
session_start();
if (isset($_SESSION['user_uid']))
{
  include 'connect.php';

  $modNewCount = $_POST['modNewCount'];
  $modList = getEventList($conn);
  $check = sizeof($modList) % 2;

  if(sizeof($modList) == 0)
  {
    echo("<div class='my-4'><h3>There are no events yet.</h3></div>");
  }
  else if($check == 0)
  {
    if($modNewCount <= sizeof($modList))
    {
      for($i = 0; $i < $modNewCount; $i++)
      {
        echo(
          "<div id='event" . $modList[$i]->getID() . "' class='event my-4 p-2'>" .
          "<h3>Event number: " . $modList[$i]->getID() . "</h3>" .
          "<h3>" . $modList[$i]->getTitle() . "</h3>");
          $sql = $conn->prepare('SELECT user_id FROM user_event WHERE event_id = ?');
          $sql->execute([$modList[$i]->getID()]);
          if ($sql->rowCount() > 0) {
            echo('<table class="table table-hover">
            <thead>
            <tr>
            <th>user</th>
            <th>name</th>
            <th>phone</th>
            <th>email</th>
            <th>type</th>
            </tr>
            </thead>
            <tbody>
            ');
            while ($eventResult = $sql->fetch()) {
              $sql2 = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
              $sql2->execute([$eventResult['user_id']]);
              while ($userResults = $sql2->fetch()) {
                echo("<tr>");
                echo("<td><p>" . $userResults['user_uid'] . "</p></td>");
                echo("<td><p>" . $userResults['user_first'] . " " . $userResults['user_last'] . "</p></td>");
                echo("<td><p>" . $userResults['user_phone'] . "</p></td>");
                echo("<td><p>" . $userResults['user_email'] . "</p></td>");
                echo("<td><p>" . $userResults['user_type'] . "</p></td>");
                echo("</tr>");
              }
            }
            echo("
            </tbody>
            </table>");
          } else {
            echo("<p>There are no users going to this event</p>");
          }
          echo("<button id='" . $modList[$i]->getID() . "' class='btn btn-danger rem-event-btn'>Remove</button>");
          echo("</div><hr>");
      }
    }
    else
    {
      foreach($modList as $m)
      {
        echo(
          "<div id='event" . $m->getID() . "' class='event my-4 p-2'>" .
          "<h3>Event number: " . $m->getID() . "</h3>" .
          "<h3>" . $m->getTitle() . "</h3>");
          $sql = $conn->prepare('SELECT user_id FROM user_event WHERE event_id = ?');
          $sql->execute([$m->getID()]);
          if ($sql->rowCount() > 0) {
            echo('<table class="table table-hover">
            <thead>
            <tr>
            <th>user</th>
            <th>name</th>
            <th>phone</th>
            <th>email</th>
            <th>type</th>
            </tr>
            </thead>
            <tbody>
            ');
            while ($eventResult = $sql->fetch()) {
              $sql2 = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
              $sql2->execute([$eventResult['user_id']]);
              while ($userResults = $sql2->fetch()) {
                echo("<tr>");
                echo("<td><p>" . $userResults['user_uid'] . "</p></td>");
                echo("<td><p>" . $userResults['user_first'] . " " . $userResults['user_last'] . "</p></td>");
                echo("<td><p>" . $userResults['user_phone'] . "</p></td>");
                echo("<td><p>" . $userResults['user_email'] . "</p></td>");
                echo("<td><p>" . $userResults['user_type'] . "</p></td>");
                echo("</tr>");
              }
            }
            echo("
            </tbody>
            </table>");
          } else {
            echo("<p>There are no users going to this event</p>");
          }
          echo("<button id='" . $m->getID() . "' class='btn btn-danger rem-event-btn'>Remove</button>");
          echo("</div><hr>");
      }
      echo("<div>There are no more events</div>");
    }
  }
  else
  {
    if($modNewCount - 1 <= sizeof($modList))
    {
      for($i = 0; $i < $modNewCount - 1; $i++)
      {
        echo(
          "<div id='event" . $modList[$i]->getID() . "' class='event my-4 p-2'>" .
          "<h3>Event number: " . $modList[$i]->getID() . "</h3>" .
          "<h3>" . $modList[$i]->getTitle() . "</h3>");
          $sql = $conn->prepare('SELECT user_id FROM user_event WHERE event_id = ?');
          $sql->execute([$modList[$i]->getID()]);
          if ($sql->rowCount() > 0) {
            echo('<table class="table table-hover">
            <thead>
            <tr>
            <th>user</th>
            <th>name</th>
            <th>phone</th>
            <th>email</th>
            <th>type</th>
            </tr>
            </thead>
            <tbody>
            ');
            while ($eventResult = $sql->fetch()) {
              $sql2 = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
              $sql2->execute([$eventResult['user_id']]);
              while ($userResults = $sql2->fetch()) {
                echo("<tr>");
                echo("<td><p>" . $userResults['user_uid'] . "</p></td>");
                echo("<td><p>" . $userResults['user_first'] . " " . $userResults['user_last'] . "</p></td>");
                echo("<td><p>" . $userResults['user_phone'] . "</p></td>");
                echo("<td><p>" . $userResults['user_email'] . "</p></td>");
                echo("<td><p>" . $userResults['user_type'] . "</p></td>");
                echo("</tr>");
              }
            }
            echo("
            </tbody>
            </table>");
          } else {
            echo("<p>There are no users going to this event</p>");
          }
          echo("<button id='" . $modList[$i]->getID() . "' class='btn btn-danger rem-event-btn'>Remove</button>");
          echo("</div><hr>");
      }
    }
    else
    {
      foreach($modList as $m)
      {
        echo(
          "<div id='event" . $m->getID() . "' class='event my-4 p-2'>" .
          "<h3>Event number: " . $m->getID() . "</h3>" .
          "<h3>" . $m->getTitle() . "</h3>");
          $sql = $conn->prepare('SELECT user_id FROM user_event WHERE event_id = ?');
          $sql->execute([$m->getID()]);
          if ($sql->rowCount() > 0) {
            echo('<table class="table table-hover">
            <thead>
            <tr>
            <th>user</th>
            <th>name</th>
            <th>phone</th>
            <th>email</th>
            <th>type</th>
            </tr>
            </thead>
            <tbody>
            ');
            while ($eventResult = $sql->fetch()) {
              $sql2 = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
              $sql2->execute([$eventResult['user_id']]);
              while ($userResults = $sql2->fetch()) {
                echo("<tr>");
                echo("<td><p>" . $userResults['user_uid'] . "</p></td>");
                echo("<td><p>" . $userResults['user_first'] . " " . $userResults['user_last'] . "</p></td>");
                echo("<td><p>" . $userResults['user_phone'] . "</p></td>");
                echo("<td><p>" . $userResults['user_email'] . "</p></td>");
                echo("<td><p>" . $userResults['user_type'] . "</p></td>");
                echo("</tr>");
              }
            }
            echo("
            </tbody>
            </table>");
          } else {
            echo("<p>There are no users going to this event</p>");
          }
          echo("<button id='" . $m->getID() . "' class='btn btn-danger rem-event-btn'>Remove</button>");
          echo("</div><hr>");
      }
      echo("<div>There are no more events</div>");
    }
  }
}
?>
