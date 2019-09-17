<?php

namespace App\Http\Middleware\Alltop;

use Closure;
use Illuminate\Support\Facades\Session;

class Authenticate
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
        $is_allow_access = false;

        $user_number = Session::get('user_number');

        if (!\is_null($user_number)) {
            $is_allow_access = true;
        }

        if (!$is_allow_access) {
            Session::flash('sweet', array('warning', '系統閒置過久，請重新登入！'));
            return redirect('/');
        }

        return $next($request);
    }
}
