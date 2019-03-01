<?php
session_start();
if (isset($_POST['getData'])) {
  include 'connect.php';

  $start = $_POST['start'];
  $limit = $_POST['limit'];

  $sql = $conn->prepare("SELECT * FROM events ORDER BY dateStamp DESC LIMIT ?, ?");
  $sql->execute([$start, $limit]);
  if ($sql->rowCount() > 0) {
    $response = "";
    while($data = $sql->fetch()) {
      $response .=
      "<div id='event" . $data['event_id'] . "' class='event my-4 p-2'>" .
      "<h3 class='hThree'>" . $data['title'] . "</h3>";
      $sql2 = $conn->prepare('SELECT user_id FROM user_event WHERE event_id = ?');
      $sql2->execute([$data['event_id']]);
      if ($sql2->rowCount() > 0) {
        $response .=
        '<table class="table table-hover">
        <thead>
        <tr>
        <th>user</th>
        <th>name</th>
        <th>phone</th>
        <th>email</th>
        <th>type</th>
        </tr>
        </thead>
        <tbody>';
        while ($eventResult = $sql2->fetch()) {
          $sql3 = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
          $sql3->execute([$eventResult['user_id']]);
          while ($userResults = $sql3->fetch()) {
            $response .=
            "<tr>
            <td><p>" . $userResults['user_uid'] . "</p></td>
            <td><p>" . $userResults['user_first'] . " " . $userResults['user_last'] . "</p></td>
            <td><p>" . $userResults['user_phone'] . "</p></td>
            <td><p>" . $userResults['user_email'] . "</p></td>
            <td><p>" . $userResults['user_type'] . "</p></td>
            </tr>";
          }
        }
        $response .= "
        </tbody>
        </table>";
      } else {
        $response .= "<p>There are no users going to this event</p>";
      }
      $response .= "<button id='" . $data['event_id'] . "' class='btn btn-danger rem-event-btn'>Remove</button>";
      $response .= "</div><hr>";
    }
    exit($response);
  }else{
    exit('reachedMax');
  }
}
?>
