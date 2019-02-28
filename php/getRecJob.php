<?php
session_start();
if (isset($_POST['getData'])) {
  include 'connect.php';

  $sql1 = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $sql1->execute([$_SESSION['user_uid']]);
  $userResult = $sql1->fetch();

  $stmOccupations = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
  $stmOccupations->execute([$userResult['user_id']]);
  $userOccupation = $stmOccupations->fetch(PDO::FETCH_ASSOC);

  $start = $_POST['start'];
  $limit = $_POST['limit'];

  $sql = $conn->prepare('SELECT * FROM jobs ORDER BY dateStamp DESC LIMIT ?, ?');
  $sql->execute([$start, $limit]);
  if ($sql->rowCount() > 0) {
    $response = "";
    while($data = $sql->fetch()) {
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
      exit($response);
    }else{
      exit('reachedMax');
    }
  }
  ?>
