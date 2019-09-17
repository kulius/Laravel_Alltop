<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use DB;
use Illuminate\Support\Facades\Session;

class atAuthenticate
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
        $session = session('school');

        if (!empty($session)) {
            $school = "{$session}.ini";

            $ini_path = base_path() . '/database/connections/';

            $ini = parse_ini_file($ini_path . $school, true);

            foreach ($ini as $db => $info) {
                if (is_array($info)) {
                    //清除
                    DB::purge($db);
                    //設置
                    foreach ($info as $set => $content) {
                        Config::set("database.connections.{$db}.{$set}", $content);
                    }
                    //連接
                    //DB::reconnect($db);
                    //測試
                    //Schema::connection($db)->getConnection()->reconnect();
                }
            }
        }

        $is_allow_access = false;

        $user_id = Session::get('user_id');

        if (!\is_null($user_id)) {
            $is_allow_access = true;
        }

        if (!$is_allow_access) {
            Session::flash('msg', '請登入帳號');
            return redirect('/');
        }

        return $next($request);
    }
}
