<?php
session_start();
if(isset($_POST['submit']))
{
  require 'connect.php';

  $reset_email = $_POST['change_email'];
  $reset_email2 = $_POST['change_email2'];

  $errorEmpty = false;
  $errorEmailMatch = false;
  $errorEmailValid = false;
  $errorEmailTaken = false;

  if(empty($reset_email) || empty($reset_email2))
  {
    echo("<span class='form-error'>Please fill in all fields.</span>");
    $errorEmpty = true;
  }
  else if($reset_email != $reset_email2)
  {
    echo("<span class='form-error'>Emails do not match.</span>");
    $errorEmailMatch = true;
  }
  else if(!filter_var($reset_email, FILTER_VALIDATE_EMAIL))
  {
    echo("<span class='form-error'>Please put a valid email.</span>");
    $errorEmailValid = true;
  }
  else
  {
    $sql = $conn->prepare('SELECT * FROM users WHERE user_email = ?');
    $sql->execute([$reset_email]);
    if($sql->rowCount() > 0)
    {
      echo("<span class='form-error'>This email address already has an account.</span>");
      $errorEmailTaken = true;
    }
    else
    {
      $sql2 = $conn->prepare('UPDATE users SET user_email = ? WHERE user_uid = ?');
      $sql2->execute([$reset_email, $_SESSION['user_uid']]);
      echo("<span class='form-success'>Successfully changed email address.</span>");
    }
  }
}
else
{
  header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
$(".rEmail").removeClass("input-error");

var errorEmpty = "<?php echo $errorEmpty ?>";
var errorEmailMatch = "<?php echo $errorEmailMatch ?>";
var errorEmailValid = "<?php echo $errorEmailValid ?>";
var errorEmailTaken = "<?php echo $errorEmailTaken ?>";

if(errorEmpty == true)
{
  $(".rEmail").addClass("input-error");
}
if(errorEmailMatch == true)
{
  $(".rEmail").addClass("input-error");
}
if(errorEmailValid == true)
{
  $(".rEmail").addClass("input-error");
}
if(errorEmailTaken == true)
{
  $(".rEmail").addClass("input-error");
}
if(errorEmpty == false && errorEmailTaken == false && errorEmailValid == false && errorEmailMatch == false)
{
  $(".rEmail").val("");
}
</script>
