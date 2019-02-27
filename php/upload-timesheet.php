<?php
session_start();
if($_SESSION['user_uid'])
{
  include 'connect.php';

  $stm = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $stm->execute([$_SESSION['user_uid']]);
  $result = $stm->fetch();

  if($result['user_type'] == 'admin')
  {
    $name = $_FILES["timesheet"]["name"];
    $type = $_FILES["timesheet"]["type"];
    $data = file_get_contents($_FILES["timesheet"]["tmp_name"]);

    $stm = $conn->prepare('INSERT INTO timesheets(sheet_dateStamp, sheet_data, sheet_type, sheet_name) VALUES (?, ?, ?, ?)');
    $stm->execute([date('Y-m-d H:i:s'), $data, $type, $name]);
  }else{
    header("Location: ../index.php?error=accessdenied");
  }
}
?>
<script>
  /*var error = <?php echo $error ?>;

  window.location.reload();
*/
</script>
