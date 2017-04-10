<?php

namespace ZCJY\Pinche\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class WeixinCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //检查用户session在不在
        if ( !session()->has('user') ) {
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".Config::get('weixin.appid', 'default')."&redirect_uri=".urlencode($request->root().'/passenger')."&response_type=code&scope=snsapi_userinfo&state=".$request->url()."#wechat_redirect";
            return redirect($url);
        }
        
        return $next($request);
    }
}
