<?php
session_start();
if(isset($_SESSION['user_uid']))
{
  require 'header.php';
  echo('<link href="styles/job-page.css" rel="stylesheet" />');
  echo("<script>
  $(document).ready(function(){
    $(document).on('click','.rem-user-btn',function(){
      var x = 'Are you sure you want to delete this user?'
      var ID = $(this).attr('id');
      var submit = 1;
      bootbox.confirm({
        size: 'small',
        message: x,
        callback: function(result){
          if(result)
          {
            $.ajax({
              type: 'POST',
              url: 'php/remove-user.php',
              data: {
                ID: ID,
                submit: submit
              },
              success: function(html){
                window.location.assign('home.php');
              }
            });
          }
        }
      });
    });
    $('#reset-form').submit(function(event){
      event.preventDefault();
      var x = 'Are you sure you want to reset this users password?'
      var ID = $('.rem-user-btn').attr('id');
      bootbox.confirm({
        size: 'small',
        message: x,
        callback: function(result){
          if(result)
          {
            var reset_email = $('#reset-email').val();
            var reset_pw = $('#reset-pw').val();
            var reset_pw2 = $('#reset-pw2').val();
            var submit = 1;
            $('.form-message').load('php/reset-pw-admin.php', {
              ID: ID,
              reset_pw: reset_pw,
              reset_pw2: reset_pw2,
              submit: submit
            });
          }
        }
      });
    });
  });
  </script>");
  $sql = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $sql->execute([$_SESSION['user_uid']]);
  $isAdmin = $sql->fetch();
  if($isAdmin['user_type'] == 'admin')
  {
    $sql = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
    $sql->execute([$_GET['user-btn-value']]);
    if($sql->rowCount() > 0)
    {
      $user = $sql->fetch();

      echo('<div class="grid">');

      echo('<div class="hero1">');
      echo('</div>');

      echo('<div class="intro px-3 py-5">');
      echo('<h1>'. $user['user_first'].' '.$user['user_last'] .'</h1>');
      echo('</div>');

      echo('<div class="jobPosting">');
      echo('<div class="section py-3 px-3">');
      echo('<p><b>Username: </b>'. $user['user_uid'] .'</p>');
      echo('<p class="text-muted"><i>'. $user['user_type'] .'</i></p>');
      echo('<p><b>email:</b> '. $user['user_email'] .'</p>');
      echo('<p><b>phone:</b> '. $user['user_phone'] .'</p>');
      switch($user['user_type']){
        case 'admin':
        echo('<p><b>THIS IS AN ADMIN ACCOUNT DO NOT DELETE</b></p>');
        break;
        case 'employer':
        $empSql = $conn->prepare('SELECT * FROM employers WHERE user_id = ?');
        $empSql->execute([$user['user_id']]);
        $empResult = $empSql->fetch();
        echo('<p><b>company:</b> '. $empResult['employer_company'] .'</p>');
        echo('<p><b>tax id number:</b> '. $empResult['employer_tax'] .'</p>');
        echo('<p><b>unemployment number:</b> '. $empResult['employer_unemployNum'] .'</p>');
        echo('<p><b>website:</b> '. $empResult['employer_web'] .'</p>');
        break;
        case 'user':
        $seekSql = $conn->prepare('SELECT * FROM seekers WHERE user_id = ?');
        $seekSql->execute([$user['user_id']]);
        $seekResult = $seekSql->fetch();
        $stm5 = $conn->prepare("SELECT * FROM resume WHERE seeker_id = ?");
        $stm5->execute([$seekResult['seeker_id']]);
        if($stm5->rowCount() > 0){
          while($row = $stm5->fetch()){
            echo("<p><b>User resume: </b><a target='_blank' href='viewResume.php?id=".$row['seeker_id']."'>" . $row['file_name'] . "</a></p>");
          }
        }else{
          echo("<p>This user has not uploaded a resume.</p>");
        }
        echo('<p><b>State number:</b> '. $seekResult['user_stateNum'] .'</p>');
        break;
      }
      echo("<button id='" . $user['user_id'] . "' class='btn btn-danger rem-user-btn'>Delete user</button>");
      echo('</div>');

      echo('<div class="section">');
      echo('
      <form id="reset-form">
      <p class="form-message"></p>
      <ul class="reset-list">
      <li><input id="reset-pw" type="password" placeholder="New user password" class="form-control" aria-label="small"></li>
      <li><input id="reset-pw2" type="password" placeholder="Re-type new user password" class="form-control" aria-label="small"></li>
      </ul>
      <button id="'. $user['user_id'] .'" type="submit" class="btn btn-primary main-btn">Reset Password</button>
      </form>
      ');
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
      echo('<h1>This user does not exist.</h1>');
      echo('</div>');

      echo('</div>');
    }
    require 'footer.php';
  }else{
    header("Location: index.php?error=notAdmin");
  }
}else{
  header("Location: index.php?error=signIn");
}
