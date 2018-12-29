<?php
session_start();
require 'header.php';
include 'php/connect.php';
echo("<link href='styles/contact2.css' rel='stylesheet'>");
echo("
<script>
$(document).ready(function() {
});
</script>
");

echo('

<div class="grid">

<div class="hero1">
</div>

<div class="intro py-5">
<h1>Contact details.</h1>
</div>

<div class="contactList">

<div class="container">
  <h4 class="py-5">Career Center contacts.</h4>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Extension</th>
      </tr>
    </thead>
    <tbody id="contact-list">
');

$sql = $conn->prepare('SELECT * FROM careerCenterContact');
$sql->execute();
while($careerResult = $sql->fetch(PDO::FETCH_ASSOC))
{
    echo('<tr>');
    echo('
    <td>'. $careerResult['contact_name'] .'</td>
    <td>'. $careerResult['contact_position'] .'</td>
    <td><a href="mailto: '. $careerResult['contact_email'] .'">'. $careerResult['contact_email'] .'</a></td>
    <td>'. $careerResult['contact_phone'] .'</td>
    <td>'. $careerResult['contact_ext'] .'</td>
    ');
    echo('</tr>');
}

echo('
    </tbody>
  </table>
');

echo('
<h4 class="py-5">Department of Labor contacts.</h4>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Name</th>
      <th>Position</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Extension</th>
    </tr>
  </thead>
  <tbody id="labor-list">
');

$sql = $conn->prepare('SELECT * FROM laborContact');
$sql->execute();
while($laborResult = $sql->fetch(PDO::FETCH_ASSOC))
{
  echo('<tr>');
  echo('
  <td>'. $laborResult['labor_name'] .'</td>
  <td>'. $laborResult['labor_position'] .'</td>
  <td><a href="mailto: '. $laborResult['labor_email'] .'">'. $laborResult['labor_email'] .'</a></td>
  <td>'. $laborResult['labor_phone'] .'</td>
  <td>'. $laborResult['labor_ext'] .'</td>
  ');
  echo('</tr>');
}

echo('
  </tbody>
</table>
');

echo('
<h4 class="py-5">Rockland Boces contacts.</h4>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Name</th>
      <th>Position</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Extension</th>
    </tr>
  </thead>
  <tbody id="boces-list">
');

$sql = $conn->prepare('SELECT * FROM bocesContact');
$sql->execute();
while($bocesResult = $sql->fetch(PDO::FETCH_ASSOC))
{
  echo('<tr>');
  echo('
  <td>'. $bocesResult['boces_name'] .'</td>
  <td>'. $bocesResult['boces_position'] .'</td>
  <td><a href="mailto: '. $bocesResult['boces_email'] .'">'. $bocesResult['boces_email'] .'</a></td>
  <td>'. $bocesResult['boces_phone'] .'</td>
  <td>'. $bocesResult['boces_ext'] .'</td>
  ');
  echo('</tr>');
}

echo('
  </tbody>
</table>
');

echo('</div>');

echo('
</div>

</div>
');
require 'footer.php';
?>
