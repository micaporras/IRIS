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
          <li><a href="{{ url('usersList')}}"><span class="glyphicon glyphicon-home"></span>  Hi, {{ auth()->user()->name }}</a></li>   
          <li><a href="{{ url('logout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          @endif
          @if (auth()->user()->level === 1)
            <li><a href="{{ url('dashboard')}}"> Hi, {{ auth()->user()->name }}</a><div class="sub-menu">
              <ul>
              <li><a href="{{ url('list')}}">Todo List</a></li>
              <li><a href="{{ url('logout')}}">Logout</a></li></ul></div></li>   
            
          @endif
          @if (auth()->user()->level === 2)
            <li class="active"><a href="{{ url('editOnlyList')}}"><span class="glyphicon glyphicon-list"></span> Todo List</a></li>
            <li><a href="{{ url('dashboard')}}"><span class="glyphicon glyphicon-home"></span> Hi, {{ auth()->user()->name }}</a></li>   
            <li><a href="{{ url('logout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          @endif
          @if (auth()->user()->level === 3)
            <li class="active"><a href="{{ url('viewOnlyList')}}"><span class="glyphicon glyphicon-list"></span> Todo List</a></li>
            <li><a href="{{ url('dashboard')}}"><span class="glyphicon glyphicon-home"></span> Hi, {{ auth()->user()->name }}</a></li>   
            <li><a href="{{ url('logout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          @endif
        @endguest
    </ul>
    </div>
  </div>
</nav>

@yield('content')

</body>
</html>