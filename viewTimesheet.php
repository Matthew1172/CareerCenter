<?php
$id = $_GET['id'];
session_start();
include 'php/connect.php';
$stm5 = $conn->prepare("SELECT * FROM timesheets WHERE sheet_id = ?");
$stm5->execute([$id]);
$row = $stm5->fetch();
header('Content-Type: '.$row['sheet_type']);
echo($row['sheet_data']);
?>
