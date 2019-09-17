<?php

namespace App\Database\ACAD\tStuModify\Repo;

use App\Alltop\BaseModel;
use Illuminate\Support\Facades\DB;

class tStuModifyRepo
{

    public function __construct()
    {
        $this->DB    = "ACAD";
        $this->Table = "tStuModify";
        $this->Msg   = "學籍欄位開放修改設定";
    }

    public function ModifyDetail(array $aJoinCon = null, array $aParams = null)
    {
        $aCondition = BaseModel::setWhere($aJoinCon);
        $sJoinCon   = $aCondition['where'];
        $aJoinParam = $aCondition['param'];

        $aCondition = BaseModel::setWhere($aParams);
        $sWhere     = $aCondition['where'];
        $aParam     = $aCondition['param'];

        //將兩個條件的參數，依照順序 Join 一起
        $aParam = array_merge($aJoinParam, $aParam);

        $aColumn = array(
            'tStuModify.ModifyKind',
            'tStuModify.ModifyName',
            'tStuModify.RestrictState as FirState',
            'tStuModify.StuModifyDateKind',
            'b.StuModifyDateKind',
            'b.ModifyDateKind',
            'b.ModifyDateBeg',
            'b.ModifyDateEnd',
            'b.RestrictState as SecState',
            'b.ModifyDateID',
            'c.paracodeName as StuModifyDateKindName',
            'c.paracodeno as StuModifyDateKind',
        );

        $sColumn = implode(',', $aColumn);

        $sSql = " SELECT $sColumn FROM tStuModify
                 left join tStuModifyDate as b
                  on tStuModify.StuModifyDateKind = b.StuModifyDateKind AND b.ColumnName = tStuModify.ModifyKind AND $sJoinCon
                  left join tPara c on c.parano = 'StuModifyDateKind' AND c.paracodeno = tStuModify.StuModifyDateKind
                  WHERE $sWhere
                  ";
        return DB::connection('ACAD')->select($sSql, $aParam);
    }
}
