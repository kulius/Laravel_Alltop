<?php

namespace App\Database\eOffice;

use App\Alltop\BaseModel;
use DB;
use Illuminate\Database\Eloquent\Model;

class SysMenu extends Model
{
    public $connection = 'eOffice';

    public $table = 'tSysMenu';

    public $fillable = array(
        'menu_number', 'menu_upper', 'menu_folder'
        , 'menu_name', 'menu_icon', 'menu_module'
        , 'menu_module_custom', 'menu_hide', 'menu_sort',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;

    public static function getAuthInfo(array $filter = array())
    {
        $filters = BaseModel::setWhere($filter);
        $where   = $filters["where"];
        $param   = $filters["param"];

        $return = array();

        //授權資訊
        $sql = "
            SELECT *
            FROM (
                SELECT menu_number
                , (
                    SELECT a.source + ',' + (a.number + '-' + a.name) + '|'
                    FROM (
                        SELECT 'group' AS source, a.menu_number AS menu_number, b.group_number AS number, b.group_name AS name
                        FROM tSysGroupGrant a INNER JOIN tSysGroup b ON a.group_number = b.group_number
                        UNION ALL
                        SELECT 'user', a.menu_number, b.user_number, b.user_name
                        FROM tSysUserGrant a INNER JOIN tSysUser b ON a.user_number = b.user_number
                    ) a
                    WHERE a.menu_number = b.menu_number
                    FOR XML PATH('')
                ) AS auth
                FROM tSysMenu b
                WHERE menu_upper IS NOT NULL
            ) a
            WHERE {$where}";
        $auth_info = DB::connection('eOffice')->select($sql, $param);

        if ($auth_info) {
            foreach ($auth_info as $_key => $_value) {
                $auth = (isset($_value['auth']) ? explode('|', $_value['auth']) : array());
                $auth = array_filter($auth);

                foreach ($auth as $_key_auth => $_value_auth) {
                    $auth_detail = explode(',', $_value_auth);

                    $return[$_value['menu_number']][$auth_detail[0]][] = $auth_detail[1];
                }
            }
        }

        return $return;
    }
}
