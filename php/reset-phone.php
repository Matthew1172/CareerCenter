<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

    $reset_phone = $_POST['change_phone'];
    $reset_phone2 = $_POST['change_phone2'];

    $errorEmpty = false;
    $errorPhoneMatch = false;

    if(empty($reset_phone) || empty($reset_phone2))
    {
        echo("<span class='form-error'>Fill in all fields</span>");
        $errorEmpty = true;
    }
    else if($reset_phone != $reset_phone2)
    {
        echo("<span class='form-error'>Phone numbers do not match</span>");
        $errorPhoneMatch = true;
    }
    else
    {
            $sql2 = $conn->prepare('UPDATE users SET user_phone = ? WHERE user_uid = ?');
            $sql2->execute([$reset_phone, $_SESSION['user_uid']]);
            echo("<span class='form-success'>Successfully changed phone number.</span>");
    }
}
else
{
		header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
    $("#change-phone-input, #change-phone2-input").removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorPhoneMatch = "<?php echo $errorPhoneMatch ?>";

    if(errorEmpty == true)
    {
        $("#change-phone-input, #change-phone2-input").addClass("input-error");
    }
    if(errorPhoneMatch == true)
    {
        $("#change-phone-input, #change-phone2-input").addClass("input-error");
    }
    if(errorEmpty == false && errorPhoneMatch == false)
    {
        $("#change-phone-input, #change-phone2-input").val("");
    }
</script>
