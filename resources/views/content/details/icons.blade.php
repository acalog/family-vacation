<div class="icon-container">
    <div class="icon">
        <a href="{{ route('attachment.download', ['file' => $image->filename]) }}"><img src="{{ asset('/static/svg/save.svg') }}" alt=""></a>
    </div>
    <div class="icon">
        <a href="{{ route('attachment.delete', ['id' => $image->id]) }}"><img src="{{ asset('/static/svg/trash-2.svg') }}" alt=""></a>
    </div>
</div>
