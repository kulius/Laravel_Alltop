<?php

namespace App\Database\ACAD\tBhrParaCopyHistory\Repo;

use App\Database\ACAD\tBhrParaCopyHistory\Model\tBhrParaCopyHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class tBhrParaCopyHistoryRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrParaCopyHistory";
        $this->Msg   = "參數代碼檔";
    }

    //資料設定
    public static function tBhrParaCopyHistorySetting($aParam = array())
    {
        $aField = array_keys(
            array(
                "tBhrParaCopyHistoryID" => "操行系統參數複制歷程ID",
                "SourceACADYear"        => "來源學年",
                "SourceSemester"        => "來源學期",
                "TargetACADYear"        => "目標學年",
                "TargetSemester"        => "目標學期",
                "UpdateID"              => "異動者",
                "UpdateDate"            => "異動時間",
            )
        );

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrParaCopyHistory';

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable}
        ORDER BY UpdateDate DESC";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //複製資料
    public static function CopySet($aParam = array())
    {
        //取得建立者
        $ApplyID = Session::get('user_id');

        $sSourceYear = $aParam['sSourceYear'];
        $sSourceSem  = $aParam['sSourceSem'];
        $sTargetYear = $aParam['sTargetYear'];
        $sTargetSem  = $aParam['sTargetSem'];

        $sTable1 = 'tBhrPara';
        $sTable2 = 'tBhrScoreSet';
        $sTable3 = 'tBhrScoreAddSub';
        $sTable4 = 'tBhrBehaviorClass';
        $sTable5 = 'tBhrAbsentSub';

        $sSql1 = "
            INSERT INTO {$sTable1}
            ( ACADYear, Semester, DayfgID, ClassTypeID
            , IsBalance, AllPresentAdd, NoMistakes
            , UpdateID, UpdateDate, ApplyID, ApplyDate)

            SELECT  '$sTargetYear', '$sTargetSem', DayfgID, ClassTypeID
            , IsBalance, AllPresentAdd, NoMistakes, '', '', '$ApplyID', GETDATE()

            FROM {$sTable1}
            WHERE ACADYear = '$sSourceYear' AND Semester = '$sSourceSem'
            ";
        $tBhrPara = DB::connection('ACAD')->insert($sSql1);

        $sSql2 = "
            INSERT INTO {$sTable2}
            ( ACADYear, Semester, DayfgID, ClassTypeID, BhrBasisScoreGeneral
            , BhrBasisScoreObserve, TutorScoreUp, TutorScoreLow, TutorScoreRate
            , DrillScoreUp, DrillScoreLow, DrillScoreRate, ChiefScoreUp, ChiefScoreLow
            , ChiefScoreRate, ComputScore, UpdateID, UpdateDate, ApplyID, ApplyDate)

            SELECT  '$sTargetYear', '$sTargetSem', DayfgID, ClassTypeID
            , BhrBasisScoreGeneral, BhrBasisScoreObserve, TutorScoreUp, TutorScoreLow
            , TutorScoreRate, DrillScoreUp, DrillScoreLow, DrillScoreRate
            , ChiefScoreUp, ChiefScoreLow, ChiefScoreRate, ComputScore
            , '', '', '$ApplyID', GETDATE()

            FROM {$sTable2}
            WHERE ACADYear = '$sSourceYear' AND Semester = '$sSourceSem'
            ";
        $tBhrScoreSet = DB::connection('ACAD')->insert($sSql2);

        $sSql3 = "
            INSERT INTO {$sTable3}
            (ACADYear, Semester, DayfgID, ClassTypeID
            , GreatMeritAdd, LittleMeritAdd, PraiseMeritAdd, MajorDemeritSub
            , LittleDemeritSub, RebuteDemeritSub, UpdateID, UpdateDate, ApplyID, ApplyDate)

            SELECT  '$sTargetYear', '$sTargetSem', DayfgID, ClassTypeID
            , GreatMeritAdd, LittleMeritAdd, PraiseMeritAdd, MajorDemeritSub
            , LittleDemeritSub, RebuteDemeritSub, '', '', '$ApplyID', GETDATE()

            FROM {$sTable3}
            WHERE ACADYear = '$sSourceYear' AND Semester = '$sSourceSem'
            ";
        $tBhrScoreAddSub = DB::connection('ACAD')->insert($sSql3);

        $sSql4 = "
            INSERT INTO {$sTable4}
            ( ACADYear, Semester, DayfgID, ClassTypeID
            , HighClass, Class1, Class2, Class3, Class4
            , UpdateID, UpdateDate, ApplyID, ApplyDate)

            SELECT '$sTargetYear', '$sTargetSem', DayfgID, ClassTypeID
            , HighClass, Class1, Class2, Class3, Class4
            , '', '', '$ApplyID', GETDATE()

            FROM {$sTable4}
            WHERE ACADYear = '$sSourceYear' AND Semester = '$sSourceSem'
            ";
        $tBhrBehaviorClass = DB::connection('ACAD')->insert($sSql4);

        $sSql5 = "
            INSERT INTO {$sTable5}
            (ACADYear, Semester, DayfgID, ClassTypeID
            , MeetingKindID, LeaveKindID, SubModle, SubModleValue, NoCountSection
            , UpdateID, UpdateDate, ApplyID, ApplyDate)

            SELECT '$sTargetYear', '$sTargetSem', DayfgID, ClassTypeID
            , MeetingKindID, LeaveKindID, SubModle, SubModleValue, NoCountSection
            , '', '', '$ApplyID', GETDATE()

            FROM {$sTable5}
            WHERE ACADYear = '$sSourceYear' AND Semester = '$sSourceSem'
            ";
        $tBhrAbsentSub = DB::connection('ACAD')->insert($sSql5);

        //全部複製成功才會回傳true
        if ($tBhrPara && $tBhrScoreSet && $tBhrScoreAddSub && $tBhrBehaviorClass && $tBhrAbsentSub) {
            return true;
        } else {
            return false;
        }
    }

    //複製失敗時 刪除已複製的資料
    public static function DelInsert($aParam = array())
    {
        $sTargetYear = $aParam['sTargetYear'];
        $sTargetSem  = $aParam['sTargetSem'];

        $sTable1 = 'tBhrPara';
        $sTable2 = 'tBhrScoreSet';
        $sTable3 = 'tBhrScoreAddSub';
        $sTable4 = 'tBhrBehaviorClass';
        $sTable5 = 'tBhrAbsentSub';

        $sSql1 = "
            DELETE FROM {$sTable1}
            WHERE ACADYear = '$sTargetYear' AND Semester = '$sTargetSem'
            ";
        $tBhrPara = DB::connection('ACAD')->delete($sSql1);

        $sSql2 = "
            DELETE FROM {$sTable2}
            WHERE ACADYear = '$sTargetYear' AND Semester = '$sTargetSem'
            ";
        $tBhrScoreSet = DB::connection('ACAD')->delete($sSql2);

        $sSql3 = "
            DELETE FROM {$sTable3}
            WHERE ACADYear = '$sTargetYear' AND Semester = '$sTargetSem'
            ";
        $tBhrScoreAddSub = DB::connection('ACAD')->delete($sSql3);

        $sSql4 = "
            DELETE FROM {$sTable4}
            WHERE ACADYear = '$sTargetYear' AND Semester = '$sTargetSem'
            ";
        $tBhrBehaviorClass = DB::connection('ACAD')->delete($sSql4);

        $sSql5 = "
            DELETE FROM {$sTable5}
            WHERE ACADYear = '$sTargetYear' AND Semester = '$sTargetSem'
            ";
        $tBhrAbsentSub = DB::connection('ACAD')->delete($sSql5);

        return true;
    }

    public static function Chkdata($ChkTable, $aParam = array())
    {
        $channel = $ChkTable;

        switch ($channel) {
            case 'tBhrPara':
                $aField = array_keys(
                    array(
                        "COUNT(ParaID) AS count" => "參數代碼ID",
                    )
                );
                break;
            case 'tBhrScoreSet':
                $aField = array_keys(
                    array(
                        "COUNT(ScoreSetID) AS count" => "評分設定代碼",
                    )
                );
                break;
            case 'tBhrScoreAddSub':
                $aField = array_keys(
                    array(
                        "COUNT(ScoreAddSubID) AS count" => "獎懲加扣分設定",
                    )
                );
                break;
            case 'tBhrBehaviorClass':
                $aField = array_keys(
                    array(
                        "COUNT(BehaviorClassID) AS count" => "操行等級代碼",
                    )
                );
                break;
            case 'tBhrAbsentSub':
                $aField = array_keys(
                    array(
                        "COUNT(AbsentSubID) AS count" => "請假扣分代碼",
                    )
                );
                break;
            default:
                break;
        }

        //查詢是否有舊資料
        $sSelect = implode(", ", $aField);

        $sTable = $ChkTable;

        $sWhere = 'ACADYear =' . $aParam['sSourceYear'] . ' AND Semester = ' . $aParam['sSourceSem'];

        $sSql = "
        SELECT {$sSelect}
        FROM {$sTable}
        WHERE {$sWhere}
        ";

        $oAns = DB::connection('ACAD')->select($sSql);

        //查詢目的學年是否有資料
        $sWhere2 = 'ACADYear =' . $aParam['sTargetYear'] . ' AND Semester = ' . $aParam['sTargetSem'];

        $sSql2 = "
        SELECT {$sSelect}
        FROM {$sTable}
        WHERE {$sWhere2}
        ";

        $nAns = DB::connection('ACAD')->select($sSql2);

        $Ans = array($oAns[0], $nAns[0]);

        return $Ans;
    }
}
