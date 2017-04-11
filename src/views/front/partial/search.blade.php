<div class="search">
    <div class="row">
        <form class="form-inline" action="/pinche/weixin?type={{$type}}">
            <input type="hidden" name="type" value="{{$type}}">
            <div class="form-group col-3">
                <label class="sr-only" for="dep">Name</label>
                <input type="text" class="form-control" id="dep" name="departure" placeholder="出发地" value="{{$dep}}"  maxlength="6">
            </div>
             <div class="form-group col-1">
                <div class="btn btn-default btn-change"></div>
            </div>
            <div class="form-group col-3">
                <label class="sr-only" for="des">Name</label>
                <input type="text" class="form-control" id="des" name="destination" placeholder="目的地" value="{{$des}}" maxlength="6">
            </div>
            <div class="col-4" style="padding: 0;"><input type="datetime" name="time" id="time" class="form-control" placeholder="选择时间"></div>

            <div class="form-group col-1">
                <button type="submit" class="btn btn-default btn-submit"></button>
            </div>
        </form>
        
    </div>
</div>