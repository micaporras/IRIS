@extends('layout')
@section('content')

<style>
 * {
    text-decoration: none;
}

section {
    margin-top: -20px;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: 'Jost', sans-serif;
    background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
}

/* CSS for register and login page */
.main {
    width: 500px;
    height: 500px;
    background: #4a396b;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 5px 20px 50px black;
    justify-content: center;
}

.wrapper {
    position: relative;
    width: 70%;
    height: 100%;
    margin-left: 15%;
}

label {
    color: white;
    font-size: 2.3em;
    justify-content: center;
    display: flex;
    margin: 60px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.5s ease-in-out;
}

input {
    width: 100px;
    height: 200px;
    background: white;
    justify-content: center;
    display: flex;
    margin: 20px auto;
    padding: 20px;
    border: none;
    outline: none;
    border-radius: 5px;
    color: black;
}

button {
    width: 40%;
    height: 40px;
    margin: 10px auto;
    justify-content: center;
    display: block;
    color: white;
    background: #573b8a;
    font-size: 1em;
    font-weight: bold;
    margin-top: 20px;
    outline: none;
    border: none;
    border-radius: 5px;
    transition: 0.2s ease-in;
    cursor: pointer;
}

button:hover {
    background: #6d44b8;
}


</style>

    <section>
        <div class="main">
        <div class="wrapper">
            <form method="post" action="{{route('registration.post')}}">
            @csrf
            <label>Register Here</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your username here" />
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name')}}</span>
                @endif
                <input type="text" name="email" class="form-control" placeholder="Enter your email here" />
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email')}}</span>
                @endif
                <input type="password" name="password" class="form-control" placeholder="Enter your password here" />
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password')}}</span>
                        @endif
                <button type="submit" name="submit">Register</button>
              </form>
            </div>
        </div>
    </section>
    

@endsection