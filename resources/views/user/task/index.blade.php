@extends('user.layout')
@section('title', trans('general.Career_Planning'))
@section('content')
<div class="main-section">
<div class="card mt-5">
    <div class="card-body">


        <h5>{{ trans('general.Google_Events') }}</h5>
        

<div id="calendar"></div>

    </div>
</div>
</div>
@endsection
@section('script')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
    }
#calendar {
    height: auto !important;
    min-height: 600px;
    visibility: visible;
    opacity: 1;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: @json($mergedData),
        eventDidMount: function(info) {

            // ✅ Add tooltip with type
            info.el.setAttribute(
                'title',
                info.event.title + " (" + info.event.extendedProps.type + ")"
            );

            // ✅ Add icon before title
            let icon = '';
            if (info.event.extendedProps.type === 'task') {
                icon = '📝 '; // Task icon
                info.el.style.backgroundColor = '#ffc107'; // Yellow for tasks
                info.el.style.borderColor = '#ffc107';
                    info.el.style.color = '#fff'; // Green for events
            } else if (info.event.extendedProps.type === 'event') {
                icon = '📅 '; // Event icon
                info.el.style.backgroundColor = '#28a745'; // Green for events
                info.el.style.color = '#fff'; // Green for events
                info.el.style.borderColor = '#28a745';
            }

            let titleEl = info.el.querySelector('.fc-event-title');
            if (titleEl) {
                titleEl.innerHTML = icon + info.event.title;
            }
        }
    });
    calendar.render();
});
</script>

@endsection
