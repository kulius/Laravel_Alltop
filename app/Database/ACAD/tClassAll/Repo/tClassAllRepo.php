<?php

namespace App\Database\ACAD\tClassAll\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tClassAllRepo
{
    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tClassAll";
        $this->Msg   = "學期班級總表";
    }

    public function read($aParam = array())
    {
        $aCondition = BaseModel::setWhere($aParam);
        $sWhere     = $aCondition['where'];
        $aParams    = $aCondition['param'];

        $aField = array_keys(array(
            "ACADYear"      => "學年度",
            "Semester"      => "學期",
            "ClassID"       => "班級ID",
            "ClassNo"       => "班級代碼",
            "ClassName"     => "班級名稱",
            "ClassENGName"  => "班籍英文名稱",
            "ClassAlias"    => "班級簡稱",
            "UnitID"        => '系所ID',
            "UnitNo"        => "系所代碼",
            "DayfgID"       => "部別代碼",
            "ClassTypeID"   => "學制ID",
            "ClassTypeName" => "學制名稱",
            "StudyGroupID"  => "組別ID",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tClassAll';
        $sSql    = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}";

        return DB::connection('ACAD')->select($sSql, $aParams);
    }

    //取得某年度學期的系所名稱、ID、部別等相關資料
    public function getUnitName($sYear, $sSemester, $sStudentNo)
    {

        //學生原系所
        $aParam = array();
        $sWhere = 'a.StudentNo = ? ';
        $sWhere .= ' AND b.Year = ? ';
        $sWhere .= ' AND b.Semester = ? ';
        $aParam[] = $sStudentNo;
        $aParam[] = $sYear;
        $aParam[] = $sSemester;

        $aColumn = array(
            'b.Grade'        => '年級',
            'b.ClassNo'      => '班級代碼',
            'b.ClassID'      => '班級ID',
            'b.ClassTypeID'  => '學制ID',
            'b.DayfgID'      => '部別ID',
            'b.StudyGroupID' => '組別ID',
            'b.UnitID'       => '系所ID',
            'c.ClassName'    => '班級名稱',
        );
        $sColumn = implode(', ', array_keys($aColumn));

        //學生下拉年度學期的系所名稱資料
        $sSql = "SELECT distinct c.UnitID, c.UnitName FROM vStuStudentAll a
                        left join tStuStdClassHist b on a.StudentID = b.StudentID
                        left join tClassAll c on b.DayfgID = c.DayfgID
                        and b.ClassTypeID = c.ClassTypeID
                        and b.Year = c.ACADYear
                        and b.Semester = c.Semester
                        and b.UnitID = c.UnitID
                        and b.ClassID = c.ClassID
                        where $sWhere";
        //應該撈出來只會有一筆，null 代表年度怪怪的，選錯年
        return DB::connection('ACAD')->select($sSql, $aParam)[0];
    }

}
