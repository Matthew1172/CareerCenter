<?php
session_start();
if (isset($_POST['submit'])) {
  require 'connect.php';

  include '../htmlpurifier-4.10.0/library/HTMLPurifier.auto.php';
  $config = HTMLPurifier_Config::createDefault();
  $purifier = new HTMLPurifier($config);

  $announ_title = $_POST['title'];
  $announ_description = $purifier->purify($_POST['description']);
  $dateAndTimePosted = date('Y-m-d H:i:s');

  $errorEmpty = false;

  if (empty($announ_title) || empty($announ_description)) {
    echo("<span class='form-error'>Fill in all fields.</span>");
    $errorEmpty = true;
  } else {
    $sql = $conn->prepare('INSERT INTO announcements(title, description, dateStamp) VALUES(?, ?, ?)');
    $sql->execute([$announ_title, $announ_description, $dateAndTimePosted]);
    echo("<span class='form-success'>Success.</span>");
  }
} else {
  header("Location: ../sign-up-page.php?error=invaliduid");
}
?>
<script>
$("#announ-title, #announ-desc").removeClass("input-error");

var errorEmpty = "<?php echo $errorEmpty; ?>";

if (errorEmpty == true)
{
  $("#announ-title, #announ-desc").addClass("input-error");
}
if (errorEmpty == false)
{
  $("#announ-title, #announ-desc").val("");
}
</script>
