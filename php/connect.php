<?php
include 'event-class.php';
include 'job-class.php';

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

function getJobList($conn)
{
    $jobListArray = array();
    $sql = $conn->prepare("SELECT * FROM jobs ORDER BY dateStamp DESC");
    $sql->execute();
    while($result = $sql->fetch(PDO::FETCH_ASSOC))
    {
        $jobListArray[] = new Job($result['job_id'], $result['employer_id'], $result['job_title'], $result['job_description'], $result['job_position'], $result['location'], $result['isMedical'], $result['isIT'], $result['isHealthcare'], $result['isBusiness'], $result['isFoodservice'], $result['isHospitality'], $result['isCulinary'], $result['dateStamp']);
    }
    return $jobListArray;
}

function getOwnJobList($conn, $user_uid)
{
    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid = ?");
    $sql->execute([$user_uid]);
    $userResult = $sql->fetch(PDO::FETCH_ASSOC);
        $sql2 = $conn->prepare("SELECT * FROM employers WHERE user_id = ?");
        $sql2->execute([$userResult['user_id']]);
            $employerResult = $sql2->fetch(PDO::FETCH_ASSOC);     
            $jobOwnListArray = array();
            $sql3 = $conn->prepare("SELECT * FROM jobs WHERE employer_id = ? ORDER BY dateStamp DESC");
            $sql3->execute([$employerResult['employer_id']]);
                while($result = $sql3->fetch(PDO::FETCH_ASSOC))
                {
                    $jobOwnListArray[] = new Job($result['job_id'], $result['employer_id'], $result['job_title'], $result['job_description'], $result['job_position'], $result['job_location'], $result['isMedical'], $result['isIT'], $result['isHealthcare'], $result['isBusiness'], $result['isFoodservice'], $result['isHospitality'], $result['isCulinary'], $result['dateStamp']);
                }
                return $jobOwnListArray;
}

function getJobRecList($conn, $user_uid)
{
    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid = ?");
    $sql->execute([$user_uid]);
    $userResult = $sql->fetch(PDO::FETCH_ASSOC);
    
    $stmOccupations = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
    $stmOccupations->execute([$userResult['user_id']]);
    $userOccupation = $stmOccupations->fetch(PDO::FETCH_ASSOC);
    
    $jobListRecArray = array();
    foreach(getJobList($conn) as $e)
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
            $jobListRecArray[] = new Job($e->getID(), $e->getEmployerID(), $e->getTitle(), $e->getDesc(), $e->getPos(), $e->getLoc(), $e->getMed(), $e->getIT(), $e->getHealth(), $e->getBus(), $e->getFood(), $e->getHosp(), $e->getCul(), $e->getDate());
        }    
    }
    return $jobListRecArray;
}