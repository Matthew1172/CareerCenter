<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

    $reset_pw = $_POST['change_pw'];
    $reset_pw2 = $_POST['change_pw2'];

    $errorEmpty = false;
    $errorPwMatch = false;

    if(empty($reset_pw) || empty($reset_pw2))
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
            $hashPwd = password_hash($reset_pw, PASSWORD_DEFAULT);
            $sql2 = $conn->prepare('UPDATE users SET user_pw = ? WHERE user_uid = ?');
            $sql2->execute([$hashPwd, $_SESSION['user_uid']]);
            echo("<span class='form-success'>Successfully changed password.</span>");
    }
}
else
{
		header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
    $("#change-pw-input, #change-pw2-input").removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorPwMatch = "<?php echo $errorPwMatch ?>";

    if(errorEmpty == true)
    {
        $("#change-pw-input, #change-pw2-input").addClass("input-error");
    }
    if(errorPwMatch == true)
    {
        $("#change-pw-input, #change-pw2-input").addClass("input-error");
    }
    if(errorEmpty == false && errorPwMatch == false)
    {
        $("#change-pw-input, #change-pw2-input").val("");
    }
</script>
