<?php
session_start();
if (isset($_POST['getData'])) {
  include 'connect.php';

  $sql1 = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $sql1->execute([$_SESSION['user_uid']]);
  $userResult = $sql1->fetch();

  $start = $_POST['start'];
  $limit = $_POST['limit'];

  $sql = $conn->prepare('SELECT * FROM user_event WHERE user_id = ? LIMIT ?, ?');
	$sql->execute([$userResult['user_id'], $start, $limit]);
  if ($sql->rowCount() > 0) {
    $response = "";
    while($result = $sql->fetch()) {
      $stm2 = $conn->prepare('SELECT * FROM events WHERE event_id = ? ORDER BY dateStamp DESC');
      $stm2->execute([$result['event_id']]);
      while($data = $stm2->fetch(PDO::FETCH_ASSOC))
      {
        $response .= printEvent($conn, $_SESSION['user_uid'], $data);
      }
    }
    exit($response);
  }else{
    exit('reachedMax');
  }
}
?>
