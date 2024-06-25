<figure class="gallery__thumb">
    <a href="{{ route('image.details', ['id' => $id]) }}">
        <img src="@if(isset($image->loadNow)){{ Storage::disk('s3')->url('thumbnails/' . $image->filename) }}@endif" alt="{{ $description }}" class="gallery__image @if(!isset($image->loadNow)){{ 'lazy-load' }}@endif" data-filename="{{ $filename }}">
        <figcaption class="gallery__caption">{{ $description }}</figcaption>
    </a>
</figure>
