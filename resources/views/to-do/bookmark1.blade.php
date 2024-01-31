@extends('layout')
@section('content')
<main class="container">
    <section>
        <form method="post" action="{{ route('addBookmark1', $bookmark->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="titlebar">
                <h1>Restore a Task</h1>
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
                    <input type="text" name="name" value="{{$bookmark->name}}">
                    <label>Task Description (optional)</label>
                    <textarea cols="10" rows="5" name="description" value="{{$bookmark->description}}">{{$bookmark->description}}</textarea>
                    <label>Created by</label>
                    <input type="text" name="createdby" value="{{$bookmark->createdby}}">
            </div>
            <div>
                    <label>Status</label>
                    <select  name="status">
                        @foreach (json_decode('{"Completed":"Completed", "On Going":"On Going", "Failed To Do":"Failed To Do"}', true) as $statusKey => $statusValue)
                            <option value="{{$statusKey}}" {{(isset($bookmark->status) && $bookmark->status == $statusKey) ? 'selected' : ''}}>{{$statusValue}}</option>
                        @endforeach
                    </select>
                    <div class="startEnd">
                        <label>Task Start</label>
                        <input type="date" name="start" id="start_date" class="form-control onlydatepicker" placeholder="Start By" value="{{$bookmark->start}}">
                        <label>Task End</label>
                        <input type="date" name="end" id="end_date" class="form-control" placeholder="End By" value="{{$bookmark->end}}">
                    </div>

            </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <input type="hidden" name="hidden_id" value="{{$bookmark->id}}">
                <div class="btn-sb"><button class="btn-link">Restore</button>
                    <a class="btn-back" href="{{route('list')}}">Back</a></div>
            </div>
        </form>
    </section>
</main>
@endsection