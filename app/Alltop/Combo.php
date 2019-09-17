<?php

namespace App\Alltop;

use App\Database\ACAD\tClassAll\Model\tClassAll;
use App\Database\ACAD\tStudent\Model\tStudent;
use Illuminate\Support\Facades\DB;

class Combo
{

    //學年 Year_combo()
    //學期 Semester_combo()
    //部別 Dayfg_combo()
    //學制 ClassType_combo()
    //學院 College_combo()
    //系所 Unit_combo()
    //年度系所下拉 YearUnit_combo()
    //學程 UnitClassType_combo()
    //年度學程 YearUnitClassType_combo()
    //班級下拉 Class_combo() table: tClass
    //年度班級下拉 ClassYear_combo() table: tClassAll
    //年級下拉 Grade_combo()
    //入學管道 EnrollType_combo()
    //系統參數下拉 Para_combo()  (尚未完工)
    //學籍特殊欄位下拉
    //請假類別下拉
    //勤缺類別下拉
    //學生課程下拉
    //老師授課課程下拉
    //季別下拉 Season_combo
    //語言中心班級下拉 ELCClass_combo
    //語言中心課程下拉 ELCClassCourse_combo
    //學年
    //課程架構下拉 tCusStudyCourse table: CusStudyCourse_combo()
    //單位下拉 Dep_combo
    //系組別下拉 StudyGroup_combo
    //學生下拉 StudentWithNo_combo
    /**
     * 學生與班級歷程的年度下拉 getStudentHistYearCombo($sStudentNo)
     * 傳遞學號近來，即可取得學生在班級歷程有哪些年度
     */

    /**
     * 傳遞
     */
    public function Year_combo(&$current_year = '', $sYear = null, $year_type = 'stu_year')
    {

        if ($sYear == null) {
            $oRecord = \App\Database\ACAD\ACADSysvar\Model\tACADSysvar::where(array('var' => $year_type))->first();
            if (isset($oRecord)) {
                $sYear = $oRecord->content;
            }
        }

        $aReturn    = array();
        $sStartYear = $sYear - 5;

        $sEndYear = $sYear + 5;

        for ($year = $sStartYear; $year <= $sEndYear; $year++) {
            $aReturn[] = array("value" => "{$year}", "text" => "{$year}");
        }
        $current_year = $current_year != '' ? $current_year : $aReturn[5]['value'];
        return $aReturn;
    }

    //學期
    public function Semester_combo($aType = array(1))
    {
        $aField = array_keys(array(
            "Semester AS [value]"    => "學期代碼",
            "SemesterName AS [text]" => "學期名稱",
        ));

        $sSelect = implode($aField, ', ');

        $sType = trim(implode($aType, ','), ',');

        $sWhere = " SemesterType IN ({$sType}) ";
        $sTable = 'tSemester';

        $sSql = "
             SELECT {$sSelect}
               FROM {$sTable}
              WHERE {$sWhere}
           ORDER BY seq";

        return DB::connection('ACAD')->select($sSql);
    }

    /*
     * 部別下拉
     *
     */
    public function Dayfg_combo()
    {
        $aField = array_keys(array(
            "DayfgID AS [value]"  => "部別ID",
            "DayfgName AS [text]" => "部別名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tDayfg';
        $sWhere  = " state = 1 ";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}
          ORDER BY Dayfg";

        return DB::connection('ACAD')->select($sSql);
    }

    //學制
    public function ClassType_combo($sDayfgID = null)
    {
        //條件
        $sWhere = ' 1 = 1 ';
        $aParam = array();
        if ($sDayfgID) {
            $sWhere .= "AND EXISTS(
                              SELECT 1 FROM tDayfgClassType aa WHERE aa.DayfgID = ? AND tClassType.ClassTypeID = aa.ClassTypeID
                          )";
            $aParam[] = $sDayfgID;
        }

        $aField = array_keys(array(
            "ClassTypeID AS [value]"  => "學制代碼",
            "ClassTypeName AS [text]" => "學制名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tClassType';

        $sSql = "
              SELECT {$sSelect}
              FROM {$sTable}
              WHERE {$sWhere}
              ORDER BY ClassType";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    /**
     * 學院下拉
     */
    public function College_combo($aParams = array())
    {
        $sDayfgID     = isset($aParams["DayfgID"]) ? $aParams["DayfgID"] : null;
        $sClassTypeID = isset($aParams["ClassTypeID"]) ? $aParams["ClassTypeID"] : null;

        //條件
        $aWhere = array();
        $aParam = array();

        $sWhere = " 1 = 1 ";

        $sInWhere = "";
        if ($sDayfgID) {
            $sInWhere .= " AND aa.DayfgID = ? ";
            $aParam[] = $sDayfgID;
        }
        if ($sClassTypeID) {
            $sInWhere .= " AND aa.ClassTypeID = ? ";
            $aParam[] = $sClassTypeID;
        }
        if ($sInWhere != "") {
            $sWhere = " EXISTS(SELECT 1 FROM tUnitClassType aa WHERE 1 = 1 " . $sInWhere . "
                        AND b.UnitID = aa.UnitID)";
        }
        $sWhere .= " GROUP BY a.UnitName, a.UnitID";

        $aField = array_keys(array(
            "a.UnitID AS [value]"  => "學院ID",
            "a.UnitName AS [text]" => "學院名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tUnit';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
        INNER JOIN tUnit b ON a.UnitID = b.upper
             WHERE {$sWhere}";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    /**
     * 系所下拉
     */
    public function Unit_combo($aParams = array())
    {
        $sDayfgID     = isset($aParams["DayfgID"]) ? $aParams['DayfgID'] : null;
        $sClassTypeID = isset($aParams["ClassTypeID"]) ? $aParams['ClassTypeID'] : null;
        $sCollegeID   = isset($aParams["CollegeID"]) ? $aParams['CollegeID'] : null;

        //條件
        $sWhere = '';
        $aParam = array();

        $sWhere .= "1 = 1 AND tUnit.state=1 AND tUnit.upper <> '0' ";
        $sInWhere = "";

        if ($sDayfgID) {
            $sInWhere .= " AND aa.DayfgID = ?";
            $aParam[] = $sDayfgID;
        }
        if ($sClassTypeID) {
            $sInWhere .= " AND aa.ClassTypeID = ?";
            $aParam[] = $sClassTypeID;
        }
        if ($sCollegeID) {
            $sInWhere .= " AND tUnit.upper = ? ";
            $aParam[] = $sCollegeID;
        }
        if ($sInWhere != "") {
            $sWhere .= "AND EXISTS(SELECT 1 FROM tUnitClassType aa WHERE 1 = 1 " . $sInWhere . " AND tUnit.UnitID = aa.UnitID)";
        }
        $aField = array_keys(array(
            "tUnit.UnitID AS [value]"  => "科系ID",
            "tUnit.UnitName AS [text]" => "科系名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tUnit';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} AS tUnit
        INNER JOIN tUnit b ON tUnit.upper = b.UnitID
             WHERE {$sWhere}
          ORDER BY tUnit.UnitCode";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    /**
     * 年度系所下拉
     * note: 額外 leftjoin tUnitYear
     */
    public function UnitYear_combo(array $aParams = array())
    {
        $sACADYear    = isset($aParams["ACADYear"]) ? $aParams["ACADYear"] : null;
        $sDayfgID     = isset($aParams["DayfgID"]) ? $aParams['DayfgID'] : null;
        $sClassTypeID = isset($aParams["ClassTypeID"]) ? $aParams['ClassTypeID'] : null;
        $sCollegeID   = isset($aParams["CollegeID"]) ? $aParams['CollegeID'] : null;

        //條件
        $sWhere = '';
        $aParam = array();

        $sWhere .= "1 = 1 AND tUnit.state=1 AND tUnit.upper <> '0' ";
        $sInWhere = "";

        if ($sACADYear) {
            $sInWhere .= " AND c.ACADYear = ?";
            $aParam[] = $sACADYear;
        }

        if ($sDayfgID) {
            $sInWhere .= " AND aa.DayfgID = ?";
            $aParam[] = $sDayfgID;
        }
        if ($sClassTypeID) {
            $sInWhere .= " AND aa.ClassTypeID = ?";
            $aParam[] = $sClassTypeID;
        }
        if ($sCollegeID) {
            $sInWhere .= " AND tUnit.upper = ? ";
            $aParam[] = $sCollegeID;
        }
        if ($sInWhere != "") {
            $sWhere .= "AND EXISTS(SELECT 1 FROM tUnitClassType aa WHERE 1 = 1 " . $sInWhere . " AND tUnit.UnitID = aa.UnitID)";
        }
        $aField = array_keys(array(
            "tUnit.UnitID AS [value]" => "科系ID",
            "c.UnitName AS [text]"    => "科系名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tUnit';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} AS tUnit
        INNER JOIN tUnit b ON tUnit.upper = b.UnitID
         LEFT JOIN tUnitYear c ON tUnit.UnitID = c.UnitID
             WHERE {$sWhere}
          ORDER BY tUnit.UnitCode";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //班級下拉
    public function Class_combo(array $aParam = array())
    {

        $aField = array_keys(array(
            "ClassID AS [value]"  => "班級ID",
            "ClassName AS [text]" => "班級名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tClass';
        $sWhere  = " state = 1 ";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}
          ORDER BY ClassUniqueNo";

        return DB::connection('ACAD')->select($sSql);
    }

    //年度班級下拉
    public function ClassYear_combo(array $aParams = array())
    {
        $aWhere        = array();
        $sACADYear     = $aParams['ACADYear'] ?? null;
        $sSemester     = $aParams['Semester'] ?? null;
        $sUnitID       = $aParams['UnitID'] ?? null;
        $sDayfgID      = $aParams['DayfgID'] ?? null;
        $sClassTypeID  = $aParams['ClassTypeID'] ?? null;
        $sGrade        = $aParams['Grade'] ?? null;
        $sStudyGroupID = $aParams['StudyGroupID'] ?? null;
        $aParam        = array();
        if ($sACADYear) {
            $aWhere[] = array('ACADYear', $sACADYear);
            $aParam[] = $sACADYear;
        }
        if ($sSemester) {
            $aWhere[] = array('Semester', $sSemester);
            $aParam[] = $sSemester;
        }
        if ($sUnitID) {
            $aWhere[] = array('UnitID', $sUnitID);
            $aParam[] = $sUnitID;
        }
        if ($sDayfgID) {
            $aWhere[] = array('DayfgID', $sDayfgID);
            $aParam[] = $sDayfgID;
        }
        if ($sClassTypeID) {
            $aWhere[] = array('ClassTypeID', $sClassTypeID);
            $aParam[] = $sClassTypeID;
        }
        if ($sGrade) {
            $aWhere[] = array('Grade', $sGrade);
            $aParam[] = $sGrade;
        }
        if ($sStudyGroupID) {
            $aWhere[] = array('StudyGroupID', $sStudyGroupID);
            $aParam[] = $sStudyGroupID;
        }
        return tClassAll::where($aWhere)->select('ClassName as text', 'ClassID as value')->get()->toArray();
    }

    //班級代碼下拉
    public function ClassNo_combo(array $aParams = array())
    {
        $sACADYear        = isset($aParams["ACADYear"]) ? $aParams["ACADYear"] : null;
        $sSemester        = isset($aParams["Semester"]) ? $aParams["Semester"] : null;
        $sDayfgID         = isset($aParams["DayfgID"]) ? $aParams['DayfgID'] : null;
        $sClassTypeID     = isset($aParams["ClassTypeID"]) ? $aParams['ClassTypeID'] : null;
        $sCollegeID       = isset($aParams["CollegeID"]) ? $aParams['CollegeID'] : null;
        $sUnitID          = isset($aParams["UnitID"]) ? $aParams['UnitID'] : null;
        $sUnitClassTypeID = isset($aParams["UnitClassTypeID"]) ? $aParams['UnitClassTypeID'] : null;
        $sGrade           = isset($aParams["Grade"]) ? $aParams['Grade'] : null;

        $aField = array_keys(array(
            "a.ClassNo AS [value]"  => "班級ID",
            "a.ClassName AS [text]" => "班級名稱",
        ));

        //條件
        $aWhere = array();
        $aParam = array();

        $aWhere[] = " 1 = 1 ";

        if ($sACADYear) {
            $aWhere[] = " AND a.ACADYear = ?";
            $aParam[] = $sACADYear;
        }

        if ($sSemester) {
            $aWhere[] = " AND a.Semester = ?";
            $aParam[] = $sSemester;
        }

        if ($sDayfgID) {
            $aWhere[] = " AND a.DayfgID = ?";
            $aParam[] = $sDayfgID;
        }

        if ($sClassTypeID) {
            $aWhere[] = " AND a.ClassTypeID = ?";
            $aParam[] = $sClassTypeID;
        }

        if ($sCollegeID) {
            $aWhere[] = " AND b.upper = ?";
            $aParam[] = $sCollegeID;
        }

        if ($sUnitID) {
            $aWhere[] = " AND a.UnitID in (select UnitID from tUnitYear where UnitID=? and ACADYear=?)";
            $aParam[] = $sUnitID;
            $aParam[] = $sACADYear;
        }

        if ($sUnitClassTypeID) {
            $aWhere[] = " AND a.UnitClassTypeID = ?";
            $aParam[] = $sUnitClassTypeID;
        }

        if ($sGrade) {
            $aWhere[] = " AND a.Grade = ?";
            $aParam[] = $sGrade;
        }

        $sWhere  = implode("", $aWhere);
        $sSelect = implode(", ", $aField);
        $sTable  = 'tClassAll';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
         LEFT JOIN tUnit b ON a.UnitID = b.UnitID
         LEFT JOIN tDayfg c ON a.DayfgID = c.DayfgID
         LEFT JOIN tClassType d ON a.ClassTypeID = d.ClassTypeID
             WHERE {$sWhere}
          ORDER BY c.Dayfg, d.ClassType, b.UnitCode, a.ClassUniqueNo";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //學程
    public function UnitClassType_combo($aParam = array())
    {
        $sACADYear    = isset($aParam["ACADYear"]) ? $aParam["ACADYear"] : null;
        $sDayfgID     = isset($aParam["DayfgID"]) ? $aParam["DayfgID"] : null;
        $sClassTypeID = isset($aParam["ClassTypeID"]) ? $aParam["ClassTypeID"] : null;
        $sCollegeID   = isset($aParam["CollegeID"]) ? $aParam["CollegeID"] : null;
        $sUnitID      = isset($aParam["UnitID"]) ? $aParam["UnitID"] : null;

        $sWhere = '';
        $aParam = array();
        $sWhere .= " 1 = 1 ";

        // if ($sACADYear) {
        //     $sWhere .= " AND a.ACADYear = ?";
        //     $aParam[] = $sACADYear;
        // }

        if ($sDayfgID) {
            $sWhere .= " AND a.DayfgID = ?";
            $aParam[] = $sDayfgID;
        }

        if ($sClassTypeID) {
            $sWhere .= " AND a.ClassTypeID = ?";
            $aParam[] = $sClassTypeID;
        }

        if ($sCollegeID) {
            $sWhere .= " AND b.upper = ?";
            $aParam[] = $sCollegeID;
        }

        if ($sUnitID) {
            $sWhere .= " AND a.UnitID = ?";
            $aParam[] = $sUnitID;
        }

        $aSelect = array_keys(
            array(
                "a.UnitClassTypeID AS [value]"                               => "學程ID",
                "a.UnitClassTypeName + '-' + f.DayfgClassTypeName AS [text]" => "學程名稱",
            )
        );

        $sSelect = implode($aSelect, ', ');
        $table   = 'tUnitClassType';
        $sSql    = "
            SELECT {$sSelect}
              FROM {$table} a
         LEFT JOIN tUnit b ON a.UnitID = b.UnitID
         LEFT JOIN tDayfg d ON a.DayfgID = d.DayfgID
         LEFT JOIN tClassType e ON a.ClassTypeID = e.ClassTypeID
         LEFT JOIN tDayfgClassType f ON a.DayfgID = f.DayfgID AND a.ClassTypeID = f.ClassTypeID
             WHERE {$sWhere}
          ORDER BY  b.UnitCode,a.UnitClassTypeNo,d.Dayfg, e.ClassType";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    /*
     * 年度學程下拉
     * 額外 leftjoin tUnitClassTypeYear
     */
    public function UnitClassTypeYear_combo($aParam = null)
    {
        $sACADYear    = isset($aParam["ACADYear"]) ? $aParam["ACADYear"] : null;
        $sDayfgID     = isset($aParam["DayfgID"]) ? $aParam["DayfgID"] : null;
        $sClassTypeID = isset($aParam["ClassTypeID"]) ? $aParam["ClassTypeID"] : null;
        $sCollegeID   = isset($aParam["CollegeID"]) ? $aParam["CollegeID"] : null;
        $sUnitID      = isset($aParam["UnitID"]) ? $aParam["UnitID"] : null;

        $sWhere = '';
        $aParam = array();
        $sWhere .= " 1 = 1 ";

        if ($sACADYear) {
            $sWhere .= " AND c.ACADYear = ?";
            $aParam[] = $sACADYear;
        }

        if ($sDayfgID) {
            $sWhere .= " AND a.DayfgID = ?";
            $aParam[] = $sDayfgID;
        }

        if ($sClassTypeID) {
            $sWhere .= " AND a.ClassTypeID = ?";
            $aParam[] = $sClassTypeID;
        }

        if ($sCollegeID) {
            $sWhere .= " AND b.upper = ?";
            $aParam[] = $sCollegeID;
        }

        if ($sUnitID) {
            $sWhere .= " AND a.UnitID = ?";
            $aParam[] = $sUnitID;
        }

        $aSelect = array_keys(
            array(
                "a.UnitClassTypeID AS [value]"                               => "學程ID",
                "c.UnitClassTypeName + '-' + f.DayfgClassTypeName AS [text]" => "學程名稱",
            )
        );

        $sSelect = implode($aSelect, ', ');
        $table   = 'tUnitClassType';
        $sSql    = "
            SELECT {$sSelect}
              FROM {$table} a
         LEFT JOIN tUnit b ON a.UnitID = b.UnitID
         LEFT JOIN tUnitClassTypeYear c ON a.UnitClassTypeID = c.UnitClassTypeID
         LEFT JOIN tDayfg d ON a.DayfgID = d.DayfgID
         LEFT JOIN tClassType e ON a.ClassTypeID = e.ClassTypeID
         LEFT JOIN tDayfgClassType f ON a.DayfgID = f.DayfgID AND a.ClassTypeID = f.ClassTypeID
             WHERE {$sWhere}
          ORDER BY  b.UnitCode,a.UnitClassTypeNo,d.Dayfg, e.ClassType";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    /**
     * 系組別下拉
     */
    public static function StudyGroup_combo(array $aParams = array())
    {
        $aField = array_keys(array(
            "a.StudyGroupID AS [value]"  => "系組別ID",
            "a.StudyGroupName AS [text]" => "系組別名稱",
        ));

        $sDayfgID     = isset($aParams["DayfgID"]) ? $aParams["DayfgID"] : null;
        $sClassTypeID = isset($aParams["ClassTypeID"]) ? $aParams["ClassTypeID"] : null;
        $sUnitID      = isset($aParams["UnitID"]) ? $aParams["UnitID"] : null;

        //條件
        $aWhere = array();
        $aParam = array();

        $aWhere[] = "1 = 1 ";
        $sInWhere = "";

        if ($sDayfgID) {
            $sInWhere .= " AND aa.DayfgID = ?";
            $aParam[] = $sDayfgID;
        }
        if ($sClassTypeID) {
            $sInWhere .= " AND aa.ClassTypeID = ?";
            $aParam[] = $sClassTypeID;
        }
        if ($sUnitID) {
            $sInWhere .= " AND aa.UnitID = ? ";
            $aParam[] = $sUnitID;
        }
        if ($sInWhere != "") {
            $aWhere[] = " AND EXISTS(SELECT 1 FROM tUnitClassType aa WHERE 1 = 1 " . $sInWhere . " AND a.StudyGroupID = aa.StudyGroupID)";
        }

        $sWhere  = implode("", $aWhere);
        $sSelect = implode(", ", $aField);
        $sTable  = "tStudyGroup";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
             WHERE {$sWhere}
          ORDER BY a.StudyGroup";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //年級下拉
    public function Grade_combo(array $aParams = array())
    {
        $sDayfgID     = isset($aParams["DayfgID"]) ? $aParams["DayfgID"] : null;
        $sClassTypeID = isset($aParams["ClassTypeID"]) ? $aParams["ClassTypeID"] : null;
        $sUnitID      = isset($aParams["UnitID"]) ? $aParams["UnitID"] : null;

        //條件
        $aWhere = array();
        $aParam = array();

        $aWhere[] = "1 = 1 ";

        if ($sDayfgID) {
            $aWhere[] = " AND DayfgID = ?";
            $aParam[] = $sDayfgID;
        }
        if ($sClassTypeID) {
            $aWhere[] = " AND ClassTypeID = ?";
            $aParam[] = $sClassTypeID;
        }
        if ($sUnitID) {
            $aWhere[] = " AND UnitID = ? ";
            $aParam[] = $sUnitID;
        }

        $sWhere = implode("", $aWhere);

        //找到最大年級
        $sSql = "
            SELECT MAX(Grade) AS Grade
            FROM (select case when ExtraYears is null then MinYears else ExtraYears end as Grade
                    from tUnitClassType
                    where {$sWhere}
                ) A ";

        $sGrade = DB::connection('ACAD')->select($sSql, $aParam);

        $aReturn = array();
        for ($grade = 1; $grade <= $sGrade[0]['Grade']; $grade++) {
            $aReturn[] = array("value" => "$grade", "text" => "$grade");
        }
        return $aReturn;
    }

    //入學管道
    public function EnrollType_combo($aParams = array())
    {

        //條件
        $aCondition = BaseModel::setWhere($aParams);
        $sWhere     = $aCondition["where"];
        $aParam     = $aCondition["param"];

        $aField = array_keys(array(
            "EnrollTypeID AS [value]"  => "入學管道ID",
            "EnrollTypeName AS [text]" => "入學管道名稱",
        ));
        $sSelect = implode(", ", $aField);
        $sTable  = 'tEnrEnrollType';

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}
          ORDER BY EnrollTypeNo";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //系統參數下拉
    public function Para_combo(array $aParams = array())
    {

        $parano = isset($aParams['parano']) ? $aParams['parano'] : null;

        $aField = array_keys(array(
            "paracodeno AS [value]"  => "參數代碼",
            "paracodename AS [text]" => "參數名稱",
        ));

        $aParam = array();

        $sSelect = implode(", ", $aField);
        $sTable  = 'tPara';
        if ($parano) {
            $sWhere   = 'parano = ?';
            $aParam[] = $parano;
        }

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable}
          WHERE {$sWhere}
       ORDER BY paracodeno";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //學籍特殊欄位下拉
    public function StudentOpt_combo(array $aParams = array())
    {

        $StudentOpt = isset($aParams['StudentOpt']) ? $aParams['StudentOpt'] : null;

        $aField = array_keys(array(
            "b.StudentOptDetailID AS [value]"  => "學籍特殊欄位ID",
            "b.StudentOptDetailName AS [text]" => "學籍特殊欄位選項",
        ));

        $aParam = array();

        $sSelect = implode(", ", $aField);
        $sTable  = 'tStuStudentOpt';
        if ($StudentOpt) {
            $sWhere   = 'a.StudentOpt = ?';
            $aParam[] = $StudentOpt;
        }

        $sSql = "
         SELECT {$sSelect}
           FROM {$sTable} a
      LEFT JOIN tStuStudentOptDetail b ON a.StudentOptID=b.StudentOptID
          WHERE {$sWhere}
       ORDER BY b.StudentOptDetail";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    /**
     * 請假類別下拉
     */
    public function LeaveKind_Combo()
    {
        $aField = array_keys(array(
            "LeaveKindID AS [value]"  => "請假類別ID",
            "LeaveKindName AS [text]" => "請假類別名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrLeaveKind';
        $sWhere  = " state = 1 ";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}
             order by seq";

        return DB::connection('ACAD')->select($sSql);
    }

    /**
     * 勤缺類別下拉
     */
    public function MeetingKind_Combo()
    {
        $aField = array_keys(array(
            "MeetingKindID AS [value]"  => "勤缺類別ID",
            "MeetingKindName AS [text]" => "勤缺類別名稱",
        ));

        $sSelect = implode(", ", $aField);
        $sTable  = 'tBhrMeetingKind';
        $sWhere  = " state = 1 ";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}";

        return DB::connection('ACAD')->select($sSql);
    }

    /**
     * 學生課程下拉
     */
    public function CourseName_Combo(array $aParams = array())
    {

        $sStudentID = isset($aParams['StudentID']) ? $aParams['StudentID'] : null;
        $sACADYear  = isset($aParams['ACADYear']) ? $aParams['ACADYear'] : null;
        $sSemester  = isset($aParams['Semester']) ? $aParams['Semester'] : null;

        $aField = array_keys(array(
            "a.SemesterCourseID AS [value]"                                    => "課程ID",
            "'【'+a.ACADYear+a.Semester+'】'+b.SemesterCourseName AS [text]" => "課程名稱",
        ));

        $sTable = 'tCusSelectedCourse';
        $sWhere = " 1 = 1 ";
        // dd($sStudentID);
        if ($sStudentID) {
            $sWhere .= "AND a.StudentID = ? ";
            $aParam[] = $sStudentID;
        }

        if ($sACADYear) {
            $sWhere .= "AND a.ACADYear = ? ";
            $aParam[] = $sACADYear;
        }

        if ($sSemester) {
            $sWhere .= "AND a.Semester = ? ";
            $aParam[] = $sSemester;
        }
        $sSelect = implode(", ", $aField);

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
              LEFT JOIN tCusSemesterCourse b ON a.SemesterCourseID  = b.SemesterCourseID
             WHERE {$sWhere}
             GROUP BY a.SemesterCourseID,b.SemesterCourseName,a.ACADYear,a.Semester";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    /**
     * 老師授課課程下拉
     */
    public function TeacherCourse_Combo(array $aParams = array())
    {
        $sDEPNO    = isset($aParams['DEPNO']) ? $aParams['DEPNO'] : null;
        $sACADYear = isset($aParams['ACADYear']) ? $aParams['ACADYear'] : null;
        $sSemester = isset($aParams['Semester']) ? $aParams['Semester'] : null;

        $aField = array_keys(array(
            "SemesterCourseID AS [value]"                              => "課程ID",
            "SemesterCourseName+'【'+ StudyClassName+'】' AS [text]" => "課程名稱",
        ));

        $sTable = 'tCusSemesterCourse';
        $sWhere = " 1 = 1 ";

        if ($sACADYear) {
            $sWhere .= "AND ACADYear = ? ";
            $aParam[] = $sACADYear;
        }

        if ($sSemester) {
            $sWhere .= "AND Semester = ? ";
            $aParam[] = $sSemester;
        }

        if ($sDEPNO) {
            $sWhere .= "AND DEPNO = ? ";
            $aParam[] = $sDEPNO;
        }

        $sSelect = implode(", ", $aField);

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable}
             WHERE {$sWhere}
             GROUP BY SemesterCourseID, SemesterCourseName,StudyClassName";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //語言中心季別下拉
    public function ELCSeason_combo()
    {
        $aSeason      = \App\Database\ACAD\tELCSeason\Model\tELCSeason::all();
        $aSeasonCombo = array();
        foreach ($aSeason as $sNum => $aItem) {
            if (!empty($aItem['SeasonEngName'])) {
                $sText = $aItem['SeasonName'] . ' ( ' . $aItem['SeasonEngName'] . ' ) ';
            } else {
                $sText = $aItem['SeasonName'];
            }
            $aSeasonCombo[] = array('value' => $aItem['Season'], 'text' => $sText);
        }
        return $aSeasonCombo;
    }

    //語言中心班級下拉
    public function ELCClass_combo($aParam = array())
    {
        $aField = array_keys(array(
            "ClassID AS [value]"  => "語言班級ID",
            "ClassName AS [text]" => "語言班級名稱",
        ));

        $sTWYear = isset($aParam["TWYear"]) ? $aParam["TWYear"] : null;
        $sSeason = isset($aParam["Season"]) ? $aParam["Season"] : null;

        $sWhere = '';
        $aParam = array();
        $sWhere .= " 1 = 1 ";

        if ($sTWYear) {
            $sWhere .= " AND TWYear = ?";
            $aParam[] = $sTWYear;
        }

        if ($sSeason) {
            $sWhere .= " AND Season = ?";
            $aParam[] = $sSeason;
        }

        $sSelect = implode(", ", $aField);
        $sTable  = "tELCClass";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
             WHERE {$sWhere}
          ORDER BY ClassName";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //語言中心課程下拉
    public function ELCClassCourse_combo($aParam = array())
    {
        $aField = array_keys(array(
            "ClassCourseID AS [value]"  => "語言課程ID",
            "ClassCourseName AS [text]" => "語言課程名稱",
        ));

        $sTWYear  = isset($aParam["TWYear"]) ? $aParam["TWYear"] : null;
        $sSeason  = isset($aParam["Season"]) ? $aParam["Season"] : null;
        $sClassID = isset($aParam["ClassID"]) ? $aParam["ClassID"] : null;

        $sWhere = '';
        $aParam = array();
        $sWhere .= " 1 = 1 ";

        if ($sTWYear) {
            $sWhere .= " AND TWYear = ?";
            $aParam[] = $sTWYear;
        }

        if ($sSeason) {
            $sWhere .= " AND Season = ?";
            $aParam[] = $sSeason;
        }

        if ($sClassID) {
            $sWhere .= " AND ClassID = ?";
            $aParam[] = $sClassID;
        }

        $sSelect = implode(", ", $aField);
        $sTable  = "tELCClassCourse";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
             WHERE {$sWhere}
          ORDER BY ClassCourseName";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    //課程架構下拉
    public function CusStudyCourse_combo(array $aParams)
    {

        /**
         * 常用條件 ACADYear、DayfgID、ClassTypeID、UnitID
         */
        $aCondition = BaseModel::setWhere($aParams);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];

        $sSql = "SELECT StudyCourseID as value, StudyCourseName as text
                FROM tCusStudyCourse
                WHERE $sWhere";
        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    // 單位下拉
    public function Dep_combo($aParam = array())
    {
        $aField = array_keys(array(
            "DEPNO AS [value]"  => "單位代碼",
            "DEPNAME AS [text]" => "單位名稱",
        ));

        $sWhere = '';
        $aParam = array();
        $sWhere .= " 1 = 1 ";

        $sSelect = implode(", ", $aField);
        $sTable  = "SCHOOL.vEMPDEP";

        $sSql = "
            SELECT {$sSelect}
              FROM {$sTable} a
             WHERE {$sWhere}
          ORDER BY DEPNO";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public function StudentWithNo_combo(array $aParams = null)
    {

        $sYear         = $aParams['Year'] ?? null;
        $sSemester     = $aParams['Semester'] ?? null;
        $sDayfgID      = $aParams['DayfgID'] ?? null;
        $sClassTypeID  = $aParams['ClassTypeID'] ?? null;
        $sUnitID       = $aParams['UnitID'] ?? null;
        $sStudyGroupID = $aParams['StudyGroupID'] ?? null;
        $sClassID      = $aParams['ClassID'] ?? null;
        $sGrade        = $aParams['Grade'] ?? null;
        $sWhere        = ' 1 = 1 ';
        $aParam        = array();
        if ($sYear) {
            $sWhere .= ' AND a.Year = ? ';
            $aParam[] = $sYear;
        }
        if ($sSemester) {
            $sWhere .= ' AND a.Semester = ? ';
            $aParam[] = $sSemester;
        }
        if ($sDayfgID) {
            $sWhere .= ' AND a.DayfgID = ? ';
            $aParam[] = $sDayfgID;
        }
        if ($sClassTypeID) {
            $sWhere .= ' AND a.ClassTypeID = ? ';
            $aParam[] = $sClassTypeID;
        }
        if ($sUnitID) {
            $sWhere .= ' AND a.UnitID = ? ';
            $aParam[] = $sUnitID;
        }
        if ($sStudyGroupID) {
            $sWhere .= ' AND a.StudyGroupID = ? ';
            $aParam[] = $sStudyGroupID;
        }
        if ($sClassID) {
            $sWhere .= ' AND a.ClassID = ? ';
            $aParam[] = $sClassID;
        }
        if ($sGrade) {
            $sWhere .= ' AND a.Grade = ? ';
            $aParam[] = $sGrade;
        }

        $sSql = "SELECT a.StudentID as value,
         ChtName + StudentNo as text
        from tStuStdClassHist a
        join tStudent b on a.StudentID = b.StudentID
        WHERE $sWhere ";

        return DB::connection('ACAD')->select($sSql, $aParam);
    }

    public function getStudentHistYearCombo($sStudentNo)
    {
        $combo = tStudent::join('tStuStdClassHist', 'tStudent.StudentID', '=', 'tStuStdClassHist.StudentID')
            ->where('StudentNo', $sStudentNo)
            ->select(DB::raw('distinct Year as value, Year as text'))
            ->get()->toArray();
        return $combo;
    }

    public function getStudentYearUnitCombo($sYear, $sSemester, $sUnitID)
    {
        //下拉系所不能包含原本的系所
        $sWhere   = ' c.UnitID != ? ';
        $aParam[] = $sUnitID;

        $sWhere .= 'AND b.Year = ? ';
        $aParam[] = $sYear;

        $sWhere .= 'AND b.Semester = ? ';
        $aParam[] = $sSemester;

        //下拉系所
        $sSql = "SELECT distinct c.UnitID as value, c.UnitName as text FROM vStuStudentAll a
                            left join tStuStdClassHist b on a.StudentID = b.StudentID
                            left join tClassAll c on b.DayfgID = c.DayfgID
                            and b.Year = c.ACADYear
                            and b.Semester = c.Semester
                            and b.ClassTypeID = c.ClassTypeID
                            where $sWhere";
        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
