<?php
session_start();
if (isset($_POST['getData'])) {
  include 'connect.php';
  
  $start = $_POST['start'];
  $limit = $_POST['limit'];

  $sql2 = $conn->prepare('SELECT * FROM jobs LIMIT ?, ?');
  $sql2->execute([$start, $limit]);
  if ($sql2->rowCount() > 0) {
    $response = "";
    while($data = $sql2->fetch()) {
        $dt = new DateTime($date['dateStamp']);
        $response .=
        '<tr><td><p>' . $dt->format('Y-m-d') . '</p></td>
        <td><p>' . $data['job_title'] . '</p></td>
        <td><p>' . $data['job_location'] . '</p></td>';

        if (isset($_SESSION['user_uid'])) {
            $response .= "<td><form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $data['job_id'] . "' class='btn btn-primary job-btn' type='submit'>View</button></form></td>";
        } else {
            $response .= '<td><p>Login to view this job</p></td>';
        }
        $response .= '</tr>';
    }
    exit($response);
  }else{
    exit('reachedMax');
  }
}
?>
