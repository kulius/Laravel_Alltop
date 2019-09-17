<?php

namespace App\Database\ACAD\tELCStudent\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tELCStudentRepo
{
    public function __construct()
    {
        $this->DB                     = "ACAD";
        $this->Table                  = "tELCStudent";
        $this->Msg                    = "語言班學生";
        $this->aField['studentScore'] = array(
            'b.StudentID'     => '學生ID',
            'b.ClassCourseID' => '班級課程ID',
            'a.StudentNo'     => '學號',
            'a.Passport'      => '護照號碼',
            'a.ChtName'       => '中文名字',
            'a.FirstName'     => '英文名字',
            'a.MiddleName'    => '英文名字',
            'a.LastName'      => '英文名字',
            'b.Attendance'    => '出席成績',
            'b.HomeWork'      => '作業成績',
            'b.Participation' => '平時成績',
            'b.FinalTest'     => '期末成績',
            'b.Quizzes'       => '測驗成績',
            'b.Listening'     => '聽力成績',
            'b.Speaking'      => '說話成績',
            'b.Reading'       => '閱讀成績',
            'b.Writing'       => '書寫成績',
        );
    }

    public function getStudentWithScore(array $aParam = array())
    {

        $aCondition = BaseModel::setWhere($aParam);
        $sWhere     = $aCondition['where'];
        $sParams    = $aCondition['param'];
        $sSelect    = implode(' ,', array_keys($this->aField['studentScore']));
        $sSql       = "SELECT $sSelect
		FROM tELCStudent a
        LEFT JOIN tELCClassStdScore b
        ON a.studentid = b.studentid Where $sWhere";
        return DB::connection('ACAD')->select($sSql, $sParams);
    }
}
