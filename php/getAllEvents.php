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
      $response .= printEvent($conn, $_SESSION['user_uid'], $data);
    }
    exit($response);
  }else{
    exit('reachedMax');
  }
}
?>
