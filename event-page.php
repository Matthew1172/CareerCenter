<?php
session_start();
if(isset($_SESSION['user_uid']))
{
    require 'header.php';
    include 'php/connect.php';

    echo('<link href="styles/event-page.css" rel="stylesheet" />');

    $sql = $conn->prepare('SELECT * FROM events WHERE event_id = ?');
    $sql->execute([$_GET['event-btn-value']]);
    if($sql->rowCount() > 0)
    {
                $eventListing = $sql->fetch();

                echo('<div class="grid">');

                echo('<div class="hero1">');
                echo('</div>');

                echo('<div class="intro px-3 py-5">');
                echo('<h1>'. $eventListing['title'] .'</h1>');
                echo('</div>');

                echo('<div class="eventPosting container">');

                echo('<div class="section p-3">');
                echo('<p>'. $eventListing['description'] .'</p>');
                echo('<p><b>Location: </b>'. $eventListing['location'] .'</p>');
                echo('<p><b>Type: </b>'. $eventListing['type'] .'</p>');
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
                echo('<h1>This event does not exist :(</h1>');
                echo('</div>');

                echo('</div>');
    }
    require 'footer.php';
}
else
{
    echo('<script>');
    echo('
    var x = "Sorry, you must be logged in first! \\n \\nWould you like to make an account now?"
    if(confirm(x))
    {
        window.location.assign("sign-up-page.php");
    }
    else
    {
        window.location.assign("sign-in-page.php");
    }
    ');
    echo('</script>');
}
?>
