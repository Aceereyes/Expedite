<?php
    include('includes/partner_header.php');
?>
<div class="page-body">
    <div class="container">
        <div id="calendar"></div>
    </div>
</div>
<link rel="stylesheet" href="<?= plugins('fullcalendar/main.min.css') ?>">
<script src="<?= plugins('fullcalendar/main.min.js') ?>"></script>
<script>
    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },
        aspectRatio: 2,
        nowIndicator: true,
        views: {
            dayGridMonth: { buttonText: "month" },
            timeGridWeek: { buttonText: "week" },
            timeGridDay: { buttonText: "day" }
        },
        initialView: "listMonth",
        
        editable: false,
        dayMaxEvents: false,
        navLinks: true,
        events: [
<?php
            $schedules = \App\Models\InterviewSchedule::where('partner_id', partner()->id)->get();
            $data = [];
            foreach($schedules as $schedule) {
                $data = [
                    'title' => 'Job Interview of '.$schedule->freelancer->fullName(), 
                    'start' => $schedule->start, 
                    'end' => $schedule->end,
                    'url' => 'partner_job_applicants_view.php?id='.$schedule->job_application_id
                ];
            }
            echo json_encode($data);
?>
        ],
        eventClick: function(info) {
            if(info.event.url) {
                window.location.href(info.event.url);
            }
        }
    });

    calendar.render();
</script>
<?php
    include('includes/partner_footer.php');
?>