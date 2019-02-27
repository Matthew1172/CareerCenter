<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

    $reset_phone = preg_replace("/[^0-9]/", "", $_POST['change_phone']);
    $reset_phone2 = preg_replace("/[^0-9]/", "", $_POST['change_phone2']);

    $errorEmpty = false;
    $errorPhoneMatch = false;
    $errorPhone = false;

    if(empty($reset_phone) || empty($reset_phone2))
    {
        echo("<span class='form-error'>please fill in all fields.</span>");
        $errorEmpty = true;
    }
    else if($reset_phone != $reset_phone2)
    {
        echo("<span class='form-error'>phone numbers do not match.</span>");
        $errorPhoneMatch = true;
    }
    else if(strlen($reset_phone) != 11)
    {
        echo("<span class='form-error'>please put a valid phone number.</span>");
        $errorPhone = true;
    }
    else
    {
            $sql2 = $conn->prepare('UPDATE users SET user_phone = ? WHERE user_uid = ?');
            $sql2->execute([$reset_phone, $_SESSION['user_uid']]);
            echo("<span class='form-success'>successfully changed phone number.</span>");
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
    var errorPhone = "<?php echo $errorPhone ?>";

    if(errorEmpty == true)
    {
        $("#change-phone-input, #change-phone2-input").addClass("input-error");
    }
    if(errorPhoneMatch == true)
    {
        $("#change-phone-input, #change-phone2-input").addClass("input-error");
    }
    if(errorPhone == true)
    {
        $("#change-phone-input, #change-phone2-input").addClass("input-error");
    }
    if(errorEmpty == false && errorPhoneMatch == false && errorPhone == false)
    {
        $("#change-phone-input, #change-phone2-input").val("+1");
    }
</script>
