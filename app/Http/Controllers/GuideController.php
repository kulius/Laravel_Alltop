<?php

namespace App\Http\Controllers;

use App\Alltop\BaseModel;
use DB;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function __construct()
    {
        $this->middleware(array('at.auth'));
    }

    public function index(Request $request, $module)
    {
        //主選單
        $aFilter   = array();
        $aFilter[] = array('menu_hide = ?', '0');
        $aFilter[] = array('menu_module = ?', $module);
        $aFilter[] = array('menu_number IN (
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
        )', array(session('user_id'), session('user_id')));

        $aWhere = BaseModel::setWhere($aFilter);
        $sWhere = $aWhere["where"];
        $aParam = $aWhere["param"];

        $sSql = "
                SELECT *
                FROM tSysMenu
                WHERE {$sWhere}";
        $aProj = DB::connection('eOffice')->select($sSql, $aParam);
        $aMenu = array();

        foreach ($aProj as $skProj => $svProj) {
            $sMenu_Number = trim($svProj["menu_number"]);
            $sMenu_Name   = trim($svProj["menu_name"]);
            $sMenu_ICon   = trim($svProj["menu_icon"]);
            $sMenu_Folder = trim($svProj["menu_folder"]);

            $aBasic = explode("_", $sMenu_Folder);
            $sBasic = $aBasic[0];

            //子選單
            $aFilter   = array();
            $aFilter[] = array('menu_hide = ?', '0');
            $aFilter[] = array('menu_upper = ?', $sMenu_Number);
            $aFilter[] = array('menu_number IN (
                SELECT DISTINCT menu_number
                FROM tSysGroupUser a INNER JOIN tSysGroupGrant b ON a.group_number = b.group_number
                WHERE user_number = ?
                UNION
                SELECT DISTINCT menu_number
                FROM tSysUserGrant
                WHERE user_number = ?
            )', array(session('user_id'), session('user_id')));

            $aWhere = BaseModel::setWhere($aFilter);
            $sWhere = $aWhere["where"];
            $aParam = $aWhere["param"];

            $sSql = "
                SELECT *
                FROM tSysMenu
                WHERE {$sWhere}";
            $aProg = DB::connection('eOffice')->select($sSql, $aParam);

            if ($aProg) {
                $aMenu[$sMenu_Number] = array(
                    "menu_name" => "【" . $sMenu_Number . "】" . $sMenu_Name,
                    "menu_icon" => $sMenu_ICon,
                    "menu_prog" => array(),
                );

                foreach ($aProg as $skProg => $svProg) {
                    $sMenu_Number_Prog = trim($svProg["menu_number"]);
                    $sMenu_Name_Prog   = trim($svProg["menu_name"]);
                    $sMenu_ICon_Prog   = trim($svProg["menu_icon"]);
                    $sMenu_Folder_Prog = trim($svProg["menu_folder"]);
                    $sCustom           = trim($svProg["menu_module_custom"]);

                    $aMenu[$sMenu_Number]["menu_prog"][] = array(
                        "menu_number" => $sMenu_Number_Prog,
                        "menu_name"   => $sMenu_Name_Prog,
                        "menu_icon"   => $sMenu_ICon_Prog,
                        // menu_path ex: m ntue e00 / e00000_element
                        "menu_path"   => "m{$sCustom}{$sBasic}/{$sMenu_Folder_Prog}",
                    );
                }
            }
        }

        return view('guide', array(
            'menu' => $aMenu,
        ));
    }
}
