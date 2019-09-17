<?php

namespace App\Http\Controllers;

use App\Database\UPLOAD\ITFILE;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware(array('at.auth'));
    }

    public function download(Request $request, $seq)
    {
        $where   = array();
        $where[] = array('seq', $seq);

        $data = ITFILE::where($where)->first();

        if ($data) {
            // 下載資訊
            $file_path     = $data["file_path"];
            $file_encode   = $data["file_encode"];
            $download_path = $file_path . $file_encode;

            // 檔案名稱
            $file_name = $data["file_name"];

            /*
            // 附件檔案
            $sUploadFile = base64_decode($_GET["File"]);

            // 附件名稱
            $sFile_Name = $_GET["File_Name"];

            // 分開前檔名與副檔名
            $aTmp = explode(".", $sFile_Name);

            // 最後一個點後的才是真正的副檔名
            $sFile_Extension = strtolower($aTmp[count($aTmp) - 1]);

            // 即為下載檔案的暫存位置和檔案名稱
            $sFile = $download_path_Path . date("Ymdhis") . "_" . $_SESSION["G_SESSION_ID"] . "." . $sFile_Extension;

            // 將檔案複製到下載路徑
            copy($sUpload_Path . $sUploadFile, $sFile);
             */

            header("Content-type:application");
            header("Content-Length: " . (string) (filesize($download_path)));
            //5.1.2之後的版本，已無弱點問題。
            header("Content-Disposition: attachment; filename=" . mb_convert_encoding($file_name, "BIG5", "UTF-8"));

            readfile($download_path);

            // 下載後刪除
            // unlink($sFile);
        }
    }
}
