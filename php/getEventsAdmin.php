<?php
if (isset($_POST['getData'])) {
  include 'connect.php';

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
      "<b>Date Posted: </b>" . $data['dateStamp'] . "<br/>" .
      "</div><hr>";
    }
    exit($response);
  }else{
    exit('reachedMax');
  }
}
?>
