<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

    $reset_email = $_POST['reset_email'];
    $reset_pw = $_POST['reset_pw'];
    $reset_pw2 = $_POST['reset_pw2'];

    $errorEmpty = false;
    $errorPwMatch = false;
    $errorEmail = false;

    if(empty($reset_email) || empty($reset_pw) || empty($reset_pw2))
    {
        echo("<span class='form-error'>Fill in all fields</span>");
        $errorEmpty = true;
    }
    else if($reset_pw != $reset_pw2)
    {
        echo("<span class='form-error'>Passwords do not match</span>");
        $errorPwMatch = true;
    }
    else
    {
        $sql = $conn->prepare('SELECT * FROM users WHERE user_email = ?');
        $sql->execute([$reset_email]);
        if($sql->rowCount() > 0)
        {
            $hashPwd = password_hash($reset_pw, PASSWORD_DEFAULT);

            $sql2 = $conn->prepare('UPDATE users SET user_pw = ? WHERE user_email = ?');
            $sql2->execute([$hashPwd, $reset_email]);

            echo("<span class='form-success'>Success~!</span>");
        }
        else
        {
            echo("<span class='form-error'>There is no user with the email: ". $reset_email ."</span>");
            $errorEmail = true;
        }
    }
}
else
{
		header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
    $("#reset-email, #reset-pw, #reset-pw2").removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorPwMatch = "<?php echo $errorPwMatch ?>";
    var errorEmail = "<?php echo $errorEmail ?>";

    if(errorEmpty == true)
    {
        $("#reset-email, #reset-pw, #reset-pw2").addClass("input-error");
    }
    if(errorPwMatch == true)
    {
        $("#reset-pw, #reset-pw2").addClass("input-error");
    }
    if(errorEmail == true)
    {
        $("#reset-email").addClass("input-error");
    }
    if(errorEmpty == false && errorEmail == false && errorPwMatch == false)
    {
        $("#reset-email, #reset-pw, #reset-pw2").val("");
    }
</script>
