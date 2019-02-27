<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="bootstrap/css/cosmo.min.css" rel="stylesheet">

  <!--	CUSTOM	STYLE	-->
  <link href="styles/style.css" rel="stylesheet">

  <!--	JQUERY	        -->
  <script src='js/jquery.min.js'></script>

  <!--	BOOTBOX MODALS	        -->
  <script src='js/bootbox.min.js'></script>

  <script src='bootstrap/js/jquery.hotkeys.js'></script>
  <script src='bootstrap/js/bootstrap-wysiwyg.js'></script>

  <title>Career Center</title>

  <script>
  $(document).ready(function () {
    $("[data-toggle=\"tooltip\"]").tooltip();
    $('#logout-form').submit(function (event) {
      event.preventDefault();
      var x = "Do you really want to logout?"
      bootbox.confirm({
        size: 'small',
        message: x,
        callback: function(result){
          if(result)
          {
            $.ajax({
              type: 'POST',
              url: 'php/sign-out.php',
              success: function (html) {
                window.location.assign("index.php");
              }
            });
          }
        }
      });
    });
  });
</script>
</head>

<body>
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white" id="nav1">
    <a class="navbar-brand p-3" href="index.php"><img src="pics/career-center-rockland-logo.png" height="45%" width="45%" alt="Rockland County career center logo"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1"><span class="navbar-toggler-icon"></span></button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar1">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
        <li class="nav-item"><a class="nav-link" href="calendar.php">Calendar</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="job-list.php">Job board</a></li>
        <li class="nav-item"><a class="nav-link" href="wdb-page.php">WDB</a></li>
        <?php
        session_start();
        include 'php/connect.php';
        if (isset($_SESSION['user_uid'])) {
          echo'
          <li class="nav-item"><a class="nav-link" href="home.php">Profile</a></li>
          <li>
          <form id="logout-form" action="php/sign-out.php" method="POST">
          <ul class="navbar-nav ml-auto">
          <li><button id="logout-btn" type="submit" name="logout" class="btn btn-outline-secondary my-2">Log out<span class="icon pl-2"><img src="open-iconic-master/svg/account-logout.svg" alt="icon logout"></span></button></li>
          </ul>
          </form>
          </li>
          ';
        } else {
          echo'<li class="nav-item"><a class="nav-link" href="sign-in-page.php">Sign up or sign in<span class="icon pl-2"><img src="open-iconic-master/svg/account-login.svg" alt="icon login"></span></a></li>';
        }
        ?>
      </ul>
    </div>
  </nav>
