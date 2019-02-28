<?php
session_start();
//if (isset($_POST['getData'])) {
include 'connect.php';

$sql1 = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
$sql1->execute([$_SESSION['user_uid']]);
$userResult = $sql1->fetch();

$start = $_POST['start'];
$limit = $_POST['limit'];

$sql = $conn->prepare('SELECT * FROM jobs ORDER BY dateStamp DESC LIMIT ?, ?');
$sql->execute([$start, $limit]);
if ($sql->rowCount() > 0) {
  $response = "";
  while($data = $sql->fetch()) {

    $stmOccupations = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
    $stmOccupations->execute([$userResult['user_id']]);
    $userOccupation = $stmOccupations->fetch(PDO::FETCH_ASSOC);

    if(
      ($data['isMedical'] == 'true' && $userOccupation['medical'] == 'true') ||
      ($data['isIT'] == 'true' && $userOccupation['IT'] == 'true') ||
      ($data['isHealthcare'] == 'true' && $userOccupation['healthcare'] == 'true') ||
      ($data['isBusiness'] == 'true' && $userOccupation['business'] == 'true') ||
      ($data['isFoodservice'] == 'true' && $userOccupation['foodservice'] == 'true') ||
      ($data['isHospitality'] == 'true' && $userOccupation['hospitality'] == 'true') ||
      ($data['isCulinary'] == 'true' && $userOccupation['culinary'] == 'true')
      )
      {
        $response .= "<div id='job" . $data['job_id'] . "' class='event my-4'>".
        "<h3>". $data['job_title'] ."</h3>".
        "<p>". $data['job_description'] ."</p>".
        "<p>Location: ". $data['job_location'] ."</p>".
        "<form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $data['job_id'] . "' class='btn btn-primary job-btn' type='submit'>View</button></form>".
        "</div><hr>";
      }
    }
    exit($response);
  }else{
    exit('reachedMax');
  }
  //}
  ?>
