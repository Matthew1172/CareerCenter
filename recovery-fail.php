<?php
session_start();

require 'header.php';

echo('
<link href="styles/recovery-fail.css" rel="stylesheet" />
');

echo("
<div class='grid'>

<div class='hero1'>
</div>

<div class='intro py-5'>
<h1 style='color: white'>We were unable to recover your password.</h1>
</div>

<div class='main'>
<p>Sorry m8</p>
</div>

</div>
");

require 'footer.php';

?>
