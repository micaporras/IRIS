@extends('layout')
@section('content')


<div class="container">
    @if ($message = Session::get('success'))
            <script type="text/javascript">
                Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ $message }}",
                showConfirmButton: false,
                timer: 1500
                });
            </script>
    @endif

<div class="home">
    <div class="left-home">
        
   <div class="profile"> 
    <?php
    $user = auth()->user()->id;
    $getMonth = Date('F');
    $role = auth()->user()->level;
    $getRole = '';
    if ($role === 0) {
        $getRole = "You are the admin";
    }
    elseif ($role === 1) {
        $getRole = "You are User 1. You can add, delete, and edit tasks";
    }
    elseif ($role === 2) {
        $getRole = "You are User 2. You can edit tasks";
    }
    elseif ($role === 3) {
        $getRole = "You are User 3. You can view tasks";
    }
    ?>
    <button><a href="{{ route('editProfile', $user)}}"><i class="fa-regular fa-user"></i></a></button>
    <h2><br>Hi, {{ auth()->user()->name }}<br><span>{{$getRole}}</span></h2>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <div class="pies">
            <div><h3>All Tasks</h3></div>
            <div><h3>Tasks this {{$getMonth}}</h3></div>
            <div class="pie">
                <canvas id="pieChart"></canvas>
            </div>
            <div class="pie">
                <canvas id="pieChart1"></canvas>
            </div>
        </div>
    
    </div>
    <div class="right-home"><div class="date_today">
        <h1 id="today"></h1>
        <?php
        $date = date('Y-m-d');
        $iteration = 0;
        foreach ($task as $tasks) {
            $current = $tasks->start;
            $current1 = $tasks->end;
            $summary = '';
            if ($current1 === $date) {
                $summary = "Task/s Due Today";
                $current_date[] = $current1;
                $titles[] = $tasks->name;
                $descr[] = $tasks->description;
                $date_start[] = $tasks->start;
                $date_end[] = $tasks->end;
                $task_status[] = $tasks->status;
                $task_by[] = $tasks->createdby;
                $iteration += 1;
            } else {
                $summary = "No Task Due Today";
            }
        }
        ?>
        <h2>{{$summary}}</h2>
    </div>

    <div class="details">
        @if ($iteration > 0)
            @for ($i = 0; $i < $iteration; $i++)
            <div class="task_container">
                <h2>Title: {{$titles[$i]}}</h2>
                <h2>Description: {{$descr[$i]}}</h2>
                <h2>Started On: {{$date_start[$i]}}</h2>
                <h2>Status: {{$task_status[$i]}}</h2>
                <h2>By: {{$task_by[$i]}}</h2>
            </div>
            @endfor
        @endif
        
    </div>
</div>

</div>

<script>
    const currentDate = new Date().toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
    });

    window.onload = function() {
        document.getElementById("today").innerHTML = currentDate;
    }
</script>

<script>
    var ctx = document.getElementById('pieChart').getContext('2d');
    Chart.defaults.color = 'white';
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($label),
            datasets: [{
                data: @json($totalTasks),
                backgroundColor: [
                    'white',
                    'rgb(84, 65, 129)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                ],
                borderColor: [
                    // 'rgb(90, 79, 109)',
                    'rgb(49, 9, 49)',
                    
                ],
                borderWidth: 3,
            }]
        },
    });

    var ctx = document.getElementById('pieChart1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($label),
            datasets: [{
                data: @json($totalTasks1),
                backgroundColor: [
                    'white',
                    'rgb(84, 65, 129)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                ],
                borderColor: [
                    'purple',
                ],
                borderWidth: 3
            }]
        },
    });
</script>



@endsection