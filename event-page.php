<?php
include 'header.php';
session_start();
if(isset($_SESSION['user_uid']))
{
  echo('<link href="styles/event-page.css" rel="stylesheet" />');

  echo("
  <script>
  $(document).ready(function() {
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
          var x = 'You have successfully subscribed to this Workshop. <br/> Click ok to go to your Workshops'
          bootbox.confirm({
            size: 'small',
            message: x,
            callback: function(result){
              if(result)
              {
                window.location.assign('home.php');
              }else{
                window.location.reload();
              }
            }
          });
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
          var x = 'You have successfully un-subscribed to this Workshop.'
          bootbox.confirm({
            size: 'small',
            message: x,
            callback: function(result){
              if(result)
              {
                window.location.reload();
              }else{
                window.location.reload();
              }
            }
          });
        }
      });
    });
  });
  </script>
  ");
  $sql = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $sql->execute([$_SESSION['user_uid']]);
  $userInfo = $sql->fetch();

  $sql = $conn->prepare('SELECT * FROM events WHERE event_id = ?');
  $sql->execute([$_GET['event-btn-value']]);
  if($sql->rowCount() > 0)
  {
    $eventListing = $sql->fetch();

    echo('<div class="grid">');

    echo('<div class="hero1">');
    echo('</div>');

    echo('<div class="intro px-3 py-5">');
    echo('<h1>'. $eventListing['title'] .'</h1>');
    echo('</div>');

    echo('<div class="eventPosting">');

    echo('<div class="section">');
    echo('<p>'. $eventListing['description'] .'</p>');
    echo('<p><b>Location: </b>'. $eventListing['location'] .'</p>');

    $st = new DateTime($eventListing['startTime']);
    $et = new DateTime($eventListing['endTime']);
    $dt = new DateTime($eventListing['dateStamp']);

    echo('<p><b>Date: </b>' . $st->format('Y-m-d') . ' to ' . $et->format('Y-m-d') .'</p>');
    echo('<p><b>Time: </b>' . $st->format('H-i') . ' to ' . $et->format('H-i') .'</p>');
    echo('<p><b>Date posted: </b>'. $dt->format('d-m-Y H:i') .'</p>');

    echo('<p><b>tags: </b><br/>');
    $tags = getTags($eventListing);
    foreach($tags as $t)
    {
      echo('- ' . $t . '<br/>');
    }
    echo('</p>');

    $stm2 = $conn->prepare('SELECT event_id from user_event WHERE user_id = ?');
    $stm2->execute([$userInfo['user_id']]);
    $map_result = $stm2->fetchAll(PDO::FETCH_ASSOC);
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

    echo('</div>');
    echo('</div>');


    echo('</div>');
  }
  else
  {
    echo('<div class="grid">');

    echo('<div class="hero1">');
    echo('</div>');

    echo('<div class="intro px-3 py-5">');
    echo('<h1>This event does not exist :(</h1>');
    echo('</div>');

    echo('</div>');
  }
  include 'footer.php';
}
else
{
  include 'footer.php';
  echo('<script>');
  echo('
  bootbox.confirm({
    size: "small",
    message: "Sorry, you must be logged in first!<br/><br/>Would you like to make an account now?",
    callback: function(response){
      if(response){
        window.location.assign("sign-up-page.php");
      }else{
        window.location.assign("calendar.php");
      }
    }
  });
  ');
  echo('</script>');
}
?>
