<table class="table table-responsive" id="banners-table">
    <thead>
        <th width="50%">Pic Source</th>
        <th>Url</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($banners as $banner)
        <tr>
            <td><img src="{{ asset($banner->pic_source) }}" alt="" style="max-width: 100%; max-height: 100px;"></td>
            <td>{!! $banner->url !!}</td>
            <td>
                {!! Form::open(['route' => ['banners.destroy', $banner->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('banners.show', [$banner->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('banners.edit', [$banner->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>