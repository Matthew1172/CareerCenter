<?php
session_start();
if($_SESSION['user_uid'])
{
  include 'connect.php';

  $stm = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $stm->execute([$_SESSION['user_uid']]);
  $result = $stm->fetch();

  $stm2 = $conn->prepare('SELECT * FROM seekers WHERE user_id = ?');
  $stm2->execute([$result['user_id']]);
  $seekerResult = $stm2->fetch();

  $name = $_FILES["resume"]["name"];
  $type = $_FILES["resume"]["type"];
  $data = file_get_contents($_FILES["resume"]["tmp_name"]);

  $stm = $conn->prepare('INSERT INTO resume(seeker_id, file_data, file_type, file_name) VALUES (?, ?, ?, ?)');
  $stm->execute([$seekerResult['seeker_id'], $data, $type, $name]);
}
?>
