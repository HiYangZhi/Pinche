<div class="form-group col-sm-6">
    <label for="normal">上传图片</label>
    <div id="localImag" style="border: 1px solid #d2d6de"><img id="preview" @if(!$new) src="{{ asset($banner->pic_source) }}" @endif style="display: block; min-height: 35px; max-width: 100%; "></div>
    <input type="file" name="image" id="doc" style="width:100%; position: absolute; top: 0; left: 0; height: 100%; opacity: 0;" onchange="javascript:setImagePreview('doc', 'preview', 'localImag');">
</div>


<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pinche.banners.index') !!}" class="btn btn-default">Cancel</a>
</div>
