<?php
session_start();
if($_SESSION['user_uid'])
{
  try {

    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['resume']['error']) ||
        is_array($_FILES['resume']['error'])
    ) {
        exit('1');
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['resume']['error'] value.
    switch ($_FILES['resume']['error']) {
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
    if ($_FILES['resume']['size'] > 5000000) {
        exit('3');
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['resume']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['resume']['tmp_name']),
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

    include 'connect.php';

    $stm = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
    $stm->execute([$_SESSION['user_uid']]);
    $result = $stm->fetch();

    $stm2 = $conn->prepare('SELECT * FROM seekers WHERE user_id = ?');
    $stm2->execute([$result['user_id']]);
    $seekerResult = $stm2->fetch();

    $stm3 = $conn->prepare('SELECT * FROM resume WHERE seeker_id = ?');
    $stm3->execute([$seekerResult['seeker_id']]);
    if($stm3->rowCount() > 0)
    {
      $stm4 = $conn->prepare('DELETE FROM resume WHERE seeker_id = ?');
      $stm4->execute([$seekerResult['seeker_id']]);
    }

    //$name = $_FILES["resume"]["name"];
    $name = $_SESSION['user_uid'] . 'resume';
    $type = $_FILES["resume"]["type"];
    $data = file_get_contents($_FILES["resume"]["tmp_name"]);

    $stm = $conn->prepare('INSERT INTO resume(seeker_id, file_data, file_type, file_name) VALUES (?, ?, ?, ?)');
    $stm->execute([$seekerResult['seeker_id'], $data, $type, $name]);
    exit('6');

} catch (RuntimeException $e) {

    echo $e->getMessage();

}
}
?>
