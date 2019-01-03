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
        echo"<div class='event my-2 p-2'>";
        echo "<h3>" . $row["title"] . "</h3>";
        echo "<p>" . $row["description"];
        echo"<br />";
        echo"<br />";
        echo "<b>Date posted: </b>" . $row["dateStamp"];
        echo"</p></div><hr>";
    }
}
?>
