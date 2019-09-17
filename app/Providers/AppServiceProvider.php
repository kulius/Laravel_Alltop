<?php

namespace App\Providers;

use App\Alltop\BaseModel;
use App\Database\eOffice\SysMenu;
use App\Database\eOffice\SysParam;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Cache Meny Query ...
     * @author at3211
     * @return array
     */
    public function cacheQuery($index, $sql, $aParams)
    {
        return Cache::rememberForever($index, function () use ($sql, $aParams) {
            return DB::connection('eOffice')->select($sql, $aParams);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        view()->composer('layouts.master', function ($view) {
            $user_number = session('user_id');

            //模組
            $menu   = array();
            $module = SysParam::where('param_class', '系統模組')->get();

            foreach ($module as $key => $value) {
                $module      = trim($value['param_content']);
                $module_name = trim($value['param_remark']);

                $menu[$module] = array(
                    'header' => $module_name,
                    'item'   => array(),
                );

                //主選單
                $filter   = array();
                $filter[] = array('menu_hide = ?', '0');
                $filter[] = array('menu_module = ?', $module);

                $filter[] = array('menu_number IN (
                    SELECT menu_upper
                    FROM tSysMenu
                    WHERE menu_number IN (
                        SELECT DISTINCT menu_number
                        FROM tSysGroupUser a INNER JOIN tSysGroupGrant b ON a.group_number = b.group_number
                        WHERE user_number = ?
                        UNION
                        SELECT DISTINCT menu_number
                        FROM tSysUserGrant
                        WHERE user_number = ?
                    )
                )', array($user_number, $user_number));

                $filters = BaseModel::setWhere($filter);
                $where   = $filters["where"];
                $param   = $filters["param"];

                $sql = "
                    SELECT *
                    FROM tSysMenu
                    WHERE {$where}";
                $proj = $this->cacheQuery($key, $sql, $param);

                foreach ($proj as $key_proj => $value_proj) {
                    $proj_number = trim($value_proj['menu_number']);
                    $proj_name   = trim($value_proj['menu_name']);
                    $proj_icon   = trim($value_proj['menu_icon']);

                    //子選單
                    $filter   = array();
                    $filter[] = array('menu_hide = ?', '0');
                    $filter[] = array('menu_upper = ?', $proj_number);
                    $filter[] = array('menu_number IN (
                        SELECT DISTINCT menu_number
                        FROM tSysGroupUser a INNER JOIN tSysGroupGrant b ON a.group_number = b.group_number
                        WHERE user_number = ?
                        UNION
                        SELECT DISTINCT menu_number
                        FROM tSysUserGrant
                        WHERE user_number = ?
                    )', array($user_number, $user_number));

                    $filters = BaseModel::setWhere($filter);
                    $where   = $filters["where"];
                    $param   = $filters["param"];

                    $sql = "
                        SELECT *
                        FROM tSysMenu
                        WHERE {$where}";
                    $prog = $this->cacheQuery($value_proj['seq'], $sql, $param);

                    if ($prog) {
                        $menu[$module]['item'][$proj_number] = array(
                            'text'    => $proj_name,
                            'number'  => $proj_number,
                            'icon'    => 'fas fa-fw fa-share',
                            'submenu' => array(),
                        );

                        foreach ($prog as $key_prog => $value_prog) {
                            $prog_number = trim($value_prog['menu_number']);
                            $prog_name   = trim($value_prog['menu_name']);

                            $menu[$module]['item'][$proj_number]['submenu'][] = array(
                                'text'   => $prog_name,
                                'number' => $prog_number,
                            );
                        }
                    }
                }
            }

            $uri   = explode('/', request()->path());
            $head  = array();
            $bread = array();

            if (isset($uri[1])) {
                $head = SysMenu::where('menu_number', $uri[1])->first();
            }

            if ($head) {
                \array_unshift($bread, $head->menu_name);

                $proj = SysMenu::where('menu_number', $head->menu_upper)->first();
                \array_unshift($bread, $proj->menu_name);

                $sys = SysParam::where('param_content', $proj->menu_module)->first();
                \array_unshift($bread, $sys->param_remark);
            }

            $view->with(array(
                'head'  => $head,
                'bread' => $bread,
                'menu'  => $menu,
            ));
        });

        // view()->composer('layouts.frame_default', function ($view) {

        //     /* bread-crumbs 依賴網址
        //      * a01/a0110a0 or guide/system academicaffair
        //      * uri[0] = a01 、  uri[1] = a0110a0
        //      */

        //     $aBread = null;
        //     $oMenu  = null;

        //     $uri = explode('/', request()->path());

        //     if (isset($uri[1])) {
        //         $oMenu = SysMenu::where('menu_number', $uri[1])->first();
        //     }

        //     if ($oMenu) {
        //         $aBread = array();
        //         \array_unshift($aBread, $oMenu->menu_name);

        //         $sHead = $oMenu->menu_name;
        //         $sFav  = $oMenu->menu_number;

        //         $oProj = SysMenu::where('menu_number', $oMenu->menu_upper)->first();
        //         \array_unshift($aBread, $oProj->menu_name);

        //         $oSys = SysParam::where('param_content', $oProj->menu_module)->first();
        //         \array_unshift($aBread, $oSys->param_remark);
        //     }

        //     $navbar = SysParam::where('param_class', '系統模組')->get();

        //     $view->with(array(
        //         'navbar' => $navbar,
        //         'aBread' => $aBread,
        //     ));
        // });
    }
}
