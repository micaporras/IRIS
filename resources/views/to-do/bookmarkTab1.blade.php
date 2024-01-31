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
            <div class="table-product-head4">
                <p>Task</p>
                <p>Added at</p>
            </div>
            <div class="table-product-body5">
                @if (count($bookmark) > 0)
                    @foreach ($bookmark as $bookmark)
                        <p>{{$bookmark->name}}</p>
                        <p>{{$bookmark->created_at}}</p>
                    @endforeach
                @else
                    <p>No Bookmark Yet</p>
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