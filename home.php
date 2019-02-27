<?php
session_start();
if (isset($_SESSION['user_uid'])) {
  include 'php/user-class.php';
  include 'header.php';
  //include 'php/connect.php';
  //get PDO of user info
  $sql = $conn->prepare("SELECT * FROM users WHERE user_uid=?");
  $sql->execute([$_SESSION['user_uid']]);
  $result = $sql->fetch(PDO::FETCH_ASSOC);
  //get occupations for logged in user
  $stm = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
  $stm->execute([$result['user_id']]);
  $userOccupation = $stm->fetch(PDO::FETCH_ASSOC);
  //get a list of reccommended events for user
  $recWorkList = getWorkRecList($conn, $result['user_id']);
  //get a list of all events
  $eventList = getEventList($conn);
  //get a list of all the users events
  $ownEventList = getOwnEventList($conn, $result['user_id']);
  //get a list of all jobs
  $jobList = getJobList($conn);
  echo('<script>');
  echo("
  $(document).ready(function(){
    $(document).on('click','.event-btn',function(){
      var x = 'Are you sure you want to subscribe?'
      var ID = $(this).attr('id');
      bootbox.confirm({
        size: 'small',
        message: x,
        callback: function(result){
          if(result)
          {
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
                  bootbox.alert({
                    size: 'small',
                    message: 'You\\'re already subscribed for this workshop.'
                  });
                }
                else
                {
                  $('#event'+ID).remove();
                  bootbox.alert({
                    size: 'small',
                    message: 'You have subscribed for this workshop.'
                  });
                }
              }
            });
          }
        }
      });
    });
    $(document).on('click','.sub-event-btn',function(){
      var x = 'Are you sure you want to un-subscribe?'
      var ID = $(this).attr('id');
      bootbox.confirm({
        size: 'small',
        message: x,
        callback: function(result){
          if(result)
          {
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
        }
      });
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
    var workRecCount = 2;
    $('#more-work-rec-button').click(function(){
      workRecCount += 2;
      $('#work-rec-list-section').load('php/load-work-rec-events.php', {
        workRecNewCount: workRecCount
      });
    });
    $('#change-sector-form').submit(function(event){
      event.preventDefault();
      var x = 'Are you sure you want to change your sectors?'
      bootbox.confirm({
        size: 'small',
        message: x,
        callback: function(result){
          if(result)
          {
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
              }
            });
          }
        }
      });
    });
    $('#change-pw-form').submit(function(event){
      event.preventDefault();
      var x = 'Are you sure you want to change your password?'
      bootbox.confirm({
        size: 'small',
        message: x,
        callback: function(result){
          if(result)
          {
            var change_pw = $('#change-pw-input').val();
            var change_pw2 = $('#change-pw2-input').val();
            var submit = $('#change-pw-submit').val();
            $('.form-message').load('php/reset-pw.php', {
              change_pw: change_pw,
              change_pw2: change_pw2,
              submit: submit
            });
          }
        }
      });
    });
    $('#change-phone-form').submit(function(event){
      event.preventDefault();
      var x = 'Are you sure you want to change your phone number?'
      bootbox.confirm({
        size: 'small',
        message: x,
        callback: function(result){
          if(result)
          {
            var change_phone = $('#change-phone-input').val();
            var change_phone2 = $('#change-phone2-input').val();
            var submit = $('#change-phone-submit').val();
            $('.form-message').load('php/reset-phone.php', {
              change_phone: change_phone,
              change_phone2: change_phone2,
              submit: 1
            });
          }
        }
      });
    });
    $('#change-email-form').submit(function(event){
      event.preventDefault();
      var x = 'Are you sure you want to change your email?'
      bootbox.confirm({
        size: 'small',
        message: x,
        callback: function(result){
          if(result)
          {
            var change_email = $('#change-email-input').val();
            var change_email2 = $('#change-email2-input').val();
            var submit = $('#change-email-submit').val();
            $('.form-message').load('php/reset-email.php', {
              change_email: change_email,
              change_email2: change_email2,
              submit: submit
            });
          }
        }
      });
    });
    $(window).on('resize', function(){
      var win = $(this);
      if (win.width() > 1000)
      {
        $('.dash-control-drp').hide();
        $('.dash-control-btns').show();
      }else{
        $('.dash-control-btns').hide();
        $('.dash-control-drp').show();
      }
    });
    var win = $(this);
    if (win.width() > 1000)
    {
      $('.dash-control-drp').hide();
      $('.dash-control-btns').show();
    }else{
      $('.dash-control-btns').hide();
      $('.dash-control-drp').show();
    }
  });
  ");
  echo('</script>');
  if ($result['user_type'] == "admin") {
    echo("<link href='styles/home-admin.css' rel='stylesheet'>");
    echo('<script src="js/admin-home.js"></script>');

    echo("<div class='grid'>");

    echo("<div class='hero1'></div>");

    echo("<div class='greet py-5'>");
    echo("<h1 class='hOne' style='color: white' id='demo'>Welcome, " . $result['user_first'] . "</h1>");
    echo("</div>");

    echo("<div class='dashboard-control'>");
    echo('<div class="dash-control-btns btn-group btn-group-justified">'
    . '<button class="btn-outline-secondary btn nav-link current-btn">Current Workshops</button>'
    . '<button class="btn-outline-secondary btn nav-link mod-work-btn">Modify workshops</button>'
    . '<button class="btn-outline-secondary btn nav-link add-work-btn">Add workshop</button>'
    . '<button class="btn-outline-secondary btn nav-link user-btn">User list</button>'
    . '<button class="btn-outline-secondary btn nav-link add-announ-btn">Announcements</button>'
    . '<button class="btn-outline-secondary btn nav-link change-btn">Update account</button>'
    . '<button class="btn-outline-secondary btn nav-link timesheet-btn">Manage timesheets</button>'
    . '</div>');
    echo('<div class="dash-control-drp" style="display: none;">
    <select class="form-control" id="drop-selector" style="height: 100%;">
    <option value="current">Current workshops</option>
    <option value="mod">Modify workshops</option>
    <option value="add-work">Add workshop</option>
    <option value="user-list">User list</option>
    <option value="add-announ">Add announcement</option>
    <option value="update-acc">Update account</option>
    <option value="timesheet">Manage timesheets</option>
    </select></div>');
    echo("</div>");

    echo("<div class='control-area'>");

    //list of current events
    echo("<div id='current-event-list' class='event-list p-2'>");
    echo("<h2 class='dash-header hTwo'>Current Workshops: </h2><hr>");
    echo("<div id='current-event-list-section' class='container'>");

    $check = sizeof($eventList) % 2;

    if(sizeof($eventList) == 0)
    {
      echo("<div class='my-4'><h3 class='hThree'>There are no events yet.</h3></div>");
    }
    else if($check == 0)
    {
      if(2 <= sizeof($eventList))
      {
        for($i = 0; $i < 2; $i++)
        {
          echo(
            "<div id='event" . $eventList[$i]->getID() . "' class='event my-4'>" .
            "<h3 class='hThree'>" . $eventList[$i]->getTitle() . "</h3>" .
            "<p>" . $eventList[$i]->getDesc() . "</p><br/><br/>" .
            "<b>Location: </b>" . $eventList[$i]->getLoc() . "<br/>" .
            "<b>Date: </b>" . $eventList[$i]->getStart() . "<br/>" .
            "<b>Date Posted: </b>" . $eventList[$i]->getDateStamp() . "<br/>");
            echo("</div><hr>");
          }
        }
        else
        {
          foreach($eventList as $c)
          {
            echo(
              "<div id='event" . $c->getID() . "' class='event my-4'>" .
              "<h3 class='hThree'>" . $c->getTitle() . "</h3>" .
              "<p>" . $c->getDesc() . "</p><br/><br/>" .
              "<b>Location: </b>" . $c->getLoc() . "<br/>" .
              "<b>Date: </b>" . $c->getStart() . "<br/>" .
              "<b>Date Posted: </b>" . $c->getDateStamp() . "<br/>");
              echo("</div><hr>");
            }
            echo("<div>There are no more events</div>");
          }
        }
        else
        {
          if(2 - 1 <= sizeof($eventList))
          {
            for($i = 0; $i < 2 - 1; $i++)
            {
              echo(
                "<div id='event" . $eventList[$i]->getID() . "' class='event my-4'>" .
                "<h3 class='hThree'>" . $eventList[$i]->getTitle() . "</h3>" .
                "<p>" . $eventList[$i]->getDesc() . "</p><br/><br/>" .
                "<b>Location: </b>" . $eventList[$i]->getLoc() . "<br/>" .
                "<b>Date: </b>" . $eventList[$i]->getStart() . "<br/>" .
                "<b>Date Posted: </b>" . $eventList[$i]->getDateStamp() . "<br/>");
                echo("</div><hr>");
              }
            }
            else
            {
              foreach($eventList as $c)
              {
                echo(
                  "<div id='event" . $c->getID() . "' class='event my-4'>" .
                  "<h3 class='hThree'>" . $c->getTitle() . "</h3>" .
                  "<p>" . $c->getDesc() . "</p><br/><br/>" .
                  "<b>Location: </b>" . $c->getLoc() . "<br/>" .
                  "<b>Date: </b>" . $c->getStart() . "<br/>" .
                  "<b>Date Posted: </b>" . $c->getDateStamp() . "<br/>");
                  echo("</div><hr>");
                }
                echo("<div>There are no more events</div>");
              }
            }
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-current-events-button" class="btn btn-primary more-btn">Show more</button>');
            echo("</div>");
            echo("</div>");

            //list to modify users
            echo("<div id='user-list' class='event-list p-2' style='display: none;'>");
            echo("<h2 class='dash-header hTwo'>User list: </h2><hr>");
            echo("<input type='text' name='search-user' id='search-user' placeholder='search user' class='form-control'/>");
            echo("<div id='user-list-section' class='container'>");
            /*javascript will populate this*/
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-user-button" class="btn btn-primary more-btn">Show more</button>');
            echo("</div>");
            echo("</div>");

            //list to modify workshops
            echo("<div id='mod-event-list' class='event-list p-2' style='display: none;'>");
            echo("<h2 class='dash-header hTwo'>Add workshop: </h2><hr>");
            echo('
            <form id="add-work-form">
            <p class="form-message"></p>
            <ul class="reset-list">
            <li><input id="work-title" type="text" placeholder="Workshop title" class="form-control" aria-label="small"></li>
            <li><div class="btn-toolbar" data-role="editor-toolbar" data-target="#work-desc">
            <div class="btn-group">
            <a class="btn" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><img src="open-iconic-master/svg/bold.svg" alt="icon bold"></a>
            <a class="btn" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><img src="open-iconic-master/svg/italic.svg" alt="icon italic"></a>
            <a class="btn" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><img src="open-iconic-master/svg/underline.svg" alt="icon underline"></a>
            </div>
            <div class="btn-group">
            <a class="btn" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><img src="open-iconic-master/svg/list.svg" alt="icon list"></a>
            </div>
            <div class="btn-group">
            <a class="btn btn-info" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><img src="open-iconic-master/svg/align-left.svg" alt="icon align left"></a>
            <a class="btn" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><img src="open-iconic-master/svg/align-center.svg" alt="icon align center"></a>
            <a class="btn" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><img src="open-iconic-master/svg/align-right.svg" alt="icon align right"></a>
            <a class="btn" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><img src="open-iconic-master/svg/justify-center.svg" alt="icon justify"></a>
            </div>
            <div class="btn-group">
            <a class="btn" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><img src="open-iconic-master/svg/action-undo.svg" alt="icon action undo"></a>
            <a class="btn" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><img src="open-iconic-master/svg/action-redo.svg" alt="icon action redo"></a>
            </div>
            </div></li>
            <li><div id="work-desc" class="wysiwyg">Enter description here</div></li>
            <li><input id="work-loc" type="text" placeholder="Workshop location" class="form-control" aria-label="small"></li>
            <li><input id="work-start-date" type="date" class="form-control" aria-label="small"></li>
            <li><input id="work-start-time" type="time" class="form-control" aria-label="small"></li>
            <li><input id="work-end-date" type="date" class="form-control" aria-label="small"></li>
            <li><input id="work-end-time" type="time" class="form-control" aria-label="small"></li>
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
            ');
            echo("<h2 class='dash-header hTwo pt-5'>Modify Workshops: </h2><hr>");
            echo("<div id='mod-event-list-section' class='container'>");
            /*javascript will populate this*/
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-mod-button" class="btn btn-primary more-btn">Show more</button>');
            echo("</div>");
            echo("</div>");

            //add a workshop form
            echo("<div id='add-work' class='event-list p-2' style='display: none;'>");
            echo("<h2 class='dash-header hTwo'>Add a workshop: </h2><hr>");
            echo("<div id='add-workshop-section' class='container'>");
            echo('
            <form id="add-work-form">
            <p class="form-message"></p>
            <ul class="reset-list">
            <li><input id="work-title" type="text" placeholder="Workshop title" class="form-control" aria-label="small"></li>
            <li><div class="btn-toolbar" data-role="editor-toolbar" data-target="#work-desc">
            <div class="btn-group">
            <a class="btn" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><img src="open-iconic-master/svg/bold.svg" alt="icon bold"></a>
            <a class="btn" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><img src="open-iconic-master/svg/italic.svg" alt="icon italic"></a>
            <a class="btn" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><img src="open-iconic-master/svg/underline.svg" alt="icon underline"></a>
            </div>
            <div class="btn-group">
            <a class="btn" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><img src="open-iconic-master/svg/list.svg" alt="icon list"></a>
            </div>
            <div class="btn-group">
            <a class="btn btn-info" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><img src="open-iconic-master/svg/align-left.svg" alt="icon align left"></a>
            <a class="btn" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><img src="open-iconic-master/svg/align-center.svg" alt="icon align center"></a>
            <a class="btn" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><img src="open-iconic-master/svg/align-right.svg" alt="icon align right"></a>
            <a class="btn" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><img src="open-iconic-master/svg/justify-center.svg" alt="icon justify"></a>
            </div>
            <div class="btn-group">
            <a class="btn" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><img src="open-iconic-master/svg/action-undo.svg" alt="icon action undo"></a>
            <a class="btn" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><img src="open-iconic-master/svg/action-redo.svg" alt="icon action redo"></a>
            </div>
            </div></li>
            <li><div id="work-desc" class="wysiwyg">Enter description here</div></li>
            <li><input id="work-loc" type="text" placeholder="Workshop location" class="form-control" aria-label="small"></li>
            <li><input id="work-start-date" type="date" class="form-control" aria-label="small"></li>
            <li><input id="work-start-time" type="time" class="form-control" aria-label="small"></li>
            <li><input id="work-end-date" type="date" class="form-control" aria-label="small"></li>
            <li><input id="work-end-time" type="time" class="form-control" aria-label="small"></li>
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
            ');
            echo("</div>");
            echo("</div>");

            //add an announcement form
            echo("<div id='add-announ' class='event-list p-2' style='display: none;'>");
            echo("<h2 class='dash-header hTwo'>Add an announcement: </h2><hr>");
            echo('
            <form id="add-announ-form">
            <p class="form-message"></p>
            <ul class="reset-list">
            <li><input id="announ-title" type="text" placeholder="Announcement title" class="form-control" aria-label="small"></li>
            <li><div class="btn-toolbar" data-role="editor-toolbar" data-target="#announ-desc">
            <div class="btn-group">
            <a class="btn" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><img src="open-iconic-master/svg/bold.svg" alt="icon bold"></a>
            <a class="btn" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><img src="open-iconic-master/svg/italic.svg" alt="icon italic"></a>
            <a class="btn" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><img src="open-iconic-master/svg/underline.svg" alt="icon underline"></a>
            </div>
            <div class="btn-group">
            <a class="btn" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><img src="open-iconic-master/svg/list.svg" alt="icon list"></a>
            </div>
            <div class="btn-group">
            <a class="btn btn-info" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><img src="open-iconic-master/svg/align-left.svg" alt="icon align left"></a>
            <a class="btn" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><img src="open-iconic-master/svg/align-center.svg" alt="icon align center"></a>
            <a class="btn" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><img src="open-iconic-master/svg/align-right.svg" alt="icon align right"></a>
            <a class="btn" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><img src="open-iconic-master/svg/justify-center.svg" alt="icon justify"></a>
            </div>
            <div class="btn-group">
            <a class="btn" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><img src="open-iconic-master/svg/action-undo.svg" alt="icon action undo"></a>
            <a class="btn" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><img src="open-iconic-master/svg/action-redo.svg" alt="icon action redo"></a>
            </div>
            </div></li>
            <li><div id="announ-desc" class="wysiwyg">Enter description here</div></li>
            </ul>
            <button id="submit-announ" type="submit" class="btn btn-primary main-btn"><b>Add</b></button>
            </form>
            ');
            echo("<h2 class='dash-header hTwo pt-5'>Modify announcements: </h2><hr>");
            echo("<div id='announ-list-section' class='container'>");
            /*javascript will load announcements here when add-announ-btn is pressed*/
            echo("</div>");
            echo("<div class='show-more-container'>");
            echo('<button id="more-announ-button" class="btn btn-primary more-btn">Show more</button>');
            echo("</div>");
            echo("</div>");

            //change account info
            echo("<div id='change-info' class='p-2' style='display:none;'>");
            echo("<h2 class='dash-header hTwo'>Update your personal information: </h2><hr>");
            echo("<div id='change-section' class='container'>");
            echo("
            <div class='row'>
            <ul class='current-info'>
            <li><b>First name: </b>" . $result['user_first'] . "</li>
            <li><b>Last name: </b>" . $result['user_last'] . "</li>
            <li><b>Email: </b>" . $result['user_email'] . "</li>
            <li><b>Phone number: </b>" . $result['user_phone'] . "</li>
            <li><b>User name: </b>" . $result['user_uid'] . "</li>
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
            <li><input id='change-pw-input' type='password' placeholder='New password' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
            <li><input id='change-pw2-input' type='password' placeholder='Re-type new password' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
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

            //Manage timesheets
            echo("<div id='timesheet-list' class='event-list p-2' style='display: none;'>");
            echo("<h2 class='dash-header hTwo'>Upload timesheet: </h2><hr>");
            echo("<form action='php/upload-timesheet.php' method='post' id='timesheet-form' enctype='multipart/form-data'>
            <p class='form-message'></p>
            <ul class='reset-list'>
            <li><input type='file' name='timesheet' id='timesheetToUpload'></li>
            </ul>
            <button id='timesheet-submit' type='submit' class='btn btn-primary main-btn'>Upload</button>
            </form>");
            echo("<h2 class='dash-header hTwo pt-5'>Timesheets: </h2><hr>");
            echo("<div id='timesheet-section' class='container'>");
            echo('<table class="table table-hover">
            <thead>
            <tr>
            <th>date</th>
            <th>view</th>
            <th>remove</th>
            </tr>
            </thead>
            <tbody>
            ');
            $sql2 = $conn->prepare('SELECT * FROM timesheets ORDER BY sheet_dateStamp DESC');
            $sql2->execute();
            while ($timesheetResults = $sql2->fetch()) {
              echo("<tr id='time" . $timesheetResults['sheet_id'] . "'>");
              echo("<td><p>" . $timesheetResults['sheet_dateStamp'] . "</p></td>");
              echo("<td><p><a target='_blank' href='viewTimesheet.php?id=".$timesheetResults['sheet_id']."'>".$timesheetResults['sheet_name']."</a></p></td>");
              echo("<td><button id='" . $timesheetResults['sheet_id'] . "' class='btn btn-danger rem-time-btn'>Remove</button></td>");
              echo("</tr>");
            }
            echo("
            </tbody>
            </table>");
            echo("</div>");
            echo("</div>");

            echo("</div>"); /* Control area end */

            echo("</div>"); /* grid area end */

          } elseif ($result['user_type'] == "employer") {
            echo("<link href='styles/home-employer.css' rel='stylesheet'>");
            echo("<link href='formhelper/css/bootstrap-formhelpers.css' rel='stylesheet'/>");
            echo('<script src="js/employer-home.js"></script>');

            echo("<div class='grid'>");

            echo("<div class='hero1'></div>");

            echo("<div class='greet py-5'>");
            echo("<h1 class='hOne' style='color: white' id='demo'>Welcome, " . $result['user_first'] . "</h1>");
            echo("</div>");

            echo("<div class='dashboard-control'>");
            echo('<div class="dash-control-btns btn-group btn-group-justified">'
            . '<button class="btn-outline-secondary btn nav-link all-btn">All Workshops</button>'
            . '<button class="btn-outline-secondary btn nav-link own-btn">Your Workshops</button>'
            . '<button class="btn-outline-secondary btn nav-link work-rec-btn">Workshops for you</button>'
            . '<button class="btn-outline-secondary btn nav-link job-list-btn">Your Jobs</button>'
            . '<button class="btn-outline-secondary btn nav-link post-job-btn">Post Job</button>'
            . '<button class="btn-outline-secondary btn nav-link change-btn">Update account</button>'
            . '</div>');
            echo('<div class="dash-control-drp" style="display: none;">
            <select class="form-control" id="drop-selector" style="height: 100%;">
            <option value="all">All Workshops</option>
            <option value="own-work">Your Workshops</option>
            <option value="rec-work">Workshops for you</option>
            <option value="own-job">Your Jobs</option>
            <option value="post-job">Post Jobs</option>
            <option value="update-acc">Update account</option>
            </select></div>');
            echo("</div>");

            echo("<div class='control-area'>");

            echo("<div id='all-events-list' class='event-list p-2'>");
            echo("<h2 class='dash-header hTwo'>All Workshops: </h2><hr>");
            echo("<div id='all-events-list-section' class='container'>");
            if(sizeof($eventList) > 0)
            {
              for ($i = 0; $i < 2; $i++) {
                echo(
                  "<div id='event" . getEventList($conn)[$i]->getID() . "' class='event my-4'>" .
                  "<h3 class='hThree'>" . getEventList($conn)[$i]->getTitle() . "</h3>" .
                  "<p>" . getEventList($conn)[$i]->getDesc() . "</p><br/><br/>" .
                  "<b>Location: </b>" . getEventList($conn)[$i]->getLoc() . "<br/>" .
                  "<b>Date: </b>" . getEventList($conn)[$i]->getStart() . "<br/>" .
                  "<b>Date Posted: </b>" . getEventList($conn)[$i]->getDateStamp() . "<br/>");
                  $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                  $stm2->execute([$result['user_id']]);
                  $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                  if (!empty($map_result)) {
                    $flag = false;
                    foreach ($map_result as $a) {
                      if ($a['event_id'] == getEventList($conn)[$i]->getID()) {
                        echo("<button id='" . getEventList($conn)[$i]->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                        $flag = true;
                      }
                    }
                    if (!$flag) {
                      echo("<button id='" . getEventList($conn)[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                    }
                  } else {
                    echo("<button id='" . getEventList($conn)[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                  }
                  echo("</div><hr>");
                }
              }else{
                echo("<div class='my-4'><h3 class='hThree'>There are no events yet.</h3></div>");
              }
              echo("</div>");
              echo("<div class='show-more-container'>");
              echo('<button id="more-all-events-button" class="btn btn-primary more-btn">Show more</button>');
              echo("</div>");
              echo("</div>");

              echo("<div id='own-events-list' class='event-list p-2' style='display:none;'>");
              echo("<h2 class='dash-header hTwo'>Your Workshops: </h2><hr>");
              echo("<div id='own-events-list-section' class='container'>");
              /* javascript will load list of own events here when own-btn is pressed */
              echo("</div>");
              echo("<div class='show-more-container'>");
              echo('<button id="more-own-events-button" class="btn btn-primary more-btn">Show more</button>');
              echo("</div>");
              echo("</div>");

              echo("<div id='work-rec-list' class='event-list p-2' style='display:none;'>");
              echo("<h2 class='dash-header hTwo'>Workshops for you: </h2><hr>");
              echo("<div id='work-rec-list-section' class='container'>");
              /* javascript will load list of rec events here when work-rec-btn is pressed */
              echo("</div>");
              echo("<div class='show-more-container'>");
              echo('<button id="more-work-rec-button" class="btn btn-primary more-btn">Show more</button>');
              echo("</div>");
              echo("</div>");

              echo("<div id='job-list' class='event-list p-2' style='display:none;'>");
              echo("<h2 class='dash-header hTwo'>My jobs: </h2><hr>");
              echo("<div id='job-list-section' class='container'>");
              /* javascript will load list of jobs here when job-list-btn is pressed */
              echo("</div>");
              echo("<div class='show-more-container'>");
              echo('<button id="more-own-jobs-button" class="btn btn-primary more-btn">Show more</button>');
              echo("</div>");
              echo("</div>");

              echo("<div id='post-job' class='p-2' style='display:none;'>");
              echo("<h2 class='dash-header hTwo'>Post your job: </h2><hr>");
              echo("<div id='post-job-section' class='container'>");
              echo("
              <form id='postJob-form'>
              <p class='form-message'></p>
              <ul>
              <li><input id='postJob-title' type='text' placeholder='Job title' class='form-control' aria-label='small' data-toggle='tooltip' title='Job title (must be less than 250 characters)'></li>
              <li><input id='postJob-location' type='text' placeholder='Job location' class='form-control' aria-label='small' data-toggle='tooltip' title='Job location (must be less than 50 characters)'></li>

              <li><div class='btn-toolbar' data-role='editor-toolbar' data-target='#postJob-description'>
              <div class='btn-group'>
              <a class='btn' data-edit='bold' title='' data-original-title='Bold (Ctrl/Cmd+B)'><img src='open-iconic-master/svg/bold.svg' alt='icon bold'></a>
              <a class='btn' data-edit='italic' title='' data-original-title='Italic (Ctrl/Cmd+I)'><img src='open-iconic-master/svg/italic.svg' alt='icon italic'></a>
              <a class='btn' data-edit='underline' title='' data-original-title='Underline (Ctrl/Cmd+U)'><img src='open-iconic-master/svg/underline.svg' alt='icon underline'></a>
              </div>
              <div class='btn-group'>
              <a class='btn' data-edit='insertunorderedlist' title='' data-original-title='Bullet list'><img src='open-iconic-master/svg/list.svg' alt='icon list'></a>
              </div>
              <div class='btn-group'>
              <a class='btn btn-info' data-edit='justifyleft' title='' data-original-title='Align Left (Ctrl/Cmd+L)'><img src='open-iconic-master/svg/align-left.svg' alt='icon align left'></a>
              <a class='btn' data-edit='justifycenter' title='' data-original-title='Center (Ctrl/Cmd+E)'><img src='open-iconic-master/svg/align-center.svg' alt='icon align center'></a>
              <a class='btn' data-edit='justifyright' title='' data-original-title='Align Right (Ctrl/Cmd+R)'><img src='open-iconic-master/svg/align-right.svg' alt='icon align right'></a>
              <a class='btn' data-edit='justifyfull' title='' data-original-title='Justify (Ctrl/Cmd+J)'><img src='open-iconic-master/svg/justify-center.svg' alt='icon justify'></a>
              </div>
              <div class='btn-group'>
              <a class='btn' data-edit='undo' title='' data-original-title='Undo (Ctrl/Cmd+Z)'><img src='open-iconic-master/svg/action-undo.svg' alt='icon action undo'></a>
              <a class='btn' data-edit='redo' title='' data-original-title='Redo (Ctrl/Cmd+Y)'><img src='open-iconic-master/svg/action-redo.svg' alt='icon action redo'></a>
              </div>
              </div></li>
              <li><div id='postJob-description' class='wysiwyg'>Enter description here (10000 character limit)</div></li>

              <li class='py-3'><h6 class='hSix'>What sections is your job involved with? <br/>(check all that apply)</h6></li>
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

              echo("<div id='change-info' class='p-2' style='display:none;'>");
              echo("<h2 class='dash-header hTwo'>Update your personal information: </h2><hr>");
              echo("<div id='change-section' class='container'>");
              echo("
              <div class='row'>
              <ul class='current-info'>
              <li><b>First name: </b>" . $result['user_first'] . "</li>
              <li><b>Last name: </b>" . $result['user_last'] . "</li>
              <li><b>Email: </b>" . $result['user_email'] . "</li>
              <li><b>Phone number: </b>" . $result['user_phone'] . "</li>
              <li><b>User name: </b>" . $result['user_uid'] . "</li>
              <li>
              <b>Your sectors: </b>
              <ul>
              ");
              $tags = getTags($userOccupation);
              foreach($tags as $t)
              {
                echo('<li>' . $t . '</li>');
              }
              echo("
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
              <li><input id='change-pw-input' type='password' placeholder='New password' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
              <li><input id='change-pw2-input' type='password' placeholder='Re-type new password' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
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
              <h3 class='hThree'>Check the sectors that apply to your job search.</h3>
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

              echo("</div>"); /* Control area end */

              echo("</div>"); /* grid area end */
            } else {
              echo("<link href='styles/home-user.css' rel='stylesheet'>");
              echo("<link href='formhelper/css/bootstrap-formhelpers.css' rel='stylesheet'/>");
              echo("<script src='js/seeker-home.js'></script>");

              echo("<div class='grid'>");

              echo("<div class='hero1'></div>");

              echo("<div class='greet py-5'>");
              echo("<h1 class='hOne' style='color: white' id='demo'>Welcome, " . $result['user_first'] . "</h1>");
              echo("</div>");

              echo("<div class='dashboard-control'>");
              echo('<div class="dash-control-btns btn-group btn-group-justified">'
              . '<button class="btn-outline-secondary btn nav-link all-btn">All Workshops</button>'
              . '<button class="btn-outline-secondary btn nav-link own-btn">Your Workshops</button>'
              . '<button class="btn-outline-secondary btn nav-link work-rec-btn">Workshops for you</button>'
              . '<button class="btn-outline-secondary btn nav-link job-rec-btn">Jobs for you</button>'
              . '<button class="btn-outline-secondary btn nav-link change-btn">Update account</button>'
              . '</div>');
              echo('<div class="dash-control-drp" style="display: none;">
              <select class="form-control" id="drop-selector" style="height: 100%;">
              <option value="all">All Workshops</option>
              <option value="own-work">Your Workshops</option>
              <option value="rec-work">Workshops for you</option>
              <option value="rec-job">Jobs for you</option>
              <option value="update-acc">Update account</option>
              </select></div>');
              echo("</div>");

              echo("<div class='control-area'>");

              echo("<div id='all-events-list' class='event-list p-2'>");
              echo("<h2 class='dash-header hTwo'>All Workshops: </h2><hr>");
              echo("<div id='all-events-list-section' class='container'>");
              if(sizeof($eventList) > 0)
              {
                for ($i = 0; $i < 2; $i++) {
                  echo(
                    "<div id='event" . getEventList($conn)[$i]->getID() . "' class='event my-4'>" .
                    "<h3 class='hThree'>" . getEventList($conn)[$i]->getTitle() . "</h3>" .
                    "<p>" . getEventList($conn)[$i]->getDesc() . "</p><br/><br/>" .
                    "<b>Location: </b>" . getEventList($conn)[$i]->getLoc() . "<br/>" .
                    "<b>Date: </b>" . getEventList($conn)[$i]->getStart() . "<br/>" .
                    "<b>Date Posted: </b>" . getEventList($conn)[$i]->getDateStamp() . "<br/>");
                    $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
                    $stm2->execute([$result['user_id']]);
                    $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
                    if (!empty($map_result)) {
                      $flag = false;
                      foreach ($map_result as $a) {
                        if ($a['event_id'] == getEventList($conn)[$i]->getID()) {
                          echo("<button id='" . getEventList($conn)[$i]->getID() . "' class='btn btn-primary sub-event-btn'>un-subscribe</button>");
                          $flag = true;
                        }
                      }
                      if (!$flag) {
                        echo("<button id='" . getEventList($conn)[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                      }
                    } else {
                      echo("<button id='" . getEventList($conn)[$i]->getID() . "' class='btn btn-primary event-btn'>subscribe</button>");
                    }
                    echo("</div><hr>");
                  }
                }else{
                  echo("<div class='my-4'><h3 class='hThree'>There are no events yet.</h3></div>");
                }
                echo("</div>");
                echo("<div class='show-more-container'>");
                echo('<button id="more-all-events-button" class="btn btn-primary more-btn">Show more</button>');
                echo("</div>");
                echo("</div>");

                echo("<div id='own-events-list' class='event-list p-2' style='display:none;'>");
                echo("<h2 class='dash-header hTwo'>Your Workshops: </h2><hr>");
                echo("<div id='own-events-list-section' class='container'>");
                /* javascript will load list of own events here when work-own-btn is pressed */
                echo("</div>");
                echo("<div class='show-more-container'>");
                echo('<button id="more-own-events-button" class="btn btn-primary more-btn">Show more</button>');
                echo("</div>");
                echo("</div>");

                echo("<div id='work-rec-list' class='event-list p-2' style='display:none;'>");
                echo("<h2 class='dash-header hTwo'>Workshops for you: </h2><hr>");
                echo("<div id='work-rec-list-section' class='container'>");
                /* javascript will load list of rec events here when work-rec-btn is pressed */
                echo("</div>");
                echo("<div class='show-more-container'>");
                echo('<button id="more-work-rec-button" class="btn btn-primary more-btn">Show more</button>');
                echo("</div>");
                echo("</div>");

                echo("<div id='job-rec-list' class='event-list p-2' style='display:none;'>");
                echo("<h2 class='dash-header hTwo'>Jobs for you: </h2><hr>");
                echo("<div id='job-rec-list-section' class='container'>");
                /* javascript will load list of rec jobs here when work-job-btn is pressed */
                echo("</div>");
                echo("<div class='show-more-container'>");
                echo('<button id="more-job-rec-button" class="btn btn-primary more-btn">Show more</button>');
                echo("</div>");
                echo("</div>");

                echo("<div id='change-info' class='p-2' style='display:none;'>");
                echo("<h2 class='dash-header hTwo'>Update your personal information: </h2><hr>");
                echo("<div id='change-section' class='container'>");
                echo("
                <div class='row'>
                <ul class='current-info'>
                <li><b>First name: </b>" . $result['user_first'] . "</li>
                <li><b>Last name: </b>" . $result['user_last'] . "</li>
                <li><b>Email: </b>" . $result['user_email'] . "</li>
                <li><b>Phone number: </b>" . $result['user_phone'] . "</li>
                <li><b>User name: </b>" . $result['user_uid'] . "</li>
                <li>
                <b>Your sectors: </b>
                <ul>
                ");
                $tags = getTags($userOccupation);
                foreach($tags as $t)
                {
                  echo('<li>' . $t . '</li>');
                }
                echo("
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
                <li><button class='btn-outline-primary btn nav-link change-unemp-btn'>Update state unemployment number</button></li>
                <li></li>
                </ul>
                </div>
                <div class='change-section col-xs-7 col-sm-7 col-md-7 col-lg-8'>

                <div class='change-pw' id='change-pw' style='display:none;'>
                <form id='change-pw-form'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                <li><input id='change-pw-input' type='password' placeholder='New password' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
                <li><input id='change-pw2-input' type='password' placeholder='Re-type new password' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your new password (must be 8 characters long, ! ? @ $ % & * allowed)'></li>
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
                ");


                echo("<div class='upload-section' id='upload-section' style='display:none;'>");
                echo("
                <form action='php/upload-resume.php' method='post' id='upload-form' enctype='multipart/form-data'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                <li><input type='file' name='resume' id='fileToUpload'></li>
                </ul>
                <button id='upload-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Upload</button>
                </form>
                <div class='py-5'>
                ");
                $stm5 = $conn->prepare("SELECT * FROM resume");
                $stm5->execute();
                if($stm5->rowCount() > 0){
                  while($row = $stm5->fetch()){
                    echo("<p>Your resume: <a target='_blank' href='viewResume.php?id=".$row['seeker_id']."'>".$row['file_name']."</a></p>");
                  }
                }else{
                  echo("<p>You have not uploaded a resume.</p>");
                }
                echo("</div></div>");

                echo("
                <div class='change-sector-section' id='change-sector-section' style='display:none;'>
                <h3 class='hThree'>Check the sectors that apply to your job search.</h3>
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

                <div class='change-unemp-section' id='change-unemp-section' style='display:none;'>
                <form id='change-unemp-form'>
                <p class='form-message'></p>
                <ul class='reset-list'>
                <li><input id='change-unemp-input' type='text' placeholder='New state unemployment number' class='form-control' aria-label='small' data-toggle='tooltip' title='Enter your state unemployment number'/></li>
                <li><input id='change-unemp2-input' type='text' placeholder='Re-type new state unemployment number' class='form-control' aria-label='small' data-toggle='tooltip' title='Re-type your state unemployment number'/></li>
                </ul>
                <button id='change-unemp-submit' type='submit' class='reset-btn btn btn-danger main-btn'>Submit</button>
                </form>
                </div>

                </div>
                </div>
                ");
                echo("</div>");
                echo("</div>");

                echo("</div>"); /* Control area end */

                echo("</div>"); /* grid area end */
              }
              echo("<script src='formhelper/js/bootstrap-formhelpers-phone.js'></script>");
              echo("<script src='formhelper/js/bootstrap-formhelpers.js'></script>");
              include 'footer.php';
            } else {
              header("Location: index.php?error=signIn");
            }

            function getTags($userOccupation)
            {
              $tags = array();

              if($userOccupation['medical'] == 'true')
              {
                $tags[] = 'medical';
              }
              if($userOccupation['IT'] == 'true')
              {
                $tags[] = 'IT';
              }
              if($userOccupation['healthcare'] == 'true')
              {
                $tags[] = 'healthcare';
              }
              if($userOccupation['business'] == 'true')
              {
                $tags[] = 'business';
              }
              if($userOccupation['foodservice'] == 'true')
              {
                $tags[] = 'foodservice';
              }
              if($userOccupation['hospitality'] == 'true')
              {
                $tags[] = 'hospitality';
              }
              if($userOccupation['culinary'] == 'true')
              {
                $tags[] = 'culinary';
              }

              return $tags;
            }
            ?>
