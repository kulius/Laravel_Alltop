<?php

namespace App\Alltop;

class JumpHandler
{
    public function __construct() {}

    public function setFormValue($sForm, $aFieldValue, $aDefaultValue = array())
    {
        $aReturn = array();
        //var_dump($_POST);

        $aFormValue = $_POST[$sForm];

        if ($aFormValue) {
            foreach ($aFormValue as $sKey => $sValue) {
                foreach ($sValue as $sField => $sData) {
                    $aReturn[$sKey][$sField] = $sData;
                }
            }
        } else if ($aFieldValue) {
            foreach ($aFieldValue as $sKey => $sValue) {
                foreach ($sValue as $sField => $sData) {
                    $sTMP = null;

                    if (is_object($sData)) {
                        switch (get_class($sData)) {
                            case "DateTime":
                                if (method_exists($sData, "format")) {
                                    $sTMP = $sData->format("Y.m.d H:i:s");
                                }
                                break;
                        }
                    } else {
                        $sTMP = $sData;
                    }

                    $aReturn[$sKey][$sField] = $sTMP;
                }
            }
        } else if ($aDefaultValue) {
            foreach ($aDefaultValue as $sField => $sData) {
                $aReturn[0][$sField] = $sData;
            }
        }

        if ($_SESSION["get"]["param"]) {
            foreach ($_SESSION["get"]["param"] as $sField => $sData) {
                $aReturn[0][$sField] = $sData;
            }
        }

        return $aReturn;
    }

    public static function setJumpSelData(array $aParams = array())
    {
        //基本設定
        $sName   = $aParams["name"];
       /*  $bClose  = $_SESSION["get"]["close"];
        $bReLoad = $_SESSION["get"]["reload"]; */
        $aData   = $aParams["data"];
        $sValue    = $aParams["value"];
        $aText  = (empty($aParams["text"]) ? array() : $aParams["text"]);
     
        $bClose = true;
        $bReload = false;

        $aHtml = array();

        if ($aData) {
            foreach ($aData as $skData => $svData) {
                $aTemp = array();

                foreach ($aText as $skValue => $svValue) {
                    $aTemp[] = $svData[$svValue];
                }
                
                $sText = implode("-", $aTemp);

                $aHtml[] = sprintf("<option value='%s' selected>%s</option>"
                    , $svData[$sValue], $sText
                );
            }
        }

        $aJava   = array();
        $aJava[] = "parent.refDropDown();";

        if ($bClose) {
            $aJava[] = "parent.setModalClose();";
        }

        if ($bReload) {
            // $aJava[] = sprintf("parent.setReLoad('%s');", $sName);
        }

        $sHtml = implode("", $aHtml);
        $sJava = implode("", $aJava);
        
        
        $sReturn = sprintf(
            "<script>
                var Elem = parent.document.getElementById('%s');

                Elem.innerHTML = \"%s\";

                {$sJava}
            </script>"
            , $sName, $sHtml
        );
        
        return $sReturn;
    }

    public function setReport(array $aParams = array())
    {
        $sReport = $aParams["report"];

        $sScript = sprintf(
            "<script>
                    var w = window.open('%s',
                        '','resizable=yes,scrollbars=yes','_blank');
                    w.resizeTo((screen.availWidth),(screen.availHeight));
                    w.moveTo(0,0);
                </script>"
            , $sReport
        );
        $sReturn = $sScript;

        echo $sReturn;
    }

    public function setFavourite($sMenu)
    {
        //資料庫元件
        $oSysUser = new tSysUser();

        $aResult = $oSysUser->save_fav($sMenu);

        $aReturn   = array();
        $aReturn[] = $aResult;

        return $aReturn;
    }
}
