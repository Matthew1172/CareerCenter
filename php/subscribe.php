<?php
session_start();
if (isset($_SESSION['user_uid']))
{
    include 'connect.php';

        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

    $btnSubData = $_POST['ID'];
    
    $stm = $conn->prepare('INSERT INTO user_event(user_id, event_id) VALUES (?, ?)');
    $stm->execute([$result['user_id'], $btnSubData]);
}
?>
