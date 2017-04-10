
@extends('front.layout')

@section('css')
    @include('front.partial.bannercss')
@endsection

@section('content')


<div class="container">
    @include('front.partial.banner')
     @include('front.partial.error')
    <!-- 功能选择 -->
    @include('front.partial.nav', ['index' => 3])
    
    <!-- 拼车信息列表 -->
    @foreach ($infoes as $element)
        <a class="row item" href="/show/{{$element->id}}">
            <div class="col-10">
                <div class="row">
                    <div class="col-6 info time"> {{{ $element->time->format('m-d') }}} <small>{{{ $element->time->format('H:i') }}}</small> </div>
                    <div class="col-6 info price"> @if ($element->price == 0)
                            面议
                        @elseif($element->price < 0)
                            免费
                        @else
                            {{$element->price}}/人
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 info dep">{{$element->departure}}</div>                
                    <div class="col-6 info des">{{$element->destination}}</div>
                </div>
            </div>
            <div class="col-2 show">
                查看
            </div>
        </a>
    @endforeach
    
</div>


@endsection
