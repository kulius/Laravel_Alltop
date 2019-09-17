<?php

namespace App\Database\ACAD\tBhrDirTutor\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use Illuminate\Support\Facades\DB;

class tBhrDirTutorRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrDirTutor";
        $this->Msg   = "主任導師設定";
    }

    //F05110導師擬聘申請
    public static function DirTeacherSetting($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        $sACADYear_srh       = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh       = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;
        $sDayfg_srh          = isset($aParam['sDayfg_srh']) ? $aParam['sDayfg_srh'] : null;
        $sClassType_srh      = isset($aParam['sClassType_srh']) ? $aParam['sClassType_srh'] : null;
        $sCollege_srh        = isset($aParam['sCollege_srh']) ? $aParam['sCollege_srh'] : null;
        $sUnit_srh           = isset($aParam['sUnit_srh']) ? $aParam['sUnit_srh'] : null;
        $sTeacherID_srh      = isset($aParam['sTeacherID_srh']) ? $aParam['sTeacherID_srh'] : null;
        $EmploymentState_srh = isset($aParam['EmploymentState_srh']) ? $aParam['EmploymentState_srh'] : null;
        $State_srh           = isset($aParam['State_srh']) ? $aParam['State_srh'] : null;

        $sSql = "SELECT * FROM tBhrDirTutor WHERE ACADYear = ? AND Semester = ?";

        $aParam1 = array($sACADYear_srh, $sSemester_srh);

        $chk = DB::connection('ACAD')->select($sSql, $aParam1);

        //tBhrTutor沒這學年學期的資料時，先建班級資料
        if (count($chk) == null) {
            //建系所資料
            $sql_1 = "INSERT INTO tBhrDirTutor (
                          ACADYear, Semester, DayfgID, ClassTypeID, UnitID
                          , DirTeacherID, DirTeacherPhone, DirTeacherEmail, DirEmploymentState, DirEmpStartTime, DirEmpEndTime, DirStatus)

                      SELECT a.ACADYear, a.Semester, a.DayfgID, a.ClassTypeID, a.UnitID
                          ,null, null, null, 'E', null, null, '0'
                      FROM tClassAll a
                      WHERE a.ACADYear = ? AND a.Semester = ?
                      GROUP BY a.ACADYear, a.Semester, a.DayfgID, a.ClassTypeID, a.UnitID
                      ORDER BY a.DayfgID, a.ClassTypeID, a.UnitID ASC";

            DB::connection('ACAD')->insert($sql_1, $aParam1);
        }

        $aParams = array();

        $sWhere = " 1 = 1 ";

        if ($sACADYear_srh) {
            $sWhere .= " AND a.ACADYear = ? ";
            $aParams[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND a.Semester = ? ";
            $aParams[] = $sSemester_srh;
        }
        if ($sDayfg_srh) {
            $sWhere .= " AND a.DayfgID = ? ";
            $aParams[] = $sDayfg_srh;
        }
        if ($sClassType_srh) {
            $sWhere .= " AND a.ClassTypeID = ? ";
            $aParams[] = $sClassType_srh;
        }
        if ($sCollege_srh) {
            $sWhere .= " AND c.upper = ? ";
            $aParams[] = $sCollege_srh;
        }
        if ($sUnit_srh) {
            $sWhere .= " AND a.UnitID = ? ";
            $aParams[] = $sUnit_srh;
        }
        if ($sTeacherID_srh) {
            $sWhere .= " AND (a.DirTeacherID Like '%" . trim($sTeacherID_srh) . "%' OR d.CNAME Like '%" . trim($sTeacherID_srh) . "%') ";
        }
        if ($EmploymentState_srh) {
            $sWhere .= " AND a.DirEmploymentState = ? ";
            $aParams[] = $EmploymentState_srh;
        }
        if ($State_srh) {
            $sWhere .= " AND a.DirStatus = ? ";
            $aParams[] = $State_srh;
        }
        $aField = array_keys(
            array(
                "a.DirTutorID"         => "主任導師設定ID",
                "a.ACADYear"           => "學年",
                "a.Semester"           => "學期",
                "a.DayfgID"            => "部別ID",
                "e.DayfgName"          => "部別名稱",
                "a.ClassTypeID"        => "學制ID",
                "b.ClassTypeName"      => "學制名稱",
                "a.UnitID"             => "系所ID",
                "c.UnitName"           => "系所名稱",
                "a.DirTeacherID"       => "主任導師ID",
                "d.CNAME AS DName"     => "導師姓名",
                "a.DirTeacherPhone"    => "主任導師電話",
                "a.DirTeacherEmail"    => "主任導師Email",
                "a.DirEmploymentState" => "聘用狀態(A.聘用 B.擬聘 C.替換 D.停用 E.未設定)",
                "a.DirEmpStartTime"    => "聘用起日",
                "a.DirEmpEndTime"      => "聘用迄日",
                "a.DirStatus"          => "審核狀態(0.未設定 1.審核中 2.不通過 3.審核通過)",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrDirTutor';

        $sSql = "
                    SELECT {$sSelect}
                    FROM {$sTable} a
                        LEFT JOIN tDayfg e ON a.DayfgID = e.DayfgID
                    LEFT JOIN tClassType b ON a.ClassTypeID = b.ClassTypeID
                    LEFT JOIN tUnit c ON a.UnitID = c.UnitID
                    LEFT JOIN SCHOOL.vEMPPEO d ON a.DirTeacherID = d.PNO
                    WHERE {$sWhere}
                    ORDER BY a.DirTutorID ASC";

        return DB::connection('ACAD')->select($sSql, $aParams);
    }
}
