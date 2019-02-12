<?php
session_start();
require 'header.php';
//include 'php/connect.php';
echo("<link href='styles/index.css' rel='stylesheet'>");
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
<h1>Welcome to the Rockland County Career Center.</h1>
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
<div class="contact">
<h2>Contact:</h2>
<hr/>
<ul>
<li><p><b>Phone: </b>(845)-845-8545</p></li>
<li><p><b>Hours: </b>Monday – Friday, 8:30 AM – 4:30 PM</p></li>

<li><p><b>Rockland County Career Center locations: </b></p></li>
<li><p>
145 College Rd
<br/>
Brucker Hall, Room 6104
<br/>
Suffern, New York 10901
</p></li>

<li><p>
37 West Broad Street
<br/>
Haverstraw, NY 10927
</p></li>
</ul>
</div>

<div class="description">
<p>The Rockland County Career Center supports the adult, dislocated, and youth population in Rockland County in their transition to obtaining employment by providing job search assistance, innovative training programs, workshops and other services. All services are free of charge!</p>
<p>Representatives of the New York Department of Labor provide services at the Rockland County Career Center in our Haverstraw location.</p>

</div>

<div class="slider">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>
<li data-target="#myCarousel" data-slide-to="2"></li>
</ol>
<div class="carousel-inner">
<div class="carousel-item active"><img class="first-slide" src="https://d13dcw7qo4xgly.cloudfront.net/wp-content/uploads/2015/07/twitter-bootstrap-carousel.png" alt="First slide"></div>
<div class="carousel-item"><img class="second-slide" src="https://d13dcw7qo4xgly.cloudfront.net/wp-content/uploads/2015/07/twitter-bootstrap-carousel.png" alt="Second slide"></div>
<div class="carousel-item"><img class="third-slide" src="https://d13dcw7qo4xgly.cloudfront.net/wp-content/uploads/2015/07/twitter-bootstrap-carousel.png" alt="Third slide"></div>
</div>
<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
</div>

<div class="map">
<div class="google-maps">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3005.093607088136!2d-74.0874289099301!3d41.13248246790525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2dd84d07f2229%3A0x4ef2ba305022bbf0!2sDaniel+T.+Brucker+Hall!5e0!3m2!1sen!2sus!4v1543271137679"></iframe>
  </div>
  </div>

  </div>
  ');
  require 'footer.php';
  ?>
