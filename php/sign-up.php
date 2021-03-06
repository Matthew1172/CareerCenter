<?php
session_start();
if(isset($_POST['submit']) && !isset($_SESSION['user_uid']))
{
  require 'connect.php';

  $user_first = $_POST['fName'];
  $user_last = $_POST['lName'];
  $user_email = $_POST['email'];
  $user_phone = preg_replace("/[^0-9]/", "", $_POST['phone']);
  $user_uid = $_POST['uid'];
  $user_pw = $_POST['pw'];
  $user_pw2 = $_POST['pw2'];

  $q1 = $_POST['q1'];
  $a1 = $_POST['a1'];
  $q2 = $_POST['q2'];
  $a2 = $_POST['a2'];
  $q3 = $_POST['q3'];
  $a3 = $_POST['a3'];

  $user_med = $_POST['med'];
  $user_it = $_POST['it'];
  $user_bus = $_POST['bus'];
  $user_health = $_POST['health'];
  $user_food = $_POST['food'];
  $user_cul = $_POST['cul'];
  $user_hosp = $_POST['hosp'];

  $type = $_POST['type'];

  $errorEmpty = false;
  $errorName = false;
  $errorEmail = false;
  $errorPhone = false;
  $errorUid = false;
  $errorPw = false;
  $errorSec = false;
  $errorSecMatch = false;
  $errorSecMatchAns = false;
  $errorCheckbox = false;

  $sql = $conn->prepare('SELECT user_email FROM users WHERE user_email=?');
  $sql->execute([$user_email]);
  $result = $sql->fetch();
  if($result){
    echo("<span class='form-error'>This email already has an account.</span>");
    $errorEmail = true;
  }else{
    $sql = $conn->prepare('SELECT user_uid FROM users WHERE user_uid=?');
    $sql->execute([$user_uid]);
    $result = $sql->fetch();
    if($result){
      echo("<span class='form-error'>username taken.</span>");
      $errorUid = true;
    }else{
      if(empty($user_first) ||
      empty($user_last) ||
      empty($user_email) ||
      empty($user_phone) ||
      empty($user_uid) ||
      empty($user_pw) ||
      empty($user_pw2) ||
      empty($q1) ||
      empty($a1) ||
      empty($q2) ||
      empty($a2) ||
      empty($q3) ||
      empty($a3))
      {
        echo("<span class='form-error'>Please fill in all fields.</span>");
        $errorEmpty = true;
      }
      else if($user_med == "false" &&
      $user_it == "false" &&
      $user_bus == "false" &&
      $user_health == "false" &&
      $user_food == "false" &&
      $user_cul == "false" &&
      $user_hosp == "false"
      )
      {
        echo("<span class='form-error'>Please check atleast one sector.</span>");
        $errorCheckbox = true;
      }
      else if (!preg_match("/^[a-zA-Z]*$/", $user_first) || !preg_match("/^[a-zA-Z]*$/", $user_last) || strlen($user_first) < 2 || strlen($user_last) < 2)
      {
        echo("<span class='form-error'>This name is not valid.</span>");
        $errorName = true;
      }
      else if(!preg_match("/^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$/", $q1) || !preg_match("/^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$/", $a1) || !preg_match("/^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$/", $q2) || !preg_match("/^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$/", $a2) || !preg_match("/^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$/", $q3) || !preg_match("/^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$/", $a3))
      {
        echo("<span class='form-error'>Only characters a-z 0-9 and spaces are allowed.</span>");
        $errorSec = true;
      }
      else if($q1 == $q2 || $q1 == $q3 || $q2 == $q3)
      {
        echo("<span class='form-error'>You cannot repeat the same question.</span>");
        $errorSecMatch = true;
      }
      else if($a1 == $a2 || $a1 == $a3 || $a2 == $a3)
      {
        echo("<span class='form-error'>You cannot repeat the same answer.</span>");
        $errorSecMatchAns = true;
      }
      else if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
      {
        echo("<span class='form-error'>Please put a valid email.</span>");
        $errorEmail = true;
      }
      else if(strlen($user_phone) != 11)
      {
        echo("<span class='form-error'>Please put a valid phone number.</span>");
        $errorPhone = true;
      }
      else if(!preg_match("/^[a-zA-Z0-9]*$/", $user_uid) || strlen($user_uid) < 6)
      {
        echo("<span class='form-error'>Please put a valid username.</span>");
        $errorUid = true;
      }
      else if(!preg_match("/^[a-zA-Z0-9!?@$*&%]*$/", $user_pw) || strlen($user_pw) < 8)
      {
        echo("<span class='form-error'>Please put a valid password.</span>");
        $errorPw = true;
      }
      else if($user_pw != $user_pw2)
      {
        echo("<span class='form-error'>Passwords do not match.</span>");
        $errorPw = true;
      }
      else
      {
        $hashPwd = password_hash($user_pw, PASSWORD_DEFAULT);

        if($type == 'employer')
        {
          $employer_company = $_POST['company'];
          $employer_web = $_POST['web'];
          $employer_tax = $_POST['tax'];
          $employer_employ = $_POST['unemployNum'];

          $errorCompanyName = false;
          $errorTax = false;
          $errorEmploy = false;
          $errorWeb = false;

          if(empty($employer_company) || empty($employer_tax) || empty($employer_employ))
          {
            echo("<span class='form-error'>Please fill in all fields.</span>");
            $errorEmpty = true;
          }
          else if(!preg_match("/^[a-zA-Z0-9]*$/", $employer_company))
          {
            echo("<span class='form-error'>This is not a valid company name.</span>");
            $errorCompanyName = true;
          }
          else if(strlen($employer_tax) != 10 || !preg_match("/^[0-9]*$/", $employer_tax))
          {
            echo("<span class='form-error'>Please put a valid tax number.</span>");
            $errorTax = true;
          }
          else if(strlen($employer_employ) != 10 || !preg_match("/^[0-9]*$/", $employer_employ))
          {
            echo("<span class='form-error'>Please put a valid unemployment number.</span>");
            $errorEmploy = true;
          }
          else
          {
            if(empty($employer_web))
            {
              $stm = $conn->prepare('INSERT INTO users(user_first, user_last, user_email, user_phone, user_uid, user_pw, user_type, user_q1, user_a1, user_q2, user_a2, user_q3, user_a3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
              $stm->execute([$user_first, $user_last, $user_email, $user_phone, $user_uid, $hashPwd, 'employer', $q1, $a1, $q2, $a2, $q3, $a3]);

              $stm2 = $conn->prepare('SELECT user_id FROM users WHERE user_uid = ?');
              $stm2->execute([$user_uid]);
              $result = $stm2->fetch();

              $stm3 = $conn->prepare('INSERT INTO user_occupations(user_id, isMedical, isIT, isBusiness, isFoodservice, isHealthcare, isHospitality, isCulinary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
              $stm3->execute([$result['user_id'], $user_med, $user_it, $user_bus, $user_food, $user_health, $user_hosp, $user_cul]);

              $stm4 = $conn->prepare('INSERT INTO employers(user_id, employer_company, employer_tax, employer_unemployNum, employer_web) VALUES (?, ?, ?, ?, ?)');
              $stm4->execute([$result['user_id'], $employer_company, $employer_tax, $employer_employ, "This employer has not shared a website."]);

              echo("<span class='form-success'>Success.</span>");
            }
            else
            {
              if (!filter_var($employer_web, FILTER_VALIDATE_URL))
              {
                echo("<span class='form-error'>Please put a valid URL.</span>");
                $errorWeb = true;
              }
              else
              {
                $stm = $conn->prepare('INSERT INTO users(user_first, user_last, user_email, user_phone, user_uid, user_pw, user_type, user_q1, user_a1, user_q2, user_a2, user_q3, user_a3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $stm->execute([$user_first, $user_last, $user_email, $user_phone, $user_uid, $hashPwd, 'employer', $q1, $a1, $q2, $a2, $q3, $a3]);

                $stm = $conn->prepare('SELECT user_id FROM users WHERE user_uid = ?');
                $stm->execute([$user_uid]);
                $result = $stm->fetch();

                $stm = $conn->prepare('INSERT INTO user_occupations(user_id, isMedical, isIT, isBusiness, isFoodservice, isHealthcare, isHospitality, isCulinary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                $stm->execute([$result['user_id'], $user_med, $user_it, $user_bus, $user_food, $user_health, $user_hosp, $user_cul]);

                $stm = $conn->prepare('INSERT INTO employers(user_id, employer_company, employer_tax, employer_unemployNum, employer_web) VALUES (?, ?, ?, ?, ?)');
                $stm->execute([$result['user_id'], $employer_company, $employer_tax, $employer_employ, $employer_web]);

                echo("<span class='form-success'>Success.</span>");
              }
            }
          }
        }
        else
        {
          $seeker_stateNum = $_POST['stateNum'];
          $errorStateNum = false;

          if(empty($seeker_stateNum))
          {
            $stm = $conn->prepare('INSERT INTO users(user_first, user_last, user_email, user_phone, user_uid, user_pw, user_type, user_q1, user_a1, user_q2, user_a2, user_q3, user_a3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stm->execute([$user_first, $user_last, $user_email, $user_phone, $user_uid, $hashPwd, 'user', $q1, $a1, $q2, $a2, $q3, $a3]);

            $stm = $conn->prepare('SELECT user_id FROM users WHERE user_uid = ?');
            $stm->execute([$user_uid]);
            $result = $stm->fetch();

            $stm = $conn->prepare('INSERT INTO seekers(user_id, user_stateNum) VALUES (?, ?)');
            $stm->execute([$result['user_id'], 0000000000]);

            $stm = $conn->prepare('INSERT INTO user_occupations(user_id, isMedical, isIT, isBusiness, isFoodservice, isHealthcare, isHospitality, isCulinary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $stm->execute([$result['user_id'], $user_med, $user_it, $user_bus, $user_food, $user_health, $user_hosp, $user_cul]);

            echo("<span class='form-success'>Success.</span>");
          }
          else
          {
            if(strlen($seeker_stateNum) != 10 || !preg_match("/^[0-9]*$/", $seeker_stateNum))
            {
              echo("<span class='form-error'>Please write a valid state number.</span>");
              $errorStateNum = true;
            }else{
              $stm = $conn->prepare('INSERT INTO users(user_first, user_last, user_email, user_phone, user_uid, user_pw, user_type, user_q1, user_a1, user_q2, user_a2, user_q3, user_a3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
              $stm->execute([$user_first, $user_last, $user_email, $user_phone, $user_uid, $hashPwd, 'user', $q1, $a1, $q2, $a2, $q3, $a3]);

              $stm = $conn->prepare('SELECT user_id FROM users WHERE user_uid = ?');
              $stm->execute([$user_uid]);
              $result = $stm->fetch();

              $stm = $conn->prepare('INSERT INTO seekers(user_id, user_stateNum) VALUES (?, ?)');
              $stm->execute([$result['user_id'], $seeker_stateNum]);

              $stm = $conn->prepare('INSERT INTO user_occupations(user_id, isMedical, isIT, isBusiness, isFoodservice, isHealthcare, isHospitality, isCulinary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
              $stm->execute([$result['user_id'], $user_med, $user_it, $user_bus, $user_food, $user_health, $user_hosp, $user_cul]);

              echo("<span class='form-success'>Success.</span>");
            }
          }
        }
      }
    }
  }
}
?>
<script>
$("#signup-fName, #signup-lName, #signup-email, #signup-phone, #signup-stateNum, #signup-uid, #signup-pw, #signup-pw2, #signup-q1, #signup-a1, #signup-q2, #signup-a2, #signup-q3, #signup-a3").removeClass("input-error");
$("#employer-company, #employer-tax, #employer-web, #employer-unemployNum").removeClass("input-error");
$("#signup-med, #signup-it, #signup-food, #signup-health, #signup-hosp, #signup-cul, #signup-bus").removeClass("input-error");

var errorEmpty = "<?php echo $errorEmpty; ?>";
var errorName = "<?php echo $errorName; ?>";
var errorEmail = "<?php echo $errorEmail; ?>";
var errorPhone = "<?php echo $errorPhone; ?>";
var errorUid = "<?php echo $errorUid; ?>";
var errorPw = "<?php echo $errorPw; ?>";
var errorSec = "<?php echo $errorSec; ?>";
var errorSecMatch = "<?php echo $errorSecMatch; ?>";
var errorSecMatchAns = "<?php echo $errorSecMatchAns; ?>";
var errorCheckbox = "<?php echo $errorCheckbox; ?>";

var errorStateNum = "<?php echo $errorStateNum; ?>";

var errorTax = "<?php echo $errorTax; ?>";
var errorEmploy = "<?php echo $errorEmploy; ?>";
var errorWeb = "<?php echo $errorWeb; ?>";
var errorCompanyName = "<?php echo $errorCompanyName; ?>";

if(errorEmpty == true)
{
  $("#signup-fName, #signup-lName, #signup-email, #signup-phone, #signup-uid, #signup-pw, #signup-pw2, #signup-q1, #signup-a1, #signup-q2, #signup-a2, #signup-q3, #signup-a3").addClass("input-error");
  $("#signup-med, #signup-it, #signup-food, #signup-health, #signup-hosp, #signup-cul, #signup-bus").addClass("input-error");
  $("#employer-company, #employer-tax, #employer-unemployNum").addClass("input-error");
}
if(errorCheckbox == true)
{
  $("#signup-med, #signup-it, #signup-food, #signup-health, #signup-hosp, #signup-cul, #signup-bus").addClass("input-error");
}
if(errorName == true)
{
  $("#signup-fName, #signup-lName").addClass("input-error");
}
if(errorEmail == true)
{
  $("#signup-email").addClass("input-error");
}
if(errorPhone == true)
{
  $("#signup-phone").addClass("input-error");
}
if(errorUid == true)
{
  $("#signup-uid").addClass("input-error");
}
if(errorPw == true)
{
  $("#signup-pw, #signup-pw2").addClass("input-error");
}
if(errorStateNum == true)
{
  $("#signup-stateNum").addClass("input-error");
}
if(errorTax == true)
{
  $("#employer-tax").addClass("input-error");
}
if(errorEmploy == true)
{
  $("#employer-unemployNum").addClass("input-error");
}
if(errorWeb == true)
{
  $("#employer-web").addClass("input-error");
}
if(errorCompanyName == true)
{
  $("#employer-company").addClass("input-error");
}
if(errorSec == true)
{
  $("#signup-q1, #signup-a1, #signup-q2, #signup-a2, #signup-q3, #signup-a3").addClass("input-error");
}
if(errorSecMatch == true)
{
  $("#signup-q1, #signup-q2, #signup-q3").addClass("input-error");
}
if(errorSecMatchAns == true)
{
  $("#signup-a1, #signup-a2, #signup-a3").addClass("input-error");
}
if(errorEmpty == false &&
  errorName == false &&
  errorEmail == false &&
  errorPhone == false &&
  errorUid == false &&
  errorPw == false &&
  errorStateNum == false &&
  errorTax == false &&
  errorEmploy == false &&
  errorWeb == false &&
  errorCompanyName == false &&
  errorSec == false &&
  errorSecMatch == false &&
  errorSecMatchAns == false &&
  errorCheckbox == false)
  {
    $("#signup-fName, #signup-lName, #signup-email, #signup-stateNum, #signup-uid, #signup-pw, #signup-pw2, #signup-q1, #signup-a1, #signup-q2, #signup-a2, #signup-q3, #signup-a3").val("");
    $("#signup-phone").val("+1");
    $("#signup-med, #signup-it, #signup-food, #signup-health, #signup-hosp, #signup-cul, #signup-bus").prop("checked", false);
    $("#employer-company, #employer-tax, #employer-web, #employer-unemployNum").val("");
    var x = "Thank you for creating an account with the Rockland County Career Center!"
    bootbox.confirm({
      size: 'small',
      message: x,
      callback: function(response){
        if(response)
        {
          window.location.assign('index.php');
        }
      }
    });
  }
</script>
