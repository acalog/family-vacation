<div class="gallery-container">
    <div class="gallery">
        @foreach($images as $image)
        <div class="item">
            <a href="{{ route('image.details', ['id' => $image->id]) }}">
                <div class="overlay">{{ $image->description }}</div>
                <img src="{{ Storage::disk('s3')->url('thumbnails/' . $image->filename) }}" alt="{{ $image->description }}">
            </a>

        </div>
        @endforeach


    </div>
</div>
