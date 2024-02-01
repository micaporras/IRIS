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
}

/* CSS for register and login page */
.main {
    width: 500px;
    height: 500px;
    background: #24243e;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 5px 20px 50px black;
    justify-content: center;
}

.wrapper {
    position: relative;
    width: 100%;
    height: 100%;
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

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 80%;
    height: 30px;
    background: white;
    justify-content: center;
    display: flex;
    margin: 20px auto;
    padding: 25px;
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
      @if ($message = Session::get('success'))
      <script type="text/javascript">
          Swal.fire({
          position: "center",
          icon: "info",
          title: "{{ $message }}",
          showConfirmButton: false,
          timer: 1500
        });
      </script>
    @endif
    <div class="wrapper">
            <form method="post" action="{{ route('login.post')}}">
            @csrf
            <label>Login</label>
            <input type="text" name="email" placeholder="Enter your email here"/>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email')}}</span>
            @endif
            <input type="password" name="password" placeholder="Enter your password here"/>
             @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password')}}</span>
            @endif
            <button type="submit" name="submit" id="submit">Login</button>
            </form>
        </div>
</div>
</section>
<script>
    window.logout = function (e) {
        e.preventDefault();
        var form = e.target.form;
        let timerInterval;
        Swal.fire({
          title: "Logging Out",
          html: "",
          timer: 2000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
              timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
          },
          willClose: () => {
            clearInterval(timerInterval);
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
            form.submit();
          }
        });
    }
  </script>

@endsection