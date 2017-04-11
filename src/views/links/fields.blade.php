<!-- Intro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('intro', '文字信息:') !!}
    {!! Form::text('intro', null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', '跳转链接:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pinche.links.index') !!}" class="btn btn-default">Cancel</a>
</div>
