<?php
$id = $_GET['id'];
session_start();
if($_SESSION['user_uid'])
{
  include 'php/connect.php';
  $stm = $conn->prepare("SELECT * FROM users WHERE user_uid = ?");
  $stm->execute([$_SESSION['user_uid']]);
  $userResult = $stm->fetch();

  $stm2 = $conn->prepare("SELECT * FROM seekers WHERE user_id = ?");
  $stm2->execute([$userResult['user_id']]);
  $seekerResult = $stm2->fetch();

  if($seekerResult['seeker_id'] == $id || $userResult['user_type'] == 'admin')
  {
    $stm5 = $conn->prepare("SELECT * FROM resume WHERE seeker_id = ?");
    $stm5->execute([$id]);
    $row = $stm5->fetch();
    header('Content-Type: '.$row['file_type']);
    echo($row['file_data']);
  }else{
    header("Location: home.php?error=accessdenied");
  }
}else{
  header("Location: index.php?error=signin");
}
?>
