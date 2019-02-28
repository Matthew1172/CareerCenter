<?php
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

function getTags($jobListing)
{
	$tags = array();

	if($jobListing['isMedical'] == 'true')
	{
		$tags[] = 'medical';
	}
	if($jobListing['isIT'] == 'true')
	{
		$tags[] = 'IT';
	}
	if($jobListing['isHealthcare'] == 'true')
	{
		$tags[] = 'healthcare';
	}
	if($jobListing['isBusiness'] == 'true')
	{
		$tags[] = 'business';
	}
	if($jobListing['isFoodservice'] == 'true')
	{
		$tags[] = 'foodservice';
	}
	if($jobListing['isHospitality'] == 'true')
	{
		$tags[] = 'hospitality';
	}
	if($jobListing['isCulinary'] == 'true')
	{
		$tags[] = 'culinary';
	}

	return $tags;
}

function printEvent($conn, $user_uid, $eventPDO)
{
	$response = "";

	$sql1 = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
	$sql1->execute([$user_uid]);
	$result = $sql1->fetch();

	$response .=
	"<div id='event" . $eventPDO['event_id'] . "' class='event my-4'>" .
	"<h3 class='hThree'>" . $eventPDO['title'] . "</h3>" .
	"<p>" . $eventPDO['description'] . "</p><br/><br/>" .
	"<b>Location: </b>" . $eventPDO['location'] . "<br/>" .
	"<b>Date: </b>" . $eventPDO['startTime'] . "<br/>" .
	"<b>Date Posted: </b>" . $eventPDO['dateStamp'] . "<br/>";
	$tags = getTags($eventPDO);
	foreach($tags as $t)
	{
		$response .= '- ' . $t . '<br/>';
	}
	$stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
	$stm2->execute([$result['user_id']]);
	$map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
	if (!empty($map_result)) {
		$flag = false;
		foreach ($map_result as $a) {
			if ($a['event_id'] == $eventPDO['event_id']) {
				$response .= "<button id='" . $eventPDO['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>";
				$flag = true;
			}
		}
		if (!$flag) {
			$response .= "<button id='" . $eventPDO['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>";
		}
	} else {
		$response .= "<button id='" . $eventPDO['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>";
	}
	$response .= "</div><hr>";

	return $response;
}

function printJob($jobPDO)
{
	$response = "";

	$response .= "<div id='job" . $jobPDO['job_id'] . "' class='event my-4'>".
	"<h3 class='hThree'>". $jobPDO['job_title'] ."</h3>".
	"<p>". $jobPDO['job_description'] ."</p>".
	"<p>Location: ". $jobPDO['job_location'] ."</p>";
	$tags = getTags($jobPDO);
	foreach($tags as $t)
	{
		$response .= '- ' . $t . '<br/>';
	}
	$response .= "<form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobPDO['job_id'] . "' class='btn btn-primary job-btn' type='submit'>View</button></form>".
	"</div><hr>";

	return $response;
}
