<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--_________________________________INDEX.PHP______________________________________________-->
    <!-- Bootstrap CSS -->
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--	CUSTOM	STYLE	-->
	<link href="../styles/index.css" rel="stylesheet">

	<!--	ION-ICONS	-->
	<link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet">

<title>Career Center</title>
</head>

<body>

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="index.html"><img src="pics/ny.jpg" height="60px" width="100px"></img></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar7">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar7">

<ul class="navbar-nav ml-auto">
<?php
if(isset($_SESSION['user_uid']))
{
    echo'
                <form action="../php/sign-out.php" method="POST">
                <ul class="navbar-nav ml-auto">
                <li><button type="submit" name="logout" class="btn btn-primary">LOG OUT</button></li>
                </ul>
                </form>
        ';
}
else
{
    echo'
                <form action="../php/sign-in.php" method="POST">
                <ul class="navbar-nav ml-auto">
                <li><input type="text" name="user_uid" placeholder="User Name"/></li>
                <li><input type="text" name="user_pw" placeholder="Password"/></li>
                <li><button type="submit" name="login-submit" class="btn btn-primary">LOG IN</button></li>
                <li><a href="#">Forgot account?</a></li>
                </ul>
                </form>
        ';
}
?>
</ul>

    </div>
    </nav>
