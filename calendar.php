<?php
session_start();

require 'header.php';

echo('
<link href="styles/fullcalendar.min.css" rel="stylesheet" />
<link href="styles/fullcalendar.print.min.css" rel="stylesheet" media="print" />
<link href="styles/calendar.css" rel="stylesheet" />
<script src="js/jquery-ui.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/fullcalendar.min.js"></script>
');

echo("
<script>
$(document).ready(function() {
  var calendar = $('#calendar').fullCalendar({
    editable:false,
    header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    events: 'php/load.php',
    selectable:true,
    selectHelper:true,
    eventClick:function(event)
    {
      var title = 'Name: ' + event.title;
      var location = 'Location: ' + event.location;

      var x = '<br/>' + title + '<br/>' + '<br/>' + location + '<br/>' + '<br/>' + '<br/>' + '<br/>' + 'press OK to learn more about this event.';

      bootbox.confirm({
        size: 'small',
        message: x,
      callback: function(result){
        if(result)
        {
          window.location.assign('event-page.php?event-btn-value=' + event.id);
        }
      }
    });
  }
});
});
</script>
");

echo("
<div class='grid'>

<div class='hero1'>
</div>

<div class='intro py-5'>
<h1 style='color: white'>Here is a calendar of events being hosted.</h1>
</div>

<div class='cal'>
<div id='calendar' style='color: black;'></div>
</div>

</div>
");

//MODAL FOR RESET USER PASSWORD
echo('
<div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="resetLabel">
<div class="modal-dialog" role="document">
<div id="workshop-body" class="modal-content">


</div>
</div>
</div>
');

require 'footer.php';

?>
