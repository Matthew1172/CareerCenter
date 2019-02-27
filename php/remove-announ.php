<?php
session_start();
if (isset($_SESSION['user_uid']))
{
  include 'connect.php';

  $btnSubData = $_POST['ID'];

  $stm = $conn->prepare('DELETE FROM announcements WHERE id=?');
  $stm->execute([$btnSubData]);
}
?>
