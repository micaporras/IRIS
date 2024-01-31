@extends('layout')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>TODO LIST IN CALENDAR VIEW</h1>
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
            displayEventTime: false,
            nextDayThreshold: '00:00',
        })

        $('.fc-event').css('font-size', '14px');
        $('.fc-event').css('width', '100%');
        $('.fc-event').css('background-color', 'rgb(17, 100, 100)');
        $('.fc-event').css('color', '#ffff');
        $('.fc-event').css('border', 'none');
        $('.fc-head-container').css('background-color', 'aqua');
        $('.fc-day-header').css('background-color', 'aqua');
        $('.fc-day-header').css('color', 'rgb(17, 100, 100)');
        $('.fc-center h2').css('font-size', '24px');
        $('.fc-today').css('background-color', 'aquamarine');
        $('.fc').css('color', 'aqua');
        $('.fc-day-grid-container').css('overflow-y', 'hidden');
        $('.fc-button').css('color', 'rgb(17, 100, 100)');
        $('.fc-view-container').css('color', 'rgb(17, 100, 100)');
        $('.fc-view-container').css('text-align', 'center');
        $('.fc-widget-header').css('margin-right', '-1px');
    });
</script>
@endsection