<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

  	$work_title = $_POST['title'];
  	$work_description = $_POST['description'];
  	$work_location = $_POST['location'];
    $work_start = $_POST['start'];
    $work_end = $_POST['end'];

    $work_med = $_POST['med'];
    $work_it = $_POST['it'];
    $work_bus = $_POST['bus'];
    $work_health = $_POST['health'];
    $work_food = $_POST['food'];
    $work_cul = $_POST['cul'];
    $work_hosp = $_POST['hosp'];

    $errorEmpty = false;
    $errorSectorEmpty = false;

        if(empty($work_title) || empty($work_description) || empty($work_location))
    	  {
    		echo("<span class='form-error'>Fill in all fields</span>");
    		$errorEmpty = true;
    	  }
        else if($work_med == 'false' && $work_it == 'false' && $work_bus == 'false' && $work_health == 'false' && $work_food == 'false' && $work_cul == 'false' && $work_hosp == 'false')
        {
        echo("<span class='form-error'>you must check atleast one sector</span>");
      	$errorSectorEmpty = true;
        }
        else
        {
            $sql = $conn->prepare('INSERT INTO events(title, description, location, dateStamp, startTime, endTime, isMedical, isIT, isHealthcare, isBusiness, isFoodservice, isHospitality, isCulinary) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $sql->execute([$work_title, $work_description, $work_location, date('Y-m-d H:i:s'), $work_start, $work_end, $work_med, $work_it, $work_health, $work_bus, $work_food, $work_hosp, $work_cul]);
            echo("<span class='form-success'>Success~!</span>");
        }
}
else
{
		header("Location: ../sign-up-page.php?error=invaliduid");
}
?>

<script>
  $("#work-title, #work-desc, #work-loc, #work-start, #work-end").removeClass("input-error");
  $("#add-work-med, #add-work-it, #add-work-food, #add-work-health, #add-work-hosp, #add-work-cul, #add-work-bus").removeClass("input-error");

	var errorEmpty = "<?php echo $errorEmpty; ?>";
	var errorSectorEmpty = "<?php echo $errorSectorEmpty; ?>";

  if(errorEmpty == true)
	{
        $("#work-title, #work-desc, #work-loc, #work-start, #work-end").addClass("input-error");
  }
  if(errorSectorEmpty == true)
  {
        $("#add-work-med, #add-work-it, #add-work-food, #add-work-health, #add-work-hosp, #add-work-cul, #add-work-bus").addClass("input-error");
  }
	if(errorEmpty == false && errorSectorEmpty == false)
	{
        $("#work-title, #work-desc, #work-loc, #work-start, #work-end").val("");
        $("#add-work-med, #add-work-it, #add-work-food, #add-work-health, #add-work-hosp, #add-work-cul, #add-work-bus").prop("checked", false);
  }
</script>
