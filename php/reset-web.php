<?php
session_start();
if(isset($_POST['submit']))
{
  require 'connect.php';

  $reset_web = $_POST['change_web'];
  $reset_web2 = $_POST['change_web2'];

  $errorEmpty = false;
  $errorMatch = false;
  $errorValid = false;

  if(empty($reset_web) || empty($reset_web2))
  {
    echo("<span class='form-error'>Please fill in all fields.</span>");
    $errorEmpty = true;
  }
  else if($reset_web != $reset_web2)
  {
    echo("<span class='form-error'>Fields do not match.</span>");
    $errorMatch = true;
  }
  else if (!filter_var($reset_web, FILTER_VALIDATE_URL))
  {
    echo("<span class='form-error'>Please put a valid URL.</span>");
    $errorValid = true;
  }
  else
  {
    $sql = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
    $sql->execute([$_SESSION['user_uid']]);
    $userResult = $sql->fetch();

    $sql2 = $conn->prepare('UPDATE employers SET employer_web = ? WHERE user_id = ?');
    $sql2->execute([$reset_web, $userResult['user_id']]);
    echo("<span class='form-success'>Successfully updated URL.</span>");
  }
}
else
{
  header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
$(".rWeb").removeClass("input-error");

var errorEmpty = "<?php echo $errorEmpty ?>";
var errorMatch = "<?php echo $errorMatch ?>";
var errorValid = "<?php echo $errorValid ?>";

if(errorEmpty == true)
{
  $(".rWeb").addClass("input-error");
}
if(errorMatch == true)
{
  $(".rWeb").addClass("input-error");
}
if(errorValid == true)
{
  $(".rWeb").addClass("input-error");
}
if(errorEmpty == false && errorValid == false && errorMatch == false)
{
  $(".rWeb").val("");
}
</script>
