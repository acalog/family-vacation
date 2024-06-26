@extends('layouts.master')
@section('content')
<div>
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
    @include('content.details.toolbar', ['image' => $image])
    <div class="view-container">
        <div class="viewer">
            <img width="{{ $image->width }}" height="{{ $image->height }}" src="{{ url('https://assets.caloggero.com/' . $image->filename) }}" alt="{{ $image->title }}">
        </div>
    </div>
    <div id="overlay-container">
        <div id="overlay">
            <button class="close-btn">&times;</button>
            <h1 id="image-title">{{ $image->title }}</h1>
            <p>{{ $image->owner }}</p>
            @include('content.details-icons', ['id' => $image->id, 'filename' => $image->filename])
            <p>{{ $image->description }}</p>
        </div>
    </div>

</div>

@endsection

@section('scripts')
    <script src="{{ asset('/static/js/details.js') }}"></script>
@endsection
