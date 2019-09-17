<?php

namespace App\Alltop;

//需求檔案＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
include_once "uiLayout.php";
include_once "uiElement.php";

class BaseView
{
    //底層
    public $Layout;
    public $Element;

    public function __construct()
    {
        //底層
        $this->Layout  = new Layout();
        $this->Element = new Element();
    }

    //Layout
    public function setValidata($ID)
    {
        $sReturn = sprintf(
            "<script>
                $('#%s').validate({
                    ignore: [],
                    errorElement: 'span',
                    errorPlacement: function ( error, element ) {
                        // Add the `invalid-feedback` class to the error element
                        error.addClass( 'invalid-feedback' );

                        if (typeof(element.closest('td')[0]) != 'undefined') {
                            element.closest('td').append(error);
                        } else {
                            element.closest('.form-group').append(error);
                        }

                        /*
                        if ( element.prop( 'type' ) === 'radio' ) {
                            error.insertAfter( element.next( 'label' ) );
                        } else {
                            error.insertAfter( element );
                        }
                        */
                    },
                    highlight: function ( element, errorClass, validClass ) {
                        //$( element ).addClass( 'is-invalid' ).removeClass( 'is-valid' );
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        //$( element ).addClass( 'is-valid' ).removeClass( 'is-invalid' );
                    },
                });
            </script>"
            , $ID
        );

        return $sReturn;
    }

    public function setForm(array $aParams = array())
    {
        return $this->Layout->setForm($aParams);
    }

    public function setGroup(array $aParams = array())
    {
        return $this->Layout->setGroup($aParams);
    }

    public function setSearchGroup(array $aParams = array())
    {
        //元件生成
        $sElem = $this->Layout->setGroup($aParams);

        $sReturn = "
            <div class='card bg-light'>
                <div class='card-header text-center d-md-none' id='SearchHead'  data-toggle='collapse' data-target='#SearchBody' aria-expanded='true' aria-controls='SearchBody'>
                    <a href='#'>
                       <i class='fas fa-filter text-info'></i>
                       進階查詢
                    </a>
                </div>

                <div id='SearchBody' class='collapse d-md-block' aria-labelledby='SearchHead' data-parent='#accordion'>
                    <div class='card-body'>
                        {$sElem}
                    </div>
                </div>
            </div>";

        return $sReturn;
    }

    public function setCard(array $aParams = array())
    {
        return $this->Layout->setCard($aParams);
    }

    public function setTable(array $aParams = array())
    {
        //元件生成
        $sElem = $this->Layout->setTable($aParams);

        $sReturn = $sElem;

        return $sReturn;
    }

    public function setGrid(array $aParams = array())
    {
        //元件生成
        $sElem = $this->Layout->setGrid($aParams);

        $sReturn = $sElem;

        return $sReturn;
    }

    public function setGridSGL(array $aParams = array())
    {
        //元件生成
        $aParams = array_merge(array("type" => "single"), $aParams);

        $sReturn = $this->Layout->setGrid($aParams);

        return $sReturn;
    }

    public function setGridMUL(array $aParams = array())
    {
        //元件生成
        $aParams = array_merge(array("type" => "mulit"), $aParams);

        $sReturn = $this->Layout->setGrid($aParams);

        return $sReturn;
    }

    public function setEGrid(array $aParams = array())
    {
        return $this->Layout->setEGrid($aParams);
    }

    public function setNavs(array $aParams = array())
    {
        return $this->Layout->setNavs($aParams);
    }

    //Element
    public function setIDFormat($sID)
    {
        return $this->Element->setIDFormat($sID);
    }

    public function setFont(array $aParams = array())
    {
        return $this->Element->setFont($aParams);
    }

    public function setAlert(array $aParams = array())
    {
        return $this->Element->setAlert($aParams);
    }

    public function setBtn($aParams = array())
    {
        return $this->Element->setBtn($aParams);
    }

    public function setICon($aParams = array())
    {
        return $this->Element->setICon($aParams);
    }

    public function setBtnSubmit($aParams = array())
    {
        //元件生成
        $aParams = array_merge(array("type" => "submit"), $aParams);

        $sReturn = $this->Element->setBtn($aParams);

        return $sReturn;
    }

    public function setBtnHref($aParams = array())
    {
        //元件生成
        $aParams = array_merge(array("type" => "href"), $aParams);

        $sReturn = $this->Element->setBtn($aParams);

        return $sReturn;
    }

    public function setBtnClass($aParams = array())
    {
        //元件生成
        $aParams = array_merge(array("type" => "class"), $aParams);

        $sReturn = $this->Element->setBtn($aParams);

        return $sReturn;
    }

    public function setHideBox($aParams = array())
    {
        return $this->Element->setHideBox($aParams);
    }

    public function setFileBox($aParams = array())
    {
        //元件生成
        $aParams = array_merge(array("type" => "single"), $aParams);

        $sReturn = $this->Element->setFileBox($aParams);

        return $sReturn;
    }

    public function setFileBoxMUL($aParams = array())
    {
        //基本設定
        $sID       = (empty($aParams["id"]) ? $aParams["name"] : $aParams["id"]);
        $sID       = $this->setIDFormat($sID);
        $aFileData = (empty($aParams["data"]) ? array() : $aParams["data"]);

        //元件生成
        $aParams = array_merge(array("type" => "mulit"), $aParams);

        $sElem = $this->Element->setFileBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Set = {};

                    setFileInput('%s', Set);
                });
            </script>"
            , $sID
        );

        $aField   = array();
        $aField[] = array("head" => _("下載"), "name" => "file_download", "width" => "1%", "align" => "center");
        $aField[] = array("head" => _("附件名稱"), "name" => "file_name", "width" => "20%");

        $aData = array();

        foreach ($aFileData as $skData => $svData) {
            //隱藏（KEY）
            $aData[$skData]["seq"] = trim($svData["seq"]);

            //傳遞參數
            // $aParam = array(
            //     "file_name"   => $svData["file_name"],
            //     "file_encode" => $svData["file_encode"],
            //     "file_path"   => $svData["file_path"],
            // );
            $aParam = array($svData['seq']);

            //顯示
            $aData[$skData]["file_download"] = $this->setBtnHref(array("ex" => "download", "small" => true, "route" => "download", "param" => $aParam));
            $aData[$skData]["file_name"]     = trim($svData["file_name"]);
            $aData[$skData]["file_encode"]   = trim($svData["file_encode"]);
            $aData[$skData]["file_path"]     = trim($svData["file_path"]);
        }

        $aSet = array(
            "id"    => $sID,
            "field" => $aField,
            "data"  => $aData,
            "btn"   => array("remove"),
        );

        $sGrid = $this->setGridMUL($aSet);

        $sReturn = $sElem . "<BR>" . $sScript . $sGrid;

        return $sReturn;
    }

    public function setTextBox($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);
        $sMin = (isset($aParams["min"]) ? $aParams["min"] : null);
        $sMax = (isset($aParams["max"]) ? $aParams["max"] : null);

        $aSet             = array();
        $aSet["required"] = $bReq;

        if (isset($sMin) && isset($sMax)) {
            $aSet["rangelength"] = array($sMin, $sMax);
        } else {
            if (isset($sMin)) {$aSet["minlength"] = $sMin;}
            if (isset($sMax)) {$aSet["maxlength"] = $sMax;}
        }

        $aSet["messages"] = array(
            "required"    => "※必填資訊！",
            "minlength"   => "※字數不得低於 {0} 字！",
            "maxlength"   => "※字數不得大於 {0} 字！",
            "rangelength" => "※字數限制於 {0} ~ {1} 個字！",
        );

        $sSet = json_encode($aSet);

        //元件生成
        $sElem = $this->Element->setBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');

                    $(Elem).rules('add', %s);
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setNumberBox($aParams = array())
    {
        //基本設定
        $sID = (isset($aParams["id"]) ? $aParams["id"] : $aParams["name"]);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);
        $sMin = (isset($aParams["min"]) ? $aParams["min"] : null);
        $sMax = (isset($aParams["max"]) ? $aParams["max"] : null);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["number"]   = true;

        if (isset($sMin) && isset($sMax)) {
            $aSet["range"] = array($sMin, $sMax);
        } else {
            if (isset($sMin)) {$aSet["min"] = $sMin;}
            if (isset($sMax)) {$aSet["max"] = $sMax;}
        }

        $aSet["messages"] = array(
            "required" => "※必填資訊！",
            "number"   => "※請輸入數值！",
            "min"      => "※數值不得小於 {0}！",
            "max"      => "※數值不得大於 {0}！",
            "range"    => "※數值限制於 {0} ~ {1} 之間！",
        );

        $sSet = json_encode($aSet);

        //元件生成
        $aParams = array_merge(array("type" => "number"), $aParams);

        $sElem = $this->Element->setBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');

                    $(Elem).rules('add', %s);
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setMailBox($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["email"]    = true;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
            "email"    => "※請輸入正確EMail資訊！",
        );

        $sSet = json_encode($aSet);

        //元件生成
        $sElem = $this->Element->setBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');

                    $(Elem).rules('add', %s);
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setDateTimeBox($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sID   = $this->setIDFormat($sID);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
        );

        $sSet = json_encode($aSet);

        //元件升成
        $sElem = $this->Element->setDateTimeBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');
                    var Set = {
                        format: 'YYYY-MM-DD LT',
                    };

                    $(Elem).rules('add', %s);
                    setDateTimePicker(Elem, Set);
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setDateBox($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sID   = $this->setIDFormat($sID);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["date"]     = true;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
            "date"     => "※請輸入正確日期！",
        );

        $sSet = json_encode($aSet);

        //元件升成
        $sElem = $this->Element->setDateTimeBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');
                    var Set = {
                        format: 'YYYY-MM-DD',
                    };

                    $(Elem).rules('add', %s);
                    setDateTimePicker(Elem, Set);
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setDateBoxMUL($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sID   = $this->setIDFormat($sID);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        //$aSet["date"]     = true;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
            //"date"     => "※請輸入正確日期！",
        );

        $sSet = json_encode($aSet);

        //元件升成
        $sElem = $this->Element->setDateTimeBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');
                    var Set = {
                        format: 'YYYY.MM.DD',
                        allowMultidate: true,
                        multidateSeparator: ','
                    };

                    $(Elem).rules('add', %s);
                    setDateTimePicker(Elem, Set);
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setTimeBox($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sID   = $this->setIDFormat($sID);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["time"]     = true;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
            "time"     => "※請輸入正確時間（24小時制）！",
        );

        $sSet = json_encode($aSet);

        //元件
        $sElem = $this->Element->setDateTimeBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');
                    var Set = {
                        format: 'LT',
                    };

                    $(Elem).rules('add', %s);
                    setDateTimePicker(Elem, Set);
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setPassWordBox($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
        );

        $sSet = json_encode($aSet);

        //元件生成
        $aParams = array_merge(array("type" => "password"), $aParams);

        $sElem = $this->Element->setBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');

                    $(Elem).rules('add', %s);
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setTextArea($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);
        $sMin = (isset($aParams["min"]) ? $aParams["min"] : null);
        $sMax = (isset($aParams["max"]) ? $aParams["max"] : null);

        $aSet             = array();
        $aSet["required"] = $bReq;

        if (isset($sMin) && isset($sMax)) {
            $aSet["rangelength"] = array($sMin, $sMax);
        } else {
            if (isset($sMin)) {$aSet["minlength"] = $sMin;}
            if (isset($sMax)) {$aSet["maxlength"] = $sMax;}
        }

        $aSet["messages"] = array(
            "required"    => "※必填資訊！",
            "minlength"   => "※字數不得低於 {0} 字！",
            "maxlength"   => "※字數不得大於 {0} 字！",
            "rangelength" => "※字數限制於 {0} ~ {1} 個字！",
        );

        $sSet = json_encode($aSet);

        //元件生成
        $sElem = $this->Element->setAreaBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');

                    $(Elem).rules('add', %s);
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setEditArea($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);
        $aSet = array();

        /*
        $aSet["required"] = $bReq;
        $aSet["messages"] = array(
        "required" => "※必填資訊！",
        );
         */

        $sSet = json_encode($aSet);

        //元件生成
        $sElem = $this->Element->setAreaBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementById('%s');

                    $(Elem).rules('add', %s);

                    CKEDITOR.replace(Elem, {language: 'zh', skin: 'kama'});
                });
            </script>"
            , $sID, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setRadioBox($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
        );

        $sSet = json_encode($aSet);

        //元件生成
        $aParams = array_merge(array("type" => "radio"), $aParams);

        $sElem = $this->Element->setOptionBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementsByName('%s[]');

                    $(Elem).rules('add', %s);
                });
            </script>"
            , $sName, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setCheckBox($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);
        $sMin = (isset($aParams["min"]) ? $aParams["min"] : null);
        $sMax = (isset($aParams["max"]) ? $aParams["max"] : null);

        $aSet             = array();
        $aSet["required"] = $bReq;

        if (isset($sMin) && isset($sMax)) {
            $aSet["rangelength"] = array($sMin, $sMax);
        } else {
            if (isset($sMin)) {$aSet["minlength"] = $sMin;}
            if (isset($sMax)) {$aSet["maxlength"] = $sMax;}
        }

        $aSet["messages"] = array(
            "required"    => "※必填資訊！",
            "minlength"   => "※選項不得低於 {0} 項！",
            "maxlength"   => "※選項不得大於 {0} 項！",
            "rangelength" => "※選項數量限制於 {0} ~ {1} 項！",
        );

        $sSet = json_encode($aSet);

        //元件生成
        $aParams = array_merge(array("type" => "checkbox"), $aParams);

        $sElem = $this->Element->setOptionBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementsByName('%s[]');

                    $(Elem).rules('add', %s);
                });
            </script>"
            , $sName, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setComboBox($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
        );

        $sSet = json_encode($aSet);

        //元件生成
        $sElem = $this->Element->setComboBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementsByName('%s[]');

                    $(Elem).rules('add', %s);
                    $(Elem).selectpicker({size: 7});
                    $(Elem).on('change', function () {
                        $(this).valid();
                    });
                });
            </script>"
            , $sName, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setComboBoxMUL($aParams = array())
    {
        //基本設定
        $sName = (isset($aParams["name"]) ? $aParams["name"] : null);
        $sID   = (isset($aParams["id"]) ? $aParams["id"] : $sName);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
        );

        $sSet = json_encode($aSet);

        //元件生成
        $aParams = array_merge(array("multi" => true), $aParams);

        $sElem = $this->Element->setComboBox($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementsByName('%s[]');

                    $(Elem).rules('add', %s);
                    $(Elem).selectpicker({size: 7});
                    $(Elem).on('change', function () {
                        $(this).valid();
                    });
                });
            </script>"
            , $sName, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    //Base
    public function incView($sPath)
    {
        if (is_array($sPath)) {
            $sPath = getCodePath($sPath);
        }

        include_once "{$_SESSION["url"]["path"]}/{$sPath}";

        return $aHtml;
    }

    public function setDateFormat($sDate, $sFormat)
    {
        $sReturn = null;

        if (method_exists($sDate, "format")) {
            switch ($sFormat) {
                case "date":
                    $sReturn = $sDate->format("Y.m.d");
                    break;
                case "datetime":
                    $sReturn = $sDate->format("Y.m.d H:i");
                    break;
                case "time":
                    $sReturn = $sDate->format("H:i");
                    break;
            }
        }

        return $sReturn;
    }

    public function setJump(array $aParams = array())
    {
        //基本設定
        $sName     = (isset($aParams["name"]) ? $aParams["name"] : null);
        $bClose    = (isset($aParams["close"]) ? $aParams["close"] : true);
        $bReLoad   = (isset($aParams["reload"]) ? $aParams["reload"] : false);
        $sUrlParam = (isset($aParams["urlParam"]) ? $aParams["urlParam"] : null);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
        );

        $sSet = json_encode($aSet);

        //跳轉頁面、傳遞參數
        $sUrl = $aParams["url"];
        // $sUrlParam = $burlParam;
        $aParam = (empty($aParams["param"]) ? array() : $aParams["param"]);
        $aParam = array_merge(array(
            "jump" => true,
            "name" => $sName,
        ), $aParam);

        $sHead   = isset($aParam["head"]) ? $aParam["head"] : null;
        $sFooter = isset($aParam["footer"]) ? $aParam["footer"] : null;
        unset($aParam["head"]);
        unset($aParam["footer"]);

        //$sHref = getGenerate($sUrl, $aParam);
        $sHref = route($sUrl, $sUrlParam);

        $aHtml = array(
            "head" => $sHead,
            "href" => $sHref,
        );

        $sHtml = json_encode($aHtml);

        //元件生成
        $sClick = sprintf(
            "onclick=setModalOpen('%s')"
            , $sHtml
        );

        $aParams = array_merge(array("attr" => array($sClick)), $aParams);

        $sReturn = $this->setBtn($aParams);

        return $sReturn;
    }

    public function setJumpSel(array $aParams = array())
    {
        //基本設定
        $sName   = (isset($aParams["name"]) ? $aParams["name"] : null);
        $bClose  = (isset($aParams["close"]) ? $aParams["close"] : true);
        $bReLoad = (isset($aParams["reload"]) ? $aParams["reload"] : false);

        //驗證設定
        $bReq = (isset($aParams["req"]) ? $aParams["req"] : false);

        $aSet             = array();
        $aSet["required"] = $bReq;
        $aSet["messages"] = array(
            "required" => "※必填資訊！",
        );

        $sSet = json_encode($aSet);

        //跳轉頁面、傳遞參數
        $sUrl   = $aParams["url"];
        $aParam = (empty($aParams["param"]) ? array() : $aParams["param"]);
        $aParam = array_merge(array(
            "jump" => true,
            "name" => $sName,
        ), $aParam);

        $sHead   = isset($aParams["head"]) ? $aParams["head"] : null;
        $sFooter = isset($aParams["footer"]) ? $aParams["footer"] : null;

        unset($aParam["head"]);
        unset($aParam["footer"]);

        $sHref = route($sUrl);

        $aHtml = array(
            "head" => $sHead,
            "href" => $sHref,
        );

        $sHtml = json_encode($aHtml);
        //元件生成
        $sClick = sprintf(
            "onclick=setModalOpen('%s')"
            , $sHtml
        );

        $aBtnParams = array(
            "icon"       => "fas fa-th-list",
            "icon_style" => "none",
            "style"      => "i",
            "class"      => array("btn-sm"),
            "attr"       => array($sClick),
        );

        $sBtn = $this->setBtn($aBtnParams);

        // var_dump($sBtn);
        /*
        <button type='button' class='btn btn-outline-dark' data-toggle='tooltip' data-placement='top' title='' id='' name='' value='' onclick=setModalOpen('{"head":"\u5f48\u8df3\u8996\u7a97","href":"\/2019\/ma00\/SnVtcA==\/U2luZ2xl@eyJqdW1wIjp0cnVlLCJuYW1lIjoiZm9ybVswXVtqdW1wXSIsImNsb3NlIjp0cnVlLCJyZWxvYWQiOmZhbHNlfQ=="}')>
        <i class='fas fa-th-list'></i>
        </button>
         */
        /*
        $sBtn = sprintf(
        "<div class='input-group-prepend'>
        <button type='button' class='btn btn-sm btn-info' onclick=setModalOpen('%s');>
        <i class='fas fa-th-list'></i>
        </button>
        </div>"
        , $sHtml
        );
         */

        $aParams = array_merge(array("btn" => $sBtn), $aParams);

        $sElem = $this->setComboBoxMUL($aParams);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    var Elem = document.getElementsByName('%s[]');

                    $(Elem).rules('add', %s);
                    $(Elem).selectpicker({size: 7});
                    $(Elem).on('change', function () {
                        $(this).valid();
                    });
                });
            </script>"
            , $sName, $sSet
        );

        $sReturn = $sElem . $sScript;

        return $sReturn;
    }

    public function setHead(array $aParams = array())
    {
        $sHead  = (isset($aParams["head"]) ? $aParams["head"] : null);
        $aBread = (isset($aParams["bread"]) ? $aParams["bread"] : null);
        $sFav   = (isset($aParams["fav"]) ? $aParams["fav"] : null);
        $sICon  = null;

        switch ($_SESSION["get"]["cmd"]) {
            case "add":
                $sICon = $this->Element->setICon(array("icon" => "add", "style" => "g"));
                break;
            case "edit":
                $sICon = $this->Element->setICon(array("icon" => "edit", "style" => "y"));
                break;
            case "view":
                $sICon = $this->Element->setICon(array("icon" => "view", "style" => "i"));
                break;
            default:
                break;
        }

        $aHead = array();

        if (!empty($sICon)) {
            $aHead[] = $sICon;
        } else {
            if (!empty($sFav)) {
                //我的最愛
                $aWhere = array();
                $aParam = array();

                $aWhere[] = "user_number = ?";
                $aParam[] = $_SESSION["G_USER"];

                $aUser = $this->oSysUser->read(array("where" => $aWhere, "param" => $aParam));

                $aMenu_Fav = (empty($aUser[0]["favourite"]) ? array() : explode("|", $aUser[0]["favourite"]));

                $sUrl = getGenerate($_SESSION["url"]["index"], array("index" => $_SESSION["url"]["index"], "fav" => $sFav));

                if (in_array($sFav, $aMenu_Fav)) {
                    $aHead[] = "
                        <button type='button' class='btn btn-outline-dark border border-white mb-1 rounded-circle' onclick=setHref('{$sUrl}');>
                            <i class='fas fa-star' style='color: #FF0000;font-size: 1.5rem;'></i>
                        </button>";
                } else {
                    $aHead[] = "
                        <button type='button' class='btn btn-outline-dark border border-white mb-1 rounded-circle' onclick=setHref('{$sUrl}');>
                            <i class='far fa-star' style='font-size: 1.5rem;'></i>
                        </button>";
                }
            }
        }

        $aHead[] = $sHead;
        $sBread  = null;

        if ($aBread) {
            $aList = array();

            foreach ($aBread as $sKey => $sValue) {
                $aList[] = sprintf("<div class='breadcrumb-item'>%s</div>", $sValue);
            }

            $sBread = sprintf("<div class='section-header-breadcrumb'>%s</div>", implode("", $aList));
        }

        $sHead = implode("", $aHead);

        $sReturn = sprintf(
            "<div class='section-header'>
                <h1>%s</h1>%s
            </div>"
            , $sHead, $sBread
        );

        return $sReturn;
    }

    public function setMenu()
    {
        //$aMenu = $this->BaseModel->getMenuInfo();
        $aMenu = "";

        $aReturn = array();

        foreach ($aMenu as $skMenu => $svMenu) {
            $sProgName  = $svMenu["menu_name"];
            $sProgICon  = $svMenu["menu_icon"];
            $sProgChild = $svMenu["menu_child"];

            $sActive = "";

            if (count($sProgChild) != 0) {
                $aListChild = array();

                foreach ($sProgChild as $skProgChild => $svProgChild) {
                    $sProgNameSub = trim($svProgChild["menu_name"]);
                    $sProgIConSub = trim($svProgChild["menu_icon"]);
                    $sProgProj    = trim($svProgChild["menu_proj"]);
                    $sProgPath    = trim($svProgChild["menu_path"]);

                    $sActiveList = "";

                    if ($sProgPath === $_SESSION["url"]["index"]) {
                        $sActive     = "active";
                        $sActiveList = "active";
                    }

                    $sUrl = getGenerate($sProgPath, array("index" => $sProgPath));

                    $aListChild[] = sprintf(
                        "<li class='%s'><a class='nav-link' href='#' onclick=setHref('%s');>%s</a></li>"
                        , $sActiveList, $sUrl, $sProgNameSub
                    );
                }

                $sListChild = implode("", $aListChild);

                $aReturn[] = sprintf(
                    "<li class='dropdown %s'>
                        <a href='#' class='nav-link has-dropdown'>
                            <i class='far fa-folder'></i>
                            <span>%s</span>
                        </a>
                        <ul class='dropdown-menu'>
                            %s
                        </ul>
                    </li>"
                    , $sActive, $sProgName, $sListChild
                );
            }
        }

        return implode("", $aReturn);
    }

    public function setSwal($aParams = array())
    {
        //基本設定
        $sTitle   = (isset($aParams["title"]) ? $aParams["title"] : null);
        $aMessage = (isset($aParams["msg"]) ? $aParams["msg"] : null);
        $sType    = (isset($aParams["type"]) ? $aParams["type"] : "question");
        $sStyle   = (isset($aParams["style"]) ? $aParams["style"] : "time");

        //跳轉頁面、傳遞參數
        $sRoute = (isset($aParams["route"]) ? $aParams["route"] : null);
        $aParam = (isset($aParams["param"]) ? $aParams["param"] : array());

        $sMessage = "";

        if (is_array($aMessage)) {
            $sMessage = implode("<BR>", $aMessage);
        } else {
            $sMessage = $aMessage;
        }

        $sAct     = "";
        $sContent = "";

        if (!empty($sRoute)) {
            $sAct     = "href";
            $sContent = getGenerate($sRoute, $aParam);
        }

        $aSet         = array();
        $aSet["html"] = $sMessage;
        $aSet["type"] = $sType;

        if (!empty($sTitle)) {
            //自訂Title
            $aSet["title"] = $sTitle;
        } else {
            //依據ICon種類，載入預設Title
            switch ($sType) {
                case "success":
                    $aSet["title"] = "動作執行成功！";
                    break;
                case "error":
                    $aSet["title"] = "動作執行失敗！";
                    break;
                case "warning":
                    $aSet["title"] = "系統警告！";
                    break;
                case "info":
                    $aSet["title"] = "系統資訊！";
                    break;
                case "question":
                    $aSet["title"] = "是否執行此動作？";
                    break;
            }
        }

        switch ($sStyle) {
            case "time":
                $aSet["showConfirmButton"] = false;
                $aSet["timer"]             = 1500;

                $sSet = json_encode($aSet);

                $sReturn = sprintf(
                    "<script>
                        $(document).ready(function() {
                            setSweetAlertTime(%s, '%s', '%s');
                        });
                    </script>"
                    , $sSet, $sContent, $sAct
                );
                break;
            case "alert":
                $sSet = json_encode($aSet);

                $sReturn = sprintf(
                    "<script>
                        $(document).ready(function() {
                            setSweetAlert(%s, '%s', '%s');
                        });
                    </script>"
                    , $sSet, $sContent, $sAct
                );
                break;
            case "check":
                $aSet["showCancelButton"] = true;

                $sSet = json_encode($aSet);

                $sReturn = sprintf(
                    "<script>
                        $(document).ready(function() {
                            setSweetAlert(%s, '%s', '%s');
                        });
                    </script>"
                    , $sSet, $sContent, $sAct
                );
                break;
        }

        return $sReturn;
    }

    public function setModule()
    {
        //Module
        $aWhere = array();
        $aParam = array();

        $aWhere[] = "param_class = ?";
        $aParam[] = "系統模組";

        $aModule = $this->oSysParam->read(array("where" => $aWhere, "param" => $aParam));
        $sResult = null;

        foreach ($aModule as $sKey => $sValue) {
            $sUrl = getGenerate("ms01/Guide", array("guide" => true, "module" => $sValue["param_content"]));
            //active

            $sResult .= sprintf(
                "<li class='nav-item'>
                    <a href='%s' class='nav-link'>
                        <i class='far fa-clone'></i>
                        <span>%s</span>
                    </a>
                </li>"
                , $sUrl, $sValue["param_remark"]
            );
        }

        return $sResult;
    }

    public function setTemplate($aHtml)
    {
        $aBody = array();
        $sHome = getGenerate("ms01/s01000_Home", array("index" => "ms01/s01000_Home"));

        if (is_array($aHtml)) {
            foreach ($aHtml as $skHtml => $svHtml) {
                if (is_array($svHtml)) {
                    $aBody[] = implode("", $svHtml);
                } else {
                    $aBody[] = $svHtml;
                }
            }
        } else {
            $aBody[] = $aHtml;
        }

        $sBody = implode("", $aBody);

        $sTitle = null;

        if (is_bool($this->Setup["title"])) {
            $aProj = explode("/", $_SESSION["url"]["index"]);
            $sProj = array_pop($aProj);

            $sHead  = "查無功能名稱！";
            $aBread = array();
            $sFav   = null;

            //取得功能選單
            $aWhere = array();
            $aParam = array();

            $aWhere[] = "menu_folder = ?";
            $aParam[] = $sProj;

            $aMenu = $this->oSysMenu->read(array("where" => $aWhere, "param" => $aParam));

            if ($aMenu) {
                $sHead = $aMenu[0]["menu_name"];
                $sFav  = $aMenu[0]["menu_number"];

                array_unshift($aBread, $aMenu[0]["menu_name"]);
            }

            //取得所屬專案
            $aWhere = array();
            $aParam = array();

            $aWhere[] = "menu_number = ?";
            $aParam[] = $aMenu[0]["menu_upper"];

            $aProj = $this->oSysMenu->read(array("where" => $aWhere, "param" => $aParam));

            if ($aProj) {
                array_unshift($aBread, $aProj[0]["menu_name"]);
            }

            //取得所屬模組
            $aWhere = array();
            $aParam = array();

            $aWhere[] = "param_class = ?";
            $aParam[] = "系統模組";

            $aWhere[] = "param_content = ?";
            $aParam[] = $aProj[0]["menu_module"];

            $aModule = $this->oSysParam->read(array("where" => $aWhere, "param" => $aParam));

            if ($aProj) {
                array_unshift($aBread, $aModule[0]["param_remark"]);
            }

            $aHead = array(
                "head"  => $sHead,
                "bread" => $aBread,
                "fav"   => $sFav,
            );

            if ($this->Setup["title"]) {
                $sTitle = $this->setHead($aHead);
            }
        } else {
            if ($this->Setup["title"]) {
                $aHead = array(
                    "head" => $this->Setup["title"],
                );

                $sTitle = $this->setHead($aHead);
            }
        }

        $sModule = $this->setModule();

        //var_dump($aModule);

        //$sMenu = $this->setMenu();

        $bFrame = $this->Setup["frame"];

        if ($_POST["refresh"]) {
            echo json_encode(array_merge($this->Model, htmlspecialchars($_POST["ajax"])));
        } else if ($_POST["reload"]) {
            echo json_encode(array_merge($this->Model, array("html" => $sTitle . $sHtml)));
        } else {
            include_once "template.html";
        }

        $aJump = $this->Model["result"]["jump"];

        unset($this->Model["result"]["jump"]);

        $aResult = $this->Model["result"];

        if (!empty($aResult)) {
            $aResult = array_filter($aResult);

            $bError = false;
            $aMsg   = array();

            // var_dump($aResult);

            foreach ($aResult as $sKey => $sValue) {
                if (is_array($sValue)) {
                    if (!($bError || $sValue["result"])) {
                        $bError = true;
                    }

                    foreach ($sValue["msg"] as $sKey_Msg => $sValue_Msg) {
                        $aMsg[] = $sValue_Msg;
                    }
                } else {
                    $bError = true;

                    $aMsg[] = $sValue;
                }
            }

            if ($bError) {
                $sSwal = $this->setSwal(array("type" => "error", "msg" => implode("<br>", $aMsg), "style" => "alert"));
            } else {
                $sSwal = $this->setSwal(array("type" => "success", "msg" => implode("<br>", $aMsg), "style" => "time"));
            }

            echo $sSwal;
        }

        if (!empty($aJump)) {
            $aJava = array();

            if (in_array("close", $aJump)) {
                $aJava[] = "parent.setModalClose();";
            }

            if (in_array("reload", $aJump)) {
                $aJava[] = sprintf("parent.setReLoad('%s');", $_SESSION["get"]["name"]);
            }

            $sScript = "
                <script>
                    $(document).ready(function() {
                        " . implode("", $aJava) . "
                    });
                </script>";

            echo $sScript;
        }
    }

    public function setToolBar(array $aTool = array())
    {
        $aToolHead = array();
        $aToolBody = array();

        foreach ($aTool as $key => $value) {
            $sTool    = "ToolBar_{$key}";
            $sBgColor = "info";

            switch ($value['tool']) {
                case 'search':
                    $sBgColor = "info";

                    $aToolHead[] = "
                        <a href='#' class='m-2' data-toggle='collapse' data-target='#{$sTool}' aria-expanded='false' aria-controls='{$sTool}'>
                            <i class='fas fa-search text-{$sBgColor}'></i>
                        </a>";
                    break;
                case 'print':
                    $sBgColor = "warning";

                    $aToolHead[] = "
                        <a href='#' class='m-2' data-toggle='collapse' data-target='#{$sTool}' aria-expanded='false' aria-controls='{$sTool}'>
                            <i class='fas fa-print text-{$sBgColor}'></i>
                        </a>";
                    break;
                default:
                    # code...
                    break;
            }

            $aToolBody[] = "
                <div class='collapse' id='{$sTool}'>
                    <div class='card card-body bg-light border border-{$sBgColor}'>
                        {$value['body']}
                    </div>
                </div>";
        }

        $sToolHead = implode("", $aToolHead);
        $sToolBody = implode("", $aToolBody);

        $sReturn = sprintf("
            <p>
                %s
            </p>
            %s"
            , $sToolHead, $sToolBody
        );

        return $sReturn;
    }

    /**
     * 製作頁籤
     * @param array|array $aParams
     * @return HTML
     */
    public function setTab(array $aParams = array())
    {
        $sTablHead = ''; // 頁籤頭
        $sTabBody  = ''; // 頁籤內容

        foreach ($aParams['aTabInfo'] as $route => $param) {
            $aRouteParam = isset($param['param']) ? $param['param'] : array();
            $sRoute      = route($route, $aRouteParam);
            $sActive     = isset($param['current']) ? $param['current'] : '';
            $bShow       = isset($param['show']) ? $param['show'] : true; // 是否顯示

            if ($bShow) {
                $sTablHead .= "<li>
                                <a id='" . $sRoute . "_id' class='nav-item nav-link " . $sActive . "' data-toggle='tab'
                                    href='" . $sRoute . "'>" . $param['title'] . "
                                </a>
                               </li>";
                $sTabBody .= "<div class='tab-pane " . $sActive . "' >
                                " . (isset($param['view']) ? $param['view'] : '') . "
                              </div>";
            }
        }

        $sHtml = "
            <div id='tabs-shadow' style='min-height: 80vh; width:100%'>
                <ul class='nav nav-tabs mb-3' id='nav_tabs' role='tablist'>"
            . $sTablHead . "
                </ul>
                <div class='tab-content' id='nav-tabContent'>
                    " . $sTabBody . "
                </div>
            </div>";

        // 找出id尾部為_id的<a>元素綁定click事件
        $sHtml .= "
        <script type='text/javascript'>
            $(function(){
                $('a[id$=\"_id\"]').click(function(e){
                     // console.log(e.target.href);
                     window.location.href = e.target.href;
                });
            });
        </script>";
        return $sHtml;
    }
}
