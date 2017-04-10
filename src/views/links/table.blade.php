<table class="table table-responsive" id="links-table">
    <thead>
        <th>文字信息</th>
        <th>跳转链接</th>
        <th colspan="3">操作</th>
    </thead>
    <tbody>
    @foreach($links as $link)
        <tr>
            <td>{!! $link->intro !!}</td>
            <td>{!! $link->url !!}</td>
            <td>
                {!! Form::open(['route' => ['links.destroy', $link->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('links.show', [$link->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('links.edit', [$link->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>