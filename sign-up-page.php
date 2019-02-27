<?php
session_start();
if(!isset($_SESSION['user_uid']))
{
  require 'header.php';
  echo("<link href='styles/sign-up-page.css' rel='stylesheet'>");
  echo("<link href='formhelper/css/bootstrap-formhelpers.css' rel='stylesheet'/>");

  echo('
  <script>
  $(document).ready(function(){
    $("#selector").on("change",function(){
      var selection = $(this).val();
      switch(selection)
      {
        case "seeker":
        $("#employerPartB").hide();
        $("#seekerPartB").show();
        $("#partC").show();
        break;
        case "employer":
        $("#seekerPartB").hide();
        $("#employerPartB").show();
        $("#partC").show();
        break;
        default:
        $("#employerPartB, #seekerPartB, #partC").hide();
        break;
      }
    });

    $("#signup").submit(function(event){
      event.preventDefault();

      var fName = $("#signup-fName").val();
      var lName = $("#signup-lName").val();
      var email = $("#signup-email").val();
      var phone = $("#signup-phone").val();
      var uid = $("#signup-uid").val();
      var pw = $("#signup-pw").val();
      var pw2 = $("#signup-pw2").val();

      var q1 = $("#signup-q1").val();
      var a1 = $("#signup-a1").val();
      var q2 = $("#signup-q2").val();
      var a2 = $("#signup-a2").val();
      var q3 = $("#signup-q3").val();
      var a3 = $("#signup-a3").val();

      var med = $("#signup-med");
      var it = $("#signup-it");
      var bus = $("#signup-bus");
      var health = $("#signup-health");
      var food = $("#signup-food");
      var hosp = $("#signup-hosp");
      var cul = $("#signup-cul");

      var submit = $("#submit").val();
      var type = $("#selector").val();

      if(type == "seeker")
      {
        var stateNum = $("#signup-stateNum").val();

        $(".form-message").load("php/sign-up.php", {
          fName: fName,
          lName: lName,
          email: email,
          phone: phone,
          uid: uid,
          pw: pw,
          pw2: pw2,
          q1: q1,
          a1: a1,
          q2: q2,
          a2: a2,
          q3: q3,
          a3: a3,
          med: med.prop("checked"),
          it: it.prop("checked"),
          bus: bus.prop("checked"),
          health: health.prop("checked"),
          food: food.prop("checked"),
          hosp: hosp.prop("checked"),
          cul: cul.prop("checked"),
          stateNum: stateNum,
          type: type,
          submit: submit
        });
      }
      else
      {
        var company = $("#employer-company").val();
        var web = $("#employer-web").val();
        var tax = $("#employer-tax").val();
        var unemployNum = $("#employer-unemployNum").val();

        $(".form-message").load("php/sign-up.php", {
          fName: fName,
          lName: lName,
          email: email,
          phone: phone,
          uid: uid,
          pw: pw,
          pw2: pw2,
          q1: q1,
          a1: a1,
          q2: q2,
          a2: a2,
          q3: q3,
          a3: a3,
          med: med.prop("checked"),
          it: it.prop("checked"),
          bus: bus.prop("checked"),
          health: health.prop("checked"),
          food: food.prop("checked"),
          hosp: hosp.prop("checked"),
          cul: cul.prop("checked"),
          company: company,
          web: web,
          tax: tax,
          unemployNum: unemployNum,
          type: type,
          submit: submit
        });
      }
    });

  });
  </script>
  ');

  echo('
  <div class="grid">

  <div class="main">

  <form id="signup" action="php/create-user.php" method="POST">
  <p class="form-message"></p>
  <ul>
  <li><input id="signup-fName" type="text" name="user_first" placeholder="First Name" class="form-control" aria-label="small" data-toggle="tooltip" title="Enter your first name"></li>
  <li><input id="signup-lName" type="text" name="user_last" placeholder="Last Name" class="form-control" aria-label="small" data-toggle="tooltip" title="Enter your last name"></li>
  <li><input id="signup-email" type="text" name="user_email" placeholder="Email" class="form-control" aria-label="small" data-toggle="tooltip" title="Enter your email address"></li>
  <li><input id="signup-phone" type="text" name="user_phone" class="input-small form-control bfh-phone" data-country="US" aria-label="small" data-toggle="tooltip" title="Enter your phone number (only digits)"></li>
  <li><input id="signup-uid" type="text" name="user_uid" placeholder="Username" class="form-control" aria-label="small" data-toggle="tooltip" title="Enter a user name with more than 8 characters"></li>
  <li><input id="signup-pw" type="password" name="user_pw" placeholder="Password" class="form-control" aria-label="small" data-toggle="tooltip" title="Enter a password that has atleast 8 characters, and no special characters"></li>
  <li><input id="signup-pw2" type="password" name="user_pw2" placeholder="Retype-Password" class="form-control" aria-label="small" data-toggle="tooltip" title="Re-type the password"></li>

  <li><input id="signup-q1" type="text" placeholder="Security question 1" class="form-control" aria-label="small" data-toggle="tooltip" title="Put a question only you will know the answer to. (only alphanumeric and spaces allowed)"></li>
  <li><input id="signup-a1" type="text" placeholder="Security answer 1" class="form-control" aria-label="small" data-toggle="tooltip" title="Put answer for security question 1. (only alphanumeric and spaces allowed)"></li>
  <li><input id="signup-q2" type="text" placeholder="Security question 2" class="form-control" aria-label="small" data-toggle="tooltip" title="Put a question only you will know the answer to. (only alphanumeric and spaces allowed)"></li>
  <li><input id="signup-a2" type="text" placeholder="Security answer 2" class="form-control" aria-label="small" data-toggle="tooltip" title="Put answer for security question 2. (only alphanumeric and spaces allowed)"></li>
  <li><input id="signup-q3" type="text" placeholder="Security question 3" class="form-control" aria-label="small" data-toggle="tooltip" title="Put a question only you will know the answer to. (only alphanumeric and spaces allowed)"></li>
  <li><input id="signup-a3" type="text" placeholder="Security answer 3" class="form-control" aria-label="small" data-toggle="tooltip" title="Put answer for security question 3. (only alphanumeric and spaces allowed)"></li>

  <li>
  <select class="mb-5 form-control" id="selector" name="selector">
  <option>What kind of user are you?</option>
  <option value="seeker">Job Seeker</option>
  <option value="employer">Employer</option>
  </select>
  </li>

  <div class="partB" id="seekerPartB" style="display:none;">
  <li><input id="signup-stateNum" type="text" name="user_stateNum" class="form-control" placeholder="State Number" aria-label="small" data-toggle="tooltip" title="Enter your state number (10 digits long)"></li>
  </div>

  <div class="partB" id="employerPartB" style="display:none;">
  <li><input id="employer-company" type="text" name="" placeholder="Company Name" class="form-control" aria-label="small" data-toggle="tooltip" title="Enter the name of your company"></li>
  <li><input id="employer-web" type="text" name="" placeholder="Company Website (if any)" class="form-control" aria-label="small" data-toggle="tooltip" title="Copy and paste your company\'s website URL"></li>
  <li><input id="employer-tax" type="text" name="" placeholder="Federal Tax ID #" class="form-control" aria-label="small" data-toggle="tooltip" title="Enter your federal tax id number"></li>
  <li><input id="employer-unemployNum" type="text" name="" placeholder="Unemployment Insur. ID #" class="form-control" aria-label="small" data-toggle="tooltip" title="Enter your unemployment insurance id number"></li>
  </div>

  <div class="partC" id="partC" style="display:none;">
  <li><h6>What positions interest you? <br/>(check all that apply)</h6></li>
  <li>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" value="TRUE" id="signup-med">
  <label class="form-check-label" for="signup-medical">Medical</label>
  <br/>
  <input class="form-check-input" type="checkbox" value="TRUE" id="signup-it">
  <label class="form-check-label" for="signup-it">IT</label>
  <br/>
  <input class="form-check-input" type="checkbox" value="TRUE" id="signup-bus">
  <label class="form-check-label" for="signup-business">Business</label>
  <br/>
  <input class="form-check-input" type="checkbox" value="TRUE" id="signup-health">
  <label class="form-check-label" for="signup-health">Health care</label>
  <br/>
  <input class="form-check-input" type="checkbox" value="TRUE" id="signup-food">
  <label class="form-check-label" for="signup-food">Food service</label>
  <br/>
  <input class="form-check-input" type="checkbox" value="TRUE" id="signup-hosp">
  <label class="form-check-label" for="signup-hosp">Hospitality</label>
  <br/>
  <input class="form-check-input" type="checkbox" value="TRUE" id="signup-cul">
  <label class="form-check-label" for="signup-cul">Culinary</label>
  </div>
  </li>
  <button id="submit" type="submit" name="submit" class="btn btn-outline-primary"><b>Sign up</b></button>
  </div>

  </ul>
  </form>
  <span><a href="sign-in-page.php">Already have an account?</a></span>
  </div>

  </div>

  ');

  echo("<script src='formhelper/js/bootstrap-formhelpers-phone.js'></script>");
  echo("<script src='formhelper/js/bootstrap-formhelpers.js'></script>");
  require 'footer.php';
}else{
  header("Location: index.php?error=signedin");
}
?>
