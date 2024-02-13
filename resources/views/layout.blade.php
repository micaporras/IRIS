<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>IRIS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<body>
<div class="nav"></div>
  <nav class="navbar">
  <div class="navdiv">
    <div class="logo">
      <a href="{{ url('dashboard')}}">IRIS</a>
    </div>
    <div class="menu-bar">
    <ul>
        @guest
            <li><a href="{{ url('login')}}">Login</a></li>
            <li><a href="{{ url('registration')}}">Register</a></li>
        @else
          @if (auth()->user()->level === 0)
          <li><a><i class="fa-regular fa-user"></i>   {{ auth()->user()->name }}</a><div class="sub-menu">
            <ul>
              <li class="active"><a href="{{ url('dashboard')}}">Home</a></li>
              <li><a href="{{ url('usersList')}}">Manage Users</a></li>
              <li><a onclick="logout(event)">Logout</a></li></ul></div></li>   
          @endif
          @if (auth()->user()->level === 1)
            <li><a href="{{ url('dashboard')}}"><i class="fa-regular fa-user"></i>   {{ auth()->user()->name }}</a><div class="sub-menu">
              <ul>
                <li class="active"><a href="{{ url('dashboard')}}">Home</a></li>
                <li><a href="{{ url('list')}}">Todo List</a></li>
                <li><a onclick="logout(event)">Logout</a></li></ul></div></li>   
            
          @endif
          @if (auth()->user()->level === 2)
            <li><a href="{{ url('dashboard')}}"><i class="fa-regular fa-user"></i>   {{ auth()->user()->name }}</a><div class="sub-menu">
              <ul>
                <li class="active"><a href="{{ url('dashboard')}}">Home</a></li>
                <li class="active"><a href="{{ url('editOnlyList')}}">Todo List</a></li>
                <li><a onclick="logout(event)">Logout</a></li>
            </li></ul></div>   
            
          @endif
          @if (auth()->user()->level === 3)
            <li><a href="{{ url('dashboard')}}"><i class="fa-regular fa-user"></i>   {{ auth()->user()->name }}</a><div class="sub-menu">
              <ul>
                <li class="active"><a href="{{ url('dashboard')}}">Home</a></li>
                <li class="active"><a href="{{ url('viewOnlyList')}}">Todo List</a></li>
                <li><a onclick="logout(event)">Logout</a></li>
            </li></ul></div>   
            
          @endif
        @endguest
    </ul>
    </div>
  </div>
</nav>

@yield('content')

</body>
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
        if (result.dismiss === Swal.DismissReason.timer) {
          console.log("I was closed by the timer");
          window.location.href = "{{ url('logout')}}";
        }
      });
  }
</script>
</html>