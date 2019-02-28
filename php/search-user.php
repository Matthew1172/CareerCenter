<?php
include 'connect.php';
$sql = $conn->prepare("SELECT * FROM users WHERE user_last LIKE '%".$_POST["txt"]."%'");
$sql->execute();
if($sql->rowCount() > 0)
{
  echo '<div class="container">
    <p class="pb-5 pt-3 text-muted">*For the best user experience, view on desktop.</p>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>First name</th>
          <th>Last name</th>
          <th>Email</th>
          <th>View</th>
        </tr>
      </thead>
      <tbody id="user-list">';
while($result = $sql->fetch()){
  echo '
    <tr>
    <td>'. $result['user_first'] .'</td>
    <td>'. $result['user_last'] .'</td>
    <td>'. $result['user_email'] .'</td>
    <td><form action="user-page.php" method="GET"><button name="user-btn-value" value='. $result['user_id'] .' class="btn btn-primary user-btn" type="submit">View</button></form></td>
    </tr>
  ';
}
  echo '
  </tbody>
  </table>
  </div>';
}
else {
  echo('No users found.');
}


?>
