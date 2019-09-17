<?php

namespace App\Database\ACAD\tStuNewStudent\Repo;

use App\Alltop\BaseModel;
use App\Database\ACAD\Model\tStuNewStudent\Model\tStuNewStudent;
use App\Database\ACAD\tDayfg\Model\tDayfg;
use Illuminate\Support\Facades\DB;

class StudentNoGenerator
{
    private $oNewStudent = null;
    public function setStudentByID($guid)
    {
        $this->oNewStudent = tStuNewStudent::find($guid);
        return $this;
    }

    public function setStudentByObject($oStu)
    {
        $this->oNewStudent               = new \stdClass();
        $this->oNewStudent->EnrollYear   = $oStu->EnrollYear; //須確保 $oStu 有先設定EnrollYear
        $this->oNewStudent->DayfgID      = $oStu->DayfgID;
        $this->oNewStudent->ClassTypeID  = $oStu->ClassTypeID;
        $this->oNewStudent->UnitID       = $oStu->UnitID;
        $this->oNewStudent->StudyGroupID = $oStu->StudyGroupID;
        return $this;
    }

    public function createStudentNoByType()
    {
        static $aDayfg = null;
        $aDayfg        = isset($aDayfg) ? $aDayfg : tDayfg::all();

        //尋找對應的部別
        foreach ($aDayfg as $item) {
            if ($item['DayfgID'] == $this->oNewStudent->DayfgID) {
                $studentType = $item['Dayfg'];
            }
        }

        $sStudentNo = null;
        switch ($studentType) {
            //日間學制: 本校生
            case 1:
                $sStudentNo = $this->getDayDivisionStuNo();
                break;
            case 2:
                $sStudentNo = $this->getNightSchoolStuNo();
                break;
        }
        return $sStudentNo;
    }

    public function DaySchoolLocalStuPrefix()
    {
        //使用 Guid ，進行查詢學生相關資料，
        $aParam   = array();
        $sWhere   = ' NewStdID = ? ';
        $aParam[] = $this->oNewStudent->NewStdID;

        $sSql = "select
        LEFT(b.Dayfg,1)+
        RIGHT('000'+ CAST((a.EnrollYear - a.EnterGrade + 1) AS VARCHAR) ,3)+
        left(c.UnitNo,2)+
        LEFT(ISNULL(d.StudyGroup,'0'),1) as 'prefix'
        from tStuNewStudent a
        join tDayfg b
            on a.DayfgID=b.DayfgID
        join tUnit c
            on a.UnitID=c.UnitID
        left join tStudyGroup d
            on a.UnitID=d.UnitID
            and a.StudyGroupID=d.StudyGroupID
        where b.Dayfg= 1 and $sWhere
        and exists(
            select 1
            from tUnitClassType
            where DayfgID=a.DayfgID
            and ClassTypeID=a.ClassTypeID
            and UnitID=a.UnitID
            and StudyGroupID=a.StudyGroupID
            and IsOffical='1'
        )";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public function getDayDivisionStuNo(array $aParams = array())
    {
        $DayfgID      = isset($this->oNewStudent->DayfgID) ? $this->oNewStudent->DayfgID : null;
        $EnrollYear   = isset($this->oNewStudent->EnrollYear) ? $this->oNewStudent->EnrollYear : null;
        $ClassTypeID  = isset($this->oNewStudent->ClassTypeID) ? $this->oNewStudent->ClassTypeID : null;
        $UnitID       = isset($this->oNewStudent->UnitID) ? $this->oNewStudent->UnitID : null;
        $StudyGroupID = isset($this->oNewStudent->StudyGroupID) ? $this->oNewStudent->StudyGroupID : null;
        $aData        = $this->DaySchoolLocalStuPrefix();
        //TODO::資料庫目前資料有缺，可能會報錯，且找出的結果可能不只一筆
        $StudentNoPrefix = $aData[0]['prefix'];

        if ($DayfgID == null || $EnrollYear == null || $ClassTypeID == null || $UnitID == null || $StudyGroupID == null || $StudentNoPrefix == null) {
            throw new \Exception("取得最大流水號條件不足", 1);
        }

        $aFilter   = array();
        $aFilter[] = array(" DayfgID = ? ", $DayfgID);
        //$aFilter[] = array("EnrollYear = ?", $EnrollYear);
        $aFilter[] = array(" ClassTypeID = ? ", $ClassTypeID);
        $aFilter[] = array(" UnitID = ? ", $UnitID);
        $aFilter[] = array(" StudyGroupID = ? ", $StudyGroupID);
        $aFilter[] = array(" LEFT(StudentNo,7) LIKE ? ", $StudentNoPrefix . '%');
//(? + '%' )
        $aCondition = BaseModel::setWhere($aFilter);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];
        $sSql       = "DECLARE @StuNo VARCHAR(2) = (SELECT RIGHT(Max(StudentNo), 2)
        FROM tStuNewStudent
        WHERE NewStdState IN ('1','2','3') AND $sWhere
       );

        IF @StuNo IS NOT NULL
        SELECT RIGHT('00' + CAST(@StuNo + 1 AS VARCHAR), 2) as 'serialNum'
        ELSE
        SELECT '01' as serialNum ";
        $aData = DB::connection('ACAD')->select($sSql, $aParam);

        $sSerialNum = $aData[0]['serialNum'];
        return $StudentNoPrefix . $sSerialNum;
    }

    public function NightSchoolLocalStuPrefix()
    {
        //使用 Guid ，進行查詢學生相關資料，
        $aParam   = array();
        $sWhere   = ' NewStdID = ? ';
        $aParam[] = $this->oNewStudent->NewStdID;
        $sSql     = "select
        LEFT(b.Dayfg,1)+
        RIGHT('000'+ CAST((a.EnrollYear - a.EnterGrade + 1) AS VARCHAR) ,3)+
        left(c.UnitNo,2) as 'prefix'
        from tStuNewStudent a
        join tDayfg b
            on a.DayfgID=b.DayfgID
        join tUnit c
            on a.UnitID=c.UnitID
        left join tStudyGroup d
            on a.UnitID=d.UnitID
            and a.StudyGroupID=d.StudyGroupID
        where b.Dayfg= 2 and $sWhere
        and exists(
            select 1
            from tUnitClassType
            where DayfgID=a.DayfgID
            and ClassTypeID=a.ClassTypeID
            and UnitID=a.UnitID
            and StudyGroupID=a.StudyGroupID
            and IsOffical='1'
        )";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public function getNightSchoolStuNo(array $aParams = array())
    {
        $DayfgID         = isset($this->oNewStudent->DayfgID) ? $this->oNewStudent->DayfgID : null;
        $EnrollYear      = isset($this->oNewStudent->EnrollYear) ? $this->oNewStudent->EnrollYear : null;
        $ClassTypeID     = isset($this->oNewStudent->ClassTypeID) ? $this->oNewStudent->ClassTypeID : null;
        $UnitID          = isset($this->oNewStudent->UnitID) ? $this->oNewStudent->UnitID : null;
        $StudyGroupID    = isset($this->oNewStudent->StudyGroupID) ? $this->oNewStudent->StudyGroupID : null;
        $aData           = $this->NightSchoolLocalStuPrefix();
        $StudentNoPrefix = $aData[0]['prefix'];

        if ($DayfgID == null || $EnrollYear == null || $ClassTypeID == null || $UnitID == null || $StudyGroupID == null || $StudentNoPrefix == null) {
            throw new \Exception("取得最大流水號條件不足", 1);
        }
        $aFilter   = array();
        $aFilter[] = array("DayfgID = ?", $DayfgID);
        //$aFilter[] = array("EnrollYear = ?", $EnrollYear);
        $aFilter[] = array("ClassTypeID = ?", $ClassTypeID);
        $aFilter[] = array("UnitID = ?", $UnitID);
        $aFilter[] = array("StudyGroupID = ?", $StudyGroupID);
        $aFilter[] = array("LEFT(StudentNo,6) like '?%'", $StudentNoPrefix);

        $aCondition = BaseModel::setWhere($aFilter);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];
        $sSql       = "DECLARE @StuNo VARCHAR(2) = (SELECT RIGHT(Max(StudentNo), 2)
        FROM tStuNewStudent
        WHERE NewStdState IN ('1','2','3') AND $sWhere
       );
        IF @StuNo IS NOT NULL
        SELECT RIGHT('000' + CAST(@StuNo + 1 AS VARCHAR), 3) as 'serialNum'
        ELSE
        SELECT '001' as serialNum ";
        //, $aParam
        $aData      = DB::connection('ACAD')->select($sSql, $aParam);
        $sSerialNum = $aData[0]['serialNum'];
        return $StudentNoPrefix . $sSerialNum;
    }
}
