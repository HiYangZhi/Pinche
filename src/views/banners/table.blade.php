<table class="table table-responsive" id="banners-table">
    <thead>
        <th width="50%">图片路径</th>
        <th>跳转链接</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($banners as $banner)
        <tr>
            <td><img src="{{ asset($banner->pic_source) }}" alt="" style="max-width: 100%; max-height: 100px;"></td>
            <td>{!! $banner->url !!}</td>
            <td>
                {!! Form::open(['route' => ['pinche.banners.destroy', $banner->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pinche.banners.show', [$banner->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pinche.banners.edit', [$banner->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>