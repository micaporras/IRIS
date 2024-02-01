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
<h1>Welcome, {{ auth()->user()->name }}</h1>

</div>

@endsection