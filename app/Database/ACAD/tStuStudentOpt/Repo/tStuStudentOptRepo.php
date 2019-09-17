<?php

namespace App\Database\ACAD\tStuStudentOpt\Repo;

use App\Database\ACAD\ACADSysvar\Model\tStuStudentOpt;
use Illuminate\Support\Facades\DB;

class tStuStudentOptRepo
{

    public function __construct()
    {
        $this->DB                   = "ACAD";
        $this->Table                = "tStuStudentOpt";
        $this->Msg                  = "學籍特殊欄位表";
        $this->aField['newStudent'] = array(
            'StudentOptDetailName' => '學籍身分明細',
        );
    }

    public function Option(string $sStudentOpt)
    {
        $sStudentOpt = isset($sStudentOpt) ? $sStudentOpt : null;

        $sWhere = ' 1 = 1 ';
        $aParam = array();
        if ($sStudentOpt) {
            $sWhere .= ' AND a.StudentOpt = ? ';
            $aParam[] = $sStudentOpt;
        }
        //先全撈
        $sSelect = ' * ';
        $sTable  = 'tStuStudentOpt';

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable} a
          join tStuStudentOptDetail b
          on a.StudentOptID = b.StudentOptID
         WHERE {$sWhere}";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public function newStuData($aParam = array())
    {
        $sSelect = implode(', ', $aSelect);

        $sTable = $this->Table;

        $aCondition = BaseModel::setWhere($aParam);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];

        $sSql = "
        SELECT {$sSelect}
          FROM {$sTable} a
     LEFT JOIN tDayfg b ON a.DayfgID = b.DayfgID
     LEFT JOIN tClassType c ON a.ClassTypeID = c.ClassTypeID
     LEFT JOIN tUnit d ON a.UnitID = d.UnitID
     LEFT JOIN tUnit e ON d.upper = e.UnitID
     LEFT JOIN tStudyGroup f ON a.StudyGroupID = f.StudyGroupID
     LEFT JOIN tEnrEnrollType g ON a.EnrollTypeID = g.EnrollTypeID
     WHERE {$sWhere}
      ORDER BY b.Dayfg, c.ClassType, d.UnitNo";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
