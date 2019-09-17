<?php

namespace App\Database\ACAD\tStudent\Repo;

use App\Alltop\BaseModel;
use App\Database\ACAD\tStudent\Model\tStudent;
use Illuminate\Support\Facades\DB;

class tStudentRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStudent";
        $this->Msg   = "在籍生";

        $this->aField['getStudent'] = array_keys(array(
            "b.*"                            => "新生ID",
            "c.ClassName"                    => "班級名稱",
            "d.EnrollTypeName"               => "入學管道",
            "a.Year"                         => "學年",
            "a.Semester"                     => "學期",
            "e.GuardianName"                 => "監護人資料",
            "e.GuardianSex"                  => "",
            "e.GuardianEducationLevel"       => "",
            "e.GuardianPhone"                => "",
            "e.GuardianCellPhone"            => "",
            "e.GuardianAddress"              => "",
            "e.GuardianNeb"                  => "",
            "e.GuardianRoad"                 => "",
            "e.GuardianVill"                 => "",
            "e.GuardianZipCode"              => "",
            "e.GuardianSeq"                  => "",
            "e.GuardianCity"                 => "",
            "e.GuardianDistrict"             => "",
            "e.GuardianProfessionID"         => "",
            "e.GuardianRelationID"           => "",
            "f.paracodename as StdstateName" => "",
        ));
    }

    public function enrGuestSearch($aParam = array())
    {
        $sClassType_srh  = isset($aParam['classType_srh']) ? $aParam['classType_srh'] : null;
        $sPersonalID_srh = isset($aParam['personalID_srh']) ? $aParam['personalID_srh'] : null;
        $sBirthday_srh   = isset($aParam['birthday_srh']) ? $aParam['birthday_srh'] : null;
        //學制下拉
        $sWhere = ' 1 = 1 ';
        $aParam = array();

        if ($sClassType_srh) {
            $sWhere .= " AND ClassTypeID = ? ";
            $aParam[] = $sClassType_srh;
        }

        if ($sPersonalID_srh) {
            $sWhere .= " AND PersonalID = ? ";
            $aParam[] = $sPersonalID_srh;
        }

        if ($sBirthday_srh) {
            $sBirthday = substr($sBirthday_srh, 0, 4) . '-' . substr($sBirthday_srh, 4, 2) . '-' . substr($sBirthday_srh, 6, 2);
            //dd($sBirthday);
            $sWhere .= " AND Birthday = ? ";
            $aParam[] = $sBirthday_srh;
        }

        $sTable = 'tStudent';

        $sSql = "
            SELECT *
              FROM {$sTable}
             WHERE {$sWhere}
          ORDER BY EnrollYear DESC";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //學籍資料
    public function getStudent($aParams = array())
    {
        $sSelect = implode(', ', $this->aField['getStudent']);

        $sTable = $this->Table;

        $aCondition = BaseModel::setWhere($aParams);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];

        $sSql = "
        SELECT {$sSelect}
          FROM tStuStdClassHist a
     LEFT JOIN vStuStudentAll b ON a.StudentID = b.StudentID
     LEFT JOIN tClassAll c ON a.ClassID = c.ClassID
                          AND a.Year = c.ACADYear
                          AND a.Semester = c.Semester
     LEFT JOIN tEnrEnrollType d ON b.EnrollTypeID = d.EnrollTypeID
     LEFT JOIN (select top 1 *
                 from tStuGuardian
             order by GuardianSeq asc) e ON e.StudentID = a.StudentID
     LEFT JOIN tPara f ON a.Stdstate = f.paracodeno AND f.parano = 'StdState'
         WHERE {$sWhere}
      ORDER BY c.UnitNo, c.Grade";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public function getStudentHistYearCombo()
    {
        $sStuNo = session('user_id') ?? '110407022';
        $combo  = tStudent::join('tStuStdClassHist', 'tStudent.StudentID', '=', 'tStuStdClassHist.StudentID')
            ->where('StudentNo', $sStuNo)
            ->select(DB::raw('distinct Year as value, Year as text'))
            ->get()->toArray();
        return $combo;
    }
}
