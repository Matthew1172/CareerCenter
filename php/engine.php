<?php
function getEventList($conn)
{
    $eventListArray = array();
    $sql = $conn->prepare("SELECT * FROM events ORDER BY dateStamp DESC");
    $sql->execute();
    while($result = $sql->fetch(PDO::FETCH_ASSOC))
    {
        $eventListArray[] = new Event($result['event_id'], $result['title'], $result['description'], $result['location'], $result['dateStamp'], $result['startTime'], $result['endTime'], $result['isMedical'], $result['isIT'], $result['isHealthcare'], $result['isBusiness'], $result['isFoodservice'], $result['isHospitality'], $result['isCulinary']);
    }
    return $eventListArray;
}

