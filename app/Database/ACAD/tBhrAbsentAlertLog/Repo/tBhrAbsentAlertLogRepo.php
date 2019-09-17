<?php
namespace App\Database\ACAD\tBhrAbsentAlertLog\Repo;

use Illuminate\Support\Facades\DB;

class tBhrAbsentAlertLogRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrAbsentAlertLog";
        $this->Msg   = "請假類別";
    }

    // 學生曠課16小時通知紀錄
    public function getStuAlertData()
    {
        $DbCon = DB::connection($this->DB);
        $sSql  = 'SELECT a.AbsentAlertLogID, a.ACADYear, a.Semester, d.DayfgName, e.ClassName
					   , b.StudentNo, b.ChtName, a.AbsentAllHours, a.AlertStatus
				 FROM tBhrAbsentAlertLog a
				 INNER JOIN vStuStudentAll b ON a.StudentID = b.StudentID
				 INNER JOIN tStuStdClassHist c ON a.StudentID = c.StudentID
				 	AND a.ACADYear = c.Year AND a.Semester = c.Semester
				 INNER JOIN tDayfg d ON b.DayfgID = c.DayfgID
				 INNER JOIN tClassAll e ON c.ClassID = e.ClassID';
        return $DbCon->select($sSql);

        // return $DbCon->table($this->Table . ' AS a')
        //              ->join('vStuStudentAll AS b', 'a.StudentID', '=', 'b.StudentID')
        //              ->join('vStuStudentAll AS b', 'a.StudentID', '=', 'b.StudentID')
        //              ->join('vStuStudentAll AS b', 'a.StudentID', '=', 'b.StudentID')
        //              ->join('vStuStudentAll AS b', 'a.StudentID', '=', 'b.StudentID')
        //              ->select('a.AbsentAlertLogID', 'a.ACADYear', 'a.Semester', 'd.DayfgName', 'e.ClassName'
        // , 'b.StudentNo', 'b.ChtName', 'a.AbsentAllHours', 'a.AlertStatus')->get();
    }

}
