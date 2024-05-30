<figure class="gallery__thumb">
    <img src="{{ Storage::disk('s3')->url($filename) }}" alt="{{ $description }}" class="gallery__image">
    <figcaption class="gallery__caption">{{ $description }}</figcaption>
</figure>