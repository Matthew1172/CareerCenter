<?php
include 'connect.php';
session_start();
$sql1 = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
$sql1->execute([$_SESSION['user_uid']]);
$result = $sql1->fetch(PDO::FETCH_ASSOC);
if (isset($_SESSION['user_uid']) && $result['user_type'] !== 'admin')
{


    $btnSubData = $_POST['ID'];

    $sql2 = $conn->prepare("SELECT * FROM user_event WHERE user_id=?");
    $sql2->execute([$result['user_id']]);

    while($resultMatch = $sql2->fetch(PDO::FETCH_ASSOC))
    {
      if($resultMatch['event_id'] == $btnSubData)
      {
        exit('error100');
      }
    }

    $sql3 = $conn->prepare('INSERT INTO user_event(user_id, event_id) VALUES (?, ?)');
    $sql3->execute([$result['user_id'], $btnSubData]);
}else{
  header("Location: ../index.php?error=notsignedin");
}
?>
