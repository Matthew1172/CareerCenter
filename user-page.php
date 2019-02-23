<?php
session_start();
if (isset($_SESSION['user_uid']))
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
  });
  </script>");
  $sql = $conn->prepare('SELECT * FROM users WHERE user_uid = ?');
  $sql->execute([$_SESSION['user_uid']]);
  if($sql->rowCount() > 0)
  {
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
        echo('<h3>'. $user['user_type'] .'</h3>');
        echo('<h3>'. $user['user_uid'] .'</h3>');
        echo('</div>');

        echo('<div class="section">');
        echo('<p><b>email:</b> '. $user['user_email'] .'</p>');
        echo('<p><b>phone:</b> '. $user['user_phone'] .'</p>');
        echo('</div>');

        echo('<div class="section">');
        switch($user['user_type']){
          case 'admin':
          echo('<p><b>THIS IS AN ADMIN ACCOUNT</b></p>');
          break;
          case 'employer':
          $empSql = $conn->prepare('SELECT * FROM employers WHERE user_id = ?');
          $empSql->execute($user['user_id']);
          $empResult = $empSql->fetch();
          echo('<p><b>company:</b> '. $empResult['employer_company'] .'</p>');
          echo('<p><b>tax id number:</b> '. $empResult['employer_tax'] .'</p>');
          echo('<p><b>unemployment number:</b> '. $empResult['employer_unemployNum'] .'</p>');
          echo('<p><b>website:</b> '. $empResult['employer_web'] .'</p>');
          break;
          case 'seeker':
          $seekSql = $conn->prepare('SELECT * FROM seekers WHERE user_id = ?');
          $seekSql->execute($user['user_id']);
          $seekResult = $seekSql->fetch();
          echo('<p><b>company:</b> '. $seekResult['seeker_stateNum'] .'</p>');
          break;
        }
        echo('</div>');
        echo("<button id='" . $user['user_id'] . "' class='btn btn-primary rem-user-btn'>Delete user</button>");
        echo('</div>');

        echo('</div>');
      }
      else
      {
        echo('<div class="grid">');

        echo('<div class="hero1">');
        echo('</div>');

        echo('<div class="intro px-3 py-5">');
        echo('<h1>This user does not exist :(</h1>');
        echo('</div>');

        echo('</div>');
      }
      require 'footer.php';
    }else{
      header("Location: index.php?error=notAdmin");
    }
  }else{
    header("Location: index.php?error=noAdmin");
  }
}else{
  header("Location: index.php?error=signIn");
}
