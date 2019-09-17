<?php

namespace App\Database\ACAD\tUnitClassType\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tUnitClassTypeRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tUnitClassType";
        $this->Msg   = "年度學程";
    }

    public static function getUnitClassType(array $aParams = array())
    {
        $aField = array_keys(array(
            "a.UnitID"                  => "科系ID",
            "a.DayfgID"                 => "部別ID",
            "a.ClassTypeID"             => "學制ID",
            "a.StudyGroupID"            => "系組別ID",
            "a.MinYears"                => "最低修業年限",
            "a.ExtraYears"              => "最大延修學年",
            "a.state"                   => "狀態",
            "a.SemesterAmt"             => "學年度學期數",
            "a.PassScore"               => "修業及格分數",
            "a.DiplomaNo"               => "畢業證書號",
            "a.DegreeName"              => "中文學位名稱",
            "a.DegreeENGName"           => "英文學位名稱",
            "a.UpdateID"                => "異動人",
            "a.UpdateDate"              => "異動日期",
            "a.UnitClassTypeID"         => "科系與學制關聯主鍵",
            "a.ReissueDiplomaNo"        => "補發文號頭碼",
            "a.LeavingCertificateHead"  => "修業證明書頭號",
            "a.UnitClassTypeName"       => "學程中文名稱",
            "a.UnitClassTypeEngName"    => "學程英文名稱",
            "a.DIVS_M"                  => "學程類別",
            "a.DEPNO"                   => "單位代碼",
            "a.MinSemesters"            => "最小修業學期數",
            "a.ExtraSemesters"          => "最大延修學期數",
            "a.DIVS_ID"                 => "學程代碼",
            "a.upper"                   => "所屬學程",
            "a.UnitClassTypeAlias"      => "學程簡稱",
            "b.DayfgName"               => "部別名稱",
            "c.ClassTypeName"           => "學制名稱",
            "d.UnitName"                => "科系名稱",
            "e.UnitID AS CollegeID"     => "學院ID",
            "e.UnitName AS CollegeName" => "學院名稱",
            "f.StudyGroupName"          => "組別名稱",
        ));
        // dd($aParams);
        //條件
        $aWhere = BaseModel::setWhere($aParams);
        // dd($aParams, $aWhere);

        $sWhere = $aWhere["where"];
        $aParam = $aWhere["param"];

        $sSelect = implode(", ", $aField);
        $sTable  = 'tUnitClassType';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
         LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
         LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
         LEFT JOIN tUnit d ON a.UnitID = d.UnitID
         LEFT JOIN tUnit e ON d.upper = e.UnitID
         LEFT JOIN tStudyGroup f ON a.StudyGroupID = f.StudyGroupID
             WHERE {$sWhere}
          ORDER BY b.Dayfg, c.ClassType, d.UnitNo";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
