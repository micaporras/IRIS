@extends('layout')
@section('content')
<main class="container">
    <section>
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
                <p>Username</p>
                <p>Email</p>
                <p>Level</p>
                <p>Role</p>
                <p>Action</p>
            </div>
            <div class="table-product-body3">
                @if (count($users) > 0)
                    @foreach ($users as $users)
                        <p>{{$users->name}}</p>
                        <p>{{$users->email}}</p>
                        <p>{{$users->level}}</p>
                        <p>{{$users->createdby}}</p>
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