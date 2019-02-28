<?php
session_start();
if (isset($_POST['getData'])) {
  include 'connect.php';

  $sql = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $sql->execute([$_SESSION['user_uid']]);
  $userResult = $sql->fetch();
  $sql1 = $conn->prepare('SELECT * FROM employers WHERE user_id = ?');
  $sql1->execute([$userResult['user_id']]);
  $employerResult = $sql1->fetch();

  $start = $_POST['start'];
  $limit = $_POST['limit'];

  $sql2 = $conn->prepare('SELECT * FROM jobs WHERE employer_id = ? LIMIT ?, ?');
  $sql2->execute([$employerResult['employer_id'], $start, $limit]);
  if ($sql2->rowCount() > 0) {
    $response = "";
    while($data = $sql2->fetch()) {
      $response .= "<div id='job" . $data['job_id'] . "' class='event my-4'>".
      "<h3>". $data['job_title'] ."</h3>".
      "<p>". $data['job_description'] ."</p>".
      "<p>Location: ". $data['job_location'] ."</p>".
      "<button id='" . $data['job_id'] . "' class='btn btn-danger rem-btn'>Remove</button>".
      "</div><hr>";
    }
    exit($response);
  }else{
    exit('reachedMax');
  }
}
?>
