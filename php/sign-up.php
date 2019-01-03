<?php
session_start();
if(isset($_POST['submit']))
{
    require 'connect.php';

	$user_first = $_POST['fName'];
	$user_last = $_POST['lName'];
	$user_email = $_POST['email'];
	$user_phone = $_POST['phone'];
	$user_uid = $_POST['uid'];
	$user_pw = $_POST['pw'];
	$user_pw2 = $_POST['pw2'];

    $user_med = $_POST['med'];
    $user_it = $_POST['it'];
    $user_bus = $_POST['bus'];
    $user_health = $_POST['health'];
    $user_food = $_POST['food'];
    $user_cul = $_POST['cul'];
    $user_hosp = $_POST['hosp'];

    $type = $_POST['type'];

    $errorEmpty = false;
    $errorEmail = false;
    $errorPhone = false;
    $errorUid = false;
    $errorPw = false;

    if($type == 'employer')
    {
        $employer_company = $_POST['company'];
        $employer_web = $_POST['web'];
        $employer_tax = $_POST['tax'];
        $employer_employ = $_POST['unemployNum'];

        $errorTax = false;
        $errorEmploy = false;
        $errorWeb = false;

        if(empty($user_first) || empty($user_last) || empty($user_email) || empty($user_phone) || empty($user_uid) || empty($user_pw) || empty($user_pw2) || empty($employer_company) || empty($employer_web) || empty($employer_tax) || empty($employer_employ))
    	{
    		echo("<span class='form-error'>Fill in all fields</span>");
    		$errorEmpty = true;
    	}
    	else if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
    	{
    		echo("<span class='form-error'>write a valid email</span>");
    		$errorEmail = true;
    	}
    	else if(!preg_match("/^[a-zA-Z0-9]*$/", $user_uid))
    	{
    		echo("<span class='form-error'>write a valid username</span>");
    		$errorUid = true;
    	}
        else if(strlen($employer_tax) < 10)
        {
            echo("<span class='form-error'>please write a valid tax number</span>");
            $errorTax = true;
        }
        else if(strlen($employer_employ) < 10)
        {
            echo("<span class='form-error'>please write a valid unemployment number</span>");
            $errorEmploy = true;
        }
    	else
    	{
    		$sql = $conn->prepare('SELECT user_email FROM users WHERE user_email=?');
    		$sql->execute([$user_email]);
    		$result = $sql->fetch();

    		if(!$result)
    		{
    			$sql = $conn->prepare('SELECT user_uid FROM users WHERE user_uid=?');
    			$sql->execute([$user_uid]);
    			$result = $sql->fetch();

    			if(!$result)
    			{
    				if($user_pw == $user_pw2)
    				{
    					$hashPwd = password_hash($user_pw, PASSWORD_DEFAULT);

    					$stm = $conn->prepare('INSERT INTO users(user_first, user_last, user_email, user_phone, user_uid, user_pw, user_type) VALUES (?, ?, ?, ?, ?, ?, ?)');
    					$stm->execute([$user_first, $user_last, $user_email, $user_phone, $user_uid, $hashPwd, 'employer']);

                        $stm = $conn->prepare('SELECT user_id FROM users WHERE user_uid = ?');
    					$stm->execute([$user_uid]);
    					$result = $stm->fetch();

                        $stm = $conn->prepare('INSERT INTO employers(user_id, employer_company, employer_tax, employer_unemployNum, employer_web) VALUES (?, ?, ?, ?, ?)');
                        $stm->execute([$result['user_id'], $employer_company, $employer_tax, $employer_employ, $employer_web]);

                        $stm = $conn->prepare('INSERT INTO occupations(user_id, medical, IT, business, foodservice, healthcare, hospitality, culinary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        				$stm->execute([$result['user_id'], $user_med, $user_it, $user_bus, $user_food, $user_health, $user_hosp, $user_cul]);

    					echo("<span class='form-success'>Success~!</span>");
    				}
    				else
    				{
    					echo("<span class='form-error'>Passwords do not match!</span>");
    					$errorPw = true;
    				}
    			}
    			else
    			{
    				echo("<span class='form-error'>username taken!</span>");
    				$errorUid = true;
    			}
    		}
    		else
    		{
    			echo("<span class='form-error'>email taken!</span>");
    			$errorEmail = true;
    		}
    	}
    }
    else
    {
        $seeker_stateNum = $_POST['stateNum'];
        $errorStateNum = false;

        if(empty($user_first) || empty($user_last) || empty($user_email) || empty($user_phone) || empty($user_uid) || empty($user_pw) || empty($user_pw2) || empty($seeker_stateNum))
    	{
    		echo("<span class='form-error'>Fill in all fields</span>");
    		$errorEmpty = true;
    	}
    	else if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
    	{
    		echo("<span class='form-error'>write a valid email</span>");
    		$errorEmail = true;
    	}
    	else if(!preg_match("/^[a-zA-Z0-9]*$/", $user_uid))
    	{
    		echo("<span class='form-error'>write a valid username</span>");
    		$errorUid = true;
    	}
        else if($seeker_stateNum < 10)
        {
            echo("<span class='form-error'>write a state number!</span>");
            $errorStateNum = true;
        }
    	else
    	{
    		$sql = $conn->prepare('SELECT user_email FROM users WHERE user_email=?');
    		$sql->execute([$user_email]);
    		$result = $sql->fetch();

    		if(!$result)
    		{
    			$sql = $conn->prepare('SELECT user_uid FROM users WHERE user_uid=?');
    			$sql->execute([$user_uid]);
    			$result = $sql->fetch();

    			if(!$result)
    			{
    				if($user_pw == $user_pw2)
    				{
    					$hashPwd = password_hash($user_pw, PASSWORD_DEFAULT);

    					$stm = $conn->prepare('INSERT INTO users(user_first, user_last, user_email, user_phone, user_uid, user_pw, user_type) VALUES (?, ?, ?, ?, ?, ?, ?)');
    					$stm->execute([$user_first, $user_last, $user_email, $user_phone, $user_uid, $hashPwd, 'user']);

                        $stm = $conn->prepare('SELECT user_id FROM users WHERE user_uid = ?');
    					$stm->execute([$user_uid]);
    					$result = $stm->fetch();

                        $stm = $conn->prepare('INSERT INTO seekers(user_id, user_stateNum) VALUES (?, ?)');
                        $stm->execute([$result['user_id'], $seeker_stateNum]);

                        $stm = $conn->prepare('INSERT INTO occupations(user_id, medical, IT, business, foodservice, healthcare, hospitality, culinary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        				$stm->execute([$result['user_id'], $user_med, $user_it, $user_bus, $user_food, $user_health, $user_hosp, $user_cul]);

    					echo("<span class='form-success'>Success~!</span>");
    				}
    				else
    				{
    					echo("<span class='form-error'>Passwords do not match!</span>");
    					$errorPw = true;
    				}
    			}
    			else
    			{
    				echo("<span class='form-error'>username taken!</span>");
    				$errorUid = true;
    			}
    		}
    		else
    		{
    			echo("<span class='form-error'>email taken!</span>");
    			$errorEmail = true;
    		}
    	}
    }
}
else
{
		header("Location: ../sign-up-page.php?error=invaliduid");
}
?>
<script>
	$("#signup-fName, #signup-lName, #signup-email, #signup-phone, #signup-stateNum, #signup-uid, #signup-pw, #signup-pw2").removeClass("input-error");
	$("#employer-fName, #employer-lName, #employer-email, #employer-phone, #employer-uid, #employer-pw, #employer-pw2, #employer-company, #employer-tax, #employer-web, #employer-unemployNum").removeClass("input-error");

	var errorEmpty = "<?php echo $errorEmpty; ?>";
	var errorEmail = "<?php echo $errorEmail; ?>";
	var errorPhone = "<?php echo $errorPhone; ?>";
	var errorUid = "<?php echo $errorUid; ?>";
	var errorPw = "<?php echo $errorPw; ?>";

    var errorTax = "<?php echo $errorTax; ?>";
    var errorEmploy = "<?php echo $errorEmploy; ?>";
    var errorWeb = "<?php echo $errorWeb; ?>";

    var errorStateNum = "<?php echo $errorStateNum; ?>";

    if(errorEmpty == true)
	{
        $("#signup-fName, #signup-lName, #signup-email, #signup-phone, #signup-stateNum, #signup-uid, #signup-pw, #signup-pw2").addClass("input-error");
        $("#employer-fName, #employer-lName, #employer-email, #employer-phone, #employer-uid, #employer-pw, #employer-pw2, #employer-company, #employer-tax, #employer-web, #employer-unemployNum").addClass("input-error");
	}
	if(errorEmail == true)
	{
		$("#signup-email").addClass("input-error");
		$("#employer-email").addClass("input-error");
	}
	if(errorUid == true)
	{
		$("#signup-uid").addClass("input-error");
		$("#employer-uid").addClass("input-error");
	}
	if(errorPw == true)
	{
		$("#signup-pw, #signup-pw2").addClass("input-error");
		$("#employer-pw, #employer-pw2").addClass("input-error");
	}
	if(errorEmpty == false && errorEmail == false && errorUid == false && errorPw == false && errorStateNum == false && errorWeb == false && errorEmploy == false && errorTax == false)
	{
		$("#signup-fName, #signup-lName, #signup-email, #signup-phone, #signup-stateNum, #signup-uid, #signup-pw, #signup-pw2").val("");
        $("#employer-fName, #employer-lName, #employer-email, #employer-phone, #employer-uid, #employer-pw, #employer-pw2, #employer-company, #employer-tax, #employer-web, #employer-unemployNum").val("");

        $("#signup-med, #signup-it, #signup-food, #signup-health, #signup-hosp, #signup-cul, #signup-bus").prop("checked", false);
        $("#employer-med, #employer-it, #employer-food, #employer-health, #employer-hosp, #employer-cul, #employer-bus").prop("checked", false);
    }
</script>
