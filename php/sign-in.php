<?php
if(isset($_POST['login']))
{
    require 'connect.php';

    $user_uid = $_POST['uid'];
    $user_pw_unhashed = $_POST['pw'];

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
        		exit('failed');
        	}
        	else if($pw_check == true)
        	{

        		session_start();
        		$_SESSION['user_uid'] = $uid_result['user_uid'] ;
                exit('success');

        	}
        	else
        	{
        		exit('failed');
        	}
        }
        else
        {
                exit('failed');
        }
}
else
{
	header("Location: ../index.php");
}
?>
