@extends('layouts.master')
@section('content')

    @include('content.details.toolbar', ['image' => $image])
    <div class="view-container">
        <div class="viewer">
            <img width="{{ $image->width / 4 }}" height="{{ $image->height / 4 }}"
                 src="{{ url('https://assets.caloggero.com/' . $image->filename) }}" alt="{{ $image->title }}">
        </div>
    </div>
    <div class="details-sidebar">
        <div class="toolbar-title">
            <h1 id="image-title">{{ $image->title }}</h1>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('/static/js/details.js') }}"></script>
@endsection
