<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--	CUSTOM	STYLE	-->
	<link href="styles/style.css" rel="stylesheet">

	<!--	ION-ICONS	-->
	<link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet">

    <script src='js/jquery.min.js'></script>

<title>Career Center</title>

<script type='text/javascript'>
    $(document).ready(function(){
        $("#login").on('click', function(){
            var uid = $("#signin-uid").val();
            var pw = $("#signin-pw").val();
            $("#signin-uid, #signin-pw").removeClass("input-error");
            if(uid == "")
            {
                $("#signin-uid").addClass("input-error");
            }
            if(pw == "")
            {
                $("#signin-pw").addClass("input-error");
            }
            else
            {
                $.ajax(
                    {
                        url: 'php/sign-in.php',
                        method: 'POST',
                        data: {
                            login: 1,
                            uid: uid,
                            pw: pw
                        },
                        success: function(response){
                            if(response == 'failed')
                            {
                                alert("Invalid username or password.");
                            }
                            else if(response == 'success')
                            {
                                window.location.assign("home.php")
                            }
                            else
                            {
                                window.location.assign("index.php")
                            }
                        },
                        dataType: 'text'
                    }
                );
            }
        });
    });
</script>
</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img src="pics/ny.jpg" height="60px" width="100px"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar7">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar7">
    <ul class="navbar-nav ml-auto">
        <?php

        if(isset($_SESSION['user_uid']))
        {
            echo'
                        <li class="nav-item"><a class="nav-link" href="calendar.php">Calendar</a></li>
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
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="job-list.php">Job board</a></li>
                        <li class="nav-item"><a class="nav-link" href="sign-up-page.php">Sign up</a></li>



                        <form id="signin-form" action="php/sign-in.php" method="POST">

                        <div class="input-group mb-3">
                            <input id="signin-uid" type="text" placeholder="Username" class="form-control" aria-label="small" aria-describedby="basic-addon1"/>
                            <input id="signin-pw" type="password" placeholder="Password" class="form-control" aria-label="small" aria-describedby="basic-addon1"/>
                            <div class="input-group-append">
                            <button id="login" class="btn btn-outline-secondary mr-2" type="button">Log In</button>
                            </div>
                        </div>
                        </form>
                        <li><a href="#">Forgot account?</a></li>
                ';
        }

        ?>
    </ul>
    </div>
</nav>
