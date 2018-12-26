<?php

require 'connect.php';
require 'announcement.php';

function createAnnouncementList()
{

    include 'connect.php';

    $stm = $conn->prepare('SELECT * from announcements');
    $stm->execute();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC))
    {
        $newAnnouncement = new Announcement($row['id'], $row['title'], $row['description'], $row['dateStamp']);
        $announcementArray[] = $newAnnouncement;
    }
    return $announcementArray;
}
?>
