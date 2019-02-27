<?php
session_start();
if (isset($_SESSION['user_uid']))
{
  include 'connect.php';

  $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
  $sql->execute([$_SESSION['user_uid']]);
  $result = $sql->fetch(PDO::FETCH_ASSOC);

  if($result['user_type'] == 'admin')
  {
    $btnSubData = $_POST['ID'];
    $stm = $conn->prepare('DELETE FROM timesheets WHERE sheet_id = ?');
    $stm->execute([$btnSubData]);
  }
}
