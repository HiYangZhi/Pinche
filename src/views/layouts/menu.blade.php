<li class="header">信息列表</li>
<li><a href="/home"><i class="fa fa-circle-o text-red"></i> <span>拼车信息</span></a></li>
<li><a href="/user"><i class="fa fa-circle-o text-blue"></i> <span>用户列表</span></a></li>
<li class="header">广告设置</li>
<li class="{{ Request::is('banners*') ? 'active' : '' }}">
    <a href="{!! route('banners.index') !!}"><i class="fa fa-edit"></i><span>BANNER图</span></a>
</li>

<li class="{{ Request::is('links*') ? 'active' : '' }}">
    <a href="{!! route('links.index') !!}"><i class="fa fa-edit"></i><span>滚动提示</span></a>
</li>

