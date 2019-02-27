<?php
session_start();
if (isset($_SESSION['user_uid']))
{
    include 'connect.php';

        $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
        $sql->execute([$_SESSION['user_uid']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        $sql = $conn->prepare("SELECT * FROM employers WHERE user_id=?");
        $sql->execute([$result['user_id']]);
        $employerResult = $sql->fetch();

    $btnSubData = $_POST['ID'];

    $stm = $conn->prepare('DELETE FROM jobs WHERE employer_id=? AND job_id=?');
    $stm->execute([$employerResult['employer_id'], $btnSubData]);
}
?>
