<diw class="row">
    <div id="slideBox" class="slideBox">
        <div class="bd">
            <ul>
                @foreach ($banners as $element)
                    <li><a href="{{$element->url}}" target="_blank"><img src="{{ asset($element->pic_source) }}" /></a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <script type="text/javascript">
    jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true,delayTime:1000});
    </script>
</diw>
@if (count($links))
    <div class="row">
        <div class="txtMarquee-left">
            <div class="bd">
                <ul class="infoList">
                    @foreach ($links as $element)
                        <li><a href="{{$element->url}}" target="_blank">{{$element->intro}} <span>[{{{ $element->created_at->format('Y-m-d') }}}]</span></a></li>  
                    @endforeach
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(".txtMarquee-left").slide({mainCell:".bd ul",autoPlay:true,effect:"leftMarquee",vis:2,interTime:40});
        </script>
    </div>
@endif
