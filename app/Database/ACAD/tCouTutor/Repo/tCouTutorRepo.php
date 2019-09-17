<?php

namespace App\Database\ACAD\tCouTutor\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use Illuminate\Support\Facades\DB;

class tCouTutorRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCouTutor";
        $this->Msg   = "參數代碼檔";
    }

    //F02120取學生資料
    public static function StudentSearch($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_Semester'))->first()->content;

        $sACADYear_srh     = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh     = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;
        $sDayfg_srh        = isset($aParam['sDayfg_srh']) ? $aParam['sDayfg_srh'] : null;
        $sClassType_srh    = isset($aParam['sClassType_srh']) ? $aParam['sClassType_srh'] : null;
        $sCollege_srh      = isset($aParam['sCollege_srh']) ? $aParam['sCollege_srh'] : null;
        $sUnit_srh         = isset($aParam['sUnit_srh']) ? $aParam['sUnit_srh'] : null;
        $sStudyGroup_srh   = isset($aParam['sStudyGroup_srh']) ? $aParam['sStudyGroup_srh'] : null;
        $sGrade_srh        = isset($aParam['sGrade_srh']) ? $aParam['sGrade_srh'] : null;
        $sClass_srh        = isset($aParam['sClass_srh']) ? $aParam['sClass_srh'] : null;
        $sNoOrName_srh     = isset($aParam['sNoOrName_srh']) ? $aParam['sNoOrName_srh'] : null;
        $sCouTimeStart_srh = isset($aParam['sCouTimeStart_srh']) ? $aParam['sCouTimeStart_srh'] : null;
        $sCouTimeEnd_srh   = isset($aParam['sCouTimeEnd_srh']) ? $aParam['sCouTimeEnd_srh'] : null;

        $sWhere = ' 1 = 1 ';

        $aParam = array();

        if ($sACADYear_srh) {
            $sWhere .= " AND b.Year = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND b.Semester = ? ";
            $aParam[] = $sSemester_srh;
        }
        if ($sDayfg_srh) {
            $sWhere .= " AND b.DayfgID = ? ";
            $aParam[] = $sDayfg_srh;
        }
        if ($sClassType_srh) {
            $sWhere .= " AND b.ClassTypeID = ? ";
            $aParam[] = $sClassType_srh;
        }
        if ($sCollege_srh) {
            $sWhere .= " AND g.UnitID = ? ";
            $aParam[] = $sCollege_srh;
        }
        if ($sUnit_srh) {
            $sWhere .= " AND b.UnitID = ? ";
            $aParam[] = $sUnit_srh;
        }
        if ($sStudyGroup_srh) {
            $sWhere .= " AND b.StudyGroupID = ? ";
            $aParam[] = $sStudyGroup_srh;
        }
        if ($sGrade_srh) {
            $sWhere .= " AND b.Grade = ? ";
            $aParam[] = $sGrade_srh;
        }
        if ($sClass_srh) {
            $sWhere .= " AND b.ClassNo = ? ";
            $aParam[] = $sClass_srh;
        }
        if ($sNoOrName_srh) {
            $sWhere .= " AND (a.StudentNo LIKE ? OR a.ChtName LIKE ?) ";
            $aParam[] = "%" . $sNoOrName_srh . "%";
            $aParam[] = "%" . $sNoOrName_srh . "%";
        }

        $aField = array_keys(
            array(
                "b.Year"                => "學年",
                "b.Semester"            => "學期",
                "d.DayfgName"           => "部別",
                "e.ClassTypeName"       => "學制",
                "g.UnitName AS College" => "學院",
                "f.UnitName"            => "系所",
                "h.StudyGroupName"      => "組別",
                "b.Grade"               => "年級",
                "i.ClassName"           => "班級",
                "a.StudentID"           => "學生ID",
                "a.StudentNo"           => "學號",
                "a.ChtName"             => "姓名",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "vStuStudentAll";

        $sSql = "
        SELECT DISTINCT {$sSelect}
                   FROM {$sTable} a
             INNER JOIN tStuStdClassHist b ON a.StudentID = b.StudentID
             INNER JOIN tUnitClassType c ON b.DayfgID = c.DayfgID AND b.ClassTypeID = c.ClassTypeID AND b.UnitID = c.UnitID
             INNER JOIN tDayfg d ON b.DayfgID = d.DayfgID
             INNER JOIN tClassType e ON b.ClassTypeID = e.ClassTypeID
             INNER JOIN tUnit f ON b.UnitID = f.UnitID
             INNER JOIN tUnit g ON f.upper = g.UnitID
              LEFT JOIN tStudyGroup h ON h.StudyGroupID = b.StudyGroupID
             INNER JOIN tClassAll i ON b.Year = i.ACADYear AND b.Semester = i.Semester AND i.ClassID = b.ClassID
                  WHERE {$sWhere}
               ORDER BY StudentNo";

        // dd($sSql, $aParam);
        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //F02120取資料
    public static function CouStuPerSetting($aParam = array())
    {
        $sACADYear_srh = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : null;
        $sSemester_srh = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : null;
        $sStudentID    = $aParam['sStudentID'];

        $aParam = array();

        $sWhere = ' StudentID = ? ';

        $aParam[] = $sStudentID;

        if ($sACADYear_srh) {
            $sWhere .= " AND ACADYear = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND Semester = ? ";
            $aParam[] = $sSemester_srh;
        }

        $aField = array_keys(
            array(
                "CouTutorID"                                               => "導師輔導主單ID",
                "CouTimeStart"                                             => "輔導時間(起)",
                "CouTimeEnd"                                               => "輔導時間(迄)",
                "Implementation"                                           => "實施方式",
                "StudentNo"                                                => "學號",
                "ChtName"                                                  => "姓名",
                "CouTime"                                                  => "輔導時間(分)",
                "LEFT(M.ProblemType,len(M.ProblemType)-1) as sProblemType" => "問題類別",
                "FollowTrack"                                              => "後續處理方式",
                "BriefContent"                                             => "簡要內容記錄",
                "ACADYear"                                                 => "學年",
                "Semester"                                                 => "學期",
                "StudentID"                                                => "學生ID",

            )
        );

        $sSelect = implode(", ", $aField);

        $sSql = "
        SELECT {$sSelect}
          FROM (
                select a.CouTutorID,a.CouTimeStart,a.CouTimeEnd,
                       CASE WHEN e.NeedText = '1' THEN e.Content+d.ImpContent ELSE e.Content END AS Implementation,
                       c.StudentNo, c.ChtName, datediff(MINUTE,a.CouTimeStart,a.CouTimeEnd) AS CouTime,
                       (SELECT
                        CASE WHEN bb.NeedText = '1'
                             THEN bb.Content+aa.ProContent+','
                             ELSE bb.Content+',' END
                        FROM tCouStdProblemType aa
                        LEFT JOIN tCouProblemType bb ON  aa.ProblemID = bb.ProblemID
                        WHERE aa.CouTutorID = a.CouTutorID
                        FOR XML PATH('')
                       )AS ProblemType ,

                       CASE WHEN i.NeedText = '1' AND i.TextReason is not NULL THEN i.Content+h.TrackContent+i.TextReason
                            WHEN i.NeedText = '1' AND i.TextReason is NULL THEN i.Content+h.TrackContent
                            ELSE i.Content END AS FollowTrack,
                       a.BriefContent,
                       a.ACADYear,a.Semester,a.StudentID
                FROM tCouTutor a
                LEFT JOIN tStuStdClassHist b ON a.StudentID = b.StudentID AND a.ACADYear = b.Year AND a.Semester = b.Semester
                LEFT JOIN tStudent c ON a.StudentID = c.StudentID
                LEFT JOIN tCouStdImplementation d ON a.CouTutorID = d.CouTutorID
                LEFT JOIN tCouImplementation e ON d.ImpID = e.ImpID
                LEFT JOIN tCouStdFollowTrack h ON a.CouTutorID = h.CouTutorID
                LEFT JOIN tCouFollowTrack i ON h.TrackID = i.TrackID) M
        WHERE {$sWhere}
        order by ACADYear, Semester DESC";
        //dd($sSql, $aParam);
        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //F02130取資料
    public static function tCouTutorSetting($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_Semester'))->first()->content;

        $sACADYear_srh     = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh     = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;
        $sDayfg_srh        = isset($aParam['sDayfgID_srh']) ? $aParam['sDayfgID_srh'] : null;
        $sClassType_srh    = isset($aParam['sClassTypeID_srh']) ? $aParam['sClassTypeID_srh'] : null;
        $sCollege_srh      = isset($aParam['sCollege_srh']) ? $aParam['sCollege_srh'] : null;
        $sUnit_srh         = isset($aParam['sUnit_srh']) ? $aParam['sUnit_srh'] : null;
        $sStudyGroup_srh   = isset($aParam['sStudyGroup_srh']) ? $aParam['sStudyGroup_srh'] : null;
        $sGrade_srh        = isset($aParam['sGrade_srh']) ? $aParam['sGrade_srh'] : null;
        $sClass_srh        = isset($aParam['sClass_srh']) ? $aParam['sClass_srh'] : null;
        $sNoOrName_srh     = isset($aParam['sNoOrName_srh']) ? $aParam['sNoOrName_srh'] : null;
        $sCouTimeStart_srh = isset($aParam['sCouTimeStart_srh']) ? $aParam['sCouTimeStart_srh'] : null;
        $sCouTimeEnd_srh   = isset($aParam['sCouTimeEnd_srh']) ? $aParam['sCouTimeEnd_srh'] : null;

        $sWhere = ' 1 = 1 ';

        $aParam = array();

        if ($sACADYear_srh) {
            $sWhere .= " AND ACADYear = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND Semester = ? ";
            $aParam[] = $sSemester_srh;
        }
        if ($sDayfg_srh) {
            $sWhere .= " AND DayfgID = ? ";
            $aParam[] = $sDayfg_srh;
        }
        if ($sClassType_srh) {
            $sWhere .= " AND ClassTypeID = ? ";
            $aParam[] = $sClassType_srh;
        }
        if ($sCollege_srh) {
            $sWhere .= " AND upper = ? ";
            $aParam[] = $sCollege_srh;
        }
        if ($sUnit_srh) {
            $sWhere .= " AND UnitID = ? ";
            $aParam[] = $sUnit_srh;
        }
        if ($sStudyGroup_srh) {
            $sWhere .= " AND StudyGroupID = ? ";
            $aParam[] = $sStudyGroup_srh;
        }
        if ($sGrade_srh) {
            $sWhere .= " AND Grade = ? ";
            $aParam[] = $sGrade_srh;
        }
        if ($sClass_srh) {
            $sWhere .= " AND ClassNO = ? ";
            $aParam[] = $sClass_srh;
        }
        if ($sNoOrName_srh) {
            $sWhere .= " AND StudentNo LIKE ? OR ChtName LIKE ? ";
            $aParam[] = "%" . $sNoOrName_srh . "%";
            $aParam[] = "%" . $sNoOrName_srh . "%";
        }
        if ($sCouTimeStart_srh) {
            $sWhere .= " AND CouTimeStart >= ? ";
            $aParam[] = $sCouTimeStart_srh;
        }
        if ($sCouTimeEnd_srh) {
            $sWhere .= " AND CouTimeEnd <= ? ";
            $aParam[] = $sCouTimeEnd_srh;
        }

        $aField = array_keys(
            array(
                "CouTutorID"                                               => "導師輔導主單ID",
                "CouTimeStart"                                             => "輔導時間(起)",
                "CouTimeEnd"                                               => "輔導時間(迄)",
                "Implementation"                                           => "實施方式",
                "StudentNo"                                                => "學號",
                "ChtName"                                                  => "姓名",
                "CouTime"                                                  => "輔導時間(分)",
                "LEFT(M.ProblemType,len(M.ProblemType)-1) as sProblemType" => "問題類別",
                "FollowTrack"                                              => "後續處理方式",
                "BriefContent"                                             => "簡要內容記錄",
                "ACADYear"                                                 => "學年",
                "Semester"                                                 => "學期",
                "DayfgID"                                                  => "部別",
                "ClassTypeID"                                              => "學制",
                "upper"                                                    => "學院",
                "UnitID"                                                   => "系所",
                "StudyGroupID"                                             => "組別",
                "Grade"                                                    => "年級",
                "ClassNO"                                                  => "班級",
            )
        );

        $sSelect = implode(", ", $aField);

        $sSql = "
        SELECT {$sSelect}
          FROM (
                select a.CouTutorID,a.CouTimeStart,a.CouTimeEnd,
                       CASE WHEN e.NeedText = '1' THEN e.Content+d.ImpContent ELSE e.Content END AS Implementation,
                       c.StudentNo, c.ChtName, datediff(MINUTE,a.CouTimeStart,a.CouTimeEnd) AS CouTime,
                       (SELECT
                        CASE WHEN bb.NeedText = '1'
                             THEN bb.Content+aa.ProContent+','
                             ELSE bb.Content+',' END
                        FROM tCouStdProblemType aa
                        LEFT JOIN tCouProblemType bb ON  aa.ProblemID = bb.ProblemID
                        WHERE aa.CouTutorID = a.CouTutorID
                        FOR XML PATH('')
                       )AS ProblemType ,

                       CASE WHEN i.NeedText = '1' AND i.TextReason is not NULL THEN i.Content+h.TrackContent+i.TextReason
                            WHEN i.NeedText = '1' AND i.TextReason is NULL THEN i.Content+h.TrackContent
                            ELSE i.Content END AS FollowTrack,
                       a.BriefContent,
                       a.ACADYear,a.Semester,b.DayfgID,b.ClassTypeID,f.upper,b.UnitID,b.StudyGroupID,b.Grade,b.ClassNO
                FROM tCouTutor a
                LEFT JOIN tStuStdClassHist b ON a.StudentID = b.StudentID AND a.ACADYear = b.Year AND a.Semester = b.Semester
                LEFT JOIN tStudent c ON a.StudentID = c.StudentID
                LEFT JOIN tCouStdImplementation d ON a.CouTutorID = d.CouTutorID
                LEFT JOIN tCouImplementation e ON d.ImpID = e.ImpID
                LEFT JOIN tCouStdFollowTrack h ON a.CouTutorID = h.CouTutorID
                LEFT JOIN tCouFollowTrack i ON h.TrackID = i.TrackID
                LEFT JOIN tUnit f ON b.UnitID = f.UnitID) M
        WHERE {$sWhere}
        order by StudentNo";
        //dd($sSql, $aParam);
        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //選擇學生彈跳資料(限老師登入)
    public static function StuSelSetting($aParam = array())
    {
        $sTeacherNo      = $aParam['sTeacherNo'];
        $sACADYear_srh   = $aParam['sYear'];
        $sSemester_srh   = $aParam['sSemester'];
        $sDayfg_srh      = isset($aParam['sDayfg_srh']) ? $aParam['sDayfg_srh'] : null;
        $sClassType_srh  = isset($aParam['sClassType_srh']) ? $aParam['sClassType_srh'] : null;
        $sCollege_srh    = isset($aParam['sCollege_srh']) ? $aParam['sCollege_srh'] : null;
        $sUnit_srh       = isset($aParam['sUnit_srh']) ? $aParam['sUnit_srh'] : null;
        $sStudyGroup_srh = isset($aParam['sStudyGroup_srh']) ? $aParam['sStudyGroup_srh'] : null;
        $sGrade_srh      = isset($aParam['sGrade_srh']) ? $aParam['sGrade_srh'] : null;
        $sClass_srh      = isset($aParam['sClass_srh']) ? $aParam['sClass_srh'] : null;

        $aParam = array();

        $sWhere = ' e.TeacherID = ? ';

        $aParam[] = $sTeacherNo;

        if ($sACADYear_srh) {
            $sWhere .= " AND b.Year = ? ";
            $aParam[] = $sACADYear_srh;
        }
        if ($sSemester_srh) {
            $sWhere .= " AND b.Semester = ? ";
            $aParam[] = $sSemester_srh;
        }
        if ($sDayfg_srh) {
            $sWhere .= " AND b.DayfgID = ? ";
            $aParam[] = $sDayfg_srh;
        }
        if ($sClassType_srh) {
            $sWhere .= " AND b.ClassTypeID = ? ";
            $aParam[] = $sClassType_srh;
        }
        if ($sCollege_srh) {
            $sWhere .= " AND d.upper = ? ";
            $aParam[] = $sCollege_srh;
        }
        if ($sUnit_srh) {
            $sWhere .= " AND b.UnitID = ? ";
            $aParam[] = $sUnit_srh;
        }
        if ($sStudyGroup_srh) {
            $sWhere .= " AND b.StudyGroupID = ? ";
            $aParam[] = $sStudyGroup_srh;
        }
        if ($sGrade_srh) {
            $sWhere .= " AND b.Grade = ? ";
            $aParam[] = $sGrade_srh;
        }
        if ($sClass_srh) {
            $sWhere .= " AND b.ClassID = ? ";
            $aParam[] = $sClass_srh;
        }

        $aField = array_keys(
            array(
                "a.StudentID" => "學生ID",
                "a.StudentNo" => "學號",
                "a.ChtName"   => "姓名",
                "f.ClassName" => "班級",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "vStuStudentAll";

        $sSql = "
        SELECT DISTINCT {$sSelect}
                   FROM {$sTable} a
             INNER JOIN tStuStdClassHist b ON a.StudentID = b.StudentID
             INNER JOIN tBhrTutor e ON b.ClassID = e.ClassID
             INNER JOIN tUnitClassType c ON b.DayfgID = c.DayfgID AND b.ClassTypeID = c.ClassTypeID AND b.UnitID = c.UnitID
             INNER JOIN tUnit d ON b.UnitID = d.UnitID
             INNER JOIN tClassAll f ON b.Year = f.ACADYear AND b.Semester = f.Semester AND e.ClassID = f.ClassID
                  WHERE {$sWhere}
               ORDER BY a.StudentNo";
        //dd($sSql, $aParam);
        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //問題類別選項
    public static function ProblemOption()
    {
        $aField = array_keys(
            array(
                "ProblemID AS [value]" => "問題類別參數ID",
                "Content AS [text]"    => "問題類別描述",
                "NeedText"             => "是否需文字格",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "tCouProblemType";

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable} a
         WHERE state = '1'
      ORDER BY ProblemID";

        return DB::connection('ACAD')->select($sSql);
    }

    //問題類別選項(答案)
    public static function ProblemAns($CouTutorID = null)
    {
        $sCouTutorID = isset($CouTutorID) ? $CouTutorID : null;
        $aField      = array_keys(
            array(
                "a.*"          => "",
                "b.ProblemID"  => "輔導問題ID",
                "b.ProContent" => "輔導問題描述",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "tCouProblemType";

        if ($sCouTutorID) {
            $sWhere = " AND b.CouTutorID = ? ";
            $aParam = array($sCouTutorID);
        } else {
            $sWhere = " AND 1 = 1";
            $aParam = array('');
        }

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable} a
     LEFT JOIN tCouStdProblemType b ON a.ProblemID = b.ProblemID {$sWhere}
         WHERE b.CouTutorID is NULL OR b.CouTutorID is not NULL AND a.state = '1'
      ORDER BY a.ProblemID";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //實施方式選項
    public static function ImplementationOption()
    {
        $aField = array_keys(
            array(
                "ImpID AS [value]"  => "實施方式參數ID",
                "Content AS [text]" => "實施方式描述",
                "NeedText"          => "是否需文字格",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "tCouImplementation";

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable}
         WHERE state = '1'
      ORDER BY ImpID";

        return DB::connection('ACAD')->select($sSql);
    }

    //實施方式選項(答案)
    public static function ImplementationAns($CouTutorID = null)
    {
        $sCouTutorID = isset($CouTutorID) ? $CouTutorID : null;
        $aField      = array_keys(
            array(
                "a.*"          => "",
                "b.ImpID"      => "實施方式參數ID",
                "b.ImpContent" => "實施方式描述",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "tCouImplementation";

        if ($sCouTutorID) {
            $sWhere = " AND b.CouTutorID = ?";
            $aParam = array($sCouTutorID);
        } else {
            $sWhere = " AND 1 = 1";
            $aParam = array('');
        }

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable} a
     LEFT JOIN tCouStdImplementation b ON a.ImpID = b.ImpID {$sWhere}
         WHERE b.CouTutorID is NULL OR b.CouTutorID is not NULL AND a.state = '1'
      ORDER BY a.ImpID";
        //dd($sSql, $aParam);
        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //後續處理方式選項
    public static function FollowTrackOption()
    {
        $aField = array_keys(
            array(
                "TrackID AS [value]" => "後續處理方式參數ID",
                "Content AS [text]"  => "後續處理方式描述",
                "NeedText"           => "是否需文字格",
                "TextReason"         => "是否需文字格",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "tCouFollowTrack";

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable}
         WHERE state = '1'
      ORDER BY TrackID";

        return DB::connection('ACAD')->select($sSql);
    }

    //後續處理方式選項(答案)
    public static function FollowTrackAns($CouTutorID = null)
    {
        $sCouTutorID = isset($CouTutorID) ? $CouTutorID : null;
        $aField      = array_keys(
            array(
                "b.TrackID"      => "實施方式參數ID",
                "b.TrackContent" => "實施方式描述",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "tCouFollowTrack";

        if ($sCouTutorID) {
            $sWhere = " AND b.CouTutorID = ?";
            $aParam = array($sCouTutorID);
        } else {
            $sWhere = " AND 1=1 ";
            $aParam = array('');
        }

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable} a
     LEFT JOIN tCouStdFollowTrack b ON a.TrackID = b.TrackID {$sWhere}
         WHERE b.CouTutorID is NULL OR b.CouTutorID is not NULL AND a.state = '1'
      ORDER BY a.TrackID";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //編輯頁取資料
    public static function CouTutorView($id = null)
    {

        $aField = array_keys(
            array(
                "a.*"         => "tCouTutor所有欄位",
                "b.StudentNo" => "學號",
                "b.ChtName"   => "姓名",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "tCouTutor";

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable} a
     LEFT JOIN tStudent b ON a.StudentID = b.StudentID
         WHERE CouTutorID = ? ";

        $aParam = array($id);

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
