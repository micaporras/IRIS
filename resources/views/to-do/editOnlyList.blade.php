@extends('layout')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>TODO LIST</h1>
            <div>
            <a href="{{ url('bookmarkTab1')}}" class="btn-link">Bookmark Tab</a>
            <a href="{{ url('todoCalendar1')}}" class="btn-link"><i class="fa-solid fa-calendar-days"></i></a>
            </div>
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
            <div class="table-product-head">
                <h2>Task</h2>
                <h2>Description</h2>
                <h2>Start By</h2>
                <h2>End By</h2>
                <h2>Status</h2>
                <h2>Created by</h2>
                <h2>Action</h2>
            </div>
            <div class="table-product-body1">
                @if (count($task) > 0)
                    @foreach ($task as $task)
                        <p>{{$task->name}}</p>
                        <p>{{$task->description}}</p>
                        <p>{{$task->start}}</p>
                        <p>{{$task->end}}</p>
                        <p>{{$task->status}}</p>
                        <p>{{$task->createdby}}</p>
                        <div class="btn-layout">     
                            <a href="{{ route('edit2', $task->id)}}" class="btn btn-success" >
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>Task Not Found</p>
                @endif
                
            </div>
        </div>
    </section>
</main>
{{-- <script>
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
</script> --}}
@endsection