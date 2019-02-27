<?php
session_start();
require 'header.php';
//include 'php/connect.php';
echo("<link href='styles/wdb-page.css' rel='stylesheet'>");
echo("<link href='styles/carousel.css' rel='stylesheet'/>");
echo("
<script>
$(document).ready(function() {
    var announcementCount = 1;
    $('button').click(function(){
        announcementCount += 1;
        $('#news').load('php/load-announcements.php', {
            announcementNewCount: announcementCount
        });
    });
});
</script>
");

echo('

<div class="grid">

<div class="hero1">
</div>

<div class="intro py-5">
<h1>About the Workforce Development Board.</h1>
</div>

<div class="news">
<h2>Recent News: </h2>
<hr>
<div id="news">
');

$stm = $conn->prepare('SELECT * FROM announcements ORDER BY dateStamp DESC LIMIT 1');
$stm->execute();

    while($row = $stm->fetch(PDO::FETCH_ASSOC))
    {
        echo("<div class='my-2 p-2'>");
        echo("<h4>" . $row["title"] . "</h4>");
        echo("<p>" . $row["description"]);
        echo("<br />");
        echo("<br />");
        echo("<b>Date posted: </b>" . $row["dateStamp"]);
        echo("</p></div><hr>");
    }

echo('
</div>
<div class="show-more-container">
<button id="button" class="btn btn-primary more-btn">Show more</button>
</div>
</div>');

echo('
<div class="content">
<ul>
    <li><p>Federal Workforce Innovation and Opportunity Act of 2014 created local business led boards of Directors called Workforce Development Boards (WDB’s)</p></li>
    <li><p>The Mission of the Rockland County WDB is to foster a skilled and competitive workforce by promoting an understanding of workforce trends and issues in a dynamic economy for individuals and businesses.</p></li>
    <li><p>The Rockland County WDB provides oversight and monitoring of Workforce Innovation and Opportunity Act System. Rockland County Career Center is the one stop employment center as part of this system.The WDB of Rockland County receives funding through WIOA and oversees the Rockland County Career Center. The Career Center is operated by Rockland Community College.</p></li>
</ul>
</div>

<div class="download">
<a href="#"><p><b>2018 WDB Meeting Schedule*</b></p></a>
<p><b>Date: </b>September 13th 2018 @ 8:30<p>
<p><b>Location: </b>37 West Broad Street<br/>Haverstraw, NY 10927<p>
</div>');

echo('<div class="wdb-board">');
echo('<h3>Rockland County Workforce Development Board.</h3>');
$sql = $conn->prepare('SELECT * FROM boardContact ORDER BY board_type');
$sql->execute();
while($boardResult = $sql->fetch(PDO::FETCH_ASSOC))
{
    echo('<div class="member-section">');
    echo('
    <ul>
    <li><b>Name: </b>'. $boardResult['board_name'] .'</li>
    <li><b>Position: </b>'. $boardResult['board_position'] .'</li>
    <li><b>Company: </b>'. $boardResult['board_company'] .'</li>
    <li><b>Type: </b>'. $boardResult['board_type'] .'</li>
    </ul>
    ');
    echo('</div>');
}
echo("
</div>

</div>
");
require 'footer.php';
?>
