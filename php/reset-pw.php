<?php
session_start();
if(isset($_POST['submit']))
{
  require 'connect.php';

  $reset_pw = $_POST['change_pw'];
  $reset_pw2 = $_POST['change_pw2'];

  $errorEmpty = false;
  $errorPwMatch = false;
  $errorPw = false;

  if(empty($reset_pw) || empty($reset_pw2))
  {
    echo("<span class='form-error'>please fill in all fields.</span>");
    $errorEmpty = true;
  }
  else if($reset_pw != $reset_pw2)
  {
    echo("<span class='form-error'>passwords do not match.</span>");
    $errorPwMatch = true;
  }
  else if(!preg_match("/^[a-zA-Z0-9!?@$*&%]*$/", $reset_pw) || strlen($reset_pw) < 8)
  {
    echo("<span class='form-error'>please put a valid password.</span>");
    $errorPw = true;
  }
  else
  {
    $hashPwd = password_hash($reset_pw, PASSWORD_DEFAULT);
    $sql2 = $conn->prepare('UPDATE users SET user_pw = ? WHERE user_uid = ?');
    $sql2->execute([$hashPwd, $_SESSION['user_uid']]);
    echo("<span class='form-success'>successfully changed password.</span>");
  }
}
else
{
  header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
$(".rPw").removeClass("input-error");

var errorEmpty = "<?php echo $errorEmpty ?>";
var errorPwMatch = "<?php echo $errorPwMatch ?>";
var errorPw = "<?php echo $errorPw ?>";

if(errorEmpty == true)
{
  $(".rPw").addClass("input-error");
}
if(errorPwMatch == true)
{
  $(".rPw").addClass("input-error");
}
if(errorPw == true)
{
  $(".rPw").addClass("input-error");
}
if(errorEmpty == false && errorPwMatch == false && errorPw == false)
{
  $(".rPw").val("");
}
</script>
