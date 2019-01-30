<?php
session_start();

require 'header.php';

echo('<link href="styles/recovery.css" rel="stylesheet" />');

echo("
<script>
  $(document).ready(function() {
      $('#recovery-form').submit(function(event){
          event.preventDefault();
          var recovery_email = $('#recovery-email').val();
          var submit = '1'
          if(recovery_email != '')
          {
              $('#question-section').load('php/load-questions.php', {
                  recovery_email: recovery_email,
                  submit: submit
              });
          }
          else
          {
              $('#recovery-email').addClass('input-error')
              confirm('Please fill out all fields.');
          }
      });
  });
</script>
");

echo('
<div class="grid">

<div class="hero1">
</div>

<div class="intro py-5">
<h1 style="color: white">Password Recovery.</h1>
</div>

<div class="main">
<form id="recovery-form">
    <ul>
        <li><input id="recovery-email" type="text" placeholder="Enter your email" class="form-control" aria-label="small"/></li>
        <li><button id="recovery" class="btn btn-outline-primary" type="submit">Recover</button></li>
    </ul>
</form>
</div>

<div class="question" style="display: none;">
<div id="question-section">
</div>
</div>
</div>
');

require 'footer.php';
?>
