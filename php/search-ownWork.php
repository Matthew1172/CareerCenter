<?php
session_start();
include 'connect.php';
$sql1 = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
$sql1->execute([$_SESSION['user_uid']]);
$userResult = $sql1->fetch();

$sql2 = $conn->prepare('SELECT * FROM user_event WHERE user_id = ?');
$sql2->execute([$userResult['user_id']]);
if ($sql2->rowCount() > 0) {
  $response = "";
  while($result = $sql2->fetch()){
    $sql3 = $conn->prepare("SELECT * FROM events WHERE event_id = ? AND title LIKE '%".$_POST["txt"]."%' ORDER BY dateStamp DESC");
    $sql3->execute([$result['event_id']]);
      while($data = $sql3->fetch(PDO::FETCH_ASSOC))
      {
        $response .= printEvent($conn, $_SESSION['user_uid'], $data);
      }
  }
  echo($response);
}else{
  echo('Nothing to search.');
}
?>
