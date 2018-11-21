<?php
session_start();
require 'header.php';
?>

<div class="container main my-5 py-3">

    <form action="../php/create-user.php" method="POST">
        <ul>
            <li>FIRST<input type="text" name="user_first"></li>
            <li>LAST<input type="text" name="user_last"></li>
            <li>EMAIL<input type="text" name="user_email"></li>
            <li>USERNAME<input type="text" name="user_uid"></li>
            <li>PASSWORD<input type="text" name="user_pw"></li>
        </ul>
        <button id="main-button" type="submit" name="signup-submit" class="btn btn-primary">SIGN-UP</button>
    </form>

<p class=""><a href="sign-in-page.php">Have an account?</a></p>

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
