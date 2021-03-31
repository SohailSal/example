<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Excel extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $inputFileType = 'Xlsx';
        $inputFileName = 'tb.xlsx';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        $reader->setLoadSheetsOnly('Sheet1');
        $spreadsheet = $reader->load($inputFileName);
        $filterSubset = new MyReadFilter(9,15,range('G','K'));
        dd($filterSubset);
    }
}

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    private $startRow = 0;
    private $endRow   = 0;
    private $columns  = [];

    /**  Get the list of rows and columns to read  */
    public function __construct($startRow, $endRow, $columns) {
        $this->startRow = $startRow;
        $this->endRow   = $endRow;
        $this->columns  = $columns;
    }

    public function readCell($column, $row, $worksheetName = '') {
        //  Only read the rows and columns that were configured
        if ($row >= $this->startRow && $row <= $this->endRow) {
            if (in_array($column,$this->columns)) {
                return true;
            }
        }
        return false;
    }
}

