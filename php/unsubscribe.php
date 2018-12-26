<?php
session_start();
if (isset($_SESSION['user_uid']))
{
    include 'connect.php';

        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

    $btnSubData = $_POST['ID'];

    $stm = $conn->prepare('DELETE FROM user_event WHERE user_id=? AND event_id=?');
    $stm->execute([$result['user_id'], $btnSubData]);
}
?>
