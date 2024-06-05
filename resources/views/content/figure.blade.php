<figure class="gallery__thumb">
    <a href="{{ route('image.details', ['id' => $id]) }}">
        <img src="" alt="{{ $description }}" class="gallery__image" data-filename="{{ $filename }}">
        <figcaption class="gallery__caption">{{ $description }}</figcaption>
    </a>
</figure>