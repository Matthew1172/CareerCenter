<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

	$job_title = $_POST['title'];
	$job_description = $_POST['description'];
	$job_position = $_POST['position'];
	$job_location = $_POST['location'];

    $job_med = $_POST['med'];
    $job_it = $_POST['it'];
    $job_bus = $_POST['bus'];
    $job_health = $_POST['health'];
    $job_food = $_POST['food'];
    $job_cul = $_POST['cul'];
    $job_hosp = $_POST['hosp'];

    $errorEmpty = false;

        if(empty($job_title) || empty($job_description) || empty($job_position) || empty($job_location))
    	{
    		echo("<span class='form-error'>Fill in all fields</span>");
    		$errorEmpty = true;
    	}
        else
        {
            $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
            $sql->execute([$_SESSION['user_uid']]);
            $result = $sql->fetch();

            $sql = $conn->prepare("SELECT * FROM employers WHERE user_id=?");
            $sql->execute([$result['user_id']]);
            $resultEmployer = $sql->fetch();

            $sql = $conn->prepare('INSERT INTO jobs(employer_id, job_title, job_description, job_position, job_location, isMedical, isIT, isHealthcare, isBusiness, isFoodservice, isHospitality, isCulinary) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $sql->execute([$resultEmployer['employer_id'], $job_title, $job_description, $job_position, $job_location, $job_med, $job_it, $job_health, $job_bus, $job_food, $job_hosp, $job_cul]);

            echo("<span class='form-success'>Success~!</span>");
        }
}
else
{
		header("Location: ../sign-up-page.php?error=invaliduid");
}
?>

<script>
    $("#postJob-title, #postJob-description, #postJob-position, #postJob-location").removeClass("input-error");

	var errorEmpty = "<?php echo $errorEmpty; ?>";

    if(errorEmpty == true)
	{
        $("#postJob-title, #postJob-description, #postJob-position, #postJob-location").addClass("input-error");
    }
	if(errorEmpty == false)
	{
        $("#postJob-title, #postJob-description, #postJob-position, #postJob-location").val("");
        $("#postJob-med, #postJob-it, #postJob-food, #postJob-health, #postJob-hosp, #postJob-cul, #postJob-bus").prop("checked", false);
    }
</script>
