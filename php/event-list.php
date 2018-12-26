<?php

require 'connect.php';
require 'event.php';

function createEventList()
{

    include 'connect.php';

    $stm = $conn->prepare('SELECT * from events');
    $stm->execute();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC))
    {
        $newEvent = new Event($row['id'], $row['title'], $row['description'], $row['location'], $row['dateStamp'], $row['startTime'], $row['endTime'], $row['type']);
        $eventArray[] = $newEvent;
    }
    return $eventArray;
}
?>
