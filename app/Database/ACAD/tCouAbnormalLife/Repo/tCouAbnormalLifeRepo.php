<?php

namespace App\Database\ACAD\tCouAbnormalLife\Repo;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class tCouAbnormalLifeRepo
{

    public function cacheQuery($sql, $aParams, $timeout = 60)
    {
        return Cache::remember(md5($sql), $timeout, function () use ($sql, $aParams) {
            return DB::connection('ACAD')->raw($sql, $aParams);
        });
    }

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tCouAbnormalLife";
        $this->Msg   = "學生生活異狀";
    }

    /**
     * 正在引用此function的 Controller檔案:
     *     1. F07310Controller.php
     *     2.
     *
     * @param $viewColumn: 可自訂欲顯示之資料欄位
     * @return Object
     */
    public function getCouAbnormalLife($aParams = array())
    {

        // 判斷有無自訂欄位
        if (isset($aParams['viewColumn'])) {
            $viewColumn = $aParams['viewColumn'];
        } else {
            $viewColumn = "a.AbnormalLifeID, a.ACADYear, a.Semester, e.DayfgName, e.ClassTypeName, d.CollegeName, e.UnitName
                         , f.StudyGroupName, e.Grade, e.ClassName, b.StudentNo, b.ChtName, CAST(a.ApplyDate AS DATE) AS ApplyDate";
        }

        $sSql = "SELECT " . $viewColumn . "
                 FROM tCouAbnormalLife a
                 INNER JOIN vStuStudentAll b ON a.StudentID = b.StudentID
                 INNER JOIN tStuStdClassHist c ON b.StudentID = c.StudentID AND a.ACADYear = c.Year AND a.Semester = c.Semester
                 INNER JOIN (
                     SELECT b.UnitID, a.UnitName AS CollegeName, a.UnitID AS CollegeID
                     FROM tUnit a
                     INNER JOIN tUnit b ON a.UnitID = b.upper
                 ) d ON c.UnitID = d.UnitID
                 INNER JOIN tClassAll e ON c.ClassID = e.ClassID AND a.ACADYear = e.ACADYear AND a.Semester = e.Semester
                 LEFT JOIN tStudyGroup f ON e.StudyGroupID = f.StudyGroupID
                 WHERE " . $aParams['where'];

        return $this->cacheQuery($sSql, $aParams['param']);
    }
}
