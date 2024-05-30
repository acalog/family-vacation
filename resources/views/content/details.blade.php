@extends('layouts.master')
@section('content')
<div class="background-image" style="background: url('https://assets.caloggero.com/{{ $image->filename }}') no-repeat center center/cover;">
    <div class="navbar">
        <div class="logo"></div>
        <ul>
            <li><a href="{{ route('home') }}">Back</a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
        </ul>
        <!-- <a href="" class="quote-button">Login</a> -->
    </div>
    <div id="overlay-container">
        <div id="overlay">
            <h1>{{ $image->filename }}</h1>
            <a href="">Download Link</a>
            <a href="">Share Links</a>
            <p>{{ $image->description }}</p>
            <p>{{ $image->owner }}</p>
        </div>
    </div>
    
</div>
@endsection