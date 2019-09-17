<?php

namespace App\Database\eOffice;

use App\Alltop\BaseModel;
use DB;
use Illuminate\Database\Eloquent\Model;

class SysUser extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysUser';

    public $fillable = array(
        'user_number', 'user_name', 'password',
        'authorize', 'login_last_ip', 'login_last_time',
        'login_count', 'eff_date', 'ip_check', 'language',
        'remark', 'favourite',
    );

    public $primaryKey = 'user_number';

    public $timestamps = false;

    public $incrementing = false;

    public static function getGroupAuth(array $filter = array())
    {
        $filters = BaseModel::setWhere($filter);
        $where   = $filters["where"];
        $param   = $filters["param"];

        $sql = "
            SELECT *
            FROM (
                SELECT user_number
                , (
                    SELECT CAST(group_number AS NVARCHAR) + '|'
                    FROM tSysGroupUser
                    WHERE user_number = a.user_number
                    FOR XML PATH('')
                ) AS auth
                FROM tSysUser a
            ) a
            WHERE {$where}";
        $return = DB::connection('eOffice')->select($sql, $param);

        return $return;
    }

    public static function getMenuAuth(array $filter = array())
    {
        $filters = BaseModel::setWhere($filter);
        $where   = $filters["where"];
        $param   = $filters["param"];

        $sql = "
            SELECT *
            FROM (
                SELECT user_number
                , (
                    SELECT CAST(menu_number AS NVARCHAR) + '|'
                    FROM tSysUserGrant
                    WHERE user_number = a.user_number
                    FOR XML PATH('')
                ) AS auth
                FROM tSysUser a
            ) a
            WHERE {$where}";
        $return = DB::connection('eOffice')->select($sql, $param);

        return $return;
    }
}
