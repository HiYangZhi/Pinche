
@extends('pinche::front.layout')

@section('css')
    @include('pinche::front.partial.bannercss')
@endsection

@section('content')


<div class="container">
    @include('pinche::front.partial.banner')
    
    <!-- 功能选择 -->
    @include('pinche::front.partial.nav', ['index' => 2])
    
    <div class="row form">
        @if (count($errors) > 0)
            <div class="alert alert-danger col-12">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="col-12" action="/pinche/create" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group form-group col-12" data-toggle="buttons">
                <label class="btn btn-primary col-6 @if (old('type') != 1) focus active @endif" id="type-selection-1">
                    <input type="radio" name="type" autocomplete="off" value=0 @if (old('type') != 1) checked @endif> 我是车主
                </label>
                <label class="btn btn-primary col-6 @if (old('type') == 1) focus active @endif " id="type-selection-2">
                    <input type="radio" name="type" autocomplete="off" value=1 @if (old('type') == 1) checked @endif> 我是乘客
                </label>
            </div>

            <div class="row form-group">
                <div class="col-5"><input type="text" class="form-control" id="dep" name="departure" placeholder="出发地" value="{{ old('departure') }}" maxlength="6"></div>
                <div class="col-2" style="padding: 0;text-align: center;"><div class="switch"></div></div>
                <div class="col-5"><input type="text" class="form-control" id="des" name="destination" placeholder="目的地" value="{{ old('destination') }}" maxlength="6"></div>
            </div>

            <div class="row form-group">
                <div class="col-4 form-lable">出发时间</div>
                <div class="col-8"><input type="datetime" name="time" id="time" class="form-control" value="{{ old('time') }}"></div>
                
            </div>

            <div class="row form-group">
                <div class="col-4 form-lable" id="seat-text">提供车位</div>
                <div class="col-5"><input type="text" class="form-control" name="seat" placeholder="座位数"  maxlength="1" value="{{ old('seat') }}"></div>
                <div class="col-1 form-lable">个</div>
            </div>

            <div class="row form-group">
                <div class="col-4 form-lable">联系电话</div>
                <div class="col-8"><input type="text" class="form-control" name="contact" placeholder="联系电话" maxlength="11" value="{{ old('contact') }}"></div>
            </div>

            <div class="row form-group">
                <div class="col-4 form-lable">费用方式</div>
                <div class="col-8 price-btn">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary @if (old('price') == -1) active @endif" id="price-selection-1">
                            <input type="radio" name="price" id="option1" autocomplete="off" value=-1 @if (old('price') == -1) checked @endif> 免费
                        </label>
                        <label class="btn btn-primary @if (old('price') == 0) active @endif" id="price-selection-2">
                            <input type="radio" name="price" id="option2" autocomplete="off" value=0 @if (old('price') == 0) checked @endif> 面议
                        </label>
                        <label class="btn btn-primary @if (old('price') > 0) active @endif" id="price-selection-3">
                            <input type="radio" name="price" id="option3" autocomplete="off" @if (old('price') > 0) checked value="{{ old('price') }}" @endif> 一口价
                        </label>
                    </div>
                    <div class="row price-customer">
                        <div class="col-8"><input type="text" class="form-control" id="price" placeholder="请输入价格" maxlength="3" @if (old('price') > 0) value="{{ old('price') }}" @endif></div>
                        <div class="col-4 form-lable" style="padding: 0;">元/人</div>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-4 form-lable">其他说明</div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <textarea rows="5" name="info" style="width: 100%;"  maxlength="150">{{ old('info') }}</textarea>
                </div>
            </div>

            <button  type="submit" class="btn btn-primary col-8 offset-2">立即发布</button>
        </form>
    </div>
    
</div>


@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            @if (old('price') <= 0)
                $('.price-customer').hide();
            @endif

            $('#time').fdatepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
                language: 'zh-CN',
                pickTime: true
            });


            $('.switch').on('click', function(){
                var des = $("#des").val();
                var dep = $("#dep").val();
                $('#des').val(dep);
                $('#dep').val(des);
            });

            $('#type-selection-1, #type-selection-2').on('click', function() {
                $('#type-selection-1 input, #type-selection-2 input').removeAttr('checked');
                $(this).find('input').attr('checked', 'checked');
                if( $(this).attr('id') == 'type-selection-1'){
                    $('#seat-text').text('提供车位');
                }else{
                    $('#seat-text').text('乘客人数');
                }
            })

            $('#price-selection-1, #price-selection-2, #price-selection-3').on('click', function() {
                $('#price-selection-1 input, #price-selection-2 input, #price-selection-3 input').removeAttr('checked');
                $(this).find('input').attr('checked', 'checked');
                if( $(this).attr('id') == 'price-selection-3'){
                    $('.price-customer').show();
                }else{
                    $('.price-customer').hide();
                }
            });

            $("#price").on('input',function(e){  
                $('#price-selection-3 input').val($("#price").val());
            });  
        })
    </script>
@endsection