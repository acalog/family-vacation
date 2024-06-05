@extends('layouts.master')

@section('content')
@include('content.dashboard')
    <div class="in-progress-sign">
        <h1>Under Construction</h1>
    </div>
    <div class="gallery">
        @foreach($columns as $column)
            @include('content.gallery-column', ['images' => $column])
        @endforeach
    </div>
    <script src="{{ asset('/static/js/gallery.js') }}"></script>
    
@endsection