@extends('layout')
@section('content')
<main class="container">
    <section>
        <form method="post" action="{{ route('create.post')}}" enctype="multipart/form-data">
            @csrf
            <div class="titlebar">
                <h1>Add Task</h1>
                
            </div>
            @if ($errors -> any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
            <div>
                <?php
                    $date = date('Y-m-d');
                ?>
                    <label>Task Title</label>
                    <input type="text" name="name">
                    <label>Task Description (optional)</label>
                    <textarea cols="10" rows="5" name="description"></textarea>
                    <label>Created by</label>
                    <input type="text" name="createdby" value="{{auth()->user()->name}}">
                </div>
            <div>
                    <label>Status</label>
                    <select  name="status">
                        @foreach (json_decode('{"Completed":"Completed", "On Going":"On Going", "Failed To Do":"Failed To Do"}', true) as $statusKey => $statusValue)
                            <option value="{{$statusKey}}">{{$statusValue}}</option>
                        @endforeach
                    </select>
                    <div class="startEnd">
                    <label>Task Start</label>
                    <input type="date" name="start" id="start_date" class="form-control onlydatepicker" placeholder="Start By" value="{{$date}}">
                    <label>Task End</label>
                    <input type="date" name="end" id="end_date" class="form-control" placeholder="End By" value="{{$date}}">
                    </div>
            </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <div class="btn-sb"><button class="btn-link">Save</button>
                <a class="btn-back" href="{{route('list')}}">Back</a></div>
            </div>
        </form>
    </section>
</main>
@endsection