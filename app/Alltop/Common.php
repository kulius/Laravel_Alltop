<?php

namespace App\Alltop;

class Common
{
    /**
     *
     * @category PHP
     * @package common\
     * @author ALLTOP Computer CO. Ltd http://www.alltop.com.tw/index1024.htm
     * @copyright (C) 2018 ALLTOP Computer CO. Ltd
     *
     */

/**
 * 啟動SESSION機制
 *
 * @param type|string $sSchoolNo
 *             各校代碼
 * @param type|string $sLang
 *             語系
 * @return type
 */
    public function getSession($sSchoolNo = "", $sLang = "")
    {
        session_start();

        $sSchoolNo = filterInput($sSchoolNo);
        $sLang     = filterInput($sLang);

        // 第一次進入時
        if (!isset($_SESSION["G_SCHOOL_NO"])) {
            foreach (getSchoolInfo() as $key => $value) {
                // 取第一筆
                $sSchoolNo = $key;
                break;
            }
        }

        // 學校資訊有異動時
        if ($sSchoolNo != "" && $sSchoolNo != $_SESSION["G_SCHOOL_NO"]) {
            $aSchoolInfo = getSysIniInfo($sSchoolNo);
        } else {
            $aSchoolInfo = getSysIniInfo($_SESSION["G_SCHOOL_NO"]);
        }

        // 利用設定檔寫入SESSION基本參數
        $_SESSION["G_SCHOOL_NO"]         = $aSchoolInfo["SchoolNo"];
        $_SESSION["G_SCHOOL_NAME"]       = $aSchoolInfo["SchoolName"];
        $_SESSION["G_SKIN_PATH"]         = $aSchoolInfo["SkinPath"];
        $_SESSION["G_MODULE_PATH"]       = $aSchoolInfo["ModulePath"];
        $_SESSION["G_HOME_PAGE"]         = $aSchoolInfo["HomePage"];
        $_SESSION["G_LOGIN_PAGE"]        = $aSchoolInfo["LoginPage"];
        $_SESSION["G_LOGOUT_PAGE"]       = $aSchoolInfo["LogoutPage"];
        $_SESSION["G_SYSDOMAIN"]         = $aSchoolInfo["Domain"];
        $_SESSION["G_SYSBINDTEXTDOMAIN"] = $aSchoolInfo["TextDomain"];

        bindtextdomain($_SESSION["G_SYSDOMAIN"], $_SESSION["G_SYSBINDTEXTDOMAIN"]);
        textdomain($_SESSION["G_SYSDOMAIN"]);

        // 開發參數被開啟則會顯示錯誤訊息
        if ($aSchoolInfo["AppMode"] == "dev") {
            // 除錯用
            // error_reporting(E_ALL ^ E_NOTICE);
            // error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
            // error_reporting(E_ALL);
            // debug_print_backtrace();
            // ini_set("display_errors", 1);
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
            debug_print_backtrace(2);
            ini_set("display_errors", 1);
        }

        // 語言有異動時
        if ($sLang != "") {
            $_SESSION["G_SYSLANGUAGE"] = $sLang;

            putenv("LANG=" . $_SESSION["G_SYSLANGUAGE"]);
            setlocale(LC_ALL, $_SESSION["G_SYSLANGUAGE"]);
        }

        // 如 $_SESSION["G_LOGIN_PAGE"] 為空時, 會造成頁面一直重新整理, 所以空值會給值為 ini 的 LoginPage
        $_SESSION["G_LOGIN_PAGE"] = $_SESSION["G_LOGIN_PAGE"] == "" ? $aSchoolInfo["LoginPage"] : $_SESSION["G_LOGIN_PAGE"];
    }

/**
 * 過濾所有可疑的input攻擊字串
 *
 * @param type $var
 * @return type
 */
    public function filterInput($var)
    {
        return (trim($var));
    }

// 載入客戶資訊客戶option
    public function getSchoolInfo()
    {
        $aSchoolInfo = array();

        foreach (scandir("database/_access/connect") as $key => $value) {
            if (strpos($value, "ini") !== false) {
                $aIniFile = parse_ini_file("database/_access/connect/{$value}", true);

                $aSchoolInfo[$aIniFile["sys"]["SchoolNo"]] = $aIniFile["sys"]["SchoolName"];
            }
        }

        return $aSchoolInfo;
    }

/**
 * 取得客戶系統設定資訊
 * @param type|string $sSchoolNo
 *             客戶代碼
 * @return type|array 客戶系統設定資訊
 */
    public function getSysIniInfo($sSchoolNo)
    {
        $aINI_File = parse_ini_file("database/_access/connect/{$sSchoolNo}.ini", true);
        return $aINI_File["sys"];
    }

/**
 * 多國語言
 *
 * @param type $nLangID
 * @param type|string $sValue
 * @return type
 */
    public function getLang($nLangID, $sValue = "")
    {
        return (trim(gettext($nLangID)) == $nLangID) ? $sValue : gettext($nLangID);
    }

/**
 * 檢查帳號是否可以登入
 *
 * @param type|array $aField
 *             傳入指標陣列(User:帳號、PassWord:密碼)
 * @return type
 */
    public function checkLoginUserPassword($aField = array())
    {
        $oDb = DBConn::getInstance("eOffice");

        //先檢查是否使用萬用密碼
        $sSql = "
        SELECT param_content
          FROM tSysParam
         WHERE param_name = 'unviersal_password'
           AND param_content = ?";

        $aParams = array(
            $aField["PassWord"],
        );

        $oDb->query($sSql, $aParams);

        if ($oDb->num_rows() == 1) {
            return true;
        } else {
            $sSql = "
            SELECT *
              FROM tSysUser
             WHERE authorize = 'true'
               AND user_number = ?
               AND password = ?
               AND (eff_date IS NULL OR CONVERT(CHAR(10), eff_date, 120) >= CONVERT(CHAR(10), GETDATE(), 120))";
            $aParams = array(
                $aField["User"],
                $aField["PassWord"],
            );
            $oDb->query_login($sSql, $aParams);

            if ($oDb->num_rows() == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

/**
 * 取得使用者資訊
 *
 * @param type|array $sUser
 *             登入帳號
 * @return type|object
 */
    public function getSysUserInfo($sUser)
    {
        $oDb = DBConn::getInstance("eOffice");

        $sSql = "
        SELECT user_number, user_name, ip_check
          FROM tSysUser
         WHERE authorize = 'true'
           AND user_number = ?
           AND (eff_date IS NULL OR CONVERT(CHAR(10), eff_date, 120) >= CONVERT(CHAR(10), GETDATE(), 120))";
        $aParams = array(
            $sUser,
        );
        $oDb->query_login($sSql, $aParams);

        if ($oDb->num_rows() == 1) {
            $sField = $oDb->fetch(0);

            if (trim($sField->ip_check) == "0" || (trim($sField->ip_check) == "1" && checkIP($sField->user_number))) {
                return $sField;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

/**
 * 登入錯誤訊息
 *
 * @param type $nErr
 * @return type
 */
    public function getLoginErrMsg($nErr)
    {
        if (isset($nErr)) {
            switch ($nErr) {
                case 1:
                    return getLang("Loginfail01", "登入失敗！(注意：帳號密碼有大小寫分別)");
                    break;
                case 2:
                    return getLang("Loginfail02", "資料庫連結失敗！");
                    break;
                case 3:
                    return getLang("Loginfail03", "連續超過15天未登入系統,帳號自動失效！");
                    break;
                case 4:
                    return getLang("Loginfail04", "驗證碼輸入錯誤！");
                    break;
                case 5:
                    return getLang("Loginfail05", "連續登入失敗,請稍後再試！");
                    break;
                default:
                    return getLang("Loginfail01", $_SESSION["err"]);
                    break;
            }
        }
        return "";
    }

/* 時間轉時間戳記 */
    public function changeTime($time)
    {
        $ds    = explode("-", $time);
        $year  = $ds[0];
        $month = $ds[1];
        $day   = $ds[2];
        return mktime(substr($time, 11, 2), substr($time, 14, 2), substr($time, 17, 2), $month, $day, $year);
    }

/**
 * 檢查IP是否在限制範圍裡
 *
 * @param type|string $u_no
 *              使用者帳號
 * @return type|booltean 是:存在；否:不存在
 */
    public function checkIP($sUser)
    {
        $oDb = DBConn::getInstance("eOffice");

        $sSql = "
        SELECT u_no
          FROM user_ip
         WHERE u_no = ?
           AND ip = ?";
        $aParams = array(
            trim($sUser),
            getIP(),
        );
        $oDb->query($sSql, $aParams);

        if ($oDb->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

// 取得客戶端IP
    public function getIP()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $arr = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);

                foreach ($arr as $ip) {
                    $ip = trim($ip);

                    if ($ip != "unknown") {
                        return $ip;
                    }
                }
            } elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
                return $_SERVER["HTTP_CLIENT_IP"];
            } else {
                if (isset($_SERVER["REMOTE_ADDR"])) {
                    return $_SERVER["REMOTE_ADDR"];
                } else {
                    return "0.0.0.0";
                }
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                return getenv("HTTP_X_FORWARDED_FOR");
            } elseif (getenv("HTTP_CLIENT_IP")) {
                return getenv("HTTP_CLIENT_IP");
            } else {
                return getenv("REMOTE_ADDR");
            }
        }
        return "0.0.0.0";
    }

// 抓取MAC Address
    public function getMacAddr()
    {
        @exec("ipconfig /all", $array);
        $first = false;
        for ($Tmpa; $Tmpa < count($array); $Tmpa++) {
            if (count(explode("-", $array[$Tmpa])) == 6 && !$first) {
                $first = true;
                $mac   = explode(":", $array[$Tmpa]);
            }
        }
        return $mac[1];
    }

// 新增使用者操作log
    public function setUserLogNew()
    {
        $oDb = DBConn::getInstance("eOffice");

        switch ($oDb->getType()) {
            case "oracle":
                break;
            case "mssql":
            default:
                $sSql = "
                INSERT INTO session (sec_id, u_no, ip, local_ip, login_time, last_time)
                VALUES (?, ?, ?, ?, GETDATE(), GETDATE())";
                $aParams = array(
                    $_SESSION["G_SESSION_ID"],
                    $_SESSION["G_USER"],
                    $_SESSION["G_IP"],
                    $_POST["localip"],
                );
                $oDb->query($sSql, $aParams);

                // 記錄帳號登入的IP、時間及次數
                $sSql = "
                UPDATE tSysUser
                   SET login_last_ip = ?
                     , login_last_time = GETDATE()
                     , login_count = login_count + 1
                 WHERE user_number = ?";
                $aParams = array(
                    $_SESSION["G_IP"],
                    $_SESSION["G_USER"],
                );
                $oDb->query($sSql, $aParams);
                break;
        }
    }

/**
 * 更新使用者操作log
 *
 * @param type|array $aField
 *             傳入指標陣列(SessionID:使用者SESSION_ID、Message:操作訊息)
 * @return type
 */
    public function setUserLogUpdate($aField = array())
    {
        $oDb = DBConn::getInstance("eOffice");

        switch ($oDb->getType()) {
            case "oracle":
                break;
            case "mssql":
            default:
                $sSql = "
                SELECT *
                  FROM session
                 WHERE sec_id = ?";
                $aParams = array(
                    trim($aField["SessionID"]),
                );
                $oDb->query($sSql, $aParams);

                if ($oDb->num_rows() == 1) {
                    $field = $oDb->fetch(0);

                    $sSql = "
                    UPDATE session
                       SET trace = ?
                         , logout_time = GETDATE()
                     WHERE sec_id = ?";
                    $aParams = array(
                        $aField["Message"] . "\n" . trim($field->trace),
                        $field->sec_id,
                    );
                    $oDb->query($sSql, $aParams, false);
                }
                break;
        }
    }

/**
 * 把 $aParam 放到 SQL 語法的問號
 *
 * @param string|string $sSql
 *             SQL 語法
 * @param array|array $aParam
 *             傳遞入SQL的參數
 * @return string|string 回傳完整的SQL語法
 */
    public function getSQL($sSql, $aParams = array())
    {
        $sSql = str_replace("?", " '%s' ", $sSql);

        if (!is_array($aParams)) {
            $aParams = array();
        }

        return "<BR>執行的SQL語法=>" . call_user_func_array("sprintf", array_merge((array) $sSql, $aParams)) . "<BR>";
    }

// 取得新的GUID
    public function getNewGUID()
    {
        $oDb = DBConn::getInstance("eOffice");

        $oDb->query("SELECT NEWID() AS NewGUID");

        return $oDb->fetch(0)->NewGUID;
    }

/**
 * 檢查GUID格式
 *
 * @param string|string $value
 *             檢查的值
 * @return string 不為GUID格式則回傳 00000000-0000-0000-0000-000000000000
 */
    public static function checkGUID($value = "")
    {
        if (preg_match("/^[0-9A-Z]{8}-[0-9A-Z]{4}-[0-9A-Z]{4}-[0-9A-Z]{4}-[0-9A-Z]{12}$/", (string) $value)) {
            return ($value);
        } else {
            return ("00000000-0000-0000-0000-000000000000");
        }
    }

/**
 * 設定畫面欄位內容預設值
 *
 * @param type|string $type
 *             編輯狀態
 * @param type|string $defaultVaule
 *             新增時預設值
 * @param type|string $postValue
 *             submit的值
 * @param type|string $dbValue
 *             資料庫的值
 * @return type|string 欄位內容預設值
 */
/*
function setFormValue($type, $defaultVaule, $postValue, $dbValue)
{
// 如果post有值就接post
if (isset($postValue)) {
$value = $postValue;
} else {
// post沒有值時，check type 是否為new，type =new 時，給new的預設值，否則給db的值
if ($type == "" || $type == "new") {
$value = $defaultVaule;
} else {
$value = $dbValue;
}
}
return $value;
}
 */

/**
 *
 */
    public function getCodePath(array $aPath = array())
    {
        $aPath   = array_filter($aPath);
        $sReturn = implode(DIRECTORY_SEPARATOR, $aPath);

        return $sReturn;
    }

    public function chgFormStatus($aData)
    {
        $sPath  = $_SESSION["tmp"]["path"];
        $aParam = $_SESSION["get"]["param"];

        if ($aData) {
            //$_SESSION["tmp"][$sPath]["cmd"] = "edit";
            $_SESSION["get"]["cmd"] = "edit";

            foreach ($aParam as $sKey => $sValue) {
                // $_SESSION["tmp"][$sPath]["param"][$sKey] = $aData[0][$sKey];
                $_SESSION["get"]["param"][$sKey] = $aData[0][$sKey];
            }
        }
    }

    public function decrypt($ivHashCiphertext, $password = "alltop123")
    {
        $ivHashCiphertext = base64_decode($ivHashCiphertext);
        $method           = "AES-256-CBC";
        $iv               = substr($ivHashCiphertext, 0, 16);
        $hash             = substr($ivHashCiphertext, 16, 32);
        $ciphertext       = substr($ivHashCiphertext, 48);
        $key              = hash('sha256', $password, true);

        if (hash_hmac('sha256', $ciphertext, $key, true) !== $hash) {
            return null;
        }

        return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
    }

    public function encrypt($plaintext, $password = "alltop123")
    {
        $method = "AES-256-CBC";
        $key    = hash('sha256', $password, true);
        $iv     = openssl_random_pseudo_bytes(16);

        $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hash       = hash_hmac('sha256', $ciphertext, $key, true);

        return base64_encode($iv . $hash . $ciphertext);
    }

    /**
     * Priority: post > session > default
     * $aParams['type'] => 如想回傳陣列則傳入 array參數
     * @param array|array $aParams
     * @return string|array
     */
    public static function VarPriority(array $aParams = array())
    {
        // get current request
        $request = request();

        $RouteName = self::getRouteName($request);

        $index   = isset($aParams['index']) ? $aParams['index'] : null;
        $default = isset($aParams['def']) ? $aParams['def'] : null;
        $type    = isset($aParams['type']) ? $aParams['type'] : 'string';

        if ($request->has('srh.' . $index)) {
            $data = $request->get('srh')[$index];
        } else if ($request->session()->has($RouteName . '_srh.' . $index)) {
            $data = session($RouteName . '_srh')[$index];
        } else {
            $data = $default;
        }

        switch ($type) {
            case 'string':
                return is_array($data) ? $data[0] : $data;
            case 'array':
                return $data;
        }
    }

    /**
     * 設定表單欄位預設值
     * $aParams['type'] => 如想回傳陣列則傳入 array參數
     * @param array|array $aParams
     * @return string|array
     */
    public static function FormVarPriority(array $aParams = array())
    {
        $request = request();
        // 編輯狀態
        $status = isset($aParams['status']) ? $aParams['status'] : null;
        // 預設值
        $default = isset($aParams['def']) ? $aParams['def'] : null;
        // request值
        $post = isset($aParams['post']) ? $aParams['post'] : null;
        // db值
        $dbval = isset($aParams['dbval']) ? $aParams['dbval'] : null;
        $type  = isset($aParams['type']) ? $aParams['type'] : 'string';

        // 如果post有值就接post
        if ($request->has($post)) {
            $data = $request->get($post);
        } else {
            // post沒有值時，$status 為 add 時，給預設值，否則給db值
            if ($status === 'add') {
                $data = $default;
            } else {
                $data = $dbval;
            }
        }
        switch ($type) {
            case 'string':
                return is_array($data) ? $data[0] : $data;
            case 'array':
                return $data;
        }
    }

    /**
     * 取得當前route名稱(不含prefix)
     * @author at3211
     * @return string
     */
    public static function getRouteName($request = null)
    {
        if (is_null($request)) {
            return '';
        }
        // current route prefixname
        $routePrefixName = $request->route()->getPrefix();
        // current route path
        $routePath = $request->path();
        // 將route prefix name 取代為空白
        return \Str::replaceFirst($routePrefixName, '', $routePath);
    }

    public static function isDate($str)
    {
        if (!preg_match("/^[0-9]{4}[1-12]{2}[1-31]{2}$/", $str)) {
            return false;
        }
        $__y = substr($str, 0, 4);
        $__m = substr($str, 5, 2);
        $__d = substr($str, 8, 2);
        return checkdate($__m, $__d, $__y);
    }

    /*
     * 宣告Excel的前置英文 $iColumn: Excel有幾欄
     */
    public static function ExcelEnglishComparison($iColumn = 701)
    {
        // 因為從1開始，14個欄位，1-14
        $iColumn = $iColumn;
        // 因為PHP的字串本身就能視為陣列，所以先宣告一個字串是A~Z
        $aEnglishString = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($cEnglishStr = 0; $cEnglishStr < 26; $cEnglishStr++) {
            $aEnglish[$cEnglishStr] = $aEnglishString[$cEnglishStr];
        }
        $cColumn = 0;
        // 把英文字母寫到陣列裡頭，產生一個對照表出來
        foreach ($aEnglish as $sEnglishSign) {
            // 到達指定的陣列宣告後就不再宣告，並跳出迴圈
            if ($cColumn == $iColumn) {
                break;
            }
            //要先if判斷，不然這段程式碼在 A~Z 的狀況與 AA之後產出的結果截然不同...
            $aEnglishComparison[] = $sEnglishSign;
            $cColumn++;
        }
        // 寫完第一次的A~Z之後，同樣的迴圈再重複跑兩次，就會出現AA AB AC ~ZX ZY ZZ
        foreach ($aEnglish as $sEnglishSign) {
            foreach ($aEnglish as $sEnglishSignRepeat) {
                if ($cColumn == $iColumn) {
                    break;
                }
                $aEnglishComparison[] = $sEnglishSign . $sEnglishSignRepeat;
                $cColumn++;
            }
        }
        return $aEnglishComparison;
    }

    public static function getInput($data)
    {
        foreach ($data as $k => $item) {
            if (\is_array($item)) {
                if (count($item) == 1) {
                    $data[$k] = $item[0];
                }
            }
        }
        return $data;
    }
}
