<div class="col-12">
    <div class="row eee-border-bottom">
        <div class="col-4 info info-withouticon bold"> @if ($info->type == 0)
            车找人
        @else
            人找车
        @endif </div>
        <div class="col-8 info info-withouticon"><a  @if ($index == 1) href="/pinche/weixin?type={{$info->type}}" @else href="/pinche/infoes"  @endif style="float: right;"> 返回</a></div>
    </div>
</div>
<div class="col-12">
    <div class="row eee-border-bottom">
        <div class="col-12 info info-withouticon bold">{{$info->departure}} 到 {{$info->destination}}</div>
    </div>
    
</div>
<div class="col-12">
    <div class="row eee-border-bottom">
        <div class="col-4 info info-withouticon">出发时间</div>
        <div class="col-8 info info-withouticon bold">{{{ $info->time->format('m-d') }}} <small class="bold">{{{ $info->time->format('H:i') }}}</small></div>
    </div>
    
</div>
<div class="col-12">
    <div class="row eee-border-bottom">
        <div class="col-4 info info-withouticon"> @if ($info->type == 0)
            提供车位
        @else
            乘客人数
        @endif</div>
        <div class="col-8 info info-withouticon bold">{{$info->seat}} @if ($info->type == 0) 个 @else 位 @endif</div>
    </div>
    
</div>
<div class="col-12">
    <div class="row eee-border-bottom">
        <div class="col-4 info info-withouticon">联系电话</div>
        <div class="col-8 info info-withouticon bold">{{$info->contact}}</div>
    </div>
    
</div>

<div class="col-12">
    <div class="row eee-border-bottom">
        <div class="col-4 info info-withouticon">费用方式</div>
        <div class="col-8 info info-withouticon bold"> @if ($info->price == 0) 面议 @elseif($info->price < 0) 免费 @else {{$info->price}}/人 @endif
        </div>
    </div>
   
</div>
<div class="col-12">
    <div class="row eee-border-bottom"><div class="col-12 info info-withouticon bold">{{$info->info}}</div></div>
</div>

@if ($index == 3)
    @if (count($participants) > 0)
        <div class="col-12">
            <div class="row">
                <div class="col-12 info info-withouticon">@if ($info->type == 0) 乘客信息 @else 司机信息 @endif</div>
            </div>
            @foreach ($participants as $element)
                <div class="row eee-border-bottom">
                    <div class="col-4 info info-withouticon">{{$element->nickname}}</div>
                    <div class="col-3 info info-withouticon">{{$element->pivot->seat}}位</div>
                    <div class="col-5 info info-withouticon">{{$element->pivot->contact}}</div>
                </div>
            @endforeach
        </div>
    @endif
    

    <div class="col-12">
        <div class="row" style="margin-top: 10px;">
            <div class="col-4" style="padding: 0">@if($owner) <a class="btn btn-default" href="/pinche/edit/{{$info->id}}">修改</a> @endif</div>
            <div class="col-4" style="padding: 0"><a class="btn btn-danger" id='cancel_info' style="color: #fff;">取消行程</a></div>
            <div class="col-4"><a class="btn btn-primary" style="color: #fff;" href="/pinche/infoes">返回</a></div>
        </div>
    </div>
@else
    <div class="col-12">
        <div class="row" style="margin-top: 10px;">
            <form action="/pinche/participate/{{$info->id}}" method="GET" class="col-12">
                <button id="participate" class="btn btn-warning" style="color: #fff; width: 100%; ">@if ($info->type == 0) 立即加入 @else 邀请乘车 @endif</button>
            </form>
        </div>
    </div>
@endif
