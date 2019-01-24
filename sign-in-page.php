<?php
session_start();
require 'header.php';
include 'php/connect.php';

echo('<link href="styles/sign-in-page.css" rel="stylesheet" />');

echo('
<script>
    $(document).ready(function(){
        $("#signin-form").submit(function(event){
            event.preventDefault();
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
                        url: "php/sign-in.php",
                        method: "POST",
                        data: {
                            login: 1,
                            uid: uid,
                            pw: pw
                        },
                        success: function(response){
                            if(response == "failed")
                            {
                                alert("Invalid username or password.");
                            }
                            else if(response == "success")
                            {
                                window.location.assign("home.php")
                            }
                            else
                            {
                                window.location.assign("index.php")
                            }
                        },
                        dataType: "text"
                    }
                );
            }
        });
    });
</script>
');

echo('<div class="grid">');

echo('<div class="main">');
echo('
<form id="signin-form" action="php/sign-in.php" method="POST">
    <p class="form-message"></p>
    <ul>
        <li><input id="signin-uid" type="text" placeholder="Username" class="form-control" aria-label="small"/></li>
        <li><input id="signin-pw" type="password" placeholder="Password" class="form-control" aria-label="small"/></li>
        <li><button id="login" class="btn btn-outline-primary" type="submit">Log In</button></li>
    </ul>
</form>
    <span><a href="sign-up-page.php">Don\'t have an account?</a></span>
    <br/>
    <br/>
    <span><a href="recovery.php">Forgot your password?</a></span>
');
echo('</div>');

echo('</div>');

require 'footer.php';
?>
