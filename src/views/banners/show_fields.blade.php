<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $banner->id !!}</p>
</div>

<!-- Pic Source Field -->
<div class="form-group">
    {!! Form::label('pic_source', '显示图片:') !!}</br>
    <img src="{{ asset($banner->pic_source) }}" alt="" style="max-width: 100%; max-height: 100px;">
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', '跳转链接:') !!}
    <p>{!! $banner->url !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', '创建日期:') !!}
    <p>{!! $banner->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', '更新人气:') !!}
    <p>{!! $banner->updated_at !!}</p>
</div>

