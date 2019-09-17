<?php

namespace App\Alltop;

class BaseModel
{
    public function __construct() {}

    public static function setWhere(array $aFilter = array())
    {
        $aWhere = array();
        $aParam = array();

        if (!empty($aFilter)) {
            foreach ($aFilter as $sKey => $sValue) {
                $sWhere = $sValue[0];
                $sParam = $sValue[1];

                $aWhere[] = $sWhere;
                $aParam[] = $sParam;

                if (is_array($sParam)) {
                    if (preg_match("/IN \(\?\)/i", $sWhere)) {
                        $aSet = array();

                        for ($i = 0; $i < count($sParam); $i++) {
                            $aSet[] = "?";
                        }

                        $aWhere[$sKey] = str_replace("?", implode(", ", $aSet), $aWhere[$sKey]);
                    }

                    array_splice($aParam, $sKey, 1, $sParam);
                }
            }
        } else {
            $aWhere[] = "1 = 1";
        }

        $sWhere = implode(" AND ", $aWhere);

        $aReturn = array(
            "where" => $sWhere,
            "param" => $aParam,
        );

        return $aReturn;
    }
}
