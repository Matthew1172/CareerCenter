<?php
session_start();
if(isset($_SESSION['user_uid']) && isset($_POST['submit'])){
  include 'connect.php';

  $userID = $_POST['ID'];

  $sql = $conn->prepare("SELECT * FROM users WHERE user_id=?");
  $sql->execute([$userID]);
  $result = $sql->fetch(PDO::FETCH_ASSOC);

  switch($result['user_type']){
    case 'employer':
    $empSql = $conn->prepare('SELECT * FROM employers WHERE user_id = ?');
    $empSql->execute([$userID]);
    $empResult = $empSql->fetch();

    $stm = $conn->prepare('DELETE FROM jobs WHERE employer_id = ?');
    $stm->execute([$empResult['employer_id']]);
    break;
    case 'user':
    $seekSql = $conn->prepare('SELECT * FROM seekers WHERE user_id = ?');
    $seekSql->execute([$userID]);
    $seekResult = $seekSql->fetch();

    $stm = $conn->prepare('DELETE FROM resume WHERE seeker_id = ?');
    $stm->execute([$seekResult['seeker_id']]);
    break;
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
