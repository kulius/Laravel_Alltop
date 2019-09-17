<?php

namespace App\Database\ACAD\tBhrBasisScore\Repo;

use App\Database\ACAD\ACADSysvar\Model\tACADSysvar;
use App\Database\ACAD\tBhrAbsentSub\Repo\tBhrAbsentSubRepo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class tBhrBasisScoreRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrBasisScore";
        $this->Msg   = "學期開始成績檔建立";
    }

    public static function BasisScoreSetting($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        $sACADYear_srh  = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh  = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;
        $sDayfg_srh     = isset($aParam['sDayfgID_srh']) ? $aParam['sDayfgID_srh'] : null;
        $sClassType_srh = isset($aParam['sClassTypeID_srh']) ? $aParam['sClassTypeID_srh'] : null;

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

        $aField = array_keys(
            array(
                "BasisScoreID"               => "學期成績檔ID",
                "ACADYear"                   => "學年度",
                "Semester"                   => "學期",
                "DayfgID"                    => "部別ID",
                "DayfgName"                  => "部別名稱",
                "ClassTypeID"                => "學制ID",
                "ClassTypeName"              => "學制名稱",
                "Grade"                      => "年級",
                "BehBasisScore"              => "操行基本分",
                "AllPresent"                 => "全勤加分",
                "StuNum as StudentNum"       => "學生人數",
                "ScoreNum as BehNum"         => "操行成績檔人數",
                "StuNum-ScoreNum AS NoScore" => "未建檔人數",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = "(
            SELECT a.*
                   , b.DayfgName
                   , c.ClassTypeName
                   , ( SELECT COUNT(1)
                       FROM tStuStdClassHist aa
                       INNER JOIN tUnit ab ON aa.UnitID = ab.UnitID and ab.IsOfficial = '1'
                       WHERE a.ACADYear = aa.Year AND a.Semester = aa.Semester AND a.DayfgID = aa.DayfgID AND a.ClassTypeID = aa.ClassTypeID AND a.Grade = aa.Grade
                     ) AS StuNum
                   , ( SELECT COUNT(1)
                       FROM tBhrScore aa
                       INNER JOIN tStuStdClassHist ab ON aa.ACADYear = ab.Year AND aa.Semester = ab.Semester AND aa.StudentID = ab.StudentID
                       INNER JOIN tUnit ac ON ab.UnitID = ac.UnitID AND ac.IsOfficial = '1'
                       WHERE a.ACADYear = aa.ACADYear AND a.Semester = aa.Semester AND a.DayfgID = ab.DayfgID AND a.ClassTypeID = ab.ClassTypeID AND a.Grade = ab.Grade
                       AND EXISTS ( SELECT 1 FROM vStuEnrolled ad WHERE aa.ACADYear = ad.ACADYear AND aa.Semester = ad.Semester AND aa.StudentID = ad.StudentID)
                     ) AS ScoreNum
            FROM tBhrBasisScore a
            LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
            LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
        )";

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} a
        WHERE {$sWhere}
        ORDER BY DayfgID, ClassTypeID, Grade";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //未建檔人數
    public static function NonScore($aParam = array())
    {
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        $sACADYear_srh  = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh  = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;
        $sDayfg_srh     = isset($aParam['sDayfgID_srh']) ? $aParam['sDayfgID_srh'] : null;
        $sClassType_srh = isset($aParam['sClassTypeID_srh']) ? $aParam['sClassTypeID_srh'] : null;

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

        $aField = array_keys(
            array(
                "SUM(ScoreNum1)" => "未建立成績檔人數",
            )
        );

        $sSelect = implode(", ", $aField);

        $sTable = "(
            SELECT a.ACADYear,a.Semester,a.DayfgID,a.ClassTypeID
                    , ( SELECT COUNT(1)
                        FROM tBhrScore aa
                        INNER JOIN tStuStdClassHist ab ON aa.ACADYear = ab.Year AND aa.Semester = ab.Semester AND aa.StudentID = ab.StudentID
                        INNER JOIN tUnit ac ON ab.UnitID = ac.UnitID AND ac.IsOfficial = '1'
                        WHERE a.ACADYear = aa.ACADYear AND a.Semester = aa.Semester AND a.DayfgID = ab.DayfgID AND a.ClassTypeID = ab.ClassTypeID AND a.Grade = ab.Grade
                            AND NOT EXISTS ( SELECT 1 FROM vStuEnrolled ad WHERE aa.ACADYear = ad.ACADYear AND aa.Semester = ad.Semester AND aa.StudentID = ad.StudentID)
                      ) AS ScoreNum1
            FROM tBhrBasisScore a
            LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
            LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
        )";

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable} aa
        WHERE {$sWhere}";

        $ans = DB::connection('ACAD')->select($sSql, $aParam);

        return $ans;
    }

    //TODO 不確定是否建立都正確
    //建立本學年學期操性基本檔
    public static function CreatPerformance($aParam = array())
    {
        $err = '0';
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        $sACADYear_srh = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;

        $sSql0 = "SELECT a.ACADYear, a.Semester, a.DayfgID, a.ClassTypeID, a.BhrBasisScoreGeneral, b.AllPresentAdd
                 FROM tBhrScoreSet a
                 INNER JOIN tBhrPara b ON a.ACADYear = b.ACADYear AND a.Semester = b.Semester AND a.DayfgID = b.DayfgID AND a.ClassTypeID = b.ClassTypeID
                 WHERE a.ACADYear = ? AND a.Semester = ?
                 GROUP BY a.ACADYear, a.Semester, a.DayfgID, a.ClassTypeID, a.BhrBasisScoreGeneral, b.AllPresentAdd";

        $aParam = array(
            $sACADYear_srh,
            $sSemester_srh,
        );

        $ScoreSet = DB::connection('ACAD')->select($sSql0, $aParam);

        if (COUNT($ScoreSet) == 0) {
            $err           = '1';
            return $result = array('err', $err);
        } else {

            for ($i = 0; $i < COUNT($ScoreSet); $i++) {
                $sSql1 = "
                    SELECT COUNT(1) AS count
                    FROM tStuStdClassHist a
                    INNER JOIN tUnit b ON a.UnitID = b.UnitID AND b.IsOfficial = '1'
                    WHERE a.Year = ? AND a.Semester = ? AND a.DayfgID = ? AND a.ClassTypeID = ?
                ";
                $aParam1 = array(
                    trim($ScoreSet[$i]['ACADYear']),
                    trim($ScoreSet[$i]['Semester']),
                    trim($ScoreSet[$i]['DayfgID']),
                    trim($ScoreSet[$i]['ClassTypeID']),
                );

                $ChkStd = DB::connection('ACAD')->select($sSql1, $aParam1);

                // 判斷這學年度、學期、部別、學制是否有學生資料
                if (Count($ChkStd) == 0) {
                    $err           = '2';
                    return $result = array('err', $err);
                } elseif (Count($ChkStd) > 0) {
                    // 刪除學期操行成績基本檔
                    $sSql2 = "DELETE tBhrBasisScore
                              WHERE ACADYear = ? AND Semester = ? AND DayfgID = ? AND ClassTypeID = ?";

                    DB::connection('ACAD')->delete($sSql2, $aParam1);

                    // 建立學期操行成績基本檔
                    $sSql3 = "INSERT INTO tBhrBasisScore (ACADYear, Semester, DayfgID, ClassTypeID, Grade, BehBasisScore, AllPresent, StudentNum, BehNum)
                              SELECT a.YEAR, a.Semester, a.DayfgID, a.ClassTypeID, a.Grade, ?, ?, ?, ?
                              FROM tStuStdClassHist a
                              INNER JOIN tUnit b ON a.UnitID = b.UnitID AND b.IsOfficial = '1'
                              WHERE a.YEAR = ? AND a.Semester = ? AND a.DayfgID = ? AND a.ClassTypeID = ?
                              GROUP BY a.YEAR, a.Semester, a.DayfgID, a.ClassTypeID, a.Grade ";

                    $aParam2 = array(
                        trim($ScoreSet[$i]['BhrBasisScoreGeneral']),
                        trim($ScoreSet[$i]['AllPresentAdd']),
                        trim("0"),
                        trim("0"),
                        trim($ScoreSet[$i]['ACADYear']),
                        trim($ScoreSet[$i]['Semester']),
                        trim($ScoreSet[$i]['DayfgID']),
                        trim($ScoreSet[$i]['ClassTypeID']),
                    );
                    DB::connection('ACAD')->delete($sSql3, $aParam2);

                    // 建立學生操行成績
                    $sSql4 = "SELECT ACADYear, Semester, DayfgID, ClassTypeID, Grade, BehBasisScore, AllPresent
                             FROM tBhrBasisScore
                             WHERE ACADYear = ? AND Semester = ? AND DayfgID = ? AND ClassTypeID = ?";
                    $BasisScore = DB::connection('ACAD')->select($sSql4, $aParam1);

                    for ($j = 0; $j < COUNT($BasisScore); $j++) {
                        $BehaviorScore = (int) trim($BasisScore[$j]['BehBasisScore']) + (int) trim($BasisScore[$j]['AllPresent']);

                        $sSql5 = "INSERT INTO tBhrScore (StudentID, ACADYear, Semester, BehBasisScore, AllPresentAdd, BehaviorScore, BehaviorScoreLevel, UpateID, UpdateDate)
                                  SELECT StudentID, ?, ?, ?, ?, ?, '甲等' AS BehaviorScoreLevel, ?, GETDATE()
                                  FROM tStuStdClassHist a
                                  INNER JOIN tUnit b ON a.UnitID = b.UnitID AND b.IsOfficial = '1'
                                  WHERE a.YEAR = ? AND a.Semester = ? AND a.DayfgID = ? AND a.ClassTypeID = ? AND a.Grade = ?
                                    AND a.StudentID NOT IN (SELECT StudentID FROM tBhrScore WHERE ACADYear = ? AND Semester = ?) ";
                        $aParam3 = array(
                            trim($BasisScore[$j]['ACADYear']),
                            trim($BasisScore[$j]['Semester']),
                            trim($BasisScore[$j]['BehBasisScore']),
                            trim($BasisScore[$j]['AllPresent']),
                            trim($BehaviorScore),
                            trim(Session::get('user_id')),
                            trim($BasisScore[$j]['ACADYear']),
                            trim($BasisScore[$j]['Semester']),
                            trim($BasisScore[$j]['DayfgID']),
                            trim($BasisScore[$j]['ClassTypeID']),
                            trim($BasisScore[$j]['Grade']),
                            trim($BasisScore[$j]['ACADYear']),
                            trim($BasisScore[$j]['Semester']),
                        );

                        $result = DB::connection('ACAD')->insert($sSql5, $aParam3);
                    }
                }
            }

            $sSql6 = "UPDATE tBhrScore
                         SET BehBasisScore = 60
                           , BehaviorScore = 60 + AllPresentAdd
                           , BehaviorScoreLevel = '丙等'
                       WHERE ACADYear = ?
                         AND Semester = ?
                         AND StudentID IN (SELECT StudentID FROM tBhrScore WHERE Probation = '1' AND ACADYear = ? AND Semester = ?)";

            switch ($sSemester_srh) {
                case "1":
                    $aParam4 = array(
                        trim($sACADYear_srh),
                        trim($sSemester_srh),
                        ((int) trim($sACADYear_srh) - 1),
                        "2",
                    );
                    DB::connection('ACAD')->update($sSql6, $aParam4);
                    break;
                case "2":
                    $aParam4 = array(
                        trim($sACADYear_srh),
                        trim($sSemester_srh),
                        trim($sACADYear_srh),
                        "1",
                    );
                    DB::connection('ACAD')->update($sSql6, $aParam4);
                    break;
                default:
                    break;
            }
        }
        if ($err == 0) {
            return $result = array('success');
        }
    }

    //TODO 不確定是否建立都正確
    //補建成績檔
    public static function Reconstruction($aParam = array())
    {
        $err = 0;
        //第一次載入時直接查詢當前學年度的資料
        $sYear     = tACADSysvar::where(array('var' => 'stu_year'))->first()->content;
        $sSemester = tACADSysvar::where(array('var' => 'stu_semester'))->first()->content;

        $sACADYear_srh = isset($aParam['sACADYear_srh']) ? $aParam['sACADYear_srh'] : $sYear;
        $sSemester_srh = isset($aParam['sSemester_srh']) ? $aParam['sSemester_srh'] : $sSemester;

        $sSql = "SELECT a.StudentID, a.DayfgID, a.ClassTypeID, a.Grade
                 FROM tStuStdClassHist a
                 INNER JOIN tUnit b ON a.UnitID = b.UnitID AND b.IsOfficial = '1'
                 LEFT JOIN tBhrScore c ON a.Year = c.ACADYear AND a.Semester = c.Semester AND a.StudentID = c.StudentID
                 WHERE c.BehaviorScore is NULL AND a.Year = ? AND a.Semester = ?";

        $aParam = array(
            $sACADYear_srh,
            $sSemester_srh,
        );

        $ClassHist = DB::connection('ACAD')->select($sSql, $aParam);

        if (count($ClassHist) > 0) {
            for ($i = 0; $i < count($ClassHist); $i++) {
                $sSql1 = "SELECT bbs.BehBasisScore, p.AllPresentAdd
                          FROM tBhrBasisScore bbs
                          INNER JOIN tBhrPara p ON bbs.ACADYear = p.ACADYear AND bbs.Semester = p.Semester AND bbs.DayfgID = p.DayfgID AND bbs.ClassTypeID = p.ClassTypeID
                          WHERE bbs.ACADYear = ? AND bbs.Semester = ? AND bbs.DayfgID = ? AND bbs.ClassTypeID = ? AND bbs.Grade = ? ";

                $aParam1 = array(
                    trim($sACADYear_srh),
                    trim($sSemester_srh),
                    trim($ClassHist[$i]['DayfgID']),
                    trim($ClassHist[$i]['ClassTypeID']),
                    trim($ClassHist[$i]['Grade']),
                );

                $BasisScore = DB::connection('ACAD')->select($sSql1, $aParam1);

                for ($j = 0; $j < count($BasisScore); $j++) {
                    $BehBasisScore = trim($BasisScore[$j]['BehBasisScore']);

                    switch (trim($sSemester_srh)) {
                        case "1":
                            $pwhere = "StudentID = '" . trim($ClassHist[$i]['StudentID']) . "' AND ACADYear = '" . ((int) trim($sACADYear_srh) - 1) . "' AND Semester = '2'";

                            $sSql = "SELECT Probation
                                     FROM tBhrScore
                                     WHERE {$pwhere}";

                            $Probation = DB::connection('ACAD')->select($sSql);

                            if ($Probation == 1) {
                                $BehBasisScore = "60";
                            }
                            break;
                        case "2":
                            $pwhere = "StudentID = '" . trim($ClassHist[$i]['StudentID']) . "' AND ACADYear = '" . trim($sACADYear_srh) . "' AND Semester = '1'";

                            $sSql = "SELECT Probation
                                     FROM tBhrScore
                                     WHERE {$pwhere}";

                            $Probation = DB::connection('ACAD')->select($sSql);

                            if ($Probation == 1) {
                                $BehBasisScore = "60";
                            }
                            break;
                        default:
                            break;
                    }

                    $sSql2 = "INSERT INTO tBhrScore (StudentID, ACADYear, Semester, BehBasisScore, AllPresentAdd, BehaviorScore, BehaviorScoreLevel, UpateID, UpdateDate)
                              VALUES (?, ?, ?, ?, ?, ?, '甲等', ?, GETDATE())";

                    $aParma2 = array(
                        trim($ClassHist[$i]['StudentID']),
                        trim($sACADYear_srh),
                        trim($sSemester_srh),
                        trim($BehBasisScore),
                        trim($BasisScore[$j]['AllPresentAdd']),
                        (int) trim($BehBasisScore) + (int) trim($BasisScore[$j]['AllPresentAdd']),
                        trim(Session::get('user_id')),
                    );
                    $Reconstr = DB::connection('ACAD')->insert($sSql2, $aParma2);
                }
            }
            tBhrAbsentSubRepo::UpdateAbsentSub($sACADYear_srh, $sSemester_srh);
        } else {
            $err           = 1;
            return $result = array('err', $err);
        }
        if ($err == 0) {
            return $result = array('success');
        }
    }

    //檢視頁特製學制
    public static function VUnit_combo($aParam = array())
    {
        $sACADYear    = $aParam['sYear'];
        $sSemester    = $aParam['sSemester'];
        $sDayfgID     = $aParam['sDayfgID'];
        $sClassTypeID = $aParam['sClassTypeID'];
        $sGrade       = $aParam['sGrade'];
        //條件
        $sWhere = ' 1 = 1 ';

        $sWhere .= " AND a.StudentID = b.StudentID AND b.StudentID = c.StudentID
                     AND c.UnitID = d.UnitID AND a.ACADYear = c.Year AND a.Semester = c.Semester
                     AND a.ACADYear = ? AND a.Semester = ?
                     AND c.DayfgID = ? AND c.ClassTypeID = ? AND c.Grade = ?
                     ";
        $aParam = array($sACADYear, $sSemester, $sDayfgID, $sClassTypeID, $sGrade);

        $aField = array_keys(array(
            "c.UnitID AS [value]"  => "系所代碼",
            "d.UnitName AS [text]" => "系所名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrScore a, vStuStudentAll b, tStuStdClassHist c , tUnit d';

        $sSql = "
              SELECT {$sSelect}
              FROM {$sTable}
              WHERE {$sWhere}
              GROUP BY c.UnitID,d.UnitName";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //檢視頁資料設定
    public static function BhrScoreSetting($aParam = array())
    {
        $sACADYear    = $aParam['sYear'];
        $sSemester    = $aParam['sSemester'];
        $sDayfgID     = $aParam['sDayfgID'];
        $sClassTypeID = $aParam['sClassTypeID'];
        $sGrade       = $aParam['sGrade'];

        $sUnit_srh = isset($aParam['sUnit_srh']) ? $aParam['sUnit_srh'] : null;
        //條件
        $sWhere = ' 1 = 1 ';

        $sWhere .= " AND a.StudentID = b.StudentID AND b.StudentID = c.StudentID
                     AND c.UnitID = d.UnitID AND c.ClassID = e.ClassID
                     AND a.ACADYear = c.Year AND a.Semester = c.Semester
                     AND enrl.StudentID = b.StudentID
                     AND a.ACADYear = ?
                     AND a.Semester = ?
                     AND c.DayfgID = ?
                     AND c.ClassTypeID = ?
                     AND c.Grade = ?
                     AND enrl.ACADYear = ?
                     AND enrl.Semester = ? ";

        $aParam = array($sACADYear, $sSemester, $sDayfgID, $sClassTypeID, $sGrade, $sACADYear, $sSemester);

        if ($sUnit_srh) {
            $sWhere .= " AND c.UnitID = ? ";
            $aParam[] = $sUnit_srh;
        }

        $aField = array_keys(array(
            "b.StudentID"                                                   => "學生ID",
            "b.StudentNo"                                                   => "學號",
            "b.ChtName"                                                     => "學生姓名",
            "c.UnitID"                                                      => "系所ID",
            "d.UnitName"                                                    => "系所名稱",
            "a.AllPresentAdd"                                               => "全勤加分",
            "a.BehaviorScore"                                               => "操行成績",
            "ROW_NUMBER() OVER( order by b.UnitID, b.StudentNo asc) AS row" => "編號",
            "c.ClassID"                                                     => "班級ID",
            "e.ClassName"                                                   => "班級名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrScore a, vStuStudentAll b, tStuStdClassHist c, vStuEnrolled enrl, tUnit d, tClass e ';

        $sSql = "
              SELECT {$sSelect}
              FROM {$sTable}
              WHERE {$sWhere}";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
