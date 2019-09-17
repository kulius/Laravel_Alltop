<?php

namespace App\Database\eOffice;

use App\Alltop\BaseModel;
use DB;
use Illuminate\Database\Eloquent\Model;

class SysGroup extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysGroup';

    public $fillable = array(
        'group_number', 'group_name', 'group_remark',
    );

    public $primaryKey = 'group_number';

    public $timestamps = false;

    public $incrementing = false;

    public static function getMenuAuth(array $filter = array())
    {
        $filters = BaseModel::setWhere($filter);
        $where   = $filters["where"];
        $param   = $filters["param"];

        $sql = "
            SELECT *
            FROM (
                SELECT group_number
                , (
                    SELECT CAST(menu_number AS NVARCHAR) + '|'
                    FROM tSysGroupGrant
                    WHERE group_number = a.group_number
                    FOR XML PATH('')
                ) AS auth
                FROM tSysGroup a
            ) a
            WHERE {$where}";
        $return = DB::connection('eOffice')->select($sql, $param);

        return $return;
    }

    public static function getUserAuth(array $filter = array())
    {
        $filters = BaseModel::setWhere($filter);
        $where   = $filters["where"];
        $param   = $filters["param"];

        $sql = "
            SELECT *
            FROM (
                SELECT group_number
                , (
                    SELECT CAST(user_number AS NVARCHAR) + '|'
                    FROM tSysGroupUser
                    WHERE group_number = a.group_number
                    FOR XML PATH('')
                ) AS auth
                FROM tSysGroup a
            ) a
            WHERE {$where}";
        $return = DB::connection('eOffice')->select($sql, $param);

        return $return;
    }
}
