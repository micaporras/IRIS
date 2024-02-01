@extends('layout')
@section('content')


<div class="container">
    @if ($message = Session::get('success'))
            <script type="text/javascript">
                Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ $message }}",
                showConfirmButton: false,
                timer: 1500
                });
            </script>
        @endif

<div class="home">
    <div class="left-home">
        <div class="user-profile">
            <i class="fa-regular fa-address-card"></i>
        </div>
    <h1>Hi, {{ auth()->user()->name }}</h1>
    <p>!!!!!!!!!!!!!!!</p></div>
    <div class="right-home">
    <h1>Today</h1>
    <p>!!!!!!!!!!!!!!!</p></div>
</div>

</div>

@endsection