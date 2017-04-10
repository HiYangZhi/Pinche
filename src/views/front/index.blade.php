
@extends('front.layout')

@section('css')
    @include('front.partial.bannercss')
@endsection

@section('content')


<div class="container">
    @include('front.partial.banner')
    
    <!-- 功能选择 -->
    @include('front.partial.nav', ['index' => 1])

    <!-- 消息类型 -->
    <div class="row index-type">
        <div class="col-4 owner"> <a @if ($type == 0) class="active" @endif  href="/weixin?type=0">车主</a> </div>
        <div class="col-4 passenger"> <a @if ($type == 1) class="active" @endif href="/weixin?type=1">乘客</a> </div>
    </div>

    <!-- 搜索功能 -->
    @include('front.partial.search')

    <!-- 拼车信息列表 -->
    <div class="infinite_scroll">
        
    
    @foreach ($infos as $element)
        <a class="row item" href="/detail/{{$element->id}}">
            <div class="col-10" >
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
    <div class="tc paginate-wraper">
        {{ $infos->links() }}
    </div>
</div>


@endsection

@section('js')
    <script type="text/javascript" src=" {{ asset('js/jquery.infinitescroll.min.js') }} "></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('#time').fdatepicker({
                format: 'yyyy-mm-dd',
                language: 'zh-CN',
                pickTime: false
            });
            $('.btn-change').on('click', function(){
                var des = $('#des').val();
                var dep = $('#dep').val();
                $('#des').val(dep);
                $('#dep').val(des);
            });

            $(".infinite_scroll").infinitescroll({
                navSelector     : ".pagination",
                nextSelector    : ".pagination a:last",
                itemSelector    : ".item",
                path: function(index) {
                    return "?page=" + index;
                },
                loading:{
                    msgText: '更多信息加载中',
                    finishedMsg: '没有更多拼车信息了'
                }               
            });
        })
    </script>
@endsection