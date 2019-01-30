<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
    $sql->execute([$_SESSION['user_uid']]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    $user_med = $_POST['med'];
    $user_it = $_POST['it'];
    $user_bus = $_POST['bus'];
    $user_health = $_POST['health'];
    $user_food = $_POST['food'];
    $user_cul = $_POST['cul'];
    $user_hosp = $_POST['hosp'];;

    $errorEmpty = false;

    if($user_med == 'false' && $user_it == 'false' && $user_bus == 'false' && $user_health == 'false' && $user_food == 'false' && $user_cul == 'false' && $user_hosp == 'false')
    {
        echo("<span class='form-error'>please check atleast one box.</span>");
        $errorEmpty = true;
    }
    else
    {
        $sql2 = $conn->prepare('UPDATE user_occupations SET medical = ?, IT = ?, healthcare = ?, business = ?, foodservice = ?, hospitality = ?, culinary = ? WHERE user_id = ?');
        $sql2->execute([$user_med, $user_it, $user_health, $user_bus, $user_food, $user_hosp, $user_cul, $result['user_id']]);
        echo("<span class='form-success'>successfully changed sectors.</span>");
    }
}
else
{
		header("Location: ../sign-up-page.php?error=sign-in");
}
?>

<script>
    $("#change-sector-med, #change-sector-it, #change-sector-food, #change-sector-health, #change-sector-hosp, #change-sector-cul, #change-sector-bus").removeClass("input-error");

    var errorEmpty = "<?php echo $errorEmpty ?>";

    if(errorEmpty == true)
    {
      $("#change-sector-med, #change-sector-it, #change-sector-food, #change-sector-health, #change-sector-hosp, #change-sector-cul, #change-sector-bus").addClass("input-error");
    }
    if(errorEmpty == false && errorEmailTaken == false && errorEmailValid == false && errorEmailMatch == false)
    {
      $("#change-sector-med, #change-sector-it, #change-sector-food, #change-sector-health, #change-sector-hosp, #change-sector-cul, #change-sector-bus").removeClass("input-error");
      $("#change-sector-med, #change-sector-it, #change-sector-food, #change-sector-health, #change-sector-hosp, #change-sector-cul, #change-sector-bus").prop("checked", false);
    }
</script>
