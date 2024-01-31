@extends('layout')
@section('content')

<style>
    .welcome {
        color:white;
        margin-left: 40%;
    }

    p {
        color: white;
        margin-left: 45%;
        font-size: 20px;
        margin-top: 10%
    }

    .tenor-gif-embed {
        height: 300px;
        width: 300px;
        margin-top: 5%;
    }

</style>

<p> Welcome, {{ auth()->user()->name }}</p>
<h1 class="welcome">YOU ARE LOGGED IN</h1>
<div class="tenor-gif-embed" data-postid="21834026" data-share-method="host" data-aspect-ratio="1.33891" data-width="100%"><a href="https://tenor.com/view/hello-there-funny-sassy-hair-gif-21834026">Hello There GIF</a>from <a href="https://tenor.com/search/hello-gifs">Hello GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
@endsection