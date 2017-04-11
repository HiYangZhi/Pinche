@extends('pinche::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            滚动信息
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('pinche::links.show_fields')
                    <a href="{!! route('pinche.links.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
