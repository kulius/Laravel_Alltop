<?php

namespace App\Alltop;

include_once "uiElement.php";

class Layout extends Element
{
    public $GridBtnStyle = array("btn", "btn-outline-dark");

    public function __construct() {}

    public function setForm(array $aParams = array())
    {
        //(!isset($aParams["name"]) ? null : $aParams["name"]);
        //基本設定
        $sName       = (isset($aParams["name"]) ? $aParams["name"] : "main");
        $sID         = (isset($aParams["id"]) ? $aParams["id"] : $sName);
        $sBody       = (isset($aParams["body"]) ? $aParams["body"] : mull);
        $sMethod     = (isset($aParams["method"]) ? $aParams["method"] : "POST");
        $bValidation = (isset($aParams["vaild"]) ? $aParams["vaild"] : true);
        $bUpload     = (isset($aParams["upload"]) ? $aParams["upload"] : true);

        //跳轉頁面、傳遞參數
        $sNow  = (isset($_SESSION["url"]["now"]) ? $_SESSION["url"]["now"] : null);
        $sPath = (isset($_SESSION["tmp"]["path"]) ? $_SESSION["tmp"]["path"] : null);
        $sGet  = (isset($_SESSION["get"]) ? $_SESSION["get"] : null);

        $sUrl   = (isset($aParams["url"]) ? $aParams["url"] : $sNow);
        $aParam = array("path" => $sPath, "param" => $sGet);

        //$sHref = getGenerate($sUrl, $aParam);
        $sHref = null;
        //var_dump($_SESSION["get"]);
        $aBody = array();

        if (is_array($sBody)) {
            foreach ($sBody as $skBody => $svBody) {
                if (is_array($svBody)) {
                    $aBody[] = implode("", $svBody);
                } else {
                    $aBody[] = $svBody;
                }
            }
        } else {
            $aBody[] = $sBody;
        }

        $sBody = implode("", $aBody);

        //彈性
        $aAttr  = (isset($aParams["attr"]) ? $aParams["attr"] : array());
        $aClass = (isset($aParams["class"]) ? $aParams["class"] : array());

        if ($bValidation) {
            //$aClass[] = "example-form_after";
            //$aClass[] = "needs-validation";
        }

        $sClass = implode(" ", $aClass);

        if ($bUpload) {
            $aAttr[] = "enctype='multipart/form-data'";
        }

        //<div class='d-flex justify-content-md-center'>
        //class='container'
        $sScript = sprintf(
            "<script>
                //$(document).ready(function() {
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
                //});
            </script>"
            , $sName
        );

        $sAttr = implode(" ", $aAttr);

        //novalidate
        $sReturn = sprintf(
            "<form class='%s p-2' method='%s' id='%s' name='%s' action='%s' %s autocomplete='off'>
                %s
            </form>
            {$sScript}"
            , $sClass, $sMethod, $sID, $sName, $sHref, $sAttr, $sBody
        );

        return $sReturn;
    }

    public function getGroupLayout(array $aForms)
    {
        $aBody = array();

        foreach ($aForms as $skForms => $svForms) {
            //基本設定
            $sHead   = (isset($svForms["head"]) ? $svForms["head"] : null);
            $sBody   = (isset($svForms["body"]) ? $svForms["body"] : null);
            $sFooter = (isset($svForms["footer"]) ? $svForms["footer"] : null);
            $sAlign  = (isset($svForms["align"]) ? $svForms["align"] : "left");

            //彈性佈局
            $sFlex = (isset($svForms["flex"]) ? $svForms["flex"] : null);

            //彈性
            $aClass = (isset($svForms["class"]) ? $svForms["class"] : array());
            $aAttr  = (isset($svForms["attr"]) ? $svForms["attr"] : array());

            $aClass[] = "form-group";
            $aClass[] = "text-" . $sAlign;

            if (is_array($sFlex)) {
                foreach ($sFlex as $sK => $sV) {
                    switch ($sK) {
                        case "s":
                            $aClass[] = "col-sm-{$sV}";
                            break;
                        case "m":
                            $aClass[] = "col-md-{$sV}";
                            break;
                        case "l":
                            $aClass[] = "col-lg-{$sV}";
                            break;
                        case "xl":
                            $aClass[] = "col-xl-{$sV}";
                            break;
                    }
                }
            } else {
                if ($sFlex) {
                    switch ($sFlex) {
                        case "auto":
                            $aClass[] = "col-auto";
                            break;
                        default:
                            $aClass[] = "col-md-{$sFlex}";
                            break;
                    }
                } else {
                    $aClass[] = "col-md-4";
                }
            }

            $sClass = implode(" ", $aClass);
            $sAttr  = implode(" ", $aAttr);

            if ($sHead) {$sHead = $this->setElemHead($sHead);}
            if ($sFooter) {$sFooter = $this->setElemFooter($sFooter);}

            $aBody[] = sprintf(
                "<div class='%s' %s>
                {$sHead}
                %s
                {$sFooter}
                </div>"
                , $sClass, $sAttr, $sBody
            );
        }

        $sBody = implode("", $aBody);

        $sReturn = sprintf(
            "<div class='form-row'>%s</div>"
            , $sBody
        );

        return $sReturn;
    }

    public function setGroup(array $aParams = array())
    {
        //基本設定
        $sBody = (isset($aParams["body"]) ? $aParams["body"] : null);

        //彈性
        $aAttr = (isset($aParams["attr"]) ? $aParams["attr"] : array());

        if (is_array($sBody)) {
            $sBody = $this->getGroupLayout($sBody);
        }

        $sAttr = implode(" ", $aAttr);

        $sReturn = sprintf(
            "<div %s>%s</div>"
            , $sAttr, $sBody
        );

        return $sReturn;
    }

    public function getCardLayout(array $aForms)
    {
        $aBody = array();

        foreach ($aForms as $skForms => $svForms) {
            //基本設定
            $sHead   = (isset($svForms["head"]) ? $svForms["head"] : null);
            $sBody   = (isset($svForms["body"]) ? $svForms["body"] : null);
            $sFooter = (isset($svForms["footer"]) ? $svForms["footer"] : null);
            $sAlign  = (isset($svForms["align"]) ? $svForms["align"] : "left");

            //彈性佈局
            $sFlex = (isset($svForms["flex"]) ? $svForms["flex"] : null);

            //彈性
            $aClass = (isset($svForms["class"]) ? $svForms["class"] : array());

            if (is_array($sFlex)) {
                foreach ($sFlex as $sK => $sV) {
                    switch ($sK) {
                        case "s":
                            $aClass[] = "col-sm-{$sV}";
                            break;
                        case "m":
                            $aClass[] = "col-md-{$sV}";
                            break;
                        case "l":
                            $aClass[] = "col-lg-{$sV}";
                            break;
                        case "xl":
                            $aClass[] = "col-xl-{$sV}";
                            break;
                    }
                }
            } else {
                if ($sFlex) {
                    switch ($sFlex) {
                        case "auto":
                            $aClass[] = "col-auto";
                            break;
                        default:
                            $aClass[] = "col-md-{$sFlex}";
                            break;
                    }
                } else {
                    $aClass[] = "col-md-4";
                }
            }

            $sClass = implode(" ", $aClass);

            if ($sHead) {$sHead = "<div class='card-header d-flex p-0 ui-sortable-handle'><h6 class='m-3'>{$sHead}</h6></div>";}
            if ($sFooter) {$sFooter = "<div class='card-footer'><h4>{$sFooter}</h4></div>";}

            $aBody[] = sprintf(
                "<div class='%s'>
                    <div class='card'>
                        {$sHead}
                        <div class='card-body'>%s</div>
                        {$sFooter}
                    </div>
                </div>"
                , $sClass, $sBody
            );
        }

        $sBody = implode("", $aBody);

        $sReturn = sprintf(
            "<div class='form-row'>%s</div>"
            , $sBody
        );

        return $sReturn;
    }

    public function setCard(array $aParams = array())
    {
        //基本設定
        $sBody = (isset($aParams["body"]) ? $aParams["body"] : null);

        //彈性
        $aAttr = (isset($aParams["attr"]) ? $aParams["attr"] : array());

        if (is_array($sBody)) {
            $sBody = $this->getCardLayout($sBody);
        }

        $sAttr = implode(" ", $aAttr);

        $sReturn = sprintf(
            "<div %s>%s</div>"
            , $sAttr, $sBody
        );

        return $sReturn;
    }

    public function getGridSet()
    {
        $aReturn = array();

        $aReturn["language"] = array(
            "lengthMenu"   => "顯示 _MENU_ 筆",
            "search"       => "快速搜尋：",
            "emptyTable"   => "無符合條件資料！",
            "zeroRecords"  => "快速搜尋-無符合條件資料！",
            "info"         => "第 _START_ 至 _END_ 筆，共 _TOTAL_ 筆",
            "infoEmpty"    => "",
            "infoFiltered" => "（從 _MAX_ 筆資料篩選而出）",
            "paginate"     => array(
                "previous" => "上一頁",
                "next"     => "下一頁",
            ),
            "select"       => array(
                "rows" => array("_" => "您選擇了 %d 筆資料！", "0" => ""),
            ),
            "buttons"      => array(
                "selectAll"  => $this->setFont(array("text" => "全選", "icon" => "selected", "icon_style" => "i")),
                "selectNone" => $this->setFont(array("text" => "取消", "icon" => "select", "icon_style" => "i")),
                "create"     => $this->setFont(array("text" => "新增", "icon" => "add", "icon_style" => "g")),
                "edit"       => $this->setFont(array("text" => "編輯", "icon" => "edit", "icon_style" => "y")),
                "remove"     => $this->setFont(array("text" => "刪除", "icon" => "remove", "icon_style" => "r")),
            ),
        );
        $aReturn["dom"] = "
            <'row'<'col-12 col-sm-6 col-md-6'l><'col-12 col-sm-6 col-md-6'f>>
            <'row'<'col-12 col-md-6'B><'col-12 col-md-6 text-right'i>>
            <'row'<'col-sm-12'tr>>
            <'row'<'col-12 d-flex flex-column justify-content-center align-items-center'p>>";

        return $aReturn;
    }

    public function setTable(array $aParams = array())
    {
        //基本設定
        $aField = (isset($aParams["field"]) ? $aParams["field"] : null);
        $aData  = (isset($aParams["data"]) ? $aParams["data"] : null);

        $aTh = array();

        foreach ($aField as $skField => $svField) {
            $sHead  = (isset($svField["head"]) ? $svField["head"] : null);
            $sWidth = (isset($svField["width"]) ? $svField["width"] : "*");
            $sAlign = (isset($svField["align"]) ? $svField["align"] : "left");

            $aClass   = array();
            $aClass[] = "text-{$sAlign}";
            $aClass[] = "align-middle";

            $sClass = implode(" ", $aClass);

            $aTh[] = sprintf(
                "<th class='%s' width='%s'>%s</th>"
                , $sClass, $sWidth, $sHead
            );
        }

        $aTd = array();

        foreach ($aData as $skData => $svData) {
            $sTd = implode("</td><td align='center'>", $svData);
            //var_dump($sTd);
            $aTd[] = "<tr><td align='center'>{$sTd}</td></tr>";
        }
        $sTh = implode("", $aTh);
        $sTr = implode("", $aTd);

        $sReturn = sprintf(
            "<div class='dataTables_wrapper no-footer'>
                <table class='hover row-border compact nowrap dataTable no-footer dtr-column'>
                    <thead>
                        <tr>%s</tr>
                    </thead>
                    <tbody>
                        %s
                    </tbody>
                </table>
            </div>"
            , $sTh, $sTr
        );

        return $sReturn;
    }

    public function setGrid(array $aParams = array())
    {
        //基本設定
        $sID       = (isset($aParams["id"]) ? "{$aParams["id"]}_tb" : "tb");
        $aField    = (isset($aParams["field"]) ? $aParams["field"] : null);
        $aData     = (isset($aParams["data"]) ? $aParams["data"] : null);
        $aSelected = (isset($aParams["selected"]) ? $aParams["selected"] : array());
        $sType     = (isset($aParams["type"]) ? $aParams["type"] : null);
        $aButton   = (isset($aParams["btn"]) ? $aParams["btn"] : array());
        $sWrap     = (isset($aParams["wrap"]) ? "" : "nowrap");
        $sPaging   = $aParams['paging'] ?? true;

        $aCustomButton = (isset($aParams["cusbtn"]) ? $aParams["cusbtn"] : array());

        $aColsSet = array();

        if ($sType) {
            //選取方塊
            $aColsSet[] = array(
                "title"          => "",
                "data"           => null,
                "defaultContent" => "",
                "className"      => "select-checkbox",
                "width"          => "0.5%",
                "searchable"     => false,
                "orderable"      => false,

            );
        }

        //表單明細
        $aColsSet[] = array(
            "title"          => "",
            "data"           => null,
            "defaultContent" => "",
            "className"      => "control",
            "width"          => "1%",
            "searchable"     => false,
            "orderable"      => false,
        );

        foreach ($aField as $skField => $svField) {
            $sHead  = (isset($svField["head"]) ? $svField["head"] : null);
            $sName  = (isset($svField["name"]) ? $svField["name"] : null);
            $sWidth = (isset($svField["width"]) ? $svField["width"] : "*");
            $sAlign = (isset($svField["align"]) ? $svField["align"] : "left");
            $sOrder = (isset($svField["order"]) ? $svField["order"] : true);
            $sView  = (isset($svField["view"]) ? $svField["view"] : true);
            $sHide  = (isset($svField["hide"]) ? ($svField["hide"] ? "none" : "") : "");

            $aClass   = array();
            $aClass[] = "text-{$sAlign}";
            $aClass[] = "align-middle";
            $aClass[] = $sHide;

            $sClass = implode(" ", $aClass);

            $aColsSet[] = array(
                "title"     => $sHead,
                "data"      => $sName,
                "className" => $sClass,
                "width"     => $sWidth,
                "orderable" => $sOrder,
                "visible"   => $sView,
            );
        }

        foreach ($aData as $skData => $svData) {
            $aData[$skData] = $svData + array(
                "DT_RowId" => "row_{$skData}",
            );
        }

        $aSet                 = $this->getGridSet();
        $aSet["data"]         = $aData;
        $aSet["columns"]      = $aColsSet;
        $aSet["autoWidth"]    = false;
        $aSet["paging"]       = $sPaging;
        $aSet["deferLoading"] = "10";
        $aSet["order"]        = array();

        $aResponsive = array();
        $aSelect     = array();
        $aButtons    = array();

        $aExport = $aColsSet;
        unset($aExport[0]);
        unset($aExport[1]);
        $aExport = array_keys($aExport);

        switch ($sType) {
            case "single":
                $aResponsive["details"] = array(
                    "target" => 1,
                    "type"   => "column",
                );

                $aSelect = array(
                    "style"    => "single",
                    "selector" => "td:first-child",
                );

                $aButtons[] = array("extend" => "selectNone");
                break;
            case "mulit":
                $aResponsive["details"] = array(
                    "target" => 1,
                    "type"   => "column",
                );

                $aSelect = array(
                    "style"    => "mulit",
                    "selector" => "td:first-child",
                );

                $aButtons[] = array("extend" => "selectAll");
                $aButtons[] = array("extend" => "selectNone");
                break;
            default:
                $aResponsive["details"] = array(
                    "target" => 0,
                    "type"   => "column",
                );

                $aSelect = false;
                break;
        }

        $aSet["responsive"] = $aResponsive;
        $aSet["select"]     = $aSelect;

        if (in_array("remove", $aButton)) {
            $aButtons[] = array("text" => $this->setFont(array("text" => "刪除", "icon" => "remove", "icon_style" => "r")), "action" => "remove");
        }

        if (in_array("select", $aButton)) {
            $aButtons[] = array("text" => $this->setFont(array("text" => "選取", "icon" => "check", "icon_style" => "g")), "action" => "select");
        }

        if (in_array("stop", $aButton)) {
            $aButtons[] = array("text" => $this->setFont(array("text" => "停復用", "icon" => "fas fa-ban", "icon_style" => "r")), "action" => "stop");
        }

        if (in_array("excel", $aButton)) {
            $aButtons[] = array("extend" => "excelHtml5", "title" => "Data Export", "exportOptions" => array("columns" => $aExport), "text" => "<i class='far fa-file-excel text-success'></i> Excel");
        }

        if (in_array("pdf", $aButton)) {
            $aButtons[] = array("extend" => "pdfHtml5", "title" => "Data Export", "exportOptions" => array("columns" => $aExport), "text" => "<i class='far fa-file-pdf text-danger'></i> PDF");
        }

        if (in_array("print", $aButton)) {
            $aButtons[] = array("extend" => "print", "title" => "Data Export", "exportOptions" => array("columns" => $aExport), "text" => "<i class='fas fa-print text-warning'></i> Print");
        }

        if (in_array("save", $aButton)) {
            $aButtons[] = array("text" => $this->setFont(array("text" => "儲存", "icon" => "save", "icon_style" => "g")), "action" => "save");
        }

        if ($aCustomButton) {
            foreach ($aCustomButton as $key => $value) {
                $aButtons[] = array("text" => $value['text'], "action" => $value['action']);
            }
        }

        $aSet["buttons"] = $aButtons;

        $sSet = json_encode($aSet);
        $sSel = json_encode($aSelected);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    setDataTables('%s', %s, %s)
                } );
            </script>"
            , $sID, $sSet, $sSel
        );

        $sReturn = sprintf(
            "<table id='%s' class='hover row-border compact %s' style='width:%s'></table>%s"
            , $sID, $sWrap, "100%", $sScript
        );

        $_POST["ajax"][$sID] = $aData;

        return $sReturn;
    }

    public function setEGrid(array $aParams = array())
    {
        //基本設定
        $sID     = (isset($aParams["id"]) ? "{$aParams["id"]}_tb" : "tb");
        $aField  = (isset($aParams["field"]) ? $aParams["field"] : null);
        $aEField = (isset($aParams["efield"]) ? $aParams["efield"] : null);
        $sFilter = (isset($aParams["filter"]) ? $aParams["filter"] : null);
        $aData   = (isset($aParams["data"]) ? $aParams["data"] : null);
        $aButton = (isset($aParams["btn"]) ? $aParams["btn"] : array());
        $sWrap   = (isset($aParams["wrap"]) ? "" : "nowrap");

        $aCustomButton = (isset($aParams["cusbtn"]) ? $aParams["cusbtn"] : array());

        $aColsSet = array();

        if (in_array("edit", $aButton) || in_array("remove", $aButton)) {
            //選取方塊
            $aColsSet[] = array(
                "title"          => "",
                "data"           => null,
                "defaultContent" => "",
                "className"      => "select-checkbox text-center",
                "width"          => "0.5%",
                "searchable"     => false,
                "orderable"      => false,

            );
        }

        //表單明細
        $aColsSet[] = array(
            "title"          => "",
            "data"           => null,
            "defaultContent" => "",
            "className"      => "control",
            "width"          => "1%",
            "searchable"     => false,
            "orderable"      => false,
        );

        //編輯欄位
        $aEditSet = array();
        $sOptions = array();

        foreach ($aEField as $skEField => $svEField) {
            $sHead    = (isset($svEField["head"]) ? $svEField["head"] : null);
            $sName    = (isset($svEField["name"]) ? $svEField["name"] : null);
            $sType    = (isset($svEField["type"]) ? $svEField["type"] : null);
            $sDefault = (isset($svEField["def"]) ? $svEField["def"] : null);
            $aOption  = (isset($svEField["option"]) ? $svEField["option"] : null);

            $aSet = array(
                "label" => $sHead,
                "name"  => $sName,
            );

            switch ($sType) {
                case "radio":
                    $aSet["type"] = "radio";

                    foreach ($aOption as $skOption => $svOption) {
                        $aSet["options"][] = array(
                            "label" => $svOption["text"],
                            "value" => $svOption["value"],
                        );
                    }

                    $sOptions[$sName] = $aOption;
                    break;
                case "combo":
                    $aSet["type"] = "select";

                    foreach ($aOption as $skOption => $svOption) {
                        $aSet["options"][] = array(
                            "label" => $svOption["text"],
                            "value" => $svOption["value"],
                        );
                    }

                    $sOptions[$sName] = $aOption;
                    break;
                case "date":
                    $aSet["type"]   = "datetime";
                    $aSet["format"] = "YYYY.MM.DD";
                    break;
                case "datetime":
                    $aSet["type"]   = "datetime";
                    $aSet["format"] = "YYYY.MM.DD HH:mm";
                    break;
                case "textarea":
                    $aSet['type'] = $sType;
                    break;
            }

            if ($sDefault) {
                $aSet["def"] = $sDefault;
            }

            $aEditSet[] = $aSet;
        }

        //顯示欄位
        foreach ($aField as $skField => $svField) {
            $sHead  = (isset($svField["head"]) ? $svField["head"] : null);
            $sName  = (isset($svField["name"]) ? $svField["name"] : null);
            $sWidth = (isset($svField["width"]) ? $svField["width"] : "*");
            $sAlign = (isset($svField["align"]) ? $svField["align"] : "left");
            $sOrder = (isset($svField["order"]) ? $svField["order"] : true);
            $sView  = (isset($svField["view"]) ? $svField["view"] : true);
            $sHide  = (isset($svField["hide"]) ? ($svField["hide"] ? "none" : "") : "");

            $aRender          = array();
            $sOptions[$sName] = isset($sOptions[$sName]) ? $sOptions[$sName] : null;
            if ($sOptions[$sName]) {
                $aRender = $sOptions[$sName];
            }

            $aClass   = array();
            $aClass[] = "text-{$sAlign}";
            $aClass[] = "align-middle";
            $aClass[] = $sHide;

            $sClass = implode(" ", $aClass);

            $aTMP = array(
                "title"     => $sHead,
                "data"      => $sName,
                "className" => $sClass,
                "width"     => $sWidth,
                "orderable" => $sOrder,
                "visible"   => $sView,
            );

            if ($aRender) {
                $aTMP = array_merge($aTMP, array("render" => $aRender));
            }

            $aColsSet[] = $aTMP;
        }

        foreach ($aData as $skData => $svData) {
            $aData[$skData] = $svData + array(
                "DT_RowId" => "row_{$skData}",
            );
        }

        $aSet                 = $this->getGridSet();
        $aSet["data"]         = $aData;
        $aSet["columns"]      = $aColsSet;
        $aSet["deferLoading"] = "10";
        $aSet["keys"]         = true;

        $sTarget = 0;

        if (in_array(array("edit", "remove"), $aButton)) {
            $sTarget = 1;
        }

        $aSet["responsive"] = array(
            "details" => array(
                "target" => $sTarget,
                "type"   => "column",
            ),
        );
        $sStyle         = isset($sStyle) ? $sStyle : null;
        $aSet["order"]  = array();
        $aSet["select"] = array(
            "style"    => $sStyle,
            "selector" => "td:first-child",
        );

        $aExport = $aColsSet;
        unset($aExport[0]);
        unset($aExport[1]);
        $aExport = array_keys($aExport);

        $aButtons = array();

        if (in_array("edit", $aButton) || in_array("remove", $aButton)) {
            $aButtons[] = array("extend" => "selectAll");
            $aButtons[] = array("extend" => "selectNone");
        }

        if (in_array("add", $aButton)) {
            $aButtons[] = array("extend" => "create");
        }

        if (in_array("edit", $aButton)) {
            $aButtons[] = array("extend" => "edit");
        }

        if (in_array("remove", $aButton)) {
            $aButtons[] = array("extend" => "remove");
        }

        if (in_array("save", $aButton)) {
            $aButtons[] = array("text" => $this->setFont(array("text" => "儲存", "icon" => "save", "icon_style" => "g")), "action" => "save");
        }

        if (in_array("excel", $aButton)) {
            $aButtons[] = array("extend" => "excelHtml5", "title" => "Data Export", "exportOptions" => array("columns" => $aExport), "text" => "<i class='far fa-file-excel text-success'></i> Excel");
        }

        if (in_array("pdf", $aButton)) {
            $aButtons[] = array("extend" => "pdfHtml5", "title" => "Data Export", "exportOptions" => array("columns" => $aExport), "text" => "<i class='far fa-file-pdf text-danger'></i> PDF");
        }

        if (in_array("print", $aButton)) {
            $aButtons[] = array("extend" => "print", "title" => "Data Export", "exportOptions" => array("columns" => $aExport), "text" => "<i class='fas fa-print text-warning'></i> Print");
        }

        if ($sFilter) {
/*
<div class='collapse' id='collapseExample'>
<div class='card card-body' style='background-color:#b8f1cc'>
{$sFilter}
</div>
</div>

$aButtons[] = array("text" => $this->setFont(array("text" => "篩選", "icon" => "fas fa-filter", "icon_style" => "b")), "action" => "filter");
 */
        }

        if ($aCustomButton) {
            foreach ($aCustomButton as $key => $value) {
                $aButtons[] = array("text" => $value['text'], "action" => $value['action']);
            }
        }

        $aSet["buttons"] = $aButtons;

        $sSet     = json_encode($aSet);
        $sEditSet = json_encode($aEditSet);

        $sScript = sprintf(
            "<script>
                $(document).ready(function() {
                    setDataTablesEditor('%s', %s, %s)
                });
            </script>"
            , $sID, $sEditSet, $sSet
        );

        $sReturn = sprintf(
            "<table id='%s' class='hover row-border compact %s' style='width:%s'></table>%s"
            , $sID, $sWrap, "100%", $sScript
        );

        $_POST["ajax"][$sID] = $aData;

        return $sReturn;
    }

    public function setNavs(array $aParams = array())
    {
        $aHeadCnt = array();
        $aBodyCnt = array();

        foreach ($aParams as $skParam => $svParam) {
            $sHead = $svParam["head"];
            $sBody = $svParam["body"];
            //new route
            $sRoute = $svParam["route"];

            $aBody = array();

            if (is_array($sBody)) {
                foreach ($sBody as $skBody => $svBody) {
                    if (is_array($svBody)) {
                        $aBody[] = implode("", $svBody);
                    } else {
                        $aBody[] = $svBody;
                    }
                }
            } else {
                $aBody[] = $sBody;
            }

            $sBody = implode("", $aBody);

            $sID       = "nav_tab_" . $skParam;
            $sHref     = "nav_" . $skParam;
            $sDataLink = route($sRoute);
            if ($skParam == 0) {
                $aHeadCnt[] = sprintf(
                    "<a class='nav-item nav-link active' id='%s' data-toggle='tab' href='#%s' data-url='%s' role='tab' aria-controls='%s' aria-selected='true'>%s</a>"
                    , $sID, $sHref, $sDataLink, $sHref, $sHead
                );

                $aBodyCnt[] = sprintf(
                    "<div class='tab-pane fade show active' id='%s' role='tabpanel' aria-labelledby='%s'>%s</div>"
                    , $sHref, $sID, $sBody
                );
            } else {
                $aHeadCnt[] = sprintf(
                    "<a class='nav-item nav-link' id='%s' data-toggle='tab' href='#%s' data-url='%s' role='tab' aria-controls='%s' aria-selected='false'>%s</a>"
                    , $sID, $sHref, $sDataLink, $sHref, $sHead
                );

                $aBodyCnt[] = sprintf(
                    "<div class='tab-pane fade' id='%s' role='tabpanel' aria-labelledby='%s'>%s</div>"
                    , $sHref, $sID, $sBody
                );
            }
        }

        $sHeadCnt = implode("", $aHeadCnt);
        $sBodyCnt = implode("", $aBodyCnt);

        $sReturn = sprintf(
            "<nav>
                <div class='nav nav-tabs mb-3' id='nav-tab' role='tablist'>
                    %s
                </div>
            </nav>
            <div class='tab-content' id='nav-tabContent'>
                %s
            </div>"
            , $sHeadCnt, $sBodyCnt
        );

        return $sReturn;
    }
}
