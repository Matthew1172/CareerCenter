<?php
session_start();
if (isset($_SESSION['user_uid']))
{
    include 'connect.php';
    $announcementNewCount = $_POST['announcementNewCount'];
    $stm = $conn->prepare('SELECT * FROM announcements ORDER BY dateStamp DESC LIMIT ' . $announcementNewCount . ';');
    $stm->execute();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC))
    {
        echo"<div class='my-2 p-2'>";
        echo "<h4>" . $row["title"] . "</h4>";
        echo "<p>" . $row["description"];
        echo"<br />";
        echo"<br />";
        echo "<b>Date posted: </b>" . $row["dateStamp"];
        echo"</p></div><hr>";
    }
}
?>
