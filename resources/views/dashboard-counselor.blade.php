<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl fw-bold text-dark">
            Counselor Dashboard
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Appointments Calendar</h5>
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    {{-- FullCalendar CSS --}}
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
        <style>
            #calendar {
                max-width: 100%;
                margin: 0 auto;
                min-height: 500px;
            }
        </style>
    @endpush

    {{-- FullCalendar JS --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calendarEl = document.getElementById('calendar');

                if (calendarEl) {
                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        height: 'auto',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        events: '/calendar/appointments', // ✅ load from backend
                        eventTimeFormat: {
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                        },
                        eventClick: function (info) {
                            alert('Appointment:\n' + info.event.title + '\nDate: ' + info.event.start.toLocaleString());
                        }
                    });

                    calendar.render();
                } else {
                    console.error("Calendar element not found.");
                }
            });
        </script>
    @endpush
</x-app-layout>
