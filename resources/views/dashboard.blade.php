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
        <div class="user-profile">
            <i class="fa-regular fa-address-card"></i>
        </div>
    <h1>Hi, {{ auth()->user()->name }}</h1>
    <button>Edit Profile</button></div>
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
                <h2>Task Title: {{$titles[$i]}}</h2>
                <h2>Task Description: {{$descr[$i]}}</h2>
                <h2>Task Start: {{$date_start[$i]}}</h2>
                <h2>Task Status: {{$task_status[$i]}}</h2>
                <h2>Task By: {{$task_by[$i]}}</h2>
            </div>
            @endfor
        @endif
        
    </div></div>
</div>

</div>

<script>
    const currentDate = new Date().toDateString();

    window.onload = function() {
        document.getElementById("today").innerHTML = currentDate;
    }
</script>

@endsection