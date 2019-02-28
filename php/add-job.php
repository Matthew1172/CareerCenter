<?php
session_start();
if(isset($_POST['submit']))
{
  require 'connect.php';
  include '../htmlpurifier-4.10.0/library/HTMLPurifier.auto.php';
  $config = HTMLPurifier_Config::createDefault();
  $purifier = new HTMLPurifier($config);

  $job_title = $purifier->purify($_POST['title']);
  $job_description = $purifier->purify($_POST['description']);
  $job_location = $purifier->purify($_POST['location']);
  $job_med = $_POST['med'];
  $job_it = $_POST['it'];
  $job_bus = $_POST['bus'];
  $job_health = $_POST['health'];
  $job_food = $_POST['food'];
  $job_cul = $_POST['cul'];
  $job_hosp = $_POST['hosp'];

  $errorEmpty = false;
  $errorSectorEmpty = false;
  $errorLength = false;
  $errorValid = false;
  $errorDesc = false;

  if(empty($job_title) || empty($job_description) || empty($job_location))
  {
    echo("<span class='form-error'>Fill in all fields.</span>");
    $errorEmpty = true;
  }
  else if($job_med == 'false' && $job_it == 'false' && $job_bus == 'false' && $job_health == 'false' && $job_food == 'false' && $job_cul == 'false' && $job_hosp == 'false')
  {
    echo("<span class='form-error'>You must check atleast one sector.</span>");
    $errorSectorEmpty = true;
  }
  else if(strlen($job_title) > 250 || strlen($job_description) > 10000 || strlen($job_location) > 250)
  {
    echo("<span class='form-error'>Description cannot be more than 1000 words.</span>");
    $errorLength = true;
  }
  else if(strlen($job_description) < 500)
  {
    echo("<span class='form-error'>Description must be more specific.</span>");
    $errorDesc = true;
  }
  else if(is_numeric($job_title) || is_numeric($job_description) || is_numeric($job_location))
  {
    echo("<span class='form-error'>Field cannot be just numbers.</span>");
    $errorValid = true;
  }
  else
  {
    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
    $sql->execute([$_SESSION['user_uid']]);
    $result = $sql->fetch();
    $sql = $conn->prepare("SELECT * FROM employers WHERE user_id=?");
    $sql->execute([$result['user_id']]);
    $resultEmployer = $sql->fetch();
    $sql = $conn->prepare('INSERT INTO jobs(employer_id, job_title, job_description, job_location, isMedical, isIT, isHealthcare, isBusiness, isFoodservice, isHospitality, isCulinary, dateStamp) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $sql->execute([$resultEmployer['employer_id'], $job_title, $job_description, $job_location, $job_med, $job_it, $job_health, $job_bus, $job_food, $job_hosp, $job_cul, date('Y-m-d H:i:s')]);
    echo("<span class='form-success'>Success.</span>");
  }
}
else
{
  header("Location: ../sign-up-page.php?error=invaliduid");
}
?>
<script>
$("#postJob-title, #postJob-description, #postJob-location").removeClass("input-error");
$("#postJob-med, #postJob-it, #postJob-food, #postJob-health, #postJob-hosp, #postJob-cul, #postJob-bus").removeClass("input-error");
var errorEmpty = "<?php echo $errorEmpty; ?>";
var errorSectorEmpty = "<?php echo $errorSectorEmpty; ?>";
var errorLength = "<?php echo $errorLength; ?>";
var errorValid = "<?php echo $errorValid; ?>";
var errorDesc = "<?php echo $errorDesc; ?>";
if(errorEmpty == true)
{
  $("#postJob-title, #postJob-description, #postJob-location").addClass("input-error");
}
if(errorSectorEmpty == true)
{
  $("#postJob-med, #postJob-it, #postJob-food, #postJob-health, #postJob-hosp, #postJob-cul, #postJob-bus").addClass("input-error");
}
if(errorLength == true)
{
  $("#postJob-title, #postJob-description, #postJob-location").addClass("input-error");
}
if(errorValid == true)
{
  $("#postJob-title, #postJob-description, #postJob-location").addClass("input-error");
}
if(errorDesc == true)
{
  $("#postJob-description").addClass("input-error");
}
if(errorEmpty == false && errorSectorEmpty == false && errorLength == false && errorValid == false && errorDesc == false)
{
  $("#postJob-title, #postJob-description, #postJob-location").val("");
  $("#postJob-med, #postJob-it, #postJob-food, #postJob-health, #postJob-hosp, #postJob-cul, #postJob-bus").prop("checked", false);
}
</script>
