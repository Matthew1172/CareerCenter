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
    $errorUnempMatch = false;
    $errorUnemp = false;
    $errorNum = false;

    if(!is_numeric($reset_unemp))
    {
        echo("<span class='form-error'>please enter only the 10 digit number</span>");
        $errorNum = true;        
    }
    else if(empty($reset_unemp) || empty($reset_unemp2))
    {
        echo("<span class='form-error'>please fill in all fields.</span>");
        $errorEmpty = true;
    }
    else if($reset_unemp != $reset_unemp2)
    {
        echo("<span class='form-error'>state unemployment numbers do not match.</span>");
        $errorUnempMatch = true;
    }
    else if(strlen($reset_unemp) != 10)
    {
        echo("<span class='form-error'>please put a valid state unemployment number.</span>");
        $errorUnemp = true;
    }
    else
    {
            $sql2 = $conn->prepare('UPDATE seekers SET user_stateNum = ? WHERE user_id = ?');
            $sql2->execute([$reset_unemp, $userResult['user_id']]);
            echo("<span class='form-success'>successfully changed state unemployment number.</span>");
    }
}
else
{
		header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
    $("#change-unemp-input, #change-unemp2-input").removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorUnempMatch = "<?php echo $errorUnempMatch ?>";
    var errorUnemp = "<?php echo $errorUnemp ?>";
    var errorNum = "<?php echo $errorNum ?>";

    if(errorEmpty == true)
    {
        $("#change-unemp-input, #change-unemp2-input").addClass("input-error");
    }
    if(errorUnempMatch == true)
    {
        $("#change-unemp-input, #change-unemp2-input").addClass("input-error");
    }
    if(errorUnemp == true)
    {
        $("#change-unemp-input, #change-unemp2-input").addClass("input-error");
    }
    if(errorNum == true)
    {
        $("#change-unemp-input, #change-unemp2-input").addClass("input-error");
    }
    if(errorUnemp == false && errorUnempMatch == false && errorUnemp == false && errorNum == false)
    {
        $("#change-unemp-input, #change-unemp2-input").val("");
    }
</script>
