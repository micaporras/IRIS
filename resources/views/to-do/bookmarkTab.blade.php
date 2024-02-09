@extends('layout')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>BOOKMARKS</h1>
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
            <div class="table-product-head3">
                <h2>Task</h2>
                <h2>Added at</h2>
                <h2>Action</h2>
            </div>
            <div class="table-product-body4">
                @if (count($bookmark) > 0)
                    @foreach ($bookmark as $bookmark)
                        <p>{{$bookmark->name}}</p>
                        <p>{{$bookmark->created_at}}</p>
                        <div class="btn-layout">     
                            <a href="{{route('bookmark1', $bookmark->id)}}" class="btn restore">
                                <i class="fa-solid fa-rotate"></i>
                            </a>
                            <form method="post" action="{{route('deleteBM', $bookmark->id)}}">
                                @method('delete')
                                @csrf
                                    <button class="btn btn-danger" onclick="deleteConfirm(event)" >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p>No Bookmark Yet</p>
                @endif
                
            </div>
        </div>
        <div class="titlebar">
            <h1></h1>
            <a class="btn-back" href="{{route('list')}}">Back</a></div>
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