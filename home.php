<?php
function getEventList($conn)
{
    $eventListArray = array();
    $sql = $conn->prepare("SELECT * FROM events ORDER BY dateStamp DESC");
    $sql->execute();
    while($result = $sql->fetch(PDO::FETCH_ASSOC))
    {
        $eventListArray[] = new Event($result['event_id'], $result['title'], $result['description'], $result['location'], $result['dateStamp'], $result['startTime'], $result['endTime'], $result['isMedical'], $result['isIT'], $result['isHealthcare'], $result['isBusiness'], $result['isFoodservice'], $result['isHospitality'], $result['isCulinary']);
    }
    return $eventListArray;
}

session_start();
if (isset($_SESSION['user_uid']))
{
    include 'php/user-class.php';
    include 'php/event-class.php';

    include 'header.php';
    include 'php/connect.php';
    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
    $sql->execute([$_SESSION['user_uid']]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    

    
    echo('<script>');
    echo("
            $(document).ready(function(){
                $(document).on('click','.event-btn',function(){
                    var x = 'Are you sure you want to subscribe?'
                    if(confirm(x))
                    {
                        var ID = $(this).attr('id');
                        $('#event'+ID).hide();
                            $.ajax({
                                type: 'POST',
                                url: 'php/subscribe.php',
                                data: {
                                    ID: ID
                                },
                                success: function(response){
                                  if(response == 'error100')
                                  {
                                      alert('You\\'re already subscribed for this workshop.');
                                  }
                                  else
                                  {
                                      $('#event'+ID).remove();
                                      alert('You have subscribed to this workshop.');
                                  }
                                }
                        });
                    }
                });
                $(document).on('click','.sub-event-btn',function(){
                    var x = 'Are you sure you want to un-subscribe?'
                    if(confirm(x))
                    {
                        var ID = $(this).attr('id');
                        $('#sub-event'+ID).hide();
                            $.ajax({
                                type: 'POST',
                                url: 'php/unsubscribe.php',
                                data: {
                                    ID: ID
                                },
                                success: function(html){
                                    $('#event'+ID).remove();
                                }
                        });
                    }
                });
                var allEventCount = 2;
                $('#more-all-events-button').click(function(){
                  allEventCount += 2;
                  $('#all-events-list-section').load('php/load-all-events.php', {
                    allEventNewCount: allEventCount
                  });
                });
                var ownEventCount = 2;
                $('#more-own-events-button').click(function(){
                    ownEventCount += 2;
                    $('#own-events-list-section').load('php/load-own-events.php', {
                        ownEventNewCount: ownEventCount
                    });
                });
                var jobCount = 2;
                $('#more-own-jobs-button').click(function(){
                    jobCount += 2;
                    $('#job-list-section').load('php/load-own-jobs.php', {
                        jobNewCount: jobCount
                    });
                });
                var workRecCount = 2;
                $('#more-work-rec-button').click(function(){
                    workRecCount += 2;
                    $('#work-rec-list-section').load('php/load-work-rec-events.php', {
                      workRecNewCount: workRecCount
                    });
                });
                $('#change-sector-form').submit(function(event){
                    var x = 'Are you sure you want to change your sectors?'
                    if(confirm(x))
                    {
                        event.preventDefault();
                        var med = $('#change-sector-med');
                        var it = $('#change-sector-it');
                        var bus = $('#change-sector-bus');
                        var health = $('#change-sector-health');
                        var food = $('#change-sector-food');
                        var hosp = $('#change-sector-hosp');
                        var cul = $('#change-sector-cul');

                        var submit = $('#change-sector-submit').val();

                            $('.form-message').load('php/reset-sectors.php', {
                                med: med.prop('checked'),
                                it: it.prop('checked'),
                                bus: bus.prop('checked'),
                                health: health.prop('checked'),
                                food: food.prop('checked'),
                                hosp: hosp.prop('checked'),
                                cul: cul.prop('checked'),
                                submit: submit,
                                success: function(response){
                                    console.log(response);
                                   //window.location.reload();
                                }
                            });
                    }
                });
                $('#change-pw-form').submit(function(event){
                  var x = 'Are you sure you want to change your password?'
                  if(confirm(x))
                  {
                      event.preventDefault();
                      var change_pw = $('#change-pw-input').val();
                      var change_pw2 = $('#change-pw2-input').val();
                      var submit = $('#change-pw-submit').val();
                      $('.form-message').load('php/reset-pw.php', {
                          change_pw: change_pw,
                          change_pw2: change_pw2,
                          submit: submit
                      });
                  }
                });
                $('#change-phone-form').submit(function(event){
                  var x = 'Are you sure you want to change your phone number?'
                  if(confirm(x))
                  {
                      event.preventDefault();
                      var change_phone = $('#change-phone-input').val();
                      var change_phone2 = $('#change-phone2-input').val();
                      var submit = $('#change-phone-submit').val();
                      $('.form-message').load('php/reset-phone.php', {
                          change_phone: change_phone,
                          change_phone2: change_phone2,
                          submit: submit
                      });
                  }
                });
                $('#change-email-form').submit(function(event){
                  var x = 'Are you sure you want to change your email?'
                  if(confirm(x))
                  {
                      event.preventDefault();
                      var change_email = $('#change-email-input').val();
                      var change_email2 = $('#change-email2-input').val();
                      var submit = $('#change-email-submit').val();
                      $('.form-message').load('php/reset-email.php', {
                          change_email: change_email,
                          change_email2: change_email2,
                          submit: submit
                      });
                  }
              });
            });
    ");
    echo('</script>');

    if($result['user_type'] == "admin")
    {
            echo("<link href='styles/home-admin.css' rel='stylesheet'>");

            echo('<script>');
            echo("
                $(document).ready(function(){
                    $('#reset-form').submit(function(event){
                        event.preventDefault();

                        var reset_email = $('#reset-email').val();
                        var reset_pw = $('#reset-pw').val();
                        var reset_pw2 = $('#reset-pw2').val();

                        var submit = $('#submit').val();

                            $('.form-message').load('php/reset-pw-admin.php', {
                                reset_email: reset_email,
                                reset_pw: reset_pw,
                                reset_pw2: reset_pw2,
                                submit: submit
                            });
                    });
                    $('#add-work-form').submit(function(event){
                        var x = 'Are you sure you want to add this event?'
                        if(confirm(x))
                        {
                            event.preventDefault();

                            var title = $('#work-title').val();
                            var description = $('#work-desc').val();
                            var location = $('#work-loc').val();
                            var start = $('#work-start').val();
                            var end = $('#work-end').val();

                            var med = $('#add-work-med');
                            var it = $('#add-work-it');
                            var bus = $('#add-work-bus');
                            var health = $('#add-work-health');
                            var food = $('#add-work-food');
                            var hosp = $('#add-work-hosp');
                            var cul = $('#add-work-cul');

                            var submit = $('#submit-workshop').val();

                            $('.form-message').load('php/add-workshop.php', {
                                title: title,
                                description: description,
                                location: location,
                                start: start,
                                end: end,
                                med: med.prop('checked'),
                                it: it.prop('checked'),
                                bus: bus.prop('checked'),
                                health: health.prop('checked'),
                                food: food.prop('checked'),
                                hosp: hosp.prop('checked'),
                                cul: cul.prop('checked'),
                                submit: submit
                            });
                        }
                    });
                    $(document).on('click','.current-btn',function(){
                        $('#change-info').hide();
                        $('#current-event-list').show();
                    });
                    $(document).on('click','.change-btn',function(){
                        $('#current-event-list').hide();
                        $('#change-info').show();
                    });
                    $(document).on('click','.change-pw-btn',function(){
                        $('#change-phone').hide();
                        $('#change-email').hide();
                        $('#upload-section').hide();
                        $('#change-sector-section').hide();
                        $('#change-pw').show();
                    });
                    $(document).on('click','.change-phone-btn',function(){
                        $('#change-email').hide();
                        $('#change-pw').hide();
                        $('#upload-section').hide();
                        $('#change-sector-section').hide();
                        $('#change-phone').show();
                    });
                    $(document).on('click','.change-email-btn',function(){
                        $('#change-phone').hide();
                        $('#change-pw').hide();
                        $('#upload-section').hide();
                        $('#change-sector-section').hide();
                        $('#change-email').show();
                    });
                    $(document).on('click','.upload-btn',function(){
                        $('#change-phone').hide();
                        $('#change-pw').hide();
                        $('#change-email').hide();
                        $('#change-sector-section').hide();
                        $('#upload-section').show();
                    });
                    $(document).on('click','.change-sector-btn',function(){
                        $('#change-phone').hide();
                        $('#change-pw').hide();
                        $('#change-email').hide();
                        $('#upload-section').hide();
                        $('#change-sector-section').show();
                    });
                    $('#change-pw-form').submit(function(event){
                        var x = 'Are you sure you want to change your password?'
                        if(confirm(x))
                        {
                            event.preventDefault();
                            var change_pw = $('#change-pw-input').val();
                            var change_pw2 = $('#change-pw2-input').val();

                            var submit = $('#change-pw-submit').val();

                                $('.form-message').load('php/reset-pw.php', {
                                    change_pw: change_pw,
                                    change_pw2: change_pw2,
                                    submit: submit
                                });
                        }
                    });
                    $('#change-phone-form').submit(function(event){
                        var x = 'Are you sure you want to change your phone number?'
                        if(confirm(x))
                        {
                            event.preventDefault();
                            var change_phone = $('#change-phone-input').val();
                            var change_phone2 = $('#change-phone2-input').val();

                            var submit = $('#change-phone-submit').val();

                                $('.form-message').load('php/reset-phone.php', {
                                    change_phone: change_phone,
                                    change_phone2: change_phone2,
                                    submit: submit
                                });
                        }
                    });
                    $('#change-email-form').submit(function(event){
                        var x = 'Are you sure you want to change your email?'
                        if(confirm(x))
                        {
                            event.preventDefault();
                            var change_email = $('#change-email-input').val();
                            var change_email2 = $('#change-email2-input').val();

                            var submit = $('#change-email-submit').val();

                                $('.form-message').load('php/reset-email.php', {
                                    change_email: change_email,
                                    change_email2: change_email2,
                                    submit: submit
                                });
                        }
                    });
                    $('#upload-form').submit(function(event){
                        var x = 'Are you sure you want to upload this resume?'
                        if(confirm(x))
                        {
                            event.preventDefault();

                            $.ajax({
                            url: 'php/upload-resume.php', // Url to which the request is send
                            type: 'POST',             // Type of request to be send, called as method
                            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                            contentType: false,       // The content type used when sending data to the server.
                            cache: false,             // To unable request pages to be cached
                            processData:false        // To send DOMDocument or non processed data file it is set to false
                            });
                        }
                    });
                    $('#change-sector-form').submit(function(event){
                        var x = 'Are you sure you want to change your sectors?'
                        if(confirm(x))
                        {
                            event.preventDefault();
                            var med = $('#change-sector-med');
                            var it = $('#change-sector-it');
                            var bus = $('#change-sector-bus');
                            var health = $('#change-sector-health');
                            var food = $('#change-sector-food');
                            var hosp = $('#change-sector-hosp');
                            var cul = $('#change-sector-cul');

                            var submit = $('#change-sector-submit').val();

                                $('.form-message').load('php/reset-sectors.php', {
                                    med: med.prop('checked'),
                                    it: it.prop('checked'),
                                    bus: bus.prop('checked'),
                                    health: health.prop('checked'),
                                    food: food.prop('checked'),
                                    hosp: hosp.prop('checked'),
                                    cul: cul.prop('checked'),
                                    submit: submit
                                });
                        }
                    });
                });
                ");
            echo('</script>');

            echo("<div class='grid'>");

            echo("<div class='hero1'></div>");

            echo("<div class='greet py-5'>");
            echo("<h1 style='color: white' id='demo'>Welcome, " . $result['user_first'] . "</h1>");
            echo("</div>");

            echo("<div class='dashboard-control'>");
            echo('
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar2">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-stretch" id="navbar2">
                <ul class="navbar-nav ml-auto">
                    <li><button class="btn-outline-secondary btn nav-link current-btn">Current Workshops</button></li>
                    <li><button class="btn-outline-secondary btn nav-link change-btn">Update account</button></li>
                    <li><button class="btn-outline-secondary btn nav-link" data-toggle="modal" data-target="#reset">Reset password</button></li>
                    <li><button class="btn-outline-secondary btn nav-link" data-toggle="modal" data-target="#add-workshop">Add workshop</button></li>
                </ul>
                </div>
            </nav>
            ');
            echo("</div>");

            echo("<div class='control-area'>");

            echo("<div id='current-event-list' class='event-list p-2'>");
            echo("<h2 class='dash-header'>Current Workshops: </h2><hr>");
            echo("<div id='current-event-list-section' class='container'>");
            $stm = $conn->prepare('SELECT * from events');
            $stm->execute();
            while($event = $stm->fetch(PDO::FETCH_ASSOC))
            {
                $eventID = $event['event_id'];
                        echo(
                        "<div id='event" . $eventID . "' class='row event my-4 p-2'>" .
                        "<div class='col-xs-9 col-sm-9 col-md-10 col-lg-10'>" .
                        "<h3>"                   . $event['title']        . "</h3>" .
                        "<b>Type: </b>"          . $event['type']         . "<br/>" .
                        "<p>"                    . $event['description']  . "</p><br/><br/>" .
                        "<b>Location: </b>"      . $event['location']     . "<br/>" .
                        "<b>Date: </b>"          . $event['startTime']    . "<br/>" .
                        "<b>Date Posted: </b>"   . $event['dateStamp']    . "<br/>" .
                        "</div>");

                        echo("<div class='col-xs-3 col-sm-3 col-md-2 col-lg-2'>");
                            echo("<ul class='user-attendance'>");
                            $sql = $conn->prepare('SELECT user_id FROM user_event WHERE event_id = ?');
                            $sql->execute([$eventID]);
                            if($sql->rowCount() > 0)
                            {
                                while($eventResult = $sql->fetch())
                                {
                                    $sql2 = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
                                    $sql2->execute([$eventResult['user_id']]);
                                    while($userResults = $sql2->fetch())
                                    {
                                        echo("<li>". $userResults['user_uid'] ."</li>");
                                    }
                                }
                            }
                            else
                            {
                                echo("<li>There are no users going to this event</li>");
                            }
                            echo("</ul>");
                        echo("</div>");

                        echo("</div><hr>");
            }
            echo("</div>");
            echo("</div>");

            echo("<div id='change-info' class='p-2' style='display:none;'>");
            echo("<h2 class='dash-header'>Update your personal information: </h2><hr>");
            echo("<div id='change-section' class='container'>");
            echo("
            <div class='row'>
            <ul class='current-info'>
            <li><b>First name: </b>". $result['user_first'] ."</li>
            <li><b>Last name: </b>". $result['user_last'] ."</li>
            <li><b>Email: </b>". $result['user_email'] ."</li>
            <li><b>Phone number: </b>". $result['user_phone'] ."</li>
            <li><b>User name: </b>". $result['user_uid'] ."</li>
            </ul>
            </div>
            <div class='row'>
            <div class='col-xs-5 col-sm-5 col-md-5 col-lg-4'>
            <ul class='change-list'>
            <li><button class='btn-outline-primary btn nav-link change-pw-btn'>Change password</button></li>
            <li><button class='btn-outline-primary btn nav-link change-phone-btn'>Change phone number</button></li>
            <li><button class='btn-outline-primary btn nav-link change-email-btn'>Change email</button></li>
            <li></li>
            </ul>
            </div>
            <div class='change-section col-xs-7 col-sm-7 col-md-7 col-lg-8'>
            <div class='change-pw' id='change-pw' style='display:none;'>
            <form id='change-pw-form'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                    <li><input id='change-pw-input' type='text' placeholder='New password' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
                    <li><input id='change-pw2-input' type='text' placeholder='Re-type new password' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
                </ul>
                <button id='change-pw-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Reset password</button>
            </form>
            </div>

            <div class='change-phone' id='change-phone' style='display:none;'>
            <form id='change-phone-form'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                    <li><input id='change-phone-input' type='text' class='input-small form-control bfh-phone' data-country='US' aria-label='small' data-toggle='tooltip' title='Enter your new phone number (only digits)'></li>
                    <li><input id='change-phone2-input' type='text' class='input-small form-control bfh-phone' data-country='US' aria-label='small' data-toggle='tooltip' title='Re-type your new phone number (only digits)'></li>
                </ul>
                <button id='change-phone-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Reset phone</button>
            </form>
            </div>

            <div class='change-email' id='change-email' style='display:none;'>
            <form id='change-email-form'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                    <li><input id='change-email-input' type='text' placeholder='New email' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your new email'></li>
                    <li><input id='change-email2-input' type='text' placeholder='Re-type new email' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your new email'></li>
                </ul>
                <button id='change-email-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Reset email</button>
            </form>
            </div>

            </div>
            </div>
            ");
            echo("</div>");
            echo("</div>");

            echo("</div>");

            echo("</div>");
            //MODAL FOR RESET USER PASSWORD
            echo('
                    <div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="resetLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="resetLabel">Reset user password</h4>
                          </div>
                          <div class="modal-body">
                              <form id="reset-form">
                              <p class="form-message"></p>
                                  <ul>
                                      <li><input id="reset-email" type="text" placeholder="User email" class="form-control" aria-label="small"></li>
                                      <li><input id="reset-pw" type="text" placeholder="New user password" class="form-control" aria-label="small"></li>
                                      <li><input id="reset-pw2" type="text" placeholder="Re-type new user password" class="form-control" aria-label="small"></li>
                                  </ul>
                                  <button id="submit" type="submit" class="btn btn-primary main-btn"><b>Reset Password</b></button>
                              </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    ');

                    //MODAL FOR ADD WORKSHOP
                    echo('
                    <div class="modal fade" id="add-workshop" tabindex="-1" role="dialog" aria-labelledby="resetLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="resetLabel">Add a workshop</h4>
                            </div>
                            <div class="modal-body">
                              <form id="add-work-form">
                              <p class="form-message"></p>
                                          <ul>
                                              <li><input id="work-title" type="text" placeholder="Workshop title" class="form-control" aria-label="small"></li>
                                              <li><input id="work-desc" type="text" placeholder="Workshop description" class="form-control" aria-label="small"></li>
                                              <li><input id="work-loc" type="text" placeholder="Workshop location" class="form-control" aria-label="small"></li>
                                              <li><input id="work-start" type="text" placeholder="Workshop starting time (YYYY-MM-DD 00:00:00)" class="form-control" aria-label="small"></li>
                                              <li><input id="work-end" type="text" placeholder="Workshop ending time (YYYY-MM-DD 00:00:00)" class="form-control" aria-label="small"></li>
                                              <li>
                                              <ul class="reset-list">
                                                  <li>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="TRUE" id="add-work-med">
                                                    <label class="form-check-label" for="add-work-med">Medical</label>
                                                <br/>
                                                    <input class="form-check-input" type="checkbox" value="TRUE" id="add-work-it">
                                                    <label class="form-check-label" for="add-work-it">IT</label>
                                                <br/>
                                                    <input class="form-check-input" type="checkbox" value="TRUE" id="add-work-bus">
                                                    <label class="form-check-label" for="add-work-bus">Business</label>
                                                <br/>
                                                    <input class="form-check-input" type="checkbox" value="TRUE" id="add-work-health">
                                                    <label class="form-check-label" for="add-work-health">Health care</label>
                                                <br/>
                                                    <input class="form-check-input" type="checkbox" value="TRUE" id="add-work-food">
                                                    <label class="form-check-label" for="add-work-food">Food service</label>
                                                <br/>
                                                    <input class="form-check-input" type="checkbox" value="TRUE" id="add-work-hosp">
                                                    <label class="form-check-label" for="add-work-hosp">Hospitality</label>
                                                <br/>
                                                    <input class="form-check-input" type="checkbox" value="TRUE" id="add-work-cul">
                                                    <label class="form-check-label" for="add-work-cul">Culinary</label>
                                                  </div>
                                                  </li>
                                              </ul>
                                              </li>
                                          </ul>
                                          <button id="submit-workshop" type="submit" class="btn btn-primary main-btn"><b>Add</b></button>
                                      </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            ');
    }
    elseif ($result['user_type'] == "employer")
    {
      echo("<link href='styles/home-employer.css' rel='stylesheet'>");
      echo("<link href='formhelper/css/bootstrap-formhelpers.css' rel='stylesheet'/>");

      echo('<script>');
      echo("
          $(document).ready(function(){
              $('#postJob-form').submit(function(event){
                  var x = 'Are you sure you want to post this job?'
                  if(confirm(x))
                  {
                      event.preventDefault();

                      var title = $('#postJob-title').val();
                      var description = $('#postJob-description').val();
                      var position = $('#postJob-position').val();
                      var location = $('#postJob-location').val();

                      var med = $('#postJob-med');
                      var it = $('#postJob-it');
                      var bus = $('#postJob-bus');
                      var health = $('#postJob-health');
                      var food = $('#postJob-food');
                      var hosp = $('#postJob-hosp');
                      var cul = $('#postJob-cul');

                      var submit = $('#submit').val();

                      $('.form-message').load('php/post-job.php', {
                          title: title,
                          description: description,
                          position: position,
                          location: location,
                          med: med.prop('checked'),
                          it: it.prop('checked'),
                          bus: bus.prop('checked'),
                          health: health.prop('checked'),
                          food: food.prop('checked'),
                          hosp: hosp.prop('checked'),
                          cul: cul.prop('checked'),
                          submit: submit
                      });
                  }
              });
              $(document).on('click','.rem-btn',function(){
                  var x = 'Are you sure you want to remove this job?'
                  if(confirm(x))
                  {
                      var ID = $(this).attr('id');
                      $('#job'+ID).hide();
                      $.ajax({
                          type: 'POST',
                          url: 'php/remove-job.php',
                          data: {
                              ID: ID
                          },
                          success: function(html){
                              $('#job'+ID).remove();
                          }
                      });
                  }
              });
              $(document).on('click','.all-btn',function(){
                  $('#own-events-list').hide();
                  $('#change-info').hide();
                  $('#job-list').hide();
                  $('#post-job').hide();
                  $('#work-rec-list').hide();
                  $('#all-events-list').show();
              });
              $(document).on('click','.own-btn',function(){
                  $('#all-events-list').hide();
                  $('#change-info').hide();
                  $('#job-list').hide();
                  $('#post-job').hide();
                  $('#work-rec-list').hide();
                  $('#own-events-list').show();
              });
              $(document).on('click','.job-list-btn',function(){
                  $('#all-events-list').hide();
                  $('#change-info').hide();
                  $('#own-events-list').hide();
                  $('#post-job').hide();
                  $('#work-rec-list').hide();
                  $('#job-list').show();
              });
              $(document).on('click','.work-rec-btn',function(){
                $('#all-events-list').hide();
                $('#change-info').hide();
                $('#own-events-list').hide();
                $('#post-job').hide();
                $('#job-list').hide();
                $('#work-rec-list').show();
              });
              $(document).on('click','.post-job-btn',function(){
                  $('#all-events-list').hide();
                  $('#own-events-list').hide();
                  $('#job-list').hide();
                  $('#change-info').hide();
                  $('#work-rec-list').hide();
                  $('#post-job').show();
              });
              $(document).on('click','.change-btn',function(){
                  $('#all-events-list').hide();
                  $('#own-events-list').hide();
                  $('#job-list').hide();
                  $('#post-job').hide();
                  $('#work-rec-list').hide();
                  $('#change-info').show();
              });
              $(document).on('click','.change-pw-btn',function(){
                  $('#change-phone').hide();
                  $('#change-email').hide();
                  $('#change-sector-section').hide();
                  $('#change-pw').show();
              });
              $(document).on('click','.change-phone-btn',function(){
                  $('#change-email').hide();
                  $('#change-pw').hide();
                  $('#change-sector-section').hide();
                  $('#change-phone').show();
              });
              $(document).on('click','.change-email-btn',function(){
                  $('#change-phone').hide();
                  $('#change-pw').hide();
                  $('#change-sector-section').hide();
                  $('#change-email').show();
              });
              $(document).on('click','.change-sector-btn',function(){
                  $('#change-phone').hide();
                  $('#change-pw').hide();
                  $('#change-email').hide();
                  $('#change-sector-section').show();
              });
          });
          ");
      echo('</script>');


      echo("<div class='grid'>");

      echo("<div class='hero1'></div>");

      echo("<div class='greet py-5'>");
      echo("<h1 style='color: white' id='demo'>Welcome, " . $result['user_first'] . "</h1>");
      echo("</div>");

      echo("<div class='dashboard-control'>");

      echo('
      <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar2">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-collapse collapse justify-content-stretch" id="navbar2">
          <ul class="navbar-nav m-auto">
              <li class="main-btn"><button class="btn-sm btn-outline-secondary btn nav-link all-btn">All Workshops</button></li>
              <li class="main-btn"><button class="btn-sm btn-outline-secondary btn nav-link own-btn">Your Workshops</button></li>
              <li class="main-btn"><button class="btn-sm btn-outline-secondary btn nav-link work-rec-btn">Workshops for you</button></li>
              <li class="main-btn"><button class="btn-sm btn-outline-secondary btn nav-link job-list-btn">Your Jobs</button></li>
              <li class="main-btn"><button class="btn-sm btn-outline-secondary btn nav-link post-job-btn">Post Job</button></li>
              <li class="main-btn"><button class="btn-sm btn-outline-secondary btn nav-link change-btn">Update account</button></li>
          </ul>
          </div>
      </nav>
      ');

      echo("</div>");

      echo("<div class='control-area'>");

      echo("<div id='all-events-list' class='event-list p-2'>");
      echo("<h2 class='dash-header'>All Workshops: </h2><hr>");
      echo("<div id='all-events-list-section' class='container'>");
      
            //for ($i = 0; $i < sizeof(getEventList($conn)); $i++)
            foreach(getEventList($conn) as $e)
            {      
                            echo(
                            "<div id='event" . $e->getID()  . "' class='event my-4'>" .
                            "<h3>"                   . $e->getTitle()        . "</h3>" .
                            "<p>"                    . $e->getDesc()  . "</p><br/><br/>" .
                            "<b>Location: </b>"      . $e->getLoc()     . "<br/>" .
                            "<b>Date: </b>"          . $e->getStart()    . "<br/>" .
                            "<b>Date Posted: </b>"   . $e->getDateStamp()    . "<br/>");
                            $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                            $stm2->execute([$result['user_id']]);
                            $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                            if(!empty($map_result))
                            {
                                    $flag = false;
                                    foreach($map_result as $a)
                                    {
                                        if($a['event_id'] == $e->getID())
                                        {
                                            echo("<button id='" . $e->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                            $flag = true;
                                        }
                                    }
                                    if(!$flag)
                                    {
                                        echo("<button id='" . $e->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                    }
                            }
                            else
                            {
                                    echo("<button id='" . $e->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                            }
                            echo("</div><hr>");
            }
      echo("</div>");
      echo("<div class='show-more-container'>");
      echo('<button id="more-all-events-button" class="btn btn-primary more-btn">Show more</button>');
      echo("</div>");
      echo("</div>");

      echo("<div id='own-events-list' class='event-list p-2' style='display:none;'>");
      echo("<h2 class='dash-header'>Your Workshops: </h2><hr>");
      echo("<div id='own-events-list-section' class='container'>");
      $stm = $conn->prepare('SELECT * FROM user_event WHERE user_id = ? LIMIT 2');
      $stm->execute([$result['user_id']]);
      if($stm->rowCount() > 0)
      {
          while($map_result = $stm->fetch(PDO::FETCH_ASSOC))
          {
              $stm2 = $conn->prepare('SELECT * FROM events WHERE event_id = ? ORDER BY dateStamp DESC');
              $stm2->execute([$map_result['event_id']]);
              while($event = $stm2->fetch(PDO::FETCH_ASSOC))
              {
                  echo(
                  "<div id='event" . $event['event_id'] . "' class='event my-4'>" .
                  "<h3>"                   . $event['title']        . "</h3>" .
                  "<b>Type: </b>"          . $event['type']         . "<br/>" .
                  "<p>"                    . $event['description']  . "</p><br/><br/>" .
                  "<b>Location: </b>"      . $event['location']     . "<br/>" .
                  "<b>Date: </b>"          . $event['startTime']    . "<br/>" .
                  "<b>Date Posted: </b>"   . $event['dateStamp']    . "<br/>");
                  echo("<button id='" . $event['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                  echo("</div><hr>");
              }
          }
      }
      else
      {
          echo("<div class='my-4'><h3>You are not subscribed to any Workshops yet!</h3></div>");
      }
      echo("</div>");
      echo("<div class='show-more-container'>");
      echo('<button id="more-own-events-button" class="btn btn-primary more-btn">Show more</button>');
      echo("</div>");
      echo("</div>");

      echo("<div id='job-list' class='event-list p-2' style='display:none;'>");
      echo("<h2 class='dash-header'>My jobs: </h2><hr>");
      echo("<div id='job-list-section' class='container'>");
      $stm = $conn->prepare('SELECT * FROM employers WHERE user_id = ?');
      $stm->execute([$result['user_id']]);
      $employerResult = $stm->fetch();
      $stm = $conn->prepare('SELECT * from jobs WHERE employer_id = ? ORDER BY dateStamp DESC LIMIT 2');
      $stm->execute([$employerResult['employer_id']]);
      if($stm->rowCount() > 0)
      {
          while($event = $stm->fetch(PDO::FETCH_ASSOC))
          {
                      echo (
                      "<div id='job" . $event['job_id'] . "' class='event my-4'>" .
                      "<h3>"                   . htmlspecialchars($event['job_title'])        . "</h3>" .
                      "<b>Position: </b>"      . htmlspecialchars($event['job_position'])         . "</p>" .
                      "<p>"                    . htmlspecialchars($event['job_description'])  . "<br/><br/>" .
                      "<b>Location: </b>"      . htmlspecialchars($event['job_location'])     . "<br/>" .
                      "<b>Contact: </b>"       . htmlspecialchars($result['user_email'])     . "<br/>");
                      echo("<button id='" . $event['job_id'] . "' class='btn btn-primary rem-btn'>Remove</button>");
                      echo("</div><hr>");
          }
      }
      else
      {
          echo("<div class='my-4'><h3>You have no job postings yet!</h3></div>");
      }
      echo("</div>");
      echo("<div class='show-more-container'>");
      echo('<button id="more-own-jobs-button" class="btn btn-primary more-btn">Show more</button>');
      echo("</div>");
      echo("</div>");

      echo("<div id='post-job' class='p-2' style='display:none;'>");
      echo("<h2 class='dash-header'>Post your job: </h2><hr>");
      echo("<div id='post-job-section' class='container'>");
      echo("
      <form id='postJob-form'>
      <p class='form-message'></p>
          <ul>
              <li><input id='postJob-title' type='text' placeholder='Job title' class='form-control' aria-label='small'></li>
              <li><input id='postJob-position' type='text' placeholder='Job position' class='form-control' aria-label='small'></li>
              <li><input id='postJob-location' type='text' placeholder='Job location' class='form-control' aria-label='small'></li>
              <li><textarea id='postJob-description' type='text' placeholder='Job description' class='form-control' aria-label='small' rows='3'></textarea></li>

              <li class='py-3'><h6>What sections is your job involved with? <br/>(check all that apply)</h6></li>
              <li>
                  <div class='form-check'>
                    <input class='form-check-input' type='checkbox' value='TRUE' id='postJob-med'>
                    <label class='form-check-label' for='postJob-medical'>Medical</label>
                <br/>
                    <input class='form-check-input' type='checkbox' value='TRUE' id='postJob-it'>
                    <label class='form-check-label' for='postJob-it'>IT</label>
                <br/>
                    <input class='form-check-input' type='checkbox' value='TRUE' id='postJob-bus'>
                    <label class='form-check-label' for='postJob-business'>Business</label>
                <br/>
                    <input class='form-check-input' type='checkbox' value='TRUE' id='postJob-health'>
                    <label class='form-check-label' for='postJob-health'>Health care</label>
                <br/>
                    <input class='form-check-input' type='checkbox' value='TRUE' id='postJob-food'>
                    <label class='form-check-label' for='postJob-food'>Food service</label>
                <br/>
                    <input class='form-check-input' type='checkbox' value='TRUE' id='postJob-hosp'>
                    <label class='form-check-label' for='postJob-hosp'>Hospitality</label>
                <br/>
                    <input class='form-check-input' type='checkbox' value='TRUE' id='postJob-cul'>
                    <label class='form-check-label' for='postJob-cul'>Culinary</label>
                  </div>
              </li>
          </ul>
          <button id='submit' type='submit' class='btn btn-primary main-btn more-btn'>Post job</button>
      </form>
      ");
      echo("</div>");
      echo("</div>");

      echo("<div id='work-rec-list' class='event-list p-2' style='display:none;'>");
            echo("<h2 class='dash-header'>Workshops for you: </h2><hr>");
            echo("<div id='work-rec-list-section' class='container'>");
            $stmOccupations = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
            $stmOccupations->execute([$result['user_id']]);
            $userOccupation = $stmOccupations->fetch(PDO::FETCH_ASSOC);
            $worksFound = 0;
            $stm2 = $conn->prepare('SELECT * FROM events ORDER BY dateStamp DESC LIMIT 2');
            $stm2->execute();
            while($eventListing = $stm2->fetch(PDO::FETCH_ASSOC))
            {
              if(
              ($eventListing['isMedical'] == 'true' && $userOccupation['medical'] == 'true') ||
              ($eventListing['isIT'] == 'true' && $userOccupation['IT'] == 'true') ||
              ($eventListing['isHealthcare'] == 'true' && $userOccupation['healthcare'] == 'true') ||
              ($eventListing['isBusiness'] == 'true' && $userOccupation['business'] == 'true') ||
              ($eventListing['isFoodservice'] == 'true' && $userOccupation['foodservice'] == 'true') ||
              ($eventListing['isHospitality'] == 'true' && $userOccupation['hospitality'] == 'true') ||
              ($eventListing['isCulinary'] == 'true' && $userOccupation['culinary'] == 'true')
              )
              {
                echo(
                "<div id='event" . $eventListing['event_id'] . "' class='event my-4'>" .
                "<h3>"                   . $eventListing['title']        . "</h3>" .
                "<b>Type: </b>"          . $eventListing['type']         . "<br/>" .
                "<p>"                    . $eventListing['description']  . "</p><br/><br/>" .
                "<b>Location: </b>"      . $eventListing['location']     . "<br/>" .
                "<b>Date: </b>"          . $eventListing['startTime']    . "<br/>" .
                "<b>Date Posted: </b>"   . $eventListing['dateStamp']    . "<br/>");
                $stm3 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                $stm3->execute([$result['user_id']]);
                $map_result = $stm3->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($map_result))
                {
                        $flag = false;
                        foreach($map_result as $a)
                        {
                            if($a['event_id'] == $eventListing['event_id'])
                            {
                                echo("<button id='" . $eventListing['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                $flag = true;
                            }
                        }
                        if(!$flag)
                        {
                            echo("<button id='" . $eventListing['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                        }
                }
                else
                {
                        echo("<button id='" . $eventListing['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                }
                echo("</div><hr>");
                $worksFound += 1;
              }
            }
            if($worksFound <= 0)
            {
              echo("<div class='my-4'><h3>Couldnt find a event for you m8</h3></div>");
            }
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-work-rec-button" class="btn btn-primary more-btn">Show more</button>');
            echo("</div>");
            echo("</div>");

      echo("<div id='change-info' class='p-2' style='display:none;'>");
      echo("<h2 class='dash-header'>Update your personal information: </h2><hr>");
      echo("<div id='change-section' class='container'>");
      echo("
      <div class='row'>
      <ul class='current-info'>
      <li><b>First name: </b>". $result['user_first'] ."</li>
      <li><b>Last name: </b>". $result['user_last'] ."</li>
      <li><b>Email: </b>". $result['user_email'] ."</li>
      <li><b>Phone number: </b>". $result['user_phone'] ."</li>
      <li><b>User name: </b>". $result['user_uid'] ."</li>
      <li>
        <b>Sectors: </b>
        <ul>
        <li>medical: ".$userOccupation['medical']."</li>
        <li>IT: ".$userOccupation['IT']."</li>
        <li>healthcare: ".$userOccupation['healthcare']."</li>
        <li>business: ".$userOccupation['business']."</li>
        <li>foodservice: ".$userOccupation['foodservice']."</li>
        <li>hospitality: ".$userOccupation['hospitality']."</li>
        <li>culinary: ".$userOccupation['culinary']."</li>
        </ul>
      </li>
      </ul>
      </div>
      <div class='row'>
      <div class='col-xs-5 col-sm-5 col-md-5 col-lg-4'>
      <ul class='change-list'>
      <li><button class='btn-outline-primary btn nav-link change-pw-btn'>Change password</button></li>
      <li><button class='btn-outline-primary btn nav-link change-phone-btn'>Change phone number</button></li>
      <li><button class='btn-outline-primary btn nav-link change-email-btn'>Change email</button></li>
      <li><button class='btn-outline-primary btn nav-link change-sector-btn'>Change sectors</button></li>
      <li></li>
      </ul>
      </div>
      <div class='change-section col-xs-7 col-sm-7 col-md-7 col-lg-8'>
      <div class='change-pw' id='change-pw' style='display:none;'>
      <form id='change-pw-form'>
          <p class='form-message'></p>
          <ul class='reset-list'>
              <li><input id='change-pw-input' type='text' placeholder='New password' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
              <li><input id='change-pw2-input' type='text' placeholder='Re-type new password' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
          </ul>
          <button id='change-pw-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Reset password</button>
      </form>
      </div>

      <div class='change-phone' id='change-phone' style='display:none;'>
      <form id='change-phone-form'>
          <p class='form-message'></p>
          <ul class='reset-list'>
              <li><input id='change-phone-input' type='text' class='input-small form-control bfh-phone' data-country='US' aria-label='small' data-toggle='tooltip' title='Enter your new phone number (only digits)'></li>
              <li><input id='change-phone2-input' type='text' class='input-small form-control bfh-phone' data-country='US' aria-label='small' data-toggle='tooltip' title='Re-type your new phone number (only digits)'></li>
          </ul>
          <button id='change-phone-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Reset phone</button>
      </form>
      </div>

      <div class='change-email' id='change-email' style='display:none;'>
      <form id='change-email-form'>
          <p class='form-message'></p>
          <ul class='reset-list'>
              <li><input id='change-email-input' type='text' placeholder='New email' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your new email'></li>
              <li><input id='change-email2-input' type='text' placeholder='Re-type new email' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your new email'></li>
          </ul>
          <button id='change-email-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Reset email</button>
      </form>
      </div>

      <div class='change-sector-section' id='change-sector-section' style='display:none;'>
      <h3>Check the sectors that apply to your job search.</h3>
      <form id='change-sector-form'>
          <p class='form-message'></p>
          <ul class='reset-list'>
              <li>
              <div class='form-check'>
                <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-med'>
                <label class='form-check-label' for='change-sector-med'>Medical</label>
            <br/>
                <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-it'>
                <label class='form-check-label' for='change-sector-it'>IT</label>
            <br/>
                <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-bus'>
                <label class='form-check-label' for='change-sector-bus'>Business</label>
            <br/>
                <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-health'>
                <label class='form-check-label' for='change-sector-health'>Health care</label>
            <br/>
                <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-food'>
                <label class='form-check-label' for='change-sector-food'>Food service</label>
            <br/>
                <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-hosp'>
                <label class='form-check-label' for='change-sector-hosp'>Hospitality</label>
            <br/>
                <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-cul'>
                <label class='form-check-label' for='change-sector-cul'>Culinary</label>
              </div>
              </li>
          </ul>
          <button id='change-sector-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Change sectors</button>
      </form>
      </div>

      </div>
      </div>
      ");
      echo("</div>");
      echo("</div>");

      echo("</div>");

      echo("</div>");
      echo("<script src='formhelper/js/bootstrap-formhelpers-phone.js'></script>");
      echo("<script src='formhelper/js/bootstrap-formhelpers.js'></script>");
    }
    else
    {
            echo("<link href='styles/home-user.css' rel='stylesheet'>");
            echo("<link href='formhelper/css/bootstrap-formhelpers.css' rel='stylesheet'/>");
            echo("
            <script>
            $(document).ready(function() {
                var jobRecCount = 2;
                $('#more-job-rec-button').click(function(){
                  jobRecCount += 2;
                  $('#job-rec-list-section').load('php/load-job-rec-events.php', {
                    jobRecNewCount: jobRecCount
                  });
                });
                $(document).on('click','.all-btn',function(){
                    $('#own-events-list').hide();
                    $('#change-info').hide();
                    $('#work-rec-list').hide();
                    $('#job-rec-list').hide();
                    $('#all-events-list').show();
                });
                $(document).on('click','.own-btn',function(){
                  $('#all-events-list').hide();
                  $('#change-info').hide();
                  $('#work-rec-list').hide();
                  $('#job-rec-list').hide();
                  $('#own-events-list').show();
                });
                $(document).on('click','.work-rec-btn',function(){
                  $('#all-events-list').hide();
                  $('#change-info').hide();
                  $('#own-events-list').hide();
                  $('#job-rec-list').hide();
                  $('#work-rec-list').show();
                });
                $(document).on('click','.job-rec-btn',function(){
                  $('#job-rec-list-section').load('php/load-job-rec-events.php', {
                    jobRecNewCount: jobRecCount
                  });
                  $('#all-events-list').hide();
                  $('#change-info').hide();
                  $('#own-events-list').hide();
                  $('#work-rec-list').hide();
                  $('#job-rec-list').show();
                });
                $(document).on('click','.change-btn',function(){
                    $('#all-events-list').hide();
                    $('#own-events-list').hide();
                    $('#work-rec-list').hide();
                    $('#job-rec-list').hide();
                    $('#change-info').show();
                });
                $(document).on('click','.change-pw-btn',function(){
                    $('#change-phone').hide();
                    $('#change-email').hide();
                    $('#upload-section').hide();
                    $('#change-sector-section').hide();
                    $('#change-pw').show();
                });
                $(document).on('click','.change-phone-btn',function(){
                    $('#change-email').hide();
                    $('#change-pw').hide();
                    $('#upload-section').hide();
                    $('#change-sector-section').hide();
                    $('#change-phone').show();
                });
                $(document).on('click','.change-email-btn',function(){
                    $('#change-phone').hide();
                    $('#change-pw').hide();
                    $('#upload-section').hide();
                    $('#change-sector-section').hide();
                    $('#change-email').show();
                });
                $(document).on('click','.upload-btn',function(){
                    $('#change-phone').hide();
                    $('#change-pw').hide();
                    $('#change-email').hide();
                    $('#change-sector-section').hide();
                    $('#upload-section').show();
                });
                $(document).on('click','.change-sector-btn',function(){
                    $('#change-phone').hide();
                    $('#change-pw').hide();
                    $('#change-email').hide();
                    $('#upload-section').hide();
                    $('#change-sector-section').show();
                });
                $('#upload-form').submit(function(event){
                    var x = 'Are you sure you want to upload this resume?'
                    if(confirm(x))
                    {
                        event.preventDefault();

                        $.ajax({
                        url: 'php/upload-resume.php', // Url to which the request is send
                        type: 'POST',             // Type of request to be send, called as method
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false        // To send DOMDocument or non processed data file it is set to false
                        });
                    }
                });
            });
            </script>
            ");
            echo("<div class='grid'>");

            echo("<div class='hero1'></div>");

            echo("<div class='greet py-5'>");
            echo("<h1 style='color: white' id='demo'>Welcome, " . $result['user_first'] . "</h1>");
            echo("</div>");

            echo("<div class='dashboard-control'>");
            echo('
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar2">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-stretch" id="navbar2">
                <ul class="navbar-nav ml-auto">
                    <li class="main-btn"><button class="btn-outline-secondary btn nav-link all-btn">All Workshops</button></li>
                    <li class="main-btn"><button class="btn-outline-secondary btn nav-link own-btn">Your Workshops</button></li>
                    <li class="main-btn"><button class="btn-outline-secondary btn nav-link work-rec-btn">Workshops for you</button></li>
                    <li class="main-btn"><button class="btn-outline-secondary btn nav-link job-rec-btn">Jobs for you</button></li>
                    <li class="main-btn"><button class="btn-outline-secondary btn nav-link change-btn">Update account</button></li>
                </ul>
                </div>
            </nav>
            ');
            echo("</div>");

            echo("<div class='control-area'>");

            echo("<div id='all-events-list' class='event-list p-2'>");
            echo("<h2 class='dash-header'>All Workshops: </h2><hr>");
            echo("<div id='all-events-list-section' class='container'>");
                    foreach(getEventList($conn) as $e)
                    {
                                    echo(
                                    "<div id='event"         . $e->getID()  . "' class='event my-4'>" .
                                    "<h3>"                   . $e->getTitle()        . "</h3>" .
                                    "<p>"                    . $e->getDesc()  . "</p><br/><br/>" .
                                    "<b>Location: </b>"      . $e->getLoc()     . "<br/>" .
                                    "<b>Date: </b>"          . $e->getStart()    . "<br/>" .
                                    "<b>Date Posted: </b>"   . $e->getDateStamp()    . "<br/>");
                                    $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                    $stm2->execute([$result['user_id']]);
                                    $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                    if(!empty($map_result))
                                    {
                                            $flag = false;
                                            foreach($map_result as $a)
                                            {
                                                if($a['event_id'] == $e->getID())
                                                {
                                                    echo("<button id='" . $e->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                    $flag = true;
                                                }
                                            }
                                            if(!$flag)
                                            {
                                                echo("<button id='" . $e->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                            }
                                    }
                                    else
                                    {
                                            echo("<button id='" . $e->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                                    }
                                    echo("</div><hr>");
                    }
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-all-events-button" class="btn btn-primary more-btn">Show more</button>');
            echo("</div>");
            echo("</div>");

            echo("<div id='own-events-list' class='event-list p-2' style='display:none;'>");
            echo("<h2 class='dash-header'>Your Workshops: </h2><hr>");
            echo("<div id='own-events-list-section' class='container'>");
            $stm = $conn->prepare('SELECT * FROM user_event WHERE user_id = ? LIMIT 2');
            $stm->execute([$result['user_id']]);
            if($stm->rowCount() > 0)
            {
                while($map_result = $stm->fetch(PDO::FETCH_ASSOC))
                {
                    $stm2 = $conn->prepare('SELECT * FROM events WHERE event_id = ? ORDER BY dateStamp DESC');
                    $stm2->execute([$map_result['event_id']]);
                    while($event = $stm2->fetch(PDO::FETCH_ASSOC))
                    {
                        echo(
                        "<div id='event" . $event['event_id'] . "' class='event my-4'>" .
                        "<h3>"                   . $event['title']        . "</h3>" .
                        "<b>Type: </b>"          . $event['type']         . "<br/>" .
                        "<p>"                    . $event['description']  . "</p><br/><br/>" .
                        "<b>Location: </b>"      . $event['location']     . "<br/>" .
                        "<b>Date: </b>"          . $event['startTime']    . "<br/>" .
                        "<b>Date Posted: </b>"   . $event['dateStamp']    . "<br/>");
                        echo("<button id='" . $event['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                        echo("</div><hr>");
                    }
                }
            }
            else
            {
                echo("<div class='my-4'><h3>You are not subscribed to any Workshops yet!</h3></div>");
            }
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-own-events-button" class="btn btn-primary more-btn">Show more</button>');
            echo("</div>");
            echo("</div>");

            echo("<div id='work-rec-list' class='event-list p-2' style='display:none;'>");
            echo("<h2 class='dash-header'>Workshops for you: </h2><hr>");
            echo("<div id='work-rec-list-section' class='container'>");
            $stmOccupations = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
            $stmOccupations->execute([$result['user_id']]);
            $userOccupation = $stmOccupations->fetch(PDO::FETCH_ASSOC);
            $worksFound = 0;
            $stm2 = $conn->prepare('SELECT * FROM events ORDER BY dateStamp DESC LIMIT 2');
            $stm2->execute();
            while($eventListing = $stm2->fetch(PDO::FETCH_ASSOC))
            {
              if(
              ($eventListing['isMedical'] == 'true' && $userOccupation['medical'] == 'true') ||
              ($eventListing['isIT'] == 'true' && $userOccupation['IT'] == 'true') ||
              ($eventListing['isHealthcare'] == 'true' && $userOccupation['healthcare'] == 'true') ||
              ($eventListing['isBusiness'] == 'true' && $userOccupation['business'] == 'true') ||
              ($eventListing['isFoodservice'] == 'true' && $userOccupation['foodservice'] == 'true') ||
              ($eventListing['isHospitality'] == 'true' && $userOccupation['hospitality'] == 'true') ||
              ($eventListing['isCulinary'] == 'true' && $userOccupation['culinary'] == 'true')
              )
              {
                echo(
                "<div id='event" . $eventListing['event_id'] . "' class='event my-4'>" .
                "<h3>"                   . $eventListing['title']        . "</h3>" .
                "<b>Type: </b>"          . $eventListing['type']         . "<br/>" .
                "<p>"                    . $eventListing['description']  . "</p><br/><br/>" .
                "<b>Location: </b>"      . $eventListing['location']     . "<br/>" .
                "<b>Date: </b>"          . $eventListing['startTime']    . "<br/>" .
                "<b>Date Posted: </b>"   . $eventListing['dateStamp']    . "<br/>");
                $stm3 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                $stm3->execute([$result['user_id']]);
                $map_result = $stm3->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($map_result))
                {
                        $flag = false;
                        foreach($map_result as $a)
                        {
                            if($a['event_id'] == $eventListing['event_id'])
                            {
                                echo("<button id='" . $eventListing['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                $flag = true;
                            }
                        }
                        if(!$flag)
                        {
                            echo("<button id='" . $eventListing['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                        }
                }
                else
                {
                        echo("<button id='" . $eventListing['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                }
                echo("</div><hr>");
                $worksFound += 1;
              }
            }
            if($worksFound <= 0)
            {
              echo("<div class='my-4'><h3>Couldnt find a event for you m8</h3></div>");
            }
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-work-rec-button" class="btn btn-primary more-btn">Show more</button>');
            echo("</div>");
            echo("</div>");

            echo("<div id='job-rec-list' class='event-list p-2' style='display:none;'>");
            echo("<h2 class='dash-header'>Jobs for you: </h2><hr>");
            echo("<div id='job-rec-list-section' class='container'>");
            /*
            Get the users occupations
            */
            $stm = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
            $stm->execute([$result['user_id']]);
            $userOccupation = $stm->fetch(PDO::FETCH_ASSOC);
            $jobsFound = 0;
            /*
            Get the users occupations
            */
            $stm2 = $conn->prepare('SELECT * from jobs ORDER BY dateStamp DESC LIMIT 2');
            $stm2->execute();
            while($jobListing = $stm2->fetch(PDO::FETCH_ASSOC))
            {
              if(
              ($jobListing['isMedical'] == 'true' && $userOccupation['medical'] == 'true') ||
              ($jobListing['isIT'] == 'true' && $userOccupation['IT'] == 'true') ||
              ($jobListing['isHealthcare'] == 'true' && $userOccupation['healthcare'] == 'true') ||
              ($jobListing['isBusiness'] == 'true' && $userOccupation['business'] == 'true') ||
              ($jobListing['isFoodservice'] == 'true' && $userOccupation['foodservice'] == 'true') ||
              ($jobListing['isHospitality'] == 'true' && $userOccupation['hospitality'] == 'true') ||
              ($jobListing['isCulinary'] == 'true' && $userOccupation['culinary'] == 'true')
              )
              {
                  echo("<div id='job" . $jobListing['job_id'] . "' class='event my-4'>");
                  echo('<h3>'. $jobListing['job_title'] .'</h3>');
                  echo('<p>'. $jobListing['job_position'] .'</p>');
                  echo('<p>'. $jobListing['job_description'] .'</p>');
                  echo('<p>Location: '. $jobListing['job_location'] .'</p>');
                  echo("</div><hr>");
                  $jobsFound += 1;
              }
            }
            if($jobsFound <= 0)
            {
              echo("<div class='my-4'><h3>Couldnt find a job for you m8</h3></div>");
            }
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-job-rec-button" class="btn btn-primary more-btn">Show more</button>');
            echo("</div>");
            echo("</div>");

            echo("<div id='change-info' class='p-2' style='display:none;'>");
            echo("<h2 class='dash-header'>Update your personal information: </h2><hr>");
            echo("<div id='change-section' class='container'>");
            echo("
            <div class='row'>
            <ul class='current-info'>
            <li><b>First name: </b>". $result['user_first'] ."</li>
            <li><b>Last name: </b>". $result['user_last'] ."</li>
            <li><b>Email: </b>". $result['user_email'] ."</li>
            <li><b>Phone number: </b>". $result['user_phone'] ."</li>
            <li><b>User name: </b>". $result['user_uid'] ."</li>
            <li>
              <b>Sectors: </b>
              <ul>
              <li>medical: ".$userOccupation['medical']."</li>
              <li>IT: ".$userOccupation['IT']."</li>
              <li>healthcare: ".$userOccupation['healthcare']."</li>
              <li>business: ".$userOccupation['business']."</li>
              <li>foodservice: ".$userOccupation['foodservice']."</li>
              <li>hospitality: ".$userOccupation['hospitality']."</li>
              <li>culinary: ".$userOccupation['culinary']."</li>
              </ul>
            </li>
            </ul>
            </div>
            <div class='row'>
            <div class='col-xs-5 col-sm-5 col-md-5 col-lg-4'>
            <ul class='change-list'>
            <li><button class='btn-outline-primary btn nav-link change-pw-btn'>Change password</button></li>
            <li><button class='btn-outline-primary btn nav-link change-phone-btn'>Change phone number</button></li>
            <li><button class='btn-outline-primary btn nav-link change-email-btn'>Change email</button></li>
            <li><button class='btn-outline-primary btn nav-link upload-btn'>Upload Resume</button></li>
            <li><button class='btn-outline-primary btn nav-link change-sector-btn'>Change sectors</button></li>
            <li></li>
            </ul>
            </div>
            <div class='change-section col-xs-7 col-sm-7 col-md-7 col-lg-8'>

            <div class='change-pw' id='change-pw' style='display:none;'>
            <form id='change-pw-form'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                    <li><input id='change-pw-input' type='text' placeholder='New password' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
                    <li><input id='change-pw2-input' type='text' placeholder='Re-type new password' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
                </ul>
                <button id='change-pw-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Reset password</button>
            </form>
            </div>

            <div class='change-phone' id='change-phone' style='display:none;'>
            <form id='change-phone-form'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                    <li><input id='change-phone-input' type='text' class='input-small form-control bfh-phone' data-country='US' aria-label='small' data-toggle='tooltip' title='Enter your new phone number (only digits)'></li>
                    <li><input id='change-phone2-input' type='text' class='input-small form-control bfh-phone' data-country='US' aria-label='small' data-toggle='tooltip' title='Re-type your new phone number (only digits)'></li>
                </ul>
                <button id='change-phone-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Reset phone</button>
            </form>
            </div>

            <div class='change-email' id='change-email' style='display:none;'>
            <form id='change-email-form'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                    <li><input id='change-email-input' type='text' placeholder='New email' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your new email'></li>
                    <li><input id='change-email2-input' type='text' placeholder='Re-type new email' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your new email'></li>
                </ul>
                <button id='change-email-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Reset email</button>
            </form>
            </div>

            <div class='upload-section' id='upload-section' style='display:none;'>
            <form id='upload-form' enctype='multipart/form-data'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                    <li><input type='file' name='fileToUpload' id='fileToUpload'></li>
                </ul>
                <button id='upload-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Upload</button>
            </form>
            </div>

            <div class='change-sector-section' id='change-sector-section' style='display:none;'>
            <h3>Check the sectors that apply to your job search.</h3>
            <form id='change-sector-form'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                    <li>
                    <div class='form-check'>
                      <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-med'>
                      <label class='form-check-label' for='change-sector-med'>Medical</label>
                  <br/>
                      <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-it'>
                      <label class='form-check-label' for='change-sector-it'>IT</label>
                  <br/>
                      <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-bus'>
                      <label class='form-check-label' for='change-sector-bus'>Business</label>
                  <br/>
                      <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-health'>
                      <label class='form-check-label' for='change-sector-health'>Health care</label>
                  <br/>
                      <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-food'>
                      <label class='form-check-label' for='change-sector-food'>Food service</label>
                  <br/>
                      <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-hosp'>
                      <label class='form-check-label' for='change-sector-hosp'>Hospitality</label>
                  <br/>
                      <input class='form-check-input' type='checkbox' value='TRUE' id='change-sector-cul'>
                      <label class='form-check-label' for='change-sector-cul'>Culinary</label>
                    </div>
                    </li>
                </ul>
                <button id='change-sector-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Change sectors</button>
            </form>
            </div>

            </div>
            </div>
            ");
            echo("</div>");
            echo("</div>");

            echo("</div>");

            echo("</div>");
            echo("<script src='formhelper/js/bootstrap-formhelpers-phone.js'></script>");
            echo("<script src='formhelper/js/bootstrap-formhelpers.js'></script>");
    }
    include 'footer.php';
}
else
{
    header("Location: index.php?error=signIn");
}
?>
