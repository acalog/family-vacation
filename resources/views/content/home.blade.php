@extends('layouts.master')

@section('content')
@include('content.dashboard')
    <div class="gallery">
        @foreach($columns as $column)
            @include('content.gallery-column', ['images' => $column])
        @endforeach
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/static/js/gallery.js') }}"></script>
    <script src="{{ asset('/static/js/dropzone.js') }}"></script>
@endsection
