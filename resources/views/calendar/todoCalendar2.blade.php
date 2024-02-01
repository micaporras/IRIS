@extends('layout')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>CALENDAR VIEW</h1>
            <div>
                <a href="{{ url('viewOnlyList')}}" class="btn-link"><i class="fa-solid fa-list"></i></a>
            </div>
        </div>
        <div id="calendar">

        </div>
    </section>
</main>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
$(document).ready(function() {
        var todos = @json($events);
        $('#calendar').fullCalendar({
            timeZone: 'UTC',
            themeSystem: 'bootstrap',
            header: {
                left: 'prev',
                center: 'title',
                right: 'next, today'
            },
            events: todos,
            selectable: true,
            selectHelper: true,
            displayEventTime: false,
            allDay: false,
            eventColor: '#473c5f',
        })

        $('.fc-event').css('font-size', '14px');
        $('.fc-event').css('width', '100%');
        $('.fc-event').css('background-color', '#0c0c27');
        $('.fc-event').css('color', '#ffff');
        $('.fc-event').css('border', 'none');
        $('.fc-event').css('margin', '0');
        $('.fc-head-container').css('background-color', '#473c5f');
        $('.fc-day-header').css('background-color', '#473c5f');
        $('.fc-day-header').css('color', 'white');
        $('.fc-center h2').css('font-size', '24px');
        $('.fc-today').css('background-color', '#473c5f');
        $('.fc').css('color', '#473c5f');
        $('.fc-day-grid-container').css('overflow-y', 'hidden');
        $('.fc-button').css('color', '#473c5f');
        $('.fc-view-container').css('color', '#473c5f');
        $('.fc-view-container').css('text-align', 'center');
        $('.fc-widget-header').css('margin-right', '-1px');
        
    });
</script>
@endsection