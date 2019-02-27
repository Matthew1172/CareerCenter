<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid = ?");
    $sql->execute([$_SESSION['user_uid']]);
    $userResult = $sql->fetch(PDO::FETCH_ASSOC);

    $reset_tax = $_POST['change_tax'];
    $reset_tax2 = $_POST['change_tax2'];

    $errorNum = false;
    $errorEmpty = false;
    $errorMatch = false;
    $errorTax = false;

    if(!is_numeric($reset_tax))
    {
        echo("<span class='form-error'>Please enter only the 10 digit number</span>");
        $errorNum = true;
    }
    else if(empty($reset_tax) || empty($reset_tax2))
    {
        echo("<span class='form-error'>Please fill in all fields.</span>");
        $errorEmpty = true;
    }
    else if($reset_tax != $reset_tax2)
    {
        echo("<span class='form-error'>Tax numbers do not match.</span>");
        $errorMatch = true;
    }
    else if(strlen($reset_tax) != 10)
    {
        echo("<span class='form-error'>Please put a valid tax number.</span>");
        $errorTax = true;
    }
    else
    {
            $sql2 = $conn->prepare('UPDATE employers SET employer_tax = ? WHERE user_id = ?');
            $sql2->execute([$reset_tax, $userResult['user_id']]);
            echo("<span class='form-success'>Successfully changed tax number.</span>");
    }
}
else
{
		header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
    $(".rTax").removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorMatch = "<?php echo $errorMatch ?>";
    var errorTax = "<?php echo $errorTax ?>";
    var errorNum = "<?php echo $errorNum ?>";

    if(errorEmpty == true)
    {
        $(".rTax").addClass("input-error");
    }
    if(errorMatch == true)
    {
        $(".rTax").addClass("input-error");
    }
    if(errorTax == true)
    {
        $(".rTax").addClass("input-error");
    }
    if(errorNum == true)
    {
        $(".rTax").addClass("input-error");
    }
    if(errorEmpty == false && errorMatch == false && errorTax == false && errorNum == false)
    {
        $(".rTax").val("");
    }
</script>
