<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', '编号:') !!}
    <p>{!! $link->id !!}</p>
</div>

<!-- Intro Field -->
<div class="form-group">
    {!! Form::label('intro', '文字信息:') !!}
    <p>{!! $link->intro !!}</p>
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', '跳转链接:') !!}
    <p>{!! $link->url !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', '添加日期:') !!}
    <p>{!! $link->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', '需要日期:') !!}
    <p>{!! $link->updated_at !!}</p>
</div>

