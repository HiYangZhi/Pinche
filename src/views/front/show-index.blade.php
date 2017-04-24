
@extends('pinche::front.layout')

@section('css')
    @include('pinche::front.partial.bannercss')

    <style type="text/css">
        #formtable{position: fixed; top: 0; left: 0; bottom: 0; right: 0; z-index: 99; background-color: rgba(0,0,0,0.3); display: none;}
        #formtable .inner-content{
            position: absolute;
            width: 90%;
            background-color: #fff;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
        }
        #formtable .lable{font-size: 18px; line-height: 38px; text-align: center;}
        #formtable .btn{background-color: transparent; color: #286090; border: none;}
    </style>
@endsection

@section('content')

<div id="formtable">
    <div class="inner-content container">
        <form action="/pinche/participate/{{$info->id}}" method="GET">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row form-group" style="margin-top: 30px;">
                <div class="col-5 lable">联系方式</div>
                <div class="col-7"><input type="text" name="contact" placeholder="微信或电话" maxlength="30" class="form-control"></div>
            </div>
            <div class="row form-group">
                <div class="col-5 lable">需求座位数</div>
                <div class="col-7"><input type="text" name="seat" placeholder="需求座位" maxlength="1" class="form-control"></div>
            </div>

            <div class="row form-group">
                <button class="col-6 btn">确定</button>
                <button class="col-6 btn cancel">取消</button>
            </div>
        </form>
    </div>
</div>


<div class="container">
    @include('pinche::front.partial.banner')
    
    <!-- 功能选择 -->
    @include('pinche::front.partial.nav', ['index' => 1])

    <!-- 拼车信息列表 -->
    <div class="item row">
        @include('pinche::front.partial.error')
        @include('pinche::front.partial.show', ['index' => 1])
    </div>
</div>


@endsection

@section('js')
    <script type="text/javascript">
        $('#participate').on('click', function(event){
            event.preventDefault();
            $('#formtable').show();
        })

        $('#formtable .cancel').on('click', function(event){
            event.preventDefault();
            $('#formtable').hide();
        })
    </script>
@endsection