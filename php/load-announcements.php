<?php
    session_start();
    include 'connect.php';
    include '../htmlpurifier-4.10.0/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);

    $announcementNewCount = $_POST['announcementNewCount'];
    $stm = $conn->prepare('SELECT * FROM announcements ORDER BY dateStamp DESC LIMIT ' . $announcementNewCount . ';');
    $stm->execute();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC))
    {
      echo("<div class='my-2 p-2'>");
      echo("<h4>" . $purifier->purify($row["title"]) . "</h4>");
      echo("<h4>" . $purifier->purify($row["description"]) . "</h4>");
      echo("<br />");
      echo("<br />");
      echo("<b>Date posted: </b>" . $row["dateStamp"]);
      echo("</div><hr>");
    }
?>
