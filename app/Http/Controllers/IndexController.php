<?php

namespace App\Http\Controllers;

use App\Database\eOffice\SysBoard;
use App\Database\eOffice\SysUser;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public $ini_path = null;

    public function __construct()
    {
        $this->ini_path = base_path() . '/database/connections/';
    }

    public function index(Request $request)
    {
        $connections = array();
        $connection  = array();

        foreach (scandir($this->ini_path) as $key => $value) {
            if (strpos($value, 'ini') !== false) {
                $ini = parse_ini_file($this->ini_path . $value, true);

                if (count($connection) === 0) {
                    $connection = $ini;
                }

                $connections[$ini['school']] = $ini['school_name'];
            }
        }

        $where   = array();
        $where[] = array('board_start_date', '<=', date('Y-m-d'));
        $where[] = array('board_end_date', '>=', date('Y-m-d'));

        $data_board = SysBoard::where($where)->get();

        return view('index', array(
            'data_board'  => $data_board,
            'connection'  => $connection,
            'connections' => $connections,
        ));
    }

    public function login(Request $request)
    {
        $data  = $request->all();
        $event = (isset($data['event']) ? $data['event'] : null);

        if ($event === 'login') {
            $school = "{$data['school']}.ini";

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

            $data = SysUser::where('user_number', $request->account)
                ->where('password', $request->password)
                ->first();

            if (!\is_null($data)) {
                $filter   = array();
                $filter[] = array('user_number = ?', $data->user_number);

                $data_group = SysUser::getGroupAuth($filter);
                $user_group = array();

                if ($data_group) {
                    $user_group = explode('|', str_replace(' ', '', $data_group[0]['auth']));
                    $user_group = array_filter($user_group);
                }

                session()->put('user_id', $data->user_number);
                session()->put('user_name', $data->user_name);
                session()->put('user_unit', 'SA01');
                session()->put('user_group', $user_group);
                session()->put('school', $ini['school']);
                session()->put('school_name', $ini['school_name']);
                session()->save();

                return redirect('/home');
            } else {
                Session::flash('sweet', array('error', '登入帳號或密碼錯誤！'));

                return redirect('/')->withInput($request->except('password'));
            }
        } else {
            return redirect('/')->withInput($request->except('password'));
        }
    }

    public function update(Request $request)
    {
        /*
        $oSysUser              = new SysUser();
        $oSysUser->user_number = $request->account;
         */

        $a = SysUser::create($request->all());

        //var_dump($sResult);
        return redirect("/");
    }
}
