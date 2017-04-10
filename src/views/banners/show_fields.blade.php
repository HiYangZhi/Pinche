<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $banner->id !!}</p>
</div>

<!-- Pic Source Field -->
<div class="form-group">
    {!! Form::label('pic_source', 'Pic Source:') !!}</br>
    <img src="{{ asset($banner->pic_source) }}" alt="" style="max-width: 100%; max-height: 100px;">
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', 'Url:') !!}
    <p>{!! $banner->url !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $banner->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $banner->updated_at !!}</p>
</div>

