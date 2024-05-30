<figure class="gallery__thumb">
    <a href="{{ route('image.details', ['id' => $id]) }}">
        <img src="{{ Storage::disk('s3')->url($filename) }}" alt="{{ $description }}" class="gallery__image">
        <figcaption class="gallery__caption">{{ $description }}</figcaption>
    </a>
</figure>