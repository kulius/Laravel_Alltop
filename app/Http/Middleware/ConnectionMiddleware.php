<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class ConnectionMiddleware
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
        
        return $next($request);
    }
}
