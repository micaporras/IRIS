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
    <div class="right-home">
    <div class="details"><h1 id="today"></h1>
        <?php
        $date = date('Y-m-d');
        $task_date = '{{$task->start}}';
        foreach ($task as $task) {
            $current = $task->start;
            $current1 = $task->end;
            $summary = '';
            if ($current === $date or $current === $date) {
                $summary = "0";
                $title = $task->name;
                $desc = $task->description;
                $date_start = $task->start;
                $date_end = $task->end;
                $task_status = $task->status;
                $task_by = $task->createdby;
            }else{
                $summary = "No Task Due Today";
            }
        }
        ?>
        @if ($summary === "0")
            <h2>Task Title: {{$title}}</h2>
            <h2>Task Description: {{$desc}}</h2>
            <h2>Task Started On: {{$date_start}}</h2>
            <h2>Task Will End On: {{$date_end}}</h2>
            <h2>Task Is Currently: {{$task_status}}</h2>
            <h2>Task Is Created By: {{$task_by}}</h2>
        @else
            <h2>{{$summary}}</h2>
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