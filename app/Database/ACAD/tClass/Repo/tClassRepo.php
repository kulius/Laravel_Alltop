<?php

namespace App\Database\ACAD\tClass\Repo;

use Illuminate\Support\Facades\DB;

class tClassRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tClass";
        $this->Msg   = "班級";
    }

    public function ClassSetting($aParam = array())
    {
        $sDayfg_srh     = isset($aParam['sDayfg_srh']) ? $aParam['sDayfg_srh'] : null;
        $sClassType_srh = isset($aParam['sClassType_srh']) ? $aParam['sClassType_srh'] : null;
        $sUnit_srh      = isset($aParam['sUnit_srh']) ? $aParam['sUnit_srh'] : null;
        $sCollege_srh   = isset($aParam['sCollege_srh']) ? $aParam['sCollege_srh'] : null;

        $sWhere = ' 1 = 1 ';
        $aParam = array();
        if ($sDayfg_srh) {
            $sWhere .= " AND a.DayfgID = ? ";
            $aParam[] = $sDayfg_srh;
        }
        if ($sClassType_srh) {
            $sWhere .= " AND a.ClassTypeID = ? ";
            $aParam[] = $sClassType_srh;
        }
        if ($sUnit_srh) {
            $sWhere .= " AND a.UnitID = ? ";
            $aParam[] = $sUnit_srh;
        }
        if ($sCollege_srh) {
            $sWhere .= " AND d.upper = ? ";
            $aParam[] = $sCollege_srh;
        }

        $aField = array_keys(
            array(
                "a.DayfgID"                 => "部別ID",
                "a.ClassTypeID"             => "學制ID",
                "a.UnitID"                  => "系所ID",
                "a.StudyGroupID"            => "組別ID",
                "a.ClassNo"                 => "班級代碼",
                "b.DayfgName"               => "部別名稱",
                "c.ClassTypeName"           => "學制名稱",
                "d.UnitName"                => "科系名稱",
                "e.UnitID AS CollegeID"     => "學院ID",
                "e.UnitName AS CollegeName" => "學院名稱",
                "f.StudyGroupName"          => "組別名稱",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tClass';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
            LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
            LEFT JOIN tUnit d ON a.UnitID = d.UnitID
            LEFT JOIN tUnit e ON d.upper = e.UnitID
            LEFT JOIN tStudyGroup f ON a.StudyGroupID = f.StudyGroupID
        WHERE {$sWhere}
        GROUP BY a.DayfgID, a.ClassTypeID, a.UnitID, a.StudyGroupID, a.ClassNo,
                b.DayfgName, c.ClassTypeName, d.UnitName, e.UnitID, e.UnitName, f.StudyGroupName
                ";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
