@extends('pinche::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            滚动信息
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($link, ['route' => ['pinche.links.update', $link->id], 'method' => 'patch']) !!}

                        @include('pinche::links.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection