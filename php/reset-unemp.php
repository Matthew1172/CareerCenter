<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid = ?");
    $sql->execute([$_SESSION['user_uid']]);
    //$sql->execute(['jsmith123']);
    $userResult = $sql->fetch(PDO::FETCH_ASSOC);

    $reset_unemp = $_POST['change_unemp'];
    $reset_unemp2 = $_POST['change_unemp2'];

    $errorEmpty = false;
    $errorMatch = false;
    $errorUnemp = false;
    $errorNum = false;

    if(!is_numeric($reset_unemp))
    {
        echo("<span class='form-error'>Please enter only the 10 digit number</span>");
        $errorNum = true;
    }
    else if(empty($reset_unemp) || empty($reset_unemp2))
    {
        echo("<span class='form-error'>Please fill in all fields.</span>");
        $errorEmpty = true;
    }
    else if($reset_unemp != $reset_unemp2)
    {
        echo("<span class='form-error'>State unemployment numbers do not match.</span>");
        $errorMatch = true;
    }
    else if(strlen($reset_unemp) != 10)
    {
        echo("<span class='form-error'>Please put a valid state unemployment number.</span>");
        $errorUnemp = true;
    }
    else
    {
            $sql2 = $conn->prepare('UPDATE employers SET employer_unemployNum = ? WHERE user_id = ?');
            $sql2->execute([$reset_unemp, $userResult['user_id']]);
            echo("<span class='form-success'>Successfully changed state unemployment number.</span>");
    }
}
else
{
		header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
    $(".rUnemp").removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorMatch = "<?php echo $errorMatch ?>";
    var errorUnemp = "<?php echo $errorUnemp ?>";
    var errorNum = "<?php echo $errorNum ?>";

    if(errorEmpty == true)
    {
        $(".rUnemp").addClass("input-error");
    }
    if(errorMatch == true)
    {
        $(".rUnemp").addClass("input-error");
    }
    if(errorUnemp == true)
    {
        $(".rUnemp").addClass("input-error");
    }
    if(errorNum == true)
    {
        $(".rUnemp").addClass("input-error");
    }
    if(errorEmpty == false && errorMatch == false && errorUnemp == false && errorNum == false)
    {
        $(".rUnemp").val("");
    }
</script>
