<?php

namespace App\Database\ACAD\vStuStudentAll\Repo;

use App\Database\ACAD\tDayfgClassTypeSemester\Model\tDayfgClassTypeSemester;
use Illuminate\Support\Facades\DB;

class vStuStudentAllRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "vStuStudentAll";
        $this->Msg   = "學生檢視表";
    }

    /**
     * 使用學年、學期、學號，取得學生當期相關的部別學制系所資料
     */
    public function getYearSemStudent($sStudentNo, $sYear, $sSemester)
    {
        //TODO:: 後續要將學號轉換成 session('user_id')
        $sStudentNo = $aParams['StudentNo'] ?? null;
        $sYear      = $aParams['Year'] ?? null;
        $sSemester  = $aParams['Semester'] ?? null;

        $aParam = array();

        if ($sStudentNo) {
            $sWhere   = 'a.StudentNo = ? ';
            $aParam[] = $sStudentNo;
        }

        //取得下拉的學年
        if ($sYear) {
            $sWhere .= ' AND b.Year = ? ';
            $aParam[] = $sYear;
        }
        if ($sSemester) {
            $sWhere .= ' AND b.Semester = ? ';
            $aParam[] = $sSemester;
        }
        //需要寫入tStuStateChange的欄位，原學生資料變成 Old 欄位
        $aColumn = array(
            'b.Year as ACADYear',
            'b.Semester as Semester',
            'b.DayfgID',
            'b.ClassTypeID',
            'b.UnitID',
            'b.StudyGroupID',
            'b.Grade',
            'b.ClassID',
            'b.ClassNo',
            'b.StudentID',
        );
        $sColumn = implode(', ', $aColumn);
        //學生尚未轉系的系所資料
        $sSql = "SELECT distinct $sColumn FROM vStuStudentAll a
                            left join tStuStdClassHist b on a.StudentID = b.StudentID
                            left join tClassAll c on b.DayfgID = c.DayfgID
                            and b.ClassTypeID = c.ClassTypeID
                            and b.Year = c.ACADYear
                            and b.Semester = c.Semester
                            and b.UnitID = c.UnitID
                            where $sWhere";
        $aStuUnit = DB::connection('ACAD')->select($sSql, $aParam);
        if ($aStuUnit == null) {
            throw new \Exception('Can\' find Student Data');
        }
        return $aStuUnit[0];
    }

    //學年學期部別學制  休課期數->SuspendSemester
    public function getPredictYearSem(array $aParams)
    {
        $sStartYear      = $aParams['StartYear'];
        $sSem            = $aParams['StartSemester'];
        $sDayfgID        = $aParams['DayfgID'];
        $sClassTypeID    = $aParams['ClassTypeID'];
        $SuspendSemester = $aParams['SuspendSemester'];
        $aWhere          = array();
        $aWhere[]        = array('DayfgID', $sDayfgID);
        $aWhere[]        = array('ClassTypeID', $sClassTypeID);
        $aWhere[]        = array('CalCulable', '1');
        $aCalCuSem       = tDayfgClassTypeSemester::where($aWhere)->get()->toArray();
        //計算方式因為部別學制會有所不同!! 日間部兩學期、夜間部三學期，需動態計算!
        //TODO:: 先寫入空白，計算方式: 根據申請者的申請學年學期與 tDayfgClassTypeSemester Table，動態計算 BeBackYear、BeBackSemester，瑞文
        //可能需要列入計算的學期不只 1 or 2 or 3 or 4
        $BaseSem       = count($aCalCuSem);
        $sBackSemester = $sSem + $SuspendSemester;
        $BeBackYear    = floor(($sBackSemester - 1) / $BaseSem);
        $BeBackSem     = ($sBackSemester % $BaseSem) == 0 ? $BaseSem : $sBackSemester % $BaseSem;
        return ['BeBackYear' => $BeBackYear, 'BeBackSem' => $BeBackSem];
    }
}
