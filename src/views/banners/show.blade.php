@extends('pinche::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            顶部滚动栏
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('pinche::banners.show_fields')
                    <a href="{!! route('pinche.banners.index') !!}" class="btn btn-default">返回</a>
                </div>
            </div>
        </div>
    </div>
@endsection
