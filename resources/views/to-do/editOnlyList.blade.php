@extends('layout')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>TODO LIST</h1>
            {{-- search --}}
            <form method="GET" action="{{ route('list')}}" name="search" accept-charset="UTF-8" role="search">
                <div class="searchBox">
                    <input class="searchInput" type="text" name="search" placeholder="Search Task" value="{{ request('search')}}">
                    <button class="searchButton" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="28" viewBox="4 4 25 23" fill="none">
                    <g clip-path="url(#clip0_2_17)">
                        <g filter="url(#filter0_d_2_17)">
                        <path d="M23.7953 23.9182L19.0585 19.1814M19.0585 19.1814C19.8188 18.4211 20.4219 17.5185 20.8333 16.5251C21.2448 15.5318 21.4566 14.4671 21.4566 13.3919C21.4566 12.3167 21.2448 11.252 20.8333 10.2587C20.4219 9.2653 19.8188 8.36271 19.0585 7.60242C18.2982 6.84214 17.3956 6.23905 16.4022 5.82759C15.4089 5.41612 14.3442 5.20435 13.269 5.20435C12.1938 5.20435 11.1291 5.41612 10.1358 5.82759C9.1424 6.23905 8.23981 6.84214 7.47953 7.60242C5.94407 9.13789 5.08145 11.2204 5.08145 13.3919C5.08145 15.5634 5.94407 17.6459 7.47953 19.1814C9.01499 20.7168 11.0975 21.5794 13.269 21.5794C15.4405 21.5794 17.523 20.7168 19.0585 19.1814Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" shape-rendering="crispEdges"></path>
                        </g>
                    </g>
                    <defs>
                        <filter id="filter0_d_2_17" x="-0.418549" y="3.70435" width="29.7139" height="29.7139" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                        <feOffset dy="4"></feOffset>
                        <feGaussianBlur stdDeviation="2"></feGaussianBlur>
                        <feComposite in2="hardAlpha" operator="out"></feComposite>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_17"></feBlend>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_17" result="shape"></feBlend>
                        </filter>
                        <clipPath id="clip0_2_17">
                        <rect width="28.0702" height="28.0702" fill="white" transform="translate(0.403503 0.526367)"></rect>
                        </clipPath>
                    </defs>
                    </svg>
                    </button>
                </div>
            </form>
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