<?php
if(isset($_POST['submit']))
{
        require 'connect.php';

        $a1 = $_POST['a1'];
        $a2 = $_POST['a2'];
        $a3 = $_POST['a3'];

        $sql = $conn->prepare('SELECT * FROM users WHERE user_a1=?');
        $sql->execute([$a1]);
        if($sql->rowCount() > 0)
        {
            while($result = $sql->fetch())
            {
                if($a1 === $result['user_a1'] && $a2 === $result['user_a2'] && $a3 === $result['user_a3'])
                {
                		session_start();
                		$_SESSION['user_uid'] = $result['user_uid'];
                        exit('success');
                }
                else
                {
                        exit('error200');
                }
            }
        }
        else
        {
            exit('error100');
        }
}
else
{
    header("Location: ../index.php");
}
?>
