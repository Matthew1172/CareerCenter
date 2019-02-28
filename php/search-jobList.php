<?php
session_start();
include 'connect.php';
$sql = $conn->prepare("SELECT * FROM jobs WHERE job_title LIKE '%".$_POST["txt"]."%'");
$sql->execute();
if($sql->rowCount() > 0)
{
  while($data = $sql->fetch()){
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
  echo($response);
}
else {
  echo('No jobs found.');
}


?>
