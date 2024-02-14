@extends('layout')
@section('content')
<main class="container">
    <section>
        <div class="monitor" >
            <div class="cards">
                <div class="card2">
                    <p>Level 1 No. of Users: {{ $countUser1 }}</p>
                </div>
            </div>
            <div class="cards">
                <div class="card2">
                <p>Level 2 No. of Users: {{ $countUser2 }}</p>
                </div>
            </div>
            <div class="cards">
                <div class="card2">
                <p>Level 3 No. of Users: {{ $countUser3 }}</p>
                </div>
            </div>
        </div>
        <div class="titlebar">
            <h1>USERS' LIST</h1>
        </div>
        @if ($message = Session::get('success'))
            <script type="text/javascript">
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                Toast.fire({
                icon: 'success', 
                title: '{{ $message }}'
                })
            </script>
        @endif
        <div class="table">
            <div class="table-product-head2">
                <h2>Username</h2>
                <h2>Email</h2>
                <h2>Level</h2>
                <h2>Role</h2>
                <h2>Action</h2>
            </div>
            <div class="table-product-body3">
                @if (count($users) > 0)
                    @foreach ($users as $users)
                        <p>{{$users->name}}</p>
                        <p>{{$users->email}}</p>
                        <p>{{$users->level}}</p>
                        @if ($users->level === 0)
                        <p>Admin</p>
                        @elseif ($users->level === 1)
                        <p>Can add, update, and delete a task</p>
                        @elseif ($users->level === 2)
                        <p>Can update a task</p>
                        @elseif ($users->level === 3)
                        <p>Can view the tasks</p>
                        @endif
                        <div class="btn-layout">     
                            <a href="{{ route('editUsers', $users->id)}}" class="btn btn-success" >
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form method="post" action="{{route('deleteUser', $users->id)}}">
                                @method('delete')
                                @csrf
                                    <button class="btn btn-danger" onclick="deleteConfirm(event)" >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                            </form>
                            
                        </div>
                    @endforeach
                @else
                @endif
                @if (auth()->user()->level === 0)
                
                @endif
                
            </div>
        </div>
    </section>
</main>
<script>
    window.deleteConfirm = function (e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
            title: 'Are you sure?',
            text: "This will be deleted permanently",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    }
</script>

@endsection