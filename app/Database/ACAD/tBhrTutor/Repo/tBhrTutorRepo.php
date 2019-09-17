<?php

namespace App\Database\ACAD\tBhrTutor\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class tBhrTutorRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrTutor";
        $this->Msg   = "導師設定";
    }

    //擬聘狀態下拉
    public function EmploymentState_combo()
    {
        $aField = array_keys(array(
            "paracodeno AS [value]"  => "擬聘狀態編號",
            "paracodename AS [text]" => "擬聘狀態名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tPara';
        $sWhere  = " parano = 'EmploymentState' ";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}
          ORDER BY paracodeno";

        return DB::connection('ACAD')->select($sSql);
    }

    //擬聘審核狀態下拉
    public function EmpState_combo()
    {
        $aField = array_keys(array(
            "paracodeno AS [value]"  => "審核狀態編號",
            "paracodename AS [text]" => "審核狀態名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tPara';
        $sWhere  = " parano = 'EmpState' ";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}
          ORDER BY paracodeno";

        return DB::connection('ACAD')->select($sSql);
    }

    //F05110導師擬聘申請
    public static function TeacherSetting($TeacherEdu, $aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        $sTeacherEdu_srh = $TeacherEdu;

        $sACADYear_srh       = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh       = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;
        $sDayfg_srh          = isset($aParam['sDayfg_srh']) ? $aParam['sDayfg_srh'] : null;
        $sClassType_srh      = isset($aParam['sClassType_srh']) ? $aParam['sClassType_srh'] : null;
        $sCollege_srh        = isset($aParam['sCollege_srh']) ? $aParam['sCollege_srh'] : null;
        $sUnit_srh           = isset($aParam['sUnit_srh']) ? $aParam['sUnit_srh'] : null;
        $sStudyGroup_srh     = isset($aParam['sStudyGroup_srh']) ? $aParam['sStudyGroup_srh'] : null;
        $sGrade_srh          = isset($aParam['sGrade_srh']) ? $aParam['sGrade_srh'] : null;
        $sClassID_srh        = isset($aParam['sClass_srh']) ? $aParam['sClass_srh'] : null;
        $sUnitClassType_srh  = isset($aParam['sUnitClassType_srh']) ? $aParam['sUnitClassType_srh'] : null;
        $sTeacherID_srh      = isset($aParam['sTeacherID_srh']) ? $aParam['sTeacherID_srh'] : null;
        $sCounselorNo_srh    = isset($aParam['sCounselorNo_srh']) ? $aParam['sCounselorNo_srh'] : null;
        $sMilitaryNo_srh     = isset($aParam['sMilitaryNo_srh']) ? $aParam['sMilitaryNo_srh'] : null;
        $EmploymentState_srh = isset($aParam['EmploymentState_srh']) ? $aParam['EmploymentState_srh'] : null;
        $State_srh           = isset($aParam['State_srh']) ? $aParam['State_srh'] : null;

        $sSql = "SELECT * FROM tBhrTutor WHERE ACADYear = ? AND Semester = ?";

        $aParam1 = array($sACADYear_srh, $sSemester_srh);

        $chk = DB::connection('ACAD')->select($sSql, $aParam1);

        //tBhrTutor沒這學年學期的資料時，先建班級資料
        if (count($chk) == null) {
            //建一般班級資料
            $sql_1 = "INSERT INTO tBhrTutor (
                          ACADYear, Semester, DayfgID, ClassTypeID, UnitID, StudyGroupID, Grade, ClassID, ClassNo
                          , UnitClassTypeID, TeacherID, Phone, TeacherEmail, CounselorNo, MilitaryNo, EmploymentState, EmpStartTime, EmpEndTime
                          , TeacherEdu, status)

                      SELECT a.ACADYear, a.Semester, a.DayfgID, a.ClassTypeID, a.UnitID,a.StudyGroupID, a.Grade, a.ClassID,a.ClassNo
                          ,null, null, null, null, null, null, null, null, null, '0', '0'
                      FROM tClassAll a
                      LEFT JOIN tBhrTutor b ON a.ClassID = b.ClassID
                      WHERE a.ACADYear = ? AND a.Semester = ?
                      ORDER BY a.DayfgID, a.ClassTypeID, a.UnitID, a.Grade, a.ClassID ASC";

            DB::connection('ACAD')->insert($sql_1, $aParam1);

            //建師培班級資料
            $sql_2 = "INSERT INTO tBhrTutor (
                          ACADYear, Semester, DayfgID, ClassTypeID, UnitID, UnitClassTypeID
                          , TeacherID, Phone, TeacherEmail, CounselorNo, MilitaryNo, EmploymentState, EmpStartTime, EmpEndTime
                          , TeacherEdu, status)

                      SELECT a.ACADYear, ?, b.DayfgID, b.ClassTypeID, b.UnitID, a.UnitClassTypeID
                          , null, null, null, null, null, null, null, null, null,'1','0'
                      FROM tUnitClassTypeYear a
                      INNER JOIN tUnitClassType b ON a.UnitClassTypeID = b.UnitClassTypeID
                      WHERE a.ACADYear = ? ";

            DB::connection('ACAD')->insert($sql_2, $aParam1);
        }

        $aParams = array();

        switch ($sTeacherEdu_srh) {
            case '0':
                $sWhere = " a.TeacherEdu = '0' ";

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
                if ($sStudyGroup_srh) {
                    $sWhere .= " AND a.StudyGroupID = ? ";
                    $aParams[] = $sStudyGroup_srh;
                }
                if ($sGrade_srh) {
                    $sWhere .= " AND a.Grade = ? ";
                    $aParams[] = $sGrade_srh;
                }
                if ($sClassID_srh) {
                    $sWhere .= " AND a.ClassID = ? ";
                    $aParams[] = $sClassID_srh;
                }
                if ($sTeacherID_srh) {
                    $sWhere .= " AND (a.TeacherID Like '%" . trim($sTeacherID_srh) . "%' OR d.CNAME Like '%" . trim($sTeacherID_srh) . "%') ";
                }

                if ($sCounselorNo_srh) {
                    $sWhere .= " AND (a.CounselorNo Like '%" . trim($sCounselorNo_srh) . "%' OR e.CNAME Like '%" . trim($sCounselorNo_srh) . "%') ";
                }

                if ($sMilitaryNo_srh) {
                    $sWhere .= " AND (a.MilitaryNo Like '%" . trim($sMilitaryNo_srh) . "%' OR f.CNAME Like '%" . trim($sMilitaryNo_srh) . "%') ";
                }
                if ($EmploymentState_srh) {
                    $sWhere .= " AND a.EmploymentState = ? ";
                    $aParams[] = $EmploymentState_srh;
                }
                if ($State_srh) {
                    $sWhere .= " AND a.status = ? ";
                    $aParams[] = $State_srh;
                }

                $aField = array_keys(
                    array(
                        "a.TutorID"          => "導師設定ID",
                        "a.ACADYear"         => "學年",
                        "a.Semester"         => "學期",
                        "a.DayfgID"          => "部別ID",
                        "b.DayfgName"        => "部別名稱",
                        "a.ClassTypeID"      => "學制ID",
                        "b.ClassTypeName"    => "學制名稱",
                        "a.UnitID"           => "系所ID",
                        "b.UnitName"         => "系所名稱",
                        "a.StudyGroupID"     => "組別ID",
                        "g.StudyGroupName"   => "組別名稱",
                        "a.Grade"            => "年級",
                        "a.ClassID"          => "班級ID",
                        "b.ClassName"        => "班級名稱",
                        "a.TeacherID"        => "導師ID",
                        "d.CNAME AS TName"   => "導師姓名",
                        "a.Phone"            => "導師電話",
                        "a.TeacherEmail"     => "導師信箱",
                        "a.CounselorNo"      => "輔導老師ID",
                        "e.CNAME AS CouName" => "輔導老師姓名",
                        "a.MilitaryNo"       => "輔導教官ID",
                        "f.CNAME AS MName"   => "輔導教官姓名",
                        "a.EmploymentState"  => "導師聘用狀態",
                        "a.EmpStartTime"     => "導師聘用起日",
                        "a.EmpEndTime"       => "導師聘用迄日",
                        "a.status"           => "審核狀態",

                    )
                );

                $sSelect = implode(", ", $aField);
                $sTable  = 'tBhrTutor';

                $sSql = "
                    SELECT {$sSelect}
                    FROM {$sTable} a
                        LEFT JOIN tClassAll b ON a.ClassID = b.ClassID AND b.ACADYear = a.ACADYear AND b.Semester = a.Semester
                        LEFT JOIN tUnit c ON a.UnitID = c.UnitID
                        LEFT JOIN SCHOOL.vEMPPEO d ON a.TeacherID = d.PNO
                        LEFT JOIN SCHOOL.vEMPPEO e ON a.CounselorNo = e.PNO
                        LEFT JOIN SCHOOL.vEMPPEO f ON a.MilitaryNo = f.PNO
                        LEFT JOIN tStudyGroup g ON a.StudyGroupID = g.StudyGroupID
                    WHERE {$sWhere}
                    ORDER BY a.TutorID ASC";

                return DB::connection('ACAD')->select($sSql, $aParams);

                break;
            case '1':
                $sWhere = " c.TeacherEdu = '1' ";

                if ($sACADYear_srh) {
                    $sWhere .= " AND c.ACADYear = ? ";
                    $aParams[] = $sACADYear_srh;
                }
                if ($sSemester_srh) {
                    $sWhere .= " AND c.Semester = ? ";
                    $aParams[] = $sSemester_srh;
                }
                if ($sDayfg_srh) {
                    $sWhere .= " AND c.DayfgID = ? ";
                    $aParams[] = $sDayfg_srh;
                }
                if ($sClassType_srh) {
                    $sWhere .= " AND c.ClassTypeID = ? ";
                    $aParams[] = $sClassType_srh;
                }
                if ($sCollege_srh) {
                    $sWhere .= " AND i.upper = ? ";
                    $aParams[] = $sCollege_srh;
                }
                if ($sUnit_srh) {
                    $sWhere .= " AND c.UnitID = ? ";
                    $aParams[] = $sUnit_srh;
                }
                if ($sUnitClassType_srh) {
                    $sWhere .= " AND c.UnitClassTypeID = ? ";
                    $aParams[] = $sUnitClassType_srh;
                }

                if ($sTeacherID_srh) {
                    $sWhere .= " AND (c.TeacherID Like '%" . trim($sTeacherID_srh) . "%' OR d.CNAME Like '%" . trim($sTeacherID_srh) . "%') ";
                }

                if ($sCounselorNo_srh) {
                    $sWhere .= " AND (c.CounselorNo Like '%" . trim($sCounselorNo_srh) . "%' OR e.CNAME Like '%" . trim($sCounselorNo_srh) . "%') ";
                }

                if ($sMilitaryNo_srh) {
                    $sWhere .= " AND (c.MilitaryNo Like '%" . trim($sMilitaryNo_srh) . "%' OR f.CNAME Like '%" . trim($sMilitaryNo_srh) . "%') ";
                }
                if ($EmploymentState_srh) {
                    $sWhere .= " AND c.EmploymentState = ? ";
                    $aParams[] = $EmploymentState_srh;
                }
                if ($State_srh) {
                    $sWhere .= " AND c.status = ? ";
                    $aParams[] = $State_srh;
                }

                $aField = array_keys(
                    array(
                        "c.TutorID"           => "導師設定ID",
                        "c.ACADYear"          => "學年",
                        "c.Semester"          => "學期",
                        "c.DayfgID"           => "部別ID",
                        "g.DayfgName"         => "部別名稱",
                        "c.ClassTypeID"       => "學制ID",
                        "h.ClassTypeName"     => "學制名稱",
                        "c.UnitID"            => "系所ID",
                        "i.UnitName"          => "系所名稱",
                        "c.UnitClassTypeID"   => "學程ID",
                        "a.UnitClassTypeName" => "學程名稱",
                        "c.TeacherID"         => "導師ID",
                        "d.CNAME AS TName"    => "導師姓名",
                        "c.Phone"             => "導師電話",
                        "c.TeacherEmail"      => "導師信箱",
                        "c.CounselorNo"       => "輔導老師ID",
                        "e.CNAME AS CouName"  => "輔導老師姓名",
                        "c.MilitaryNo"        => "輔導教官ID",
                        "f.CNAME AS MName"    => "輔導教官姓名",
                        "c.EmploymentState"   => "導師聘用狀態",
                        "c.EmpStartTime"      => "導師聘用起日",
                        "c.EmpEndTime"        => "導師聘用迄日",
                        "c.status"            => "審核狀態",

                    )
                );

                $sSelect = implode(", ", $aField);
                $sTable  = 'tUnitClassTypeYear';

                $sSql = "
                    SELECT {$sSelect}
                    FROM {$sTable} a
                        INNER JOIN tUnitClassType b ON a.UnitClassTypeID = b.UnitClassTypeID
                        INNER JOIN tBhrTutor c ON c.ACADYear = a.ACADYear and c.DayfgID = b.DayfgID and c.ClassTypeID = b.ClassTypeID
                                                and c.UnitID = b.UnitID AND a.UnitClassTypeID = c.UnitClassTypeID
                        LEFT JOIN SCHOOL.vEMPPEO d ON c.TeacherID = d.PNO
                        LEFT JOIN SCHOOL.vEMPPEO e ON c.CounselorNo = e.PNO
                        LEFT JOIN SCHOOL.vEMPPEO f ON c.MilitaryNo = f.PNO
                        LEFT JOIN tDayfg g ON c.DayfgID = g.DayfgID
                        LEFT JOIN tClassType h ON c.ClassTypeID = h.ClassTypeID
                        LEFT JOIN tUnit i ON c.UnitID = i.UnitID
                    WHERE {$sWhere}
                    ORDER BY c.TutorID ASC";

                return DB::connection('ACAD')->select($sSql, $aParams);

                break;
            default:
                break;
        }
    }

    //F07240輔導教官設定
    public static function tBhrTutorSetting($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        $sACADYear_srh   = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh   = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;
        $sDayfg_srh      = isset($aParam['sDayfgID_srh']) ? $aParam['sDayfgID_srh'] : null;
        $sClassType_srh  = isset($aParam['sClassTypeID_srh']) ? $aParam['sClassTypeID_srh'] : null;
        $sUnit_srh       = isset($aParam['sUnit_srh']) ? $aParam['sUnit_srh'] : null;
        $sGrade_srh      = isset($aParam['sGrade_srh']) ? $aParam['sGrade_srh'] : null;
        $sMilitaryNo_srh = isset($aParam['sMilitaryNo_srh']) ? $aParam['sMilitaryNo_srh'] : null;

        $sSql = "SELECT * FROM tBhrTutor WHERE ACADYear = {$sACADYear_srh} AND Semester = {$sSemester_srh}";

        $chk = DB::connection('ACAD')->select($sSql);

        //tBhrTutor沒這學年學期的資料時，先建班級資料
        if (count($chk) == null) {
            $sql = "insert into tBhrTutor (ACADYear,Semester,DayfgID,ClassTypeID,UnitID,Grade,ClassNo,ClassID,TeacherID,Phone,TeacherEmail,CounselorNo,MilitaryNo,StudyGroupID)

                    SELECT a.ACADYear,a.Semester, a.DayfgID, a.ClassTypeID, a.UnitID, a.Grade,a.ClassNo, a.ClassID,null,null,null,null,null,'0'
                            FROM tClassAll a
                                LEFT JOIN tBhrTutor b ON a.ClassID = b.ClassID AND b.ACADYear = {$sACADYear_srh} AND b.Semester = {$sSemester_srh}
                                LEFT JOIN SCHOOL.vEMPPEO c ON b.MilitaryNo = c.PNO
                            WHERE a.ACADYear = {$sACADYear_srh} AND a.Semester = {$sSemester_srh}
                            ORDER BY a.DayfgID, a.ClassTypeID, a.UnitID, a.Grade ASC";
            DB::connection('ACAD')->insert($sql);
        }

        $sWhere = ' 1 = 1 ';

        $aParam = array();

        if ($sACADYear_srh) {
            $sWhere .= " AND a.ACADYear = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND a.Semester = ? ";
            $aParam[] = $sSemester_srh;
        }
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
        if ($sGrade_srh) {
            $sWhere .= " AND a.Grade = ? ";
            $aParams[] = $sGrade_srh;
        }

        if ($sMilitaryNo_srh) {
            $sWhere .= " AND a.MilitaryNo Like '%" . trim($sMilitaryNo_srh) . "%' OR c.CNAME Like '%" . trim($sMilitaryNo_srh) . "%' ";
        }

        $aField = array_keys(
            array(
                "a.TutorID"       => "導師設定ID",
                "a.ACADYear"      => "學年",
                "a.Semester"      => "學期",
                "a.DayfgID"       => "部別ID",
                "b.DayfgName"     => "部別名稱",
                "a.ClassTypeID"   => "學制ID",
                "b.ClassTypeName" => "學制名稱",
                "a.UnitID"        => "系所ID",
                "b.UnitName"      => "系所名稱",
                "a.Grade"         => "年級",
                "a.ClassID"       => "班級ID",
                "b.ClassName"     => "班級名稱",
                "a.MilitaryNo"    => "系輔導教官",
                "c.CNAME"         => "教官姓名",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrTutor';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
            LEFT JOIN tClassAll b ON a.ClassID = b.ClassID AND b.ACADYear = a.ACADYear AND b.Semester = a.Semester
            LEFT JOIN SCHOOL.vEMPPEO c ON a.MilitaryNo = c.PNO
        WHERE {$sWhere}
        ORDER BY a.TutorID ASC";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public static function Teacher_Combo($aParam = array())
    {
        $aField = array_keys(array(
            "PNO AS [value]"                  => "教職員代碼",
            "'【'+PNO+'】'+CNAME AS [text]" => "【代碼】教職員姓名",
            "EMAIL"                           => "信箱",
            "TEL1"                            => "電話",
        ));

        $sSelect = implode($aField, ', ');

        $sTable = '[SCHOOL].[vEMPPEO]';

        $sSql = "
             SELECT {$sSelect}
               FROM {$sTable}
           ORDER BY PNO";

        return DB::connection('ACAD')->select($sSql);
    }

    public static function TeacherMes($aParam = array())
    {
        $dataTeacherID = $aParam['TeacherID'];

        $aParams = array();

        $sWhere    = " PNO = ? ";
        $aParams[] = $dataTeacherID;

        $aField = array_keys(array(
            "EMAIL" => "信箱",
            "TEL1"  => "電話",
        ));

        $sSelect = implode($aField, ', ');

        $sTable = '[SCHOOL].[vEMPPEO]';

        $sSql = "
             SELECT {$sSelect}
               FROM {$sTable}
              WHERE {$sWhere}
           ORDER BY PNO";

        return DB::connection('ACAD')->select($sSql, $aParams);
    }

    public static function CopyFromSem($aParam = array())
    {
        $err = '0';

        $updatauser = Session::get('user_id');

        $nACADYear = $aParam['sACADYear_srh'];
        $nSemester = $aParam['sSemester_srh'];

        if ($nSemester == '1') {
            $oACADYear = $nACADYear - 1;
            $oSemester = $nSemester + 1;
        } else {
            $oACADYear = $nACADYear;
            $oSemester = $nSemester - 1;
        }
        $sSql = "SELECT * FROM tBhrTutor WHERE ACADYear = ? AND Semester = ?";

        $aParam = array($oACADYear, $oSemester);

        $chkold = DB::connection('ACAD')->select($sSql, $aParam);

        if (count($chkold) == '0' || null) {
            $err           = '1';
            return $result = array('error', $err);
        } else {

            $sSql = "SELECT * FROM tBhrTutor WHERE ACADYear = {$nACADYear} AND Semester = {$nSemester}";

            $chk = DB::connection('ACAD')->select($sSql);
            if (count($chk) == null) {
                $sSql = "INSERT INTO tBhrTutor (ACADYear,Semester,DayfgID,ClassTypeID,UnitID
                                            ,StudyGroupID,Grade,ClassID,ClassNo,TeacherID
                                            ,Phone,TeacherEmail,CounselorNo,MilitaryNo,UpdateID,UpdateDate)

                          SELECT ?,?,DayfgID,ClassTypeID,UnitID
                                ,StudyGroupID,Grade,ClassID,ClassNo,TeacherID,Phone
                                ,TeacherEmail,CounselorNo,MilitaryNo,?,?
                            FROM tBhrTutor
                            WHERE ACADYear = ? AND Semester = ?";

                $aParam = array($nACADYear, $nSemester, $updatauser, date('Y-m-d H:i:s'), $oACADYear, $oSemester);

                $insSuccess = DB::connection('ACAD')->insert($sSql, $aParam);

                return $result = array('success', $insSuccess);
            } else {
                $sSql = "UPDATE tBhrTutor
                        SET tBhrTutor.MilitaryNo = (
                        SELECT MilitaryNo
                          FROM tBhrTutor b
                         WHERE b.ACADYear = ? AND b.Semester = ?
                           AND tBhrTutor.DayfgID = b.DayfgID
                           AND tBhrTutor.ClassTypeID = b.ClassTypeID
                           AND tBhrTutor.UnitID = b.UnitID
                           AND tBhrTutor.Grade = b.Grade
                           AND tBhrTutor.ClassID = b.ClassID)
                           ,UpdateID = ?
                           ,UpdateDate = ?
                      WHERE tBhrTutor.ACADYear = ? AND tBhrTutor.Semester = ? ";

                $aParam = array($oACADYear, $oSemester, $updatauser, date('Y-m-d H:i:s'), $nACADYear, $nSemester);

                $UpSuccess = DB::connection('ACAD')->insert($sSql, $aParam);

                return $result = array('success', $UpSuccess);
            }
        }
    }
}
