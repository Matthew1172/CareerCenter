<?php
session_start();
require 'header.php';
echo("<link href='styles/sign.css' rel='stylesheet'>");
echo("<link href='formhelper/css/bootstrap-formhelpers.css' rel='stylesheet'/>");
?>

<script>
    $(document).ready(function(){
        $("#seeker-signup").submit(function(event){
            event.preventDefault();
            var fName = $("#signup-fName").val();
            var lName = $("#signup-lName").val();
            var email = $("#signup-email").val();
            var phone = $("#signup-phone").val();
            var stateNum = $("#signup-stateNum").val();
            var uid = $("#signup-uid").val();
            var pw = $("#signup-pw").val();
            var pw2 = $("#signup-pw2").val();
            var submit = $("#submit").val();

            var med = $("#signup-med");
            var it = $("#signup-it");
            var bus = $("#signup-bus");
            var health = $("#signup-health");
            var food = $("#signup-food");
            var hosp = $("#signup-hosp");
            var cul = $("#signup-cul");

            var type = "seeker";

                $(".form-message").load("php/sign-up.php", {
                    fName: fName,
                    lName: lName,
                    email: email,
                    phone: phone,
                    stateNum: stateNum,
                    uid: uid,
                    pw: pw,
                    pw2: pw2,
                    med: med.prop('checked'),
                    it: it.prop('checked'),
                    bus: bus.prop('checked'),
                    health: health.prop('checked'),
                    food: food.prop('checked'),
                    hosp: hosp.prop('checked'),
                    cul: cul.prop('checked'),
                    type: type,
                    submit: submit
                });
        });
        $("#employer-signup").submit(function(event){
            event.preventDefault();
            var fName = $("#employer-fName").val();
            var lName = $("#employer-lName").val();
            var email = $("#employer-email").val();
            var phone = $("#employer-phone").val();
            var uid = $("#employer-uid").val();
            var pw = $("#employer-pw").val();
            var pw2 = $("#employer-pw2").val();
            var submit = $("#submit").val();

            var med = $("#employer-med");
            var it = $("#employer-it");
            var bus = $("#employer-bus");
            var health = $("#employer-health");
            var food = $("#employer-food");
            var hosp = $("#employer-hosp");
            var cul = $("#employer-cul");

            var type = "employer";
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
                    med: med.prop('checked'),
                    it: it.prop('checked'),
                    bus: bus.prop('checked'),
                    health: health.prop('checked'),
                    food: food.prop('checked'),
                    hosp: hosp.prop('checked'),
                    cul: cul.prop('checked'),
                    company: company,
                    web: web,
                    tax: tax,
                    unemployNum: unemployNum,
                    type: type,
                    submit: submit
                });
        });
    });
</script>
<div class="container main">
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#seeker_form">Job Seeker</button>
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#employer_form">Employer</button>
</div>

        <div class="modal fade" id="seeker_form" tabindex="-1" role="dialog" aria-labelledby="seekerModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="seekerModalLabel">Job Seeker Sign up</h4>
              </div>
              <div class="modal-body">
                  <form id="seeker-signup" action="php/create-user.php" method="POST">
                  <p class="form-message"></p>
                      <ul>
                          <li><input id="signup-fName" type="text" name="user_first" placeholder="First Name" class="form-control" aria-label="small"></li>
                          <li><input id="signup-lName" type="text" name="user_last" placeholder="Last Name" class="form-control" aria-label="small"></li>
                          <li><input id="signup-email" type="text" name="user_email" placeholder="Email" class="form-control" aria-label="small"></li>
                          <li><input id="signup-phone" type="text" name="user_phone" class="input-small form-control bfh-phone" data-country="US" aria-label="small"></li>
                          <li><input id="signup-stateNum" type="text" name="user_stateNum" class="form-control" placeholder="State Number" aria-label="small"></li>
                          <li><input id="signup-uid" type="text" name="user_uid" placeholder="Username" class="form-control" aria-label="small"></li>
                          <li><input id="signup-pw" type="password" name="user_pw" placeholder="Password" class="form-control" aria-label="small"></li>
                          <li><input id="signup-pw2" type="password" name="user_pw2" placeholder="Retype-Password" class="form-control" aria-label="small"></li>
                          <li><h6>What fields are you skilled in? <br/>(check all that apply)</h6></li>
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
                      </ul>
                      <button id="submit" type="submit" name="signup-submit" class="btn btn-primary main-btn"><b>Sign up</b></button>
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="employer_form" tabindex="-1" role="dialog" aria-labelledby="employerModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="employerModalLabel">Employer Sign up</h4>
              </div>
              <div class="modal-body">
                  <form id="employer-signup" action="php/create-user.php" method="POST">
                  <p class="form-message"></p>
                      <ul>
                          <li><input id="employer-fName" type="text" name="user_first" placeholder="First Name" class="form-control" aria-label="small"></li>
                          <li><input id="employer-lName" type="text" name="user_last" placeholder="Last Name" class="form-control" aria-label="small"></li>
                          <li><input id="employer-email" type="text" name="user_email" placeholder="Email" class="form-control" aria-label="small"></li>
                          <li><input id="employer-phone" type="text" name="user_phone" class="input-small form-control bfh-phone" data-country="US" aria-label="small"></li>
                          <li><input id="employer-uid" type="text" name="user_uid" placeholder="Username" class="form-control" aria-label="small"></li>
                          <li><input id="employer-pw" type="password" name="user_pw" placeholder="Password" class="form-control" aria-label="small"></li>
                          <li><input id="employer-pw2" type="password" name="user_pw2" placeholder="Retype-Password" class="form-control" aria-label="small"></li>

                          <li><input id="employer-company" type="text" name="" placeholder="Company Name" class="form-control" aria-label="small"></li>
                          <li><input id="employer-web" type="text" name="" placeholder="Company Website (if any)" class="form-control" aria-label="small"></li>
                          <li><input id="employer-tax" type="text" name="" placeholder="Federal Tax ID #" class="form-control" aria-label="small"></li>
                          <li><input id="employer-unemployNum" type="text" name="" placeholder="Unemployment Insur. ID #" class="form-control" aria-label="small"></li>
                          <li><h6>What sections is your company involved with? <br/>(check all that apply)</h6></li>
                          <li>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="TRUE" id="employer-med">
                                <label class="form-check-label" for="employer-medical">Medical</label>
                            <br/>
                                <input class="form-check-input" type="checkbox" value="TRUE" id="employer-it">
                                <label class="form-check-label" for="employer-it">IT</label>
                            <br/>
                                <input class="form-check-input" type="checkbox" value="TRUE" id="employer-bus">
                                <label class="form-check-label" for="employer-business">Business</label>
                            <br/>
                                <input class="form-check-input" type="checkbox" value="TRUE" id="employer-health">
                                <label class="form-check-label" for="employer-health">Health care</label>
                            <br/>
                                <input class="form-check-input" type="checkbox" value="TRUE" id="employer-food">
                                <label class="form-check-label" for="employer-food">Food service</label>
                            <br/>
                                <input class="form-check-input" type="checkbox" value="TRUE" id="employer-hosp">
                                <label class="form-check-label" for="employer-hosp">Hospitality</label>
                            <br/>
                                <input class="form-check-input" type="checkbox" value="TRUE" id="employer-cul">
                                <label class="form-check-label" for="employer-cul">Culinary</label>
                              </div>
                          </li>
                      </ul>
                      <button id="submit" type="submit" name="employer-submit" class="btn btn-primary main-btn"><b>Sign up</b></button>
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
<?php
echo("<script src='formhelper/js/bootstrap-formhelpers-phone.js'></script>");
echo("<script src='formhelper/js/bootstrap-formhelpers.js'></script>");
require 'footer.php';
?>
