<?php
session_start();
if (isset($_SESSION['user_uid']))
{
    require 'header.php';
    include 'php/connect.php';
    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
    $sql->execute([$_SESSION['user_uid']]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    if($result['user_type'] == "admin")
    {
            echo("<link href='styles/home-admin.css' rel='stylesheet'>");

            echo('<script>');
            echo('
                $(document).ready(function(){
                    $("#reset-form").submit(function(event){
                        event.preventDefault();

                        var reset_email = $("#reset-email").val();
                        var reset_pw = $("#reset-pw").val();
                        var reset_pw2 = $("#reset-pw2").val();

                        var submit = $("#submit").val();

                            $(".form-message").load("php/reset-pw.php", {
                                reset_email: reset_email,
                                reset_pw: reset_pw,
                                reset_pw2: reset_pw2,
                                submit: submit
                            });
                    });
                });
                ');
            echo('</script>');

            echo("<div class='grid'>");

            echo("<div class='hero1'></div>");
            echo("<div class='greet py-5'>");
            echo("<h1 style='color: white' id='demo'>Welcome, " . $_SESSION['user_uid'] . "<br/>" . "You logged in as an: " . $result['user_type'] . "</h1>");
            echo("</div>");

            echo("<div class='btn-control-group'>");
            echo('<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#reset">Reset user password</button>');
            echo("</div>");

            echo("<div class='event-list'>");
            echo("<h2>Current Workshops: </h2><hr>");
            echo("<div id='event-list' class='container'>");
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
    }
    elseif ($result['user_type'] == "employer")
    {
            echo("<link href='styles/home-employer.css' rel='stylesheet'>");

            echo('<script>');
            echo('
                $(document).ready(function(){
                    $("#postJob-form").submit(function(event){
                        event.preventDefault();

                        var title = $("#postJob-title").val();
                        var description = $("#postJob-description").val();
                        var position = $("#postJob-position").val();
                        var location = $("#postJob-location").val();

                        var med = $("#postJob-med");
                        var it = $("#postJob-it");
                        var bus = $("#postJob-bus");
                        var health = $("#postJob-health");
                        var food = $("#postJob-food");
                        var hosp = $("#postJob-hosp");
                        var cul = $("#postJob-cul");

                        var submit = $("#submit").val();

                            $(".form-message").load("php/post-job.php", {
                                title: title,
                                description: description,
                                position: position,
                                location: location,
                                med: med.prop("checked"),
                                it: it.prop("checked"),
                                bus: bus.prop("checked"),
                                health: health.prop("checked"),
                                food: food.prop("checked"),
                                hosp: hosp.prop("checked"),
                                cul: cul.prop("checked"),
                                submit: submit
                            });
                    });

                    $(document).on("click",".rem-btn",function(){
                        var ID = $(this).attr("id");
                        $("#job"+ID).hide();
                            $.ajax({
                                type: "POST",
                                url: "php/remove-job.php",
                                data: {
                                    ID: ID
                                },
                                success: function(html){
                                    $("#job"+ID).remove();
                                }
                            });
                    });
                });
                ');
            echo('</script>');

            echo("<div class='grid'>");

            echo("<div class='hero1'></div>");
            echo("<div class='greet py-5'>");
            echo("<h1 style='color: white' id='demo'>Welcome, " . $_SESSION['user_uid'] . "<br/>" . "You logged in as an: " . $result['user_type'] . "</h1>");
            echo("</div>");

            echo("<div class='postJob'>");
            echo('<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#postJob">Post Job</button>');
            echo("</div>");

            echo("<div class='jobList'>");
            echo("<h2>My jobs: </h2><hr>");
            echo("<div id='job-list' class='container'>");

            $stm = $conn->prepare('SELECT * FROM employers WHERE user_id = ?');
            $stm->execute([$result['user_id']]);
            $employerResult = $stm->fetch();

            $stm = $conn->prepare('SELECT * from jobs WHERE employer_id = ?');
            $stm->execute([$employerResult['employer_id']]);

            if($stm->rowCount() > 0)
            {
                while($event = $stm->fetch(PDO::FETCH_ASSOC))
                {
                            echo (
                            "<div id='job" . $event['job_id'] . "' class='row event my-4 p-2'>" .
                            "<div class='col-xs-9 col-sm-9 col-md-10 col-lg-10'>" .
                            "<h3>"                   . htmlspecialchars($event['job_title'])        . "</h3>" .
                            "<b>Position: </b>"      . htmlspecialchars($event['job_position'])         . "</p>" .
                            "<p>"                    . htmlspecialchars($event['job_description'])  . "<br/><br/>" .
                            "<b>Location: </b>"      . htmlspecialchars($event['job_location'])     . "<br/>" .
                            "<b>Contact: </b>"       . htmlspecialchars($result['user_email'])     . "<br/>" .
                            "</div>");
                            echo("<div class='col-xs-3 col-sm-3 col-md-2 col-lg-2'>");
                                echo("<button id='" . $event['job_id'] . "' class='btn btn-primary rem-btn'>Remove</button>");
                            echo("</div></div><hr>");
                }
            }
            else
            {
                echo("<div class='row event my-4 p-2'>");
                echo("<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>");
                echo("<p>You don't have any job postings </p>");
                echo("</div></div><hr>");

            }
            echo("</div>");
            echo("</div>");

            echo("</div>");



            //MODAL FOR ADD JOB
            echo('
                    <div class="modal fade" id="postJob" tabindex="-1" role="dialog" aria-labelledby="postJobLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="postJobLabel">Post job</h4>
                          </div>
                          <div class="modal-body">
                              <form id="postJob-form">
                              <p class="form-message"></p>
                                  <ul>
                                      <li><input id="postJob-title" type="text" placeholder="Job title" class="form-control" aria-label="small"></li>
                                      <li><input id="postJob-position" type="text" placeholder="Job position" class="form-control" aria-label="small"></li>
                                      <li><input id="postJob-location" type="text" placeholder="Job location" class="form-control" aria-label="small"></li>
                                      <li><textarea id="postJob-description" type="text" placeholder="Job description" class="form-control" aria-label="small" rows="3"></textarea></li>

                                      <li><h6>What sections is your job involved with? <br/>(check all that apply)</h6></li>
                                      <li>
                                          <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="TRUE" id="postJob-med">
                                            <label class="form-check-label" for="postJob-medical">Medical</label>
                                        <br/>
                                            <input class="form-check-input" type="checkbox" value="TRUE" id="postJob-it">
                                            <label class="form-check-label" for="postJob-it">IT</label>
                                        <br/>
                                            <input class="form-check-input" type="checkbox" value="TRUE" id="postJob-bus">
                                            <label class="form-check-label" for="postJob-business">Business</label>
                                        <br/>
                                            <input class="form-check-input" type="checkbox" value="TRUE" id="postJob-health">
                                            <label class="form-check-label" for="postJob-health">Health care</label>
                                        <br/>
                                            <input class="form-check-input" type="checkbox" value="TRUE" id="postJob-food">
                                            <label class="form-check-label" for="postJob-food">Food service</label>
                                        <br/>
                                            <input class="form-check-input" type="checkbox" value="TRUE" id="postJob-hosp">
                                            <label class="form-check-label" for="postJob-hosp">Hospitality</label>
                                        <br/>
                                            <input class="form-check-input" type="checkbox" value="TRUE" id="postJob-cul">
                                            <label class="form-check-label" for="postJob-cul">Culinary</label>
                                          </div>
                                      </li>
                                  </ul>
                                  <button id="submit" type="submit" class="btn btn-primary main-btn"><b>Post job</b></button>
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
    else
    {
        echo("<link href='styles/home-user.css' rel='stylesheet'>");
        echo("
        <script>
        $(document).ready(function() {
            var allEventCount = 2;
            var ownEventCount = 2;
            $(document).on('click','.event-btn',function(){
                var ID = $(this).attr('id');
                $('#event'+ID).hide();
                    $.ajax({
                        type: 'POST',
                        url: 'php/subscribe.php',
                        data: {
                            ID: ID
                        },
                        success: function(html){
                            $('#event'+ID).remove();
                        }
                    });
            });
            $(document).on('click','.sub-event-btn',function(){
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
            });
            $(document).on('click','.all-btn',function(){

                $('#all-events-list-section').load('php/load-all-events.php', {
                    allEventNewCount: allEventCount
                });
                $('#own-events-list').hide();
                $('#all-events-list').show();
            });
            $(document).on('click','.own-btn',function(){

                $('#own-events-list-section').load('php/load-own-events.php', {
                    ownEventNewCount: ownEventCount
                });
                $('#all-events-list').hide();
                $('#own-events-list').show();
            });
            $('#more-all-events-button').click(function(){
                allEventCount += 2;
                $('#all-events-list-section').load('php/load-all-events.php', {
                    allEventNewCount: allEventCount
                });
            });
            $('#more-own-events-button').click(function(){
                ownEventCount += 2;
                $('#own-events-list-section').load('php/load-own-events.php', {
                    ownEventNewCount: ownEventCount
                });
            });
        });

        </script>
        ");

            echo("<div class='grid'>");

            echo("<div class='hero1'></div>");

            echo("<div class='greet py-5'>");
            echo("<h1 style='color: white' id='demo'>Welcome, " . $_SESSION['user_uid'] . "<br/>" . "You logged in as an: " . $result['user_type']  . "</h1>");
            echo("</div>");

            echo("<div class='dashboard-control'>");
            echo('<ul class="dashboard">');
            echo('<li><button class="all-btn">All Workshops</button></li>');
            echo('<li><button class="own-btn">Your Workshops</button></li>');
            echo('<li><button>Change personal info</button></li>');
            echo('</ul>');
            echo("</div>");

            echo("<div class='control-area'>");

            echo("<div id='all-events-list' class='event-list'>");
            echo("<h2>All Workshops: </h2><hr>");
            echo("<div id='all-events-list-section' class='container'>");

            $stm = $conn->prepare('SELECT * from events LIMIT 2');
            $stm->execute();
            while($event = $stm->fetch(PDO::FETCH_ASSOC))
            {
                        echo(
                        "<div id='event" . $event['event_id'] . "' class='row event my-4 p-2'>" .
                        "<div class='col-xs-9 col-sm-9 col-md-10 col-lg-10'>" .
                        "<h3>"                   . $event['title']        . "</h3>" .
                        "<b>Type: </b>"          . $event['type']         . "<br/>" .
                        "<p>"                    . $event['description']  . "</p><br/><br/>" .
                        "<b>Location: </b>"      . $event['location']     . "<br/>" .
                        "<b>Date: </b>"          . $event['startTime']    . "<br/>" .
                        "<b>Date Posted: </b>"   . $event['dateStamp']    . "<br/>" .
                        "</div>");
                        echo("<div class='col-xs-3 col-sm-3 col-md-2 col-lg-2'>");

                            $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                            $stm2->execute([$result['user_id']]);
                            $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                            if(!empty($map_result))
                            {
                                $flag = false;
                                    foreach($map_result as $a)
                                    {
                                        if($a['event_id'] == $event['event_id'])
                                        {
                                            echo("<button id='" . $event['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                            $flag = true;
                                        }
                                    }
                                    if(!$flag)
                                    {
                                        echo("<button id='" . $event['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                                    }
                            }
                            else
                            {
                                    echo("<button id='" . $event['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                            }
                        echo("</div></div><hr>");
            }
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-all-events-button" class="btn btn-primary more-btn mt-2">Show more</button>');
            echo("</div>");
            echo("</div>");

            echo("<div id='own-events-list' class='event-list' style='display:none;'>");
            echo("<h2>Your Workshops: </h2><hr>");
            echo("<div id='own-events-list-section' class='container'>");

            $stm2 = $conn->prepare('SELECT * from user_event WHERE user_id = ? LIMIT 2');
            $stm2->execute([$result['user_id']]);
            while($map_result = $stm2->fetch(PDO::FETCH_ASSOC))
            {
                $stm = $conn->prepare('SELECT * FROM events WHERE event_id = ?');
                $stm->execute([$map_result['event_id']]);
                while($event = $stm->fetch(PDO::FETCH_ASSOC))
                {
                            echo(
                            "<div id='event" . $event['event_id'] . "' class='row event my-4 p-2'>" .
                            "<div class='col-xs-9 col-sm-9 col-md-10 col-lg-10'>" .
                            "<h3>"                   . $event['title']        . "</h3>" .
                            "<b>Type: </b>"          . $event['type']         . "<br/>" .
                            "<p>"                    . $event['description']  . "</p><br/><br/>" .
                            "<b>Location: </b>"      . $event['location']     . "<br/>" .
                            "<b>Date: </b>"          . $event['startTime']    . "<br/>" .
                            "<b>Date Posted: </b>"   . $event['dateStamp']    . "<br/>" .
                            "</div>");
                            echo("<div class='col-xs-3 col-sm-3 col-md-2 col-lg-2'>");

                                $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                                $stm2->execute([$result['user_id']]);
                                $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                                if(!empty($map_result))
                                {
                                    $flag = false;
                                        foreach($map_result as $a)
                                        {
                                            if($a['event_id'] == $event['event_id'])
                                            {
                                                echo("<button id='" . $event['event_id'] . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                                                $flag = true;
                                            }
                                        }
                                        if(!$flag)
                                        {
                                            echo("<button id='" . $event['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                                        }
                                }
                                else
                                {
                                        echo("<button id='" . $event['event_id'] . "' class='btn btn-primary event-btn'>subscribe</button>");
                                }
                            echo("</div></div><hr>");
                }
            }
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-own-events-button" class="btn btn-primary more-btn mt-2">Show more</button>');
            echo("</div>");
            echo("</div>");

            echo("</div>");

            echo("</div>");
    }
    require 'footer.php';
}
else
{
    header("Location: index.php?error=signIn");
}
?>
