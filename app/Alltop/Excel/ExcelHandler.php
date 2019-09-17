<?php
namespace App\Alltop\Excel;

use App\Alltop\Common;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelHandler
{
    private $oSpreadsheet;
    private $oWorksheet;

    /* 使用步驟:
    1. readFile(檔案路徑, 檔案附檔名)
    2. getActiveWorksheet(第幾個 Excel 工作表)
    3. readExcelToPhpArray() 回傳陣列

    開始針對回傳的 Excel 資料進行驗證
    陣列: 日期格式一律統一 YYYY-MM-DD
    array(
    array('A' => '標題', 'B' => '標題'),
    array('A' => '資料內容', 'B' => '1999-12-12'),
    ) */
    //

    // 測試用 function，給檔案路徑和副檔名
    public function test($sFilePath, $sExtension)
    {
        //自己在controller new 一個ExcelHander
        //$excel = new ExcelHandler();
        //------------
        $this->readFile($sFilePath, $sExtension);
        //抓取第一頁
        $this->getActiveWorksheet(0);
        //有時候取的範圍還是怪怪的，因此還是需要手動指定範圍， ex: 只取A、B、C欄的資料 預設取到ZZ欄位
        $aData = $this->readExcelToPhpArray('C');
        dd($aData);
    }

    public function readFile(string $sFilePath, string $sExtension): Spreadsheet
    {
        if ($sExtension == 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else if ($sExtension == 'xls') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }
        //setReadEmptyCells = false 這樣才不會抓到很奇怪的範圍。
        //只會取到有值的欄位，而非空的最長欄位

        //設定 Null 或 空字串的 Excel 欄位不讀。
        $reader->setReadEmptyCells(false);
        $this->oSpreadsheet = $reader->load($sFilePath);
        return $this->oSpreadsheet;
    }

    //設定哪一個 Excel 工作頁簽 0 代表第一個 工作表
    public function getActiveWorksheet($sNum): Worksheet
    {
        $this->oWorksheet = $this->oSpreadsheet->setActiveSheetIndex($sNum);
        return $this->oWorksheet;
    }

    public function readExcelToPhpArray($endColumn = 'ZZ'): array
    {
        $aDataSet   = array();
        $aColumnEng = null;
        foreach ($this->oWorksheet->getRowIterator() as $row) {
            $sIndex        = $row->getRowIndex();
            $oCellIterator = $row->getCellIterator();
            $oCellIterator->setIterateOnlyExistingCells(false); // This loops through all cells,
            $aCells = array();

            foreach ($oCellIterator as $cell) {
                $aCells[] = $cell->getFormattedValue();
                if ($cell->getColumn() == $endColumn) {
                    break;
                }
            }
            $rows[$sIndex] = $aCells;
            //可能會多讀到一個空白列，不影響後續寫入資料庫，
            //第一列標題，$sIndex > 1 之後都是資料。
            if ($sIndex == 1) {
                $aTitle      = $rows[1];
                $aColumnEng  = Common::ExcelEnglishComparison(sizeof($rows[1]));
                $aDataSet[0] = array_combine($aColumnEng, $aTitle);
            } else {
                $aEngColumnData = array_combine($aColumnEng, $rows[$sIndex]);

                $aDataSet[] = $aEngColumnData;
            }
        }
        return $aDataSet;
    }
}
