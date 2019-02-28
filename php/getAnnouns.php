<?php
session_start();
if (isset($_POST['getData'])) {
  include 'connect.php';

  $sql = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $sql->execute([$_SESSION['user_uid']]);
  $userResult = $sql->fetch();

  $start = $_POST['start'];
  $limit = $_POST['limit'];

  $sql2 = $conn->prepare('SELECT * FROM announcements LIMIT ?, ?');
  $sql2->execute([$start, $limit]);
  if ($sql2->rowCount() > 0) {
    $response = "";
    while($data = $sql2->fetch()) {
        $response .= "<div id='announ" . $data['id'] . "' class='event my-4'>".
        "<h4>" . $data['title'] . "</h4>".
        "<p>" . $data['description'].
        "<br />".
        "<br />".
        "<b>Date posted: </b>" . $data['dateStamp'].
        "<br />".
        "<button id='" . $data['id'] . "' class='btn btn-danger rem-announ-btn'>Remove</button>".
        "</p></div><hr>";
    }
    exit($response);
  }else{
    exit('reachedMax');
  }
}
?>
