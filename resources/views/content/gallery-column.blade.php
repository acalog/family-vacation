<div class="gallery__column">
    @foreach($images as $image)
        @include('content.figure', ['filename' => $image->filename, 'description' => ''])
    @endforeach
</div>

