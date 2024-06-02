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
            <h1 id="image-title">{{ $image->title }}</h1>
            <p>{{ $image->owner }}</p>
            @include('content.details-icons', ['id' => $image->id])
            <p>{{ $image->description }}</p>
        </div>
    </div>
    
</div>
@endsection