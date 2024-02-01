@extends('layout')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>TODO LIST</h1>
            <div>
            <a href="{{ url('bookmarkTab1')}}" class="btn-link">Bookmark Tab</a>
            <a href="{{ url('todoCalendar2')}}" class="btn-link"><i class="fa-solid fa-calendar-days"></i></a>
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
            <div class="table-product-head1">
                <h2>Title</h2>
                <h2>Description</h2>
                <h2>Status</h2>
                <h2>Created by</h2>
                <h2>Created at</h2>
            </div>
            <div class="table-product-body2">
                @if (count($task) > 0)
                    @foreach ($task as $task)
                        <p>{{$task->name}}</p>
                        <p>{{$task->description}}</p>
                        <p>{{$task->status}}</p>
                        <p>{{$task->createdby}}</p>
                        <p>{{$task->created_at}}</p>
                    @endforeach
                @else
                    <p>Task Not Found</p>
                @endif
                
            </div>
        </div>
    </section>
</main>
@endsection