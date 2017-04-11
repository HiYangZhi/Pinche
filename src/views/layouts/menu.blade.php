<li class="header">信息列表</li>
<li><a href="/pinche/home"><i class="fa fa-circle-o text-red"></i> <span>拼车信息</span></a></li>
<li><a href="/pinche/user"><i class="fa fa-circle-o text-blue"></i> <span>用户列表</span></a></li>
<li class="header">广告设置</li>
<li class="{{ Request::is('banners*') ? 'active' : '' }}">
    <a href="{!! route('pinche.banners.index') !!}"><i class="fa fa-edit"></i><span>BANNER图</span></a>
</li>

<li class="{{ Request::is('links*') ? 'active' : '' }}">
    <a href="{!! route('pinche.links.index') !!}"><i class="fa fa-edit"></i><span>滚动提示</span></a>
</li>

