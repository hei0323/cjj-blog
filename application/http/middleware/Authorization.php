<?php

namespace app\http\middleware;

use CasbinAdapter\Think\Facades\Casbin;
use think\facade\Session;
use think\Request;

class Authorization
{
    public function handle(Request $request, \Closure $next)
    {
        // 当前登录用户名，这里以session为例
        $user = Session::get('user_name') ?: 'test_user';

        $url = $request->url();
        $action = $request->method();

        if (!$user){
            return response()->data('Unauthenticated.')->code(401);
        }

        if (!Casbin::enforce($user, $url, $action)) {
            return response()->data('Unauthorized.')->code(403);
        }

        return $next($request);
    }
}
