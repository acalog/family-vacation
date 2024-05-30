<form class="box" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-input">
        <input class="box-file" type="file" name="uploadFile[]" id="file" data-multiple-caption="{count} files selected" multiple />
        <label for="file"><strong>Choose a file</strong><span class="box-dragndrop"> or drag it here</span>.</label>
        <button class="box-button" type="submit">Upload</button>
    </div>
    <div class="box-uploading">Uploading...</div>
    <div class="box-success">Done!</div>
    <div class="box-error">Error! <span></span>.</div>
</form>