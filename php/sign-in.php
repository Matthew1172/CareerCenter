<?php
if(isset($_POST['login-submit']))
{
require 'connect.php';

$user_uid = $_POST['user_uid'];
$user_pw_unhashed = $_POST['user_pw'];
if(empty($user_uid) || empty($user_pw_unhashed))
{
        header("Location: ../pages/index.php?error=emptyfield");
        exit();
}
$sql = $conn->prepare('SELECT user_uid FROM users WHERE user_uid=?');
$sql->execute([$user_uid]);
$uid_result = $sql->fetch();
if($uid_result)
{
	$sql = $conn->prepare('SELECT user_pw FROM users WHERE user_uid=?');
	$sql->execute([$user_uid]);
	$result = $sql->fetch();

	$pw_check = password_verify($user_pw_unhashed, $result['user_pw']);

	if($pw_check == false)
	{
		header("Location: ../pages/index.php?error=wrongpw");
		exit();
	}
	else if($pw_check == true)
	{
		session_start();
		$_SESSION['user_uid'] = $uid_result['user_uid'];
		header("Location: ../pages/index.php?login=success" . $result['user_uid']);
        exit();
	}
	else
	{
		header("Location: ../pages/index.php?error=wrongpw");
		exit();
	}
}
else
{
		header("Location: ../pages/index.php?error=invalidUserName");
        exit();
}
//end
}
else
{
	header("Location: ../pages/index.php");
}
?>
