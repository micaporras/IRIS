@extends('layout')
@section('content')
<main class="container">
    <section>
        <form method="post" action="{{ route('addBookmark', $task->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="titlebar">
                <h1>Bookmark a Task</h1>
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
                    <label>Task Title</label>
                    <input type="text" name="name" value="{{$task->name}}">
                    <label>Task Description (optional)</label>
                    <textarea cols="10" rows="5" name="description" value="{{$task->description}}">{{$task->description}}</textarea>
                    <label>Created by</label>
                    <input type="text" name="createdby" value="{{$task->createdby}}">
            </div>
            <div>
                    <label>Status</label>
                    <input type="text" name="status" value="{{$task->status}}">
                    <div class="startEnd">
                        <label>Task Start</label>
                        <input type="date" name="start" id="start_date" class="form-control onlydatepicker" placeholder="Start By" value="{{$task->start}}">
                        <label>Task End</label>
                        <input type="date" name="end" id="end_date" class="form-control" placeholder="End By" value="{{$task->end}}">
                    </div>

            </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <input type="hidden" name="hidden_id" value="{{$task->id}}">
                <div class="btn-sb"><button class="btn-link">Add to Bookmark</button>
                    <a class="btn-back" href="{{route('list')}}">Back</a></div>
            </div>
        </form>
    </section>
</main>
@endsection