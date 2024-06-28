@extends('layouts.master')

@section('content')
@include('content.dashboard')
    @include('content.gallery', ['images' => $images])
    <div class="gallery__container">
        @foreach($columns as $column)
            @include('content.gallery-column', ['images' => $column])
        @endforeach
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/static/js/dropzone.js') }}"></script>
@endsection
