<?php
include 'event-class.php';

$conn;
$host = 'localhost';
$db = 'foo';
$username = 'eddy';
$pw = '1';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8";

	try
	{
		$conn = new PDO($dsn, $username, $pw);
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
	  echo $e->getMessage();
	}
        
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

function getOwnEventList($conn, $user_id)
{
    $eventListOwnArray = array();
    $stm = $conn->prepare('SELECT * FROM user_event WHERE user_id = ?');
    $stm->execute([$user_id]);
    while($map_result = $stm->fetch(PDO::FETCH_ASSOC))
    {
        $stm2 = $conn->prepare('SELECT * FROM events WHERE event_id = ? ORDER BY dateStamp DESC');
        $stm2->execute([$map_result['event_id']]);
        while($result = $stm2->fetch(PDO::FETCH_ASSOC))
        {
            $eventListOwnArray[] = new Event($result['event_id'], $result['title'], $result['description'], $result['location'], $result['dateStamp'], $result['startTime'], $result['endTime'], $result['isMedical'], $result['isIT'], $result['isHealthcare'], $result['isBusiness'], $result['isFoodservice'], $result['isHospitality'], $result['isCulinary']);
        }
    }
    return $eventListOwnArray;
}

function getWorkRecList($conn, $user_id)
{
    $eventListRecArray = array();
    $stmOccupations = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
    $stmOccupations->execute([$user_id]);
    $userOccupation = $stmOccupations->fetch(PDO::FETCH_ASSOC);
    foreach(getEventList($conn) as $e)
    {
        if(
              ($e->getMed() == 'true' && $userOccupation['medical'] == 'true') ||
              ($e->getIT() == 'true' && $userOccupation['IT'] == 'true') ||
              ($e->getHealth() == 'true' && $userOccupation['healthcare'] == 'true') ||
              ($e->getBus() == 'true' && $userOccupation['business'] == 'true') ||
              ($e->getFood() == 'true' && $userOccupation['foodservice'] == 'true') ||
              ($e->getHosp() == 'true' && $userOccupation['hospitality'] == 'true') ||
              ($e->getCul() == 'true' && $userOccupation['culinary'] == 'true')
              )
        {
        $eventListRecArray[] = new Event($e->getID(), $e->getTitle(), $e->getDesc(), $e->getLoc(), $e->getDateStamp(), $e->getStart(), $e->getEnd(), $e->getMed(), $e->getIT(), $e->getHealth(), $e->getBus(), $e->getFood(), $e->getHosp(), $e->getCul());
        }    
    }
    return $eventListRecArray;
}
