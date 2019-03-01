<?php
session_start();
if($_SESSION['user_uid'])
{
  include 'connect.php';
  $sql = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $sql->execute([$_SESSION['user_uid']]);
  $result = $sql->fetch();

  if($result['user_type'] == 'admin')
  {
    try {

      // Undefined | Multiple Files | $_FILES Corruption Attack
      // If this request falls under any of them, treat it invalid.
      if (
        !isset($_FILES['timesheet']['error']) ||
        is_array($_FILES['timesheet']['error'])
      ) {
        exit('1');
        throw new RuntimeException('Invalid parameters.');
      }

      // Check $_FILES['timesheet']['error'] value.
      switch ($_FILES['timesheet']['error']) {
        case UPLOAD_ERR_OK:
        break;
        case UPLOAD_ERR_NO_FILE:
        exit('2');
        throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
        exit('3');
        throw new RuntimeException('Exceeded filesize limit.');
        default:
        exit('4');
        throw new RuntimeException('Unknown errors.');
      }

      // You should also check filesize here.
      if ($_FILES['timesheet']['size'] > 10000000) {
        exit('3');
        throw new RuntimeException('Exceeded filesize limit.');
      }

      // DO NOT TRUST $_FILES['timesheet']['mime'] VALUE !!
      // Check MIME Type by yourself.
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      if (false === $ext = array_search(
        $finfo->file($_FILES['timesheet']['tmp_name']),
        array(
          'jpg' => 'image/jpeg',
          'jpeg' => 'image/jpeg',
          'png' => 'image/png',
          'pdf' => 'application/pdf',
        ),
        true
      )) {
        exit('5');
        throw new RuntimeException('Invalid file format.');
      }

      $name = 'WDBtimesheet' . date('Y-m-d');
      $type = $_FILES["timesheet"]["type"];
      $data = file_get_contents($_FILES["timesheet"]["tmp_name"]);

      $stm = $conn->prepare('INSERT INTO timesheets(sheet_dateStamp, sheet_data, sheet_type, sheet_name) VALUES (?, ?, ?, ?)');
      $stm->execute([date('Y-m-d H:i:s'), $data, $type, $name]);
      exit('6');

    } catch (RuntimeException $e) {
      echo $e->getMessage();
    }
  }else{
    header("Location: ../index.php?error=accessdenied");
  }
}
?>
