<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS      -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--	CUSTOM	STYLE	-->
	<link href="styles/style.css" rel="stylesheet">

	<!--	ION-ICONS     	-->
	<link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet">

    <!--	JQUERY	        -->
    <script src='js/jquery.min.js'></script>

<title>Career Center</title>

</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img src="pics/ny.jpg" height="60px" width="100px"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar1">
    <ul class="navbar-nav ml-auto">
        <?php

        if(isset($_SESSION['user_uid']))
        {
            echo'
                        <li class="nav-item"><a class="nav-link" href="calendar.php">Calendar</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="job-list.php">Job board</a></li>

                        <li class="nav-item"><a class="nav-link" href="home.php">Profile</a></li>

                        <form action="php/sign-out.php" method="POST">
                        <ul class="navbar-nav ml-auto">
                        <li><button type="submit" name="logout" class="btn btn-outline-secondary" type="button">Log out</button></li>
                        </ul>
                        </form>
                ';
        }
        else
        {
            echo'
                        <li class="nav-item"><a class="nav-link" href="calendar.php">Calendar</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="job-list.php">Job board</a></li>

                        <li class="nav-item"><a class="nav-link" href="sign-in-page.php">Sign up or sign in</a></li>
                ';
        }

        ?>
    </ul>
    </div>
</nav>
