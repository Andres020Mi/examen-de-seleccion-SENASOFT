@extends('layouts.app')

@section('title', 'Calendario de eventos')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">📅 Calendario de Eventos</h1>

    <!-- Calendario -->
    <div id="calendar"></div>
</div>

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es', // calendario en español
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        // Eventos ya transformados desde el controlador
        events: @json($eventosCalendario),

        eventClick: function(info) {
            alert("📌 " + info.event.title + "\n\n" + info.event.extendedProps.description);
        }
    });

    calendar.render();
});
</script>
@endsection
