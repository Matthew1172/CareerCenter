<?php
session_start();
require 'header.php';
include 'php/connect.php';
echo("<link href='styles/contact.css' rel='stylesheet'>");
echo("
<script>
$(document).ready(function() {
});
</script>
");

echo('<div class="grid">');

echo('
<div class="hero1">
</div>

<div class="intro py-5">
<h1>Contact details.</h1>
</div>
');

echo('<div class="contactList">');

echo('<h3>Career Center Contacts.</h3>');
$sql = $conn->prepare('SELECT * FROM careerCenterContact');
$sql->execute();
while($careerResult = $sql->fetch(PDO::FETCH_ASSOC))
{
    echo('<div class="contact-section">');
    echo('
    <ul>
    <li><b>Name: </b>'. $careerResult['contact_name'] .'</li>
    <li><b>Position: </b>'. $careerResult['contact_position'] .'</li>
    <li><b>Email: </b><a href="mailto:'. $careerResult['contact_email'] .'">'. $careerResult['contact_email'] .'</a></li>
    <li><b>Phone: </b>'. $careerResult['contact_phone'] .'</li>
    <li><b>Extension: </b>'. $careerResult['contact_ext'] .'</li>
    </ul>
    ');
    echo('</div>');
}

echo('<h3 class="pt-5">Department of Labor Contacts.</h3>');
$sql = $conn->prepare('SELECT * FROM laborContact');
$sql->execute();
while($laborResult = $sql->fetch(PDO::FETCH_ASSOC))
{
    echo('<div class="contact-section">');
    echo('
    <ul>
    <li><b>Name: </b>'. $laborResult['labor_name'] .'</li>
    <li><b>Position: </b>'. $laborResult['labor_position'] .'</li>
    <li><b>Email: </b><a href="mailto:'. $laborResult['labor_email'] .'">'. $laborResult['labor_email'] .'</a></li>
    <li><b>Phone: </b>'. $laborResult['labor_phone'] .'</li>
    <li><b>Extension: </b>'. $laborResult['labor_ext'] .'</li>
    </ul>
    ');
    echo('</div>');
}

echo('<h3 class="pt-5">Rockland Boces Contacts.</h3>');
$sql = $conn->prepare('SELECT * FROM bocesContact');
$sql->execute();
while($bocesResult = $sql->fetch(PDO::FETCH_ASSOC))
{
    echo('<div class="contact-section">');
    echo('
    <ul>
    <li><b>Name: </b>'. $bocesResult['boces_name'] .'</li>
    <li><b>Position: </b>'. $bocesResult['boces_position'] .'</li>
    <li><b>Email: </b><a href="mailto:'. $bocesResult['boces_email'] .'">'. $bocesResult['boces_email'] .'</a></li>
    <li><b>Phone: </b>'. $bocesResult['boces_phone'] .'</li>
    <li><b>Extension: </b>'. $bocesResult['boces_ext'] .'</li>
    </ul>
    ');
    echo('</div>');
}

echo('</div>');

echo('</div>');

require 'footer.php';
?>
