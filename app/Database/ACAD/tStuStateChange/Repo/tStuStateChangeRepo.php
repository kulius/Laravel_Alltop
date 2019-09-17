<?php

namespace App\Database\ACAD\tStuStateChange\Repo;

use Illuminate\Support\Facades\DB;

class tStuStateChangeRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tBhrRPReasonKind";
        $this->Msg   = "獎懲條款";
    }

    public function StateChangeWithStudent(array $aParams = null)
    {
        $sYear         = $aParams['ACADYear'] ?? null;
        $sSemester     = $aParams['Semester'] ?? null;
        $sDayfgID      = $aParams['DayfgID'] ?? null;
        $sClassTypeID  = $aParams['ClassTypeID'] ?? null;
        $sUnitID       = $aParams['UnitID'] ?? null;
        $sStudyGroupID = $aParams['StudyGroupID'] ?? null;
        $sGrade        = $aParams['Grade'] ?? null;
        $sClassID      = $aParams['ClassID'] ?? null;

        $sChangeKindID = $aParams['ChangeKindID'] ?? null;
        $sApplyDateBeg = $aParams['ApplyDateBeg'] ?? null;
        $sApplyDateEnd = $aParams['ApplyDateEnd'] ?? null;
        $sChgKind      = $aParams['ChangeKind'] ?? null;

        $sWhere = ' 1 = 1 ';
        $aParam = array();

        if ($sYear) {
            $sWhere .= ' AND a.ACADYear = ? ';
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
        if ($sGrade) {
            $sWhere .= ' AND a.Grade = ? ';
            $aParam[] = $sGrade;
        }
        if ($sClassID) {
            $sWhere .= ' AND a.ClassID = ? ';
            $aParam[] = $sClassID;
        }

        if ($sChangeKindID) {
            $sWhere .= 'AND a.ChangeKind > ?';
            $aParam[] = $sChangeKindID;
        }

        if ($sApplyDateBeg) {
            $sWhere .= 'AND a.ApplyDate > ?';
            $aParam[] = $sApplyDateBeg;
        }
        if ($sApplyDateEnd) {
            $sWhere .= 'AND a.ApplyDate < ?';
            $aParam[] = $sApplyDateEnd;
        }

        if ($sChgKind) {
            $sWhere .= 'AND a.ChangeKind = ?';
            $aParam[] = $sChgKind;
        }

        $sSql = "select a.ChangeLogID, convert(varchar, a.ApplyDate, 111) as ApplyDate, convert(varchar, a.ApprovedDate, 111) as ApprovedDate
        , a.Memo, a.ChangeKind, a.ChgReasonID, a.ApprovedNo,  b.StudentNo, b.ChtName, c.ClassName, a.ACADYear, a.Semester, a.SuspendSemester
				 from tStuStateChange a
				 left join vStuStudentAll b on a.StudentID = b.StudentID
				  left join tStuStdClassHist d on b.StudentID = d.StudentID and d.Year = a.ACADYear and d.Semester = a.Semester
				 left join tClassAll c on c.ACADYear = a.ACADYear and c.Semester = a.Semester and d.ClassID = c.ClassID
				 where $sWhere";
        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
