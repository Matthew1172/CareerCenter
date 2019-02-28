<?php
session_start();
if (isset($_POST['getData'])) {
  include 'connect.php';

  $sql1 = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $sql1->execute([$_SESSION['user_uid']]);
  $result = $sql1->fetch();

  $start = $_POST['start'];
  $limit = $_POST['limit'];

  $sql = $conn->prepare("SELECT * FROM events LIMIT ?, ?");
  $sql->execute([$start, $limit]);
  if ($sql->rowCount() > 0) {
    $response = "";
    while($data = $sql->fetch()) {
      $response .=
      "<div id='event" . $data['event_id'] . "' class='event my-4'>" .
      "<h3 class='hThree'>" . $data['title'] . "</h3>" .
      "<p>" . $data['description'] . "</p><br/><br/>" .
      "<b>Location: </b>" . $data['location'] . "<br/>" .
      "<b>Date: </b>" . $data['startTime'] . "<br/>" .
      "<b>Date Posted: </b>" . $data['dateStamp'] . "<br/>";
      $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
      $stm2->execute([$result['user_id']]);
      $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
      if (!empty($map_result)) {
        $flag = false;
        foreach ($map_result as $a) {
          if ($a['event_id'] == $data['event_id']) {
            $response .= "<button id='" . $data['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>";
            $flag = true;
          }
        }
        if (!$flag) {
          $response .= "<button id='" . $data['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>";
        }
      } else {
        $response .= "<button id='" . $data['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>";
      }
      $response .= "</div><hr>";
    }
    exit($response);
  }else{
    exit('reachedMax');
  }
}
?>
