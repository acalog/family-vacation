<div class="icon-container">
	<div class="icon">
		<a href="{{ route('attachment.download', ['file' => $filename]) }}"><i class="las la-save"></i></a>
	</div>
	<div class="icon">
		<a href="{{ route('attachment.delete', ['id' => $id]) }}"><i class="las la-trash"></i></a>
	</div>
    <div class="icon">
        <a href="{{ route('attachment.download', ['file' => $filename]) }}"><img src="{{ asset('/static/svg/download.svg') }}" alt=""></a>
    </div>
</div>
