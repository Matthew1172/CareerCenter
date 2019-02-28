<?php
session_start();
include 'connect.php';
$sql = $conn->prepare("SELECT * FROM events WHERE title LIKE '%".$_POST["txt"]."%' ORDER BY dateStamp DESC");
$sql->execute();
if($sql->rowCount() > 0)
{
  $response = "";
  while($data = $sql->fetch()){
    $response .= printEvent($conn, $_SESSION['user_uid'], $data);
  }
  echo($response);
}
else {
  echo('No jobs found.');
}


?>
