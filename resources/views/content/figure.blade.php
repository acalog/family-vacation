<figure class="gallery__thumb">
    <a href="">
        <img src="{{ Storage::disk('s3')->url($filename) }}" alt="{{ $description }}" class="gallery__image">
        <figcaption class="gallery__caption">{{ $description }}</figcaption>
    </a>
</figure>