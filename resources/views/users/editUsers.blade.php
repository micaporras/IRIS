@extends('layout')
@section('content')
<main class="container">
    <section>
        <form method="post" action="{{ route('updateUser', $users->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="titlebar">
                <h1>Edit User</h1>
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
                    <label>Name</label>
                    <input type="text" name="name" value="{{$users->name}}">
                </div>
            <div>
                    <label>Level</label>
                    <select  name="level">
                        @foreach (json_decode('{"0": "Admin", "1":"User 1", "2":"User 2", "3":"User 3"}', true) as $levelKey => $levelValue)
                            <option value="{{$levelKey}}" {{(isset($users->level) && $users->level == $levelKey) ? 'selected' : ''}}>{{$levelValue}}</option>
                        @endforeach
                    </select>
            </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <input type="hidden" name="hidden_id" value="{{$users->id}}">
                <div class="btn-sb"><button class="btn-link">Save</button>
                    <a class="btn-back" href="{{route('usersList')}}">Back</a></div>
            </div>
        </form>
    </section>
</main>
@endsection