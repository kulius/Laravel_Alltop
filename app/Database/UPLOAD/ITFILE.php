<?php

namespace App\Database\UPLOAD;

use Illuminate\Database\Eloquent\Model;

class ITFILE extends Model
{
    public $connection = 'UPLOAD';

    public $table = 'tITFILE';

    public $fillable = array(
        'form_number', 'file_name',
        'file_type', 'file_size',
        'file_encode', 'file_path',
        'ins_user_number', 'ins_datetime',
    );

    public $primaryKey = 'seq';

    public $timestamps = false;

    public static function save_file(array $files = array(), string $form_number)
    {
        $files_tmp = array();

        //取得檔案資訊
        foreach ($files as $key => $value) {
            foreach ($value as $key_file => $value_file) {
                $files_tmp[$key_file][$key] = $value_file;
            }
        }

        $file_upload_path = 'C:/UPLOAD/';

        if (!empty($form_number)) {
            $file_upload_path .= $form_number . "/";
        }

        if (!is_dir($file_upload_path)) {
            mkdir($file_upload_path);
        }

        //上傳程序
        $files_data = array();

        foreach ($files_tmp as $key => $value) {
            //無錯誤才進來
            if (!$value["error"]) {
                //命名規則：年月時分秒 _ 陣列序號 _ SESSION_ID . 附檔名
                $file_encode = date("YmdHis") . "_" . $key . "_" . session()->getId();

                //寫入資料庫
                $files_data[$key]["form_number"]     = $form_number;
                $files_data[$key]["file_name"]       = $value["name"];
                $files_data[$key]["file_type"]       = $value["type"];
                $files_data[$key]["file_size"]       = $value["size"];
                $files_data[$key]["file_path"]       = $file_upload_path;
                $files_data[$key]["file_encode"]     = $file_encode;
                $files_data[$key]["ins_user_number"] = session('user_number');

                $file_tmp_name = $value["tmp_name"];

                move_uploaded_file($file_tmp_name, $file_upload_path . $file_encode);
            }
        }

        $return = ITFILE::insert($files_data);

        return $return;
    }

    public static function remove_file(array $files = array())
    {
        $files_del = array_map(function ($item) {return $item['seq'];}, $files);

        // 資料刪除
        $return = false;
        $result = ITFILE::whereIn('seq', $files_del)->delete();

        // 檔案刪除
        if ($result) {
            foreach ($files as $key => $value) {
                unlink($value["file_path"] . $value["file_encode"]);
            }

            $return = true;
        }

        return $result;
    }
}
