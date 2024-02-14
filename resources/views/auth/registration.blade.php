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
    position: relative;
    background: url('{{ asset('img/1.jpg')}}') no-repeat center / cover;
}

#particles-js{ 
  position: relative;
  background-color: transparent; 
  background-image: url("");
  background-repeat: no-repeat; 
  background-size: cover;
  background-position: center center; 
}


.wrapper {
    position: relative;
    width: 100%;
    height: 100%;
}

label {
    color: #573b8a;
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

<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="http://threejs.org/examples/js/libs/stats.min.js"></script>

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
            <div id="particles-js">
            <form method="post" action="{{route('registration.post')}}" >
            @csrf
            <label>REGISTER</label>
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
            </div></div>
        </div>
    </section>
    <script>
        particlesJS("particles-js", {"particles":{"number":{"value":80,"density":{"enable":true,"value_area":800}},"color":{"value":"#573b8a"},"shape":{"type":"star","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":6,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":false,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":false});var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);;
      </script>    

@endsection