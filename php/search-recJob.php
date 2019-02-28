<?php
session_start();
include 'connect.php';
$sql1 = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
$sql1->execute([$_SESSION['user_uid']]);
$userResult = $sql1->fetch();

$stmOccupations = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
$stmOccupations->execute([$userResult['user_id']]);
$userOccupation = $stmOccupations->fetch(PDO::FETCH_ASSOC);

$sql2 = $conn->prepare("SELECT * FROM jobs WHERE job_title LIKE '%".$_POST["txt"]."%' ORDER BY dateStamp DESC");
$sql2->execute();
if ($sql2->rowCount() > 0) {
  $response = "";
  while($data = $sql2->fetch()){
      if(
        ($data['isMedical'] == 'true' && $userOccupation['isMedical'] == 'true') ||
        ($data['isIT'] == 'true' && $userOccupation['isIT'] == 'true') ||
        ($data['isHealthcare'] == 'true' && $userOccupation['isHealthcare'] == 'true') ||
        ($data['isBusiness'] == 'true' && $userOccupation['isBusiness'] == 'true') ||
        ($data['isFoodservice'] == 'true' && $userOccupation['isFoodservice'] == 'true') ||
        ($data['isHospitality'] == 'true' && $userOccupation['isHospitality'] == 'true') ||
        ($data['isCulinary'] == 'true' && $userOccupation['isCulinary'] == 'true')
        )
        {
          $response .= printJob($data);
        }
  }
  echo($response);
}else{
  echo('No jobs found.');
}
?>
