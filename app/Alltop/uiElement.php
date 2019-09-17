<?php
namespace App\Alltop;

class Element
{
    /**
     * 功能狀態（new、edit、view）
     */
    public $Status;

    /**
     * 必填標記
     */
    public $ReqMark;

    /**
     * 按鈕樣式
     */
    public $BtnStyle = array(
        "b"  => "btn-primary",
        "g"  => "btn-success",
        "r"  => "btn-danger",
        "y"  => "btn-warning",
        "i"  => "btn-info",
        "d"  => "btn-dark",
        "s"  => "btn-secondary",
        "l"  => "btn-light",
        "bo" => "btn-outline-primary",
        "go" => "btn-outline-success",
        "ro" => "btn-outline-danger",
        "yo" => "btn-outline-warning",
        "io" => "btn-outline-info",
        "do" => "btn-outline-dark",
        "so" => "btn-outline-secondary",
        "lo" => "btn-outline-light",
    );

    /**
     * 警報樣式
     */
    public $AlertStyle = array(
        "b" => "alert-primary",
        "g" => "alert-success",
        "r" => "alert-danger",
        "y" => "alert-warning",
        "i" => "alert-info",
        "d" => "alert-dark",
        "s" => "alert-secondary",
        "l" => "alert-light",
    );

    /**
     * 文字樣式
     */
    public $TextStyle = array(
        "none" => "",
        "b"    => "text-primary",
        "g"    => "text-success",
        "r"    => "text-danger",
        "y"    => "text-warning",
        "i"    => "text-info",
        "d"    => "text-dark",
        "s"    => "text-secondary",
        "l"    => "text-light",
    );

    public function __construct($aParams = array())
    {
        //功能狀態
        //$this->Status = $_SESSION["get"]["cmd"];
        //dd(session('status'));
        $this->Status = session()->pull('status');

        //必填標記
        $this->ReqMark = "<i class='fas fa-star' style='color:#ff6b6b'></i>";
    }

    public function setIDFormat($sID)
    {
        return str_replace(array("[", "]"), "", $sID);
    }

    public function setELEMHead($sHead, $bReq = false, $sSub = null)
    {
        $sMark = null;

        if ($bReq) {$sMark = $this->ReqMark;}

        $sReturn = sprintf(
            "<div class='row'>
                <div class='col-12'>
                    <h6>%s</h6>
                </div>
            </div>"
            , $sMark . $sHead, $sSub
        );

        return $sReturn;
    }

    public function setELEMFooter($sFooter)
    {
        $sReturn = sprintf(
            "<div>%s</div>"
            , $sFooter
        );

        return $sReturn;
    }

    /**
     * 設定網頁訊息（含背景顏色）
     *
     * @param array $aParam
     *
     * @return string 返回「Html」語法。
     */
    public function setAlert($aParams = array())
    {
        //基本設定
        $sText = (isset($aParams["text"]) ? $aParams["text"] : null);
        $aFont = array(
            "style" => (isset($aParams["font-style"]) ? $aParams["font-style"] : null),
            "size"  => (isset($aParams["font-size"]) ? $aParams["font-size"] : null),
        );
        $sStyle = (isset($aParams["style"]) ? $aParams["style"] : "y");

        $aClass = array();

        $aClass[] = "alert";
        $aClass[] = $this->AlertStyle[$sStyle];

        $sClass = implode(" ", $aClass);

        $aText = array();

        if (is_array($sText)) {
            foreach ($sText as $skText => $svText) {
                $aText[] = $this->setFont(array_merge(array("text" => $svText), $aFont));
            }
        } else {
            $aText[] = $this->setFont(array_merge(array("text" => $sText), $aFont));
        }

        $sText = implode("<BR>", $aText);

        $sReturn = sprintf(
            "<div class='%s' role='alert'>%s</div>"
            , $sClass, $sText
        );

        return $sReturn;
    }

    /**
     * 設定ICon（整合「Font Awesome」）
     *
     * @param array $aParam
     *
     * @return string 返回「Html」語法。
     */
    public function setICon($aParams = array())
    {
        //基本設定
        $sICon    = (isset($aParams["icon"]) ? $aParams["icon"] : null);
        $sSize    = (isset($aParams["size"]) ? $aParams["size"] : null);
        $sStyle   = (isset($aParams["style"]) ? $aParams["style"] : null);
        $sStyle   = \array_key_exists($sStyle, $this->TextStyle) ? $sStyle : 'none';
        $aClass   = array();
        $aClass[] = $sSize;
        $aClass[] = $this->TextStyle[$sStyle];

        switch ($sICon) {
            case "add":
                $aClass[] = "fas fa-plus";
                break;
            case "search":
                $aClass[] = "fas fa-search";
                break;
            case "view":
                $aClass[] = "fas fa-search";
                break;
            case "edit":
                $aClass[] = "fas fa-edit";
                break;
            case "users":
                $aClass[] = "fas fa-users";
                break;
            case "save":
                $aClass[] = "fas fa-save";
                break;
            case "leave":
                $aClass[] = "fas fa-running";
                break;
            case "cancel":
                $aClass[] = "fas fa-times";
                break;
            case "remove":
                $aClass[] = "fas fa-trash";
                break;
            case "click":
                $aClass[] = "fas fa-hand-point-up";
                break;
            case "select":
                $aClass[] = "far fa-square";
                break;
            case "selected":
                $aClass[] = "far fa-check-square";
                break;
            case "check":
                $aClass[] = "fas fa-check";
                break;
            case "pdf":
                $aClass[] = "far fa-file-pdf";
                break;
            case "excel":
                $aClass[] = "far fa-file-excel";
                break;
            case "print":
                $aClass[] = "fas fa-print";
                break;
            case "import":
                $aClass[] = "fas fa-file-import";
                break;
            case "download":
                $aClass[] = "fas fa-download";
                break;
            case "mail":
                $aClass[] = "far fa-envelope";
                break;
            default:
                $aClass[] = $sICon;
                break;
        }

        $sClass = implode(" ", $aClass);

        $sReturn = sprintf(
            "<i class='%s'></i>"
            , $sClass
        );

        return $sReturn;
    }

    /**
     * 設定文字樣式（Font）
     *
     * @param array $aParam
     *
     * @return string 返回「Html」語法。
     */
    public function setFont($aParams = array())
    {
        //基本設定
        $sText      = (isset($aParams["text"]) ? $aParams["text"] : null);
        $sStyle     = (isset($aParams["style"]) ? $aParams["style"] : null);
        $sStyle     = \array_key_exists($sStyle, $this->TextStyle) ? $sStyle : 'none';
        $sSize      = (isset($aParams["size"]) ? $aParams["size"] : null);
        $sICon      = (isset($aParams["icon"]) ? $aParams["icon"] : null);
        $sIConStyle = (isset($aParams["icon_style"]) ? $aParams["icon_style"] : null);

        //元件生成
        $aClass   = array();
        $aClass[] = $this->TextStyle[$sStyle];

        $aStyle = array();

        if (!empty($sSize)) {
            $aStyle[] = "font-size:{$sSize}rem";
        }

        $aView = array();

        if (!empty($sICon)) {
            $aView[] = $this->setICon(array("icon" => $sICon, "style" => $sIConStyle));
        }

        $aView[] = $sText;

        $sClass = implode(" ", $aClass);
        $sStyle = implode(";", $aStyle);
        $sView  = implode(" ", $aView);

        $sReturn = sprintf(
            "<font class='%s' style='%s'>%s</font>"
            , $sClass, $sStyle, $sView
        );

        return $sReturn;
    }

    public function setBox($aParams = array())
    {
        //基本設定
        $sName   = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID     = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sValue  = (isset($aParams["value"]) ? $aParams["value"] : null);
        $sHead   = (isset($aParams["head"]) ? $aParams["head"] : null);
        $sFooter = (isset($aParams["footer"]) ? $aParams["footer"] : null);
        $sType   = (isset($aParams["type"]) ? $aParams["type"] : "text");
        $sAlign  = (isset($aParams["align"]) ? $aParams["align"] : "left");
        $sStatus = (isset($aParams["status"]) ? $aParams["status"] : $this->Status);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        //彈性設定
        $aAttr = (isset($aParams["attr"]) ? $aParams["attr"] : array());

        if ($sStatus === "view") {$aAttr[] = "readonly";}

        $aClass   = (isset($aParams["class"]) ? $aParams["class"] : array());
        $aClass[] = "text-" . $sAlign;
        $aClass[] = "form-control";
        $aClass[] = "form-control-sm";

        //元件生成
        if ($sHead) {$sHead = $this->setELEMHead($sHead, $bReq);}
        if ($sFooter) {$sFooter = $this->setELEMFooter($sFooter);}

        $sAttr  = implode(" ", $aAttr);
        $sClass = implode(" ", $aClass);

        $sReturn = sprintf(
            "{$sHead}
            <div class='input-group'>
                <input type='%s' class='%s' id='%s' name='%s' value='%s' %s>
            </div>
            {$sFooter}"
            , $sType, $sClass, $sID, $sName, $sValue, $sAttr
        );

        return $sReturn;
    }

    public function setFileBox($aParams = array())
    {
        //基本設定
        $sName   = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID     = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sID     = $this->setIDFormat($sID);
        $sValue  = (isset($aParams["value"]) ? $aParams["value"] : null);
        $sHead   = (isset($aParams["head"]) ? $aParams["head"] : null);
        $sFooter = (isset($aParams["footer"]) ? $aParams["footer"] : null);
        $sType   = (isset($aParams["type"]) ? $aParams["type"] : null);
        $sStatus = (isset($aParams["status"]) ? $aParams["status"] : $this->Status);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        //彈性設定
        $aAttr = (isset($aParams["attr"]) ? $aParams["attr"] : array());
        //$aAttr[] = "data-browse-on-zone-click='true'";
        $sAttr = implode(" ", $aAttr);
        if ($sStatus === "view") {$aAttr[] = "readonly";}

        $aClass = (isset($aParams["class"]) ? $aParams["class"] : array());

        //元件生成
        if ($sHead) {$sHead = $this->setELEMHead($sHead, $bReq);}
        if ($sFooter) {$sFooter = $this->setELEMFooter($sFooter);}

        switch ($sType) {
            case "single":
                $aClass[] = "custom-file-input";

                $sClass = implode(" ", $aClass);

                $sReturn = sprintf(
                    "{$sHead}
                    <div class='custom-file'>
                        <input type='file' class='%s' id='%s' name='%s[]' %s>
                        <label class='custom-file-label' for='%s'>請選擇檔案...</label>
                    </div>
                    {$sFooter}"
                    , $sClass, $sID, $sName, $sID, $sAttr
                );
                break;
            case "mulit":
                $aAttr[] = "multiple";
                //不能設定 class = file 不然 Js 參數會無效
                // $aClass[] = "file";

                $sAttr  = implode(" ", $aAttr);
                $sClass = implode(" ", $aClass);

                $sReturn = sprintf(
                    "{$sHead}
                    <div class='file-loading'>
                        <input type='file' class='%s'  id='%s' name='%s[]' %s>
                    </div>
                    {$sFooter}"
                    , $sClass, $sID, $sName, $sAttr
                );
                break;
        }

        return $sReturn;
    }

    public function setHideBox($aParams = array())
    {
        //基本設定
        $sName  = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID    = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sValue = (isset($aParams["value"]) ? $aParams["value"] : null);

        $sResult = "<input type='hidden' id='{$sID}' name='{$sName}' value='{$sValue}'>";

        return $sResult;
    }

    public function setAreaBox($aParams = array())
    {
        //基本設定
        $sName   = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID     = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sValue  = (isset($aParams["value"]) ? $aParams["value"] : null);
        $sHead   = (isset($aParams["head"]) ? $aParams["head"] : null);
        $sFooter = (isset($aParams["footer"]) ? $aParams["footer"] : null);
        $sHeight = (isset($aParams["height"]) ? $aParams["height"] : 3);
        $sStatus = (isset($aParams["status"]) ? $aParams["status"] : $this->Status);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        //彈性設定
        $aAttr = (isset($aParams["attr"]) ? $aParams["attr"] : array());
        $sAttr = null;
        if ($sStatus === "view") {$aAttr[] = "readonly";}

        $aClass   = (isset($aParams["class"]) ? $aParams["class"] : array());
        $aClass[] = "form-control";
        $aClass[] = "form-control-sm";

        //元件生成
        if ($sHead) {$sHead = $this->setELEMHead($sHead, $bReq);}
        if ($sFooter) {$sFooter = $this->setELEMFooter($sFooter);}

        $sAttr  = implode(" ", $aAttr);
        $sClass = implode(" ", $aClass);

        $sReturn = sprintf(
            "{$sHead}
            <div>
                <textarea class='%s' id='%s' name='%s' rows='%s' %s>%s</textarea>
            </div>
            {$sFooter}"
            , $sClass, $sID, $sName, $sHeight, $sAttr, $sValue
        );

        return $sReturn;
    }

    public function setDateTimeBox($aParams = array())
    {
        //基本設定
        $sName   = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID     = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sID     = $this->setIDFormat($sID);
        $sValue  = (isset($aParams["value"]) ? $aParams["value"] : null);
        $sHead   = (isset($aParams["head"]) ? $aParams["head"] : null);
        $sFooter = (isset($aParams["footer"]) ? $aParams["footer"] : null);
        $sAlign  = (isset($aParams["align"]) ? $aParams["align"] : "left");
        $sStatus = (isset($aParams["status"]) ? $aParams["status"] : $this->Status);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        //彈性設定
        $aAttr   = (isset($aParams["attr"]) ? $aParams["attr"] : array());
        $aAttr[] = "data-toggle='datetimepicker'";
        $aAttr[] = "data-target='#{$sID}'";

        if ($sStatus === "view") {$aAttr[] = "readonly";}

        $aClass   = (isset($aParams["class"]) ? $aParams["class"] : array());
        $aClass[] = "text-" . $sAlign;
        $aClass[] = "form-control";
        $aClass[] = "form-control-sm";

        //元件生成
        if ($sHead) {$sHead = $this->setELEMHead($sHead, $bReq);}
        if ($sFooter) {$sFooter = $this->setELEMFooter($sFooter);}

        $sAttr  = implode(" ", $aAttr);
        $sClass = implode(" ", $aClass);

        $sReturn = sprintf(
            "{$sHead}
            <div class='input-group'>
                <input type='text' class='%s' id='%s' name='%s' value='%s' onblur=setDateTimePickerClose(this); %s>
            </div>
            {$sFooter}"
            , $sClass, $sID, $sName, $sValue, $sAttr
        );

        return $sReturn;
    }

    public function setOptionBox(array $aParams = array())
    {
        //基本設定
        $sName   = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID     = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sHead   = (isset($aParams["head"]) ? $aParams["head"] : null);
        $sFooter = (isset($aParams["footer"]) ? $aParams["footer"] : null);
        $aOption = (isset($aParams["option"]) ? $aParams["option"] : null);
        $sValue  = (isset($aParams["value"]) ? $aParams["value"] : null);
        $sType   = (isset($aParams["type"]) ? $aParams["type"] : null);
        $bInLine = (isset($aParams["inline"]) ? $aParams["inline"] : false);
        $sStatus = (isset($aParams["status"]) ? $aParams["status"] : $this->Status);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        //彈性設定
        $aAttr = (isset($aParams["attr"]) ? $aParams["attr"] : array());

        if ($sStatus === "view") {$aAttr[] = "disabled";}

        $aClass   = (isset($aParams["class"]) ? $aParams["class"] : array());
        $aClass[] = "icheck-material-green";
        $aClass[] = "form-check";

        if ($bInLine) {
            $aClass[] = "form-check-inline";
        }

        $sAttr  = implode(" ", $aAttr);
        $sClass = implode(" ", $aClass);

        //元件生成
        if (is_array($sValue)) {
            $aKey = $sValue;
        } else {
            $aKey = explode("|", $sValue);
        }

        $aList = array();

        foreach ($aOption as $skOption => $svOption) {
            //基本設定
            $sKey   = $svOption["value"];
            $sValue = $svOption["text"];

            //是否勾選
            $sChecked = (in_array($sKey, $aKey) ? "checked" : "");

            $aList[] = sprintf(
                "<div class='%s'>
                    <input class='form-check-input' type='%s' id='%s' name='%s[]' value='%s' %s>
                    <label class='form-check-label' for='%s'>%s</label>
                </div>"
                , $sClass, $sType, "{$sName}_{$sKey}", $sName, $sKey, "{$sChecked} {$sAttr}", "{$sName}_{$sKey}", $sValue
            );
        }

        if ($sHead) {$sHead = $this->setELEMHead($sHead, $bReq);}
        if ($sFooter) {$sFooter = $this->setELEMFooter($sFooter);}

        $sList = implode("", $aList);

        $sReturn = sprintf(
            "{$sHead}
            <div>%s</div>
            {$sFooter}"
            , $sList
        );

        return $sReturn;
    }

    public function setComboBox($aParams = array())
    {
        //基本設定
        $sName   = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID     = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sHead   = (isset($aParams["head"]) ? $aParams["head"] : null);
        $sFooter = (isset($aParams["footer"]) ? $aParams["footer"] : null);
        $sValue  = (isset($aParams["value"]) ? $aParams["value"] : null);
        $sDef    = (isset($aParams["def"]) ? $aParams["def"] : null);
        $sBtn    = (isset($aParams["btn"]) ? $aParams["btn"] : null);
        $aOption = (isset($aParams["option"]) ? $aParams["option"] : array());
        //支援空的 option '' 參數
        $aOption = ($aOption == '') ? array() : $aOption;

        if (is_object($aOption)) {
            $aOption = json_decode($aOption, true);
        }

        $sStatus = (isset($aParams["status"]) ? $aParams["status"] : $this->Status);

        //是否提供複選功能
        $bMulti = (isset($aParams["multi"]) ? $aParams["multi"] : false);

        //是否提供查詢功能
        $bSelect = (isset($aParams["select"]) ? $aParams["select"] : true);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        //彈性設定
        $aAttr   = (isset($aParams["attr"]) ? $aParams["attr"] : array());
        $aAttr[] = "data-style='form-control form-control-sm'";

        if ($bMulti) {
            $aAttr[] = "multiple";
        }

        //是否提供查詢功能
        if ($bSelect) {$aAttr[] = "data-live-search='true'";}

        if ($sStatus === "view") {$aAttr[] = "disabled";}

        $aClass   = (isset($aParams["class"]) ? $aParams["class"] : array());
        $aClass[] = "form-control";
        $aClass[] = "form-control-sm";

        if ($bSelect) {$aClass[] = "selectpicker";}

        //元件生成
        //Combo預設值
        if (!$bMulti) {
            if (!empty($sDef)) {
                $aOption = array_merge(array(array("value" => "", "text" => $sDef)), $aOption);
            }
        }

        if (is_array($sValue)) {
            $aKey = $sValue;
        } else {
            $aKey = explode("|", $sValue);
        }

        $aList = array();

        foreach ($aOption as $skOption => $svOption) {
            //基本設定
            $sKey   = $svOption["value"];
            $sValue = $svOption["text"];

            //是否勾選
            $sSelected = (in_array($sKey, $aKey) ? "selected" : "");

            $aList[] = sprintf(
                "<option value='%s' %s>%s</option>"
                , $sKey, $sSelected, $sValue
            );
        }

        if ($sHead) {$sHead = $this->setELEMHead($sHead, $bReq);}
        if ($sFooter) {$sFooter = $this->setELEMFooter($sFooter);}

        $sAttr  = implode(" ", $aAttr);
        $sClass = implode(" ", $aClass);
        $sList  = implode(" ", $aList);

        $sReturn = sprintf(
            "{$sHead}
            <div class='input-group'>
                {$sBtn}
                <select class='%s' id='%s' name='%s[]' %s>%s</select>
            </div>
            {$sFooter}"
            , $sClass, $sID, $sName, $sAttr, $sList
        );

        return $sReturn;
    }

    public function getBtnExSet($aParams = array())
    {
        //基本設定
        $sEx    = (isset($aParams["ex"]) ? $aParams["ex"] : null);
        $bSmall = (isset($aParams["small"]) ? $aParams["small"] : false);
        $sStyle = (isset($aParams["style"]) ? $aParams["style"] : "do");

        $aSet = array();

        if ($sEx) {
            $aSet["style"] = $sStyle;

            switch ($sEx) {
                case "add":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "新增");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "新增");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "g";
                    break;
                case "remove":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "刪除");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "刪除");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "r";
                    break;
                case "edit":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "編輯");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "編輯");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "y";
                    break;
                case "view":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "檢視");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "檢視");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "i";
                    break;
                case "search":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "查詢");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "查詢");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "i";
                    break;
                case "save":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "儲存");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "儲存");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "g";
                    break;
                case "cancel":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "取消");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "取消");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "r";
                    break;
                case "leave":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "離開");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "離開");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "r";
                    break;
                case "users":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "所屬人員");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "所屬人員");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "g";
                    break;
                case "click":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "點擊");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "點擊");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "g";
                    break;
                case "pdf":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "PDF");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "PDF");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "r";
                    break;
                case "excel":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "Excel");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "Excel");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "g";
                    break;
                case "print":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "列印");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "列印");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "y";
                    break;
                case "import":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "匯入");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "匯入");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "g";
                    break;
                case "download":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "下載");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "下載");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "g";
                    break;
                case "mail":
                    if ($bSmall) {
                        $aSet["tool"] = (isset($aParams["tool"]) ? $aParams["tool"] : "郵件");
                    } else {
                        $aSet["text"] = (isset($aParams["text"]) ? $aParams["text"] : "郵件");
                    }

                    $aSet["icon"]       = $sEx;
                    $aSet["icon_style"] = "y";
                    break;
            }
        } else {
            $aParams["style"] = $sStyle;

            $aSet = $aParams;
        }

        $aReturn = $aSet;

        return $aReturn;
    }

    /**
     * 設定按鈕（單純按鈕，其按鈕作用，請透過「but」設定）
     *
     * @param array $aParams
     *
     * @return string 返回「Html」語法。
     */
    public function setBtn($aParams = array())
    {
        //載入設定
        $aSet = $this->getBtnExSet($aParams);

        $sText      = (isset($aSet["text"]) ? $aSet["text"] : null);
        $sTool      = (isset($aSet["tool"]) ? $aSet["tool"] : null);
        $sStyle     = (isset($aSet["style"]) ? $aSet["style"] : null);
        $sICon      = (isset($aSet["icon"]) ? $aSet["icon"] : null);
        $sIConStyle = (isset($aSet["icon_style"]) ? $aSet["icon_style"] : null);

        //基本設定
        $sName   = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sValue  = (isset($aParams["value"]) ? $aParams["value"] : null);
        $sID     = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sHead   = (isset($aParams["head"]) ? $aParams["head"] : null);
        $sFooter = (isset($aParams["footer"]) ? $aParams["footer"] : null);
        $sType   = (isset($aParams["type"]) ? $aParams["type"] : null);
        $sStatus = (isset($aParams["status"]) ? $aParams["status"] : $this->Status);

        //是否啟用確認視窗
        $bAlert = (isset($aParams["alert"]) ? $aParams["alert"] : false);
        $sMsg   = (isset($aParams["msg"]) ? $aParams["msg"] : null);

        //彈性
        $aAttr = (isset($aParams["attr"]) ? $aParams["attr"] : array());

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aClass = (isset($aParams["class"]) ? $aParams["class"] : array());
        //$aClass[] = "m-1";
        $aClass[] = "btn";
        $aClass[] = $this->BtnStyle[$sStyle];

        switch ($sType) {
            case "href":
                /*
                //基本設定
                $sCmd  = $aParams["cmd"];
                $sPath = $aParams["path"];

                $aParamHistory = array();

                if (!($sCmd && $sPath) && $_SESSION["tmp"][$sPath]) {
                $sCmd          = $_SESSION["tmp"][$sPath]["cmd"];
                $aParamHistory = $_SESSION["tmp"][$sPath]["param"];
                }

                //跳轉頁面、傳遞參數
                $sIndex = (isset($_SESSION["url"]["index"]) ? $_SESSION["url"]["index"] : null);

                $sUrl   = (isset($aParams["url"]) ? $aParams["url"] : $sIndex);
                $aParam = (isset($aParams["param"]) ? $aParams["param"] : $aParamHistory);
                $aParam = array("param" => $aParam);

                if ($sCmd) {
                $aParam = array_merge(array("cmd" => $sCmd), $aParam);
                }

                if ($sPath) {
                $sUrl   = "{$sUrl}/{$sPath}";
                $aParam = array_merge(array("path" => $sPath), $aParam);
                }

                if ($sUrl === "download") {
                $aParam = array_merge(array("download" => true), $aParam);
                }

                //$sHref = getGenerate($sUrl, $aParam);
                $sHref   = null;
                $aAttr[] = "onclick=setHref('{$sHref}');";
                 */

                $sRoute = (isset($aParams["route"]) ? $aParams["route"] : null);
                $aParam = (isset($aParams["param"]) ? $aParams["param"] : array());

                $sHref = route($sRoute, $aParam);
                while (strpos($sHref, '??') != null) {
                    $sHref = str_replace('??', '?', $sHref);
                }
                $aAttr[] = "onclick=setHref('{$sHref}');";

                break;
            case "submit":
                $sName = (isset($sName) ? $sName : "event");

                $aAttr[] = "onclick=setSubmit(this);";
                break;
            case "class":
                $sName   = (isset($sName) ? $sName : "event");
                $aAttr[] = "onclick=setSubmit(this);";
                break;
        }

        //元件產生
        if ($sHead) {$sHead = $this->setELEMHead($sHead, $bReq);}
        if ($sFooter) {$sFooter = $this->setELEMFooter($sFooter);}

        $aView = array();

        if (!empty($sICon)) {
            $aView[] = $this->setICon(array("icon" => $sICon, "style" => $sIConStyle));
        }

        $aView[] = $sText;

        $sAttr  = implode(" ", $aAttr);
        $sClass = implode(" ", $aClass);
        $sView  = implode(" ", $aView);

        if ($bAlert || !empty($sMsg)) {
        } else {
            $sReturn = sprintf(
                "{$sHead}
                <button type='button' class='%s' data-toggle='tooltip' data-placement='top' title='%s' id='%s' name='%s' value='%s' %s>
                    %s
                </button>
                {$sFooter}"
                , $sClass, $sTool, $sID, $sName, (!isset($sValue)) ? null : $sValue, $sAttr, $sView
            );
        }

        return $sReturn;
    }
}
