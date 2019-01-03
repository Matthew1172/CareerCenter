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
        var title = 'Event name: ' + event.title;
        var location = 'Event location: ' + event.location;
        var type = 'Type of event: ' + event.type;
        var datePosted = 'Date posted: ' + event.dateStamp;

        var x = title + '\\n' + '\\n' + location + '\\n' + '\\n' + type + '\\n' + '\\n' + datePosted + '\\n' + '\\n' + '\\n' + '\\n' + 'press OK to learn more about this event.';
        if(confirm(x))
        {
            window.location.assign('event-page.php?event-btn-value=' + event.id);
        }
        else
        {
            window.location.reload();
        }
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
<h1 style='color: white'>Here is a calendar of events being hosted. Click on the event bubble to find out more information.</h1>
</div>

<div class='cal'>
<div id='calendar'></div>
</div>

</div>
");

require 'footer.php';

?>
