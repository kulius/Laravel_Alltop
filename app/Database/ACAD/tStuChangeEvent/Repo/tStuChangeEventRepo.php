<?php

namespace App\Database\ACAD\tStuChangeEvent\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tStuChangeEventRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuChangeEvent";
        $this->Msg   = "交換生紀錄";

        $this->aField['getStuChangeEvent'] = array_keys(array(
            "a.*"          => "交換生紀錄",
            "b.StudentNo"  => "學號",
            "b.ChtName"    => "姓名",
            "b.PersonalID" => "身分證",
            "d.ClassName"  => "班級",
            "b.StdState"   => "在學狀態",
        ));
    }

    public function getStuChangeEvent($aParams = array())
    {
        $sSelect = implode(', ', $this->aField['getStuChangeEvent']);

        $sTable = $this->Table;

        $aCondition = BaseModel::setWhere($aParams);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];

        $sSql = "
           SELECT {$sSelect}
             FROM tStuChangeEvent a
        LEFT JOIN vStuStudentAll b ON a.StudentID = b.StudentID
        LEFT JOIN tStuStdClassHist c ON a.StudentID = c.StudentID
        							AND a.ACADYear = c.Year
        							AND a.Semester = c.Semester
        LEFT JOIN tClassAll d ON c.Year = d.ACADYear
        					 AND c.Semester = d.Semester
        					 AND c.ClassID = d.ClassID
           WHERE {$sWhere}
		";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
