<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
-->
    <link href="bootstrap/css/cosmo.min.css" rel="stylesheet">

    <!--	CUSTOM	STYLE	-->
    <link href="styles/style.css" rel="stylesheet">

    <!--	JQUERY	        -->
    <script src='js/jquery.min.js'></script>

<title>Career Center</title>

<script>
$(document).ready(function(){
    $('#logout-form').submit(function(event){
        event.preventDefault();
        var x = "Do you really want to logout?"
        if(confirm(x))
        {
            $.ajax({
                type: 'POST',
                url: 'php/sign-out.php',
                success: function(html){
                    window.location.assign("index.php");
                }
            });
        }

    });
});
</script>

</head>
<body>
    <a class="navbar-brand p-3" href="index.php"><img src="pics/career-center-rockland-logo.png" height="100%" width="100%" alt="Rockland County career center logo"/></a>

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white" id="nav1">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1"><span class="navbar-toggler-icon"></span></button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar1">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
        <li class="nav-item"><a class="nav-link" href="calendar.php">Calendar</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="job-list.php">Job board</a></li>
        <li class="nav-item"><a class="nav-link" href="wdb-page.php">WDB</a></li>
        <?php
        if(isset($_SESSION['user_uid']))
        {
            echo'

                        <li class="nav-item"><a class="nav-link" href="home.php">Profile</a></li>
                        <li>
                        <form id="logout-form" action="php/sign-out.php" method="POST">
                        <ul class="navbar-nav ml-auto">
                        <li><button id="logout-btn" type="submit" name="logout" class="btn btn-outline-secondary">Log out</button></li>
                        </ul>
                        </form>
                        </li>
                ';
        }
        else
        {
            echo'

                        <li class="nav-item"><a class="nav-link" href="sign-in-page.php">Sign up or sign in</a></li>
                ';
        }

        ?>
    </ul>
    </div>
</nav>