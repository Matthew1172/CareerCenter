<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid = ?");
    $sql->execute([$_SESSION['user_uid']]);
    //$sql->execute(['jsmith123']);
    $userResult = $sql->fetch(PDO::FETCH_ASSOC);

    $reset_StateNum = $_POST['change_stateNum'];
    $reset_StateNum2 = $_POST['change_stateNum2'];

    $errorEmpty = false;
    $errorMatch = false;
    $errorStateNum = false;
    $errorNum = false;

    if(!is_numeric($reset_StateNum))
    {
        echo("<span class='form-error'>please enter only the 10 digit number</span>");
        $errorNum = true;
    }
    else if(empty($reset_StateNum) || empty($reset_StateNum2))
    {
        echo("<span class='form-error'>please fill in all fields.</span>");
        $errorEmpty = true;
    }
    else if($reset_StateNum != $reset_StateNum2)
    {
        echo("<span class='form-error'>state unemployment numbers do not match.</span>");
        $errorMatch = true;
    }
    else if(strlen($reset_StateNum) != 10)
    {
        echo("<span class='form-error'>please put a valid state unemployment number.</span>");
        $errorStateNum = true;
    }
    else
    {
            $sql2 = $conn->prepare('UPDATE seekers SET user_stateNum = ? WHERE user_id = ?');
            $sql2->execute([$reset_StateNum, $userResult['user_id']]);
            echo("<span class='form-success'>successfully changed state unemployment number.</span>");
    }
}
else
{
		header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
    $(".rState").removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorMatch = "<?php echo $errorMatch ?>";
    var errorStateNum = "<?php echo $errorStateNum ?>";
    var errorNum = "<?php echo $errorNum ?>";

    if(errorEmpty == true)
    {
        $(".rState").addClass("input-error");
    }
    if(errorMatch == true)
    {
        $(".rState").addClass("input-error");
    }
    if(errorStateNum == true)
    {
        $(".rState").addClass("input-error");
    }
    if(errorNum == true)
    {
        $(".rState").addClass("input-error");
    }
    if(errorEmpty == false && errorStateNum == false && errorMatch == false && errorNum == false)
    {
        $(".rState").val("");
    }
</script>
