<?php
session_start();
require 'header.php';
?>

<div class="container main my-5 py-3">

    <form action="../php/sign-in.php" method="POST">
        <ul>
            <li>USERNAME<input type="text" name="user_uid"/></li>
            <li>PASSWORD<input type="text" name="user_pw"/></li>
        </ul>
    <button id="main-button" type="submit" name="login-submit" class="btn btn-primary">LOG IN</button>
    </form>

    <p>Dont have an account? <a href="index.php">sign up</a></p>

<?php
if (isset($_SESSION['user_uid']))
{
	echo("<p>"."logged in"."</p>");
}
else
{
	echo("<p>"."logged out"."</p>");
}
?>

</div>

<?php
require 'footer.php';
?>
