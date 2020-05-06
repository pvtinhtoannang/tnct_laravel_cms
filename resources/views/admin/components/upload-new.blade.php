<form method="post" action="{{route('POST_UPLOAD_NEW_ROUTE')}}"
      enctype="multipart/form-data" class="dropzone" id="my-dropzone">
    <div class="kt-dropzone__msg dz-message needsclick">
        <h3 class="kt-dropzone__msg-title">Thả hoặc click vào đây để tải lên các tập tin</h3>
        <span class="kt-dropzone__msg-desc">Kích thước tối đa 200MB</span>
    </div>
    <div class="fallback">
        <input type="file" name="file" multiple>
    </div>
    {{ csrf_field() }}
</form>
