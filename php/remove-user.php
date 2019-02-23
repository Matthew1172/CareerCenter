<?php
session_start();
if(isset($_SESSION['user_uid']) && isset($_POST['submit'])){
  include 'connect.php';

  $userID = $_POST['ID'];


  $sql = $conn->prepare("SELECT * FROM users WHERE user_id=?");
  $sql->execute([$userID]);
  $result = $sql->fetch(PDO::FETCH_ASSOC);

  if($result['user_type'] == 'employer'){
    $empSql = $conn->prepare('SELECT * FROM employers WHERE user_id = ?');
    $empSql->execute([$userID]);
    $empResult = $empSql->fetch();

    $stm = $conn->prepare('DELETE FROM jobs WHERE employer_id = ?');
    $stm->execute([$empResult['employer_id']]);
  }


  $stm = $conn->prepare('DELETE FROM user_occupations WHERE user_id = ?');
  $stm->execute([$userID]);
  $stm = $conn->prepare('DELETE FROM user_event WHERE user_id = ?');
  $stm->execute([$userID]);
  $stm = $conn->prepare('DELETE FROM seekers WHERE user_id = ?');
  $stm->execute([$userID]);
  $stm = $conn->prepare('DELETE FROM employers WHERE user_id = ?');
  $stm->execute([$userID]);
  $stm = $conn->prepare('DELETE FROM users WHERE user_id = ?');
  $stm->execute([$userID]);
}
?>
