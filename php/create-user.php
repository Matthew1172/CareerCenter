<?php
if(isset($_POST['signup-submit']))
{
require 'connect.php';

$user_first = $_POST['user_first'];
$user_last = $_POST ['user_last'] ;
$user_email = $_POST ['user_email'] ;
$user_uid = $_POST ['user_uid'] ;
$user_pw = $_POST ['user_pw'] ;

if(empty($user_first) || empty($user_last) || empty($user_email) || empty($user_uid) || empty($user_pw))
{
	header("Location: ../index.php?error=emptyfield");
	exit();
}
else if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
{
	header("Location: ../index.php?error=invalidemail&user_first=" . $user_first ."&user_last=". $user_last );
	exit();
}
else if(!preg_match("/^[a-zA-Z0-9]*$/", $user_uid))
{
	header("Location: ../index.php?error=invaliduid");
	exit();
}
else
{

$sql = $conn->prepare('SELECT user_uid FROM users WHERE user_uid=?');
$sql->execute([$user_uid]);
$result = $sql->fetch();

if(!$result)
{

$hashPwd = password_hash($user_pw, PASSWORD_DEFAULT);

$stm = $conn->prepare('INSERT INTO users(user_first, user_last, user_email, user_uid, user_pw) VALUES (?, ?, ?, ?, ?)');
$stm->execute([$user_first, $user_last, $user_email, $user_uid, $hashPwd]);
$usr = $stm->fetch();



echo("<p>");
echo($user_first . '<br>');
echo($user_last . '<br>');
echo($user_email . '<br>');
echo($user_uid . '<br>');
echo($user_pw . '<br>');
echo($hashPwd . '<br>');
echo("</p>");
}
else
{
	echo("username taken");
}

}
}
?>
