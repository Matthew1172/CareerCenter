<?php
session_start();
if(isset($_POST['submit']))
{
  require 'connect.php';

  $ID = $_POST['ID'];
  $reset_pw = $_POST['reset_pw'];
  $reset_pw2 = $_POST['reset_pw2'];

  $errorEmpty = false;
  $errorPwMatch = false;
  $errorID = false;

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
    $sql = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
    $sql->execute([$ID]);
    if($sql->rowCount() > 0)
    {
      $hashPwd = password_hash($reset_pw, PASSWORD_DEFAULT);

      $sql2 = $conn->prepare('UPDATE users SET user_pw = ? WHERE user_id = ?');
      $sql2->execute([$hashPwd, $ID]);

      echo("<span class='form-success'>Successfully changed password.</span>");
    }
    else
    {
      echo("<span class='form-error'>The user with this ID does not exist. (Check database)</span>");
      $errorID = true;
    }
  }
}
else
{
  header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
$("#reset-pw, #reset-pw2").removeClass("input-error");

var errorEmpty = "<?php echo $errorEmpty ?>";
var errorPwMatch = "<?php echo $errorPwMatch ?>";

if(errorEmpty == true)
{
  $("#reset-pw, #reset-pw2").addClass("input-error");
}
if(errorPwMatch == true)
{
  $("#reset-pw, #reset-pw2").addClass("input-error");
}
if(errorEmpty == false && errorPwMatch == false)
{
  $("#reset-pw, #reset-pw2").val("");
}
</script>
