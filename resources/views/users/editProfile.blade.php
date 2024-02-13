@extends('layout')
@section('content')
<main class="container">
    <section>
        <?php
        $user = auth()->user()->id;
        $name = auth()->user()->name;
        ?>
        <form method="post" action="{{ route('updateProfile', $user)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="titlebar">
                <h1>Edit Profile</h1>
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
            <div class="card1">
            <div>
                    <label>Name</label>
                    <input type="text" name="name" value="{{$name}}">
                </div>
            </div>
            <div class="titlebar">
                <h1></h1>
                <input type="hidden" name="hidden_id" value="{{$user}}">
                <div class="btn-sb"><button class="btn-link">Save</button>
                    <a class="btn-back" href="{{route('dashboard')}}">Back</a></div>
            </div>
        </form>
    </section>
</main>
@endsection