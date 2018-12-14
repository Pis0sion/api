<?php
/**
 * Created by PhpStorm.
 * User: 麻破伦意识
 * Date: 2018/10/26
 * Time: 10:35
 */

namespace app\common\http\middleware;


class YesLogin
{
    public function handle($request, \Closure $next)
    {
        if (session('?userInfo')){
            $point_url = stristr($request->url(),"/login",true)."/index/index";
            return redirect($point_url);
        }
        return $next($request);
    }
}