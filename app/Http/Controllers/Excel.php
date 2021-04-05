<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use App\Models\Balance;

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
        $reader = ReaderEntityFactory::createXLSXReader();

        $reader->open('tb.xlsx');

        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
 
        foreach ($reader->getSheetIterator() as $sheet) {
            $i=0;
            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                $col1 = (string) $row->getCellAtIndex(0);
                $col2 = (string) $row->getCellAtIndex(1);
                $col3 = (string) $row->getCellAtIndex(2);
                $col4 = (string) $row->getCellAtIndex(3);
                $col5 = (string) $row->getCellAtIndex(4);
                $col6 = (string) $row->getCellAtIndex(5);
                $col7 = (string) $row->getCellAtIndex(6);
                $col8 = (string) $row->getCellAtIndex(7);
//                $cells = $row->getCells();
//                $out->writeln($cells);
                if(strlen($col1)>5){
                    Balance::create([
                        'account_id' => 1,
                        'op_debit' => is_numeric(floatval($col3))? floatval($col3): 0.0, 
                        'op_credit' => is_numeric(floatval($col4))? floatval($col4): 0.0, 
                        't_debit' => is_numeric(floatval($col5))? floatval($col5): 0.0, 
                        't_credit' => is_numeric(floatval($col6))? floatval($col6): 0.0, 
                        'cl_debit' => is_numeric(floatval($col7))? floatval($col7): 0.0, 
                        'cl_credit' => is_numeric(floatval($col8))? floatval($col8): 0.0, 
                    ]);
                }
                $out->writeln($col3.'---'.$col4.'---'.$col5);
                ++$i;
                if($i==20) break;
            }
            break;
        }

        $reader->close();
        // $inputFileType = 'Xlsx';
        // $inputFileName = 'tb.xlsx';
        // $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        // $reader->setReadDataOnly(true);
        // $reader->setLoadSheetsOnly('Sheet1');
        // $spreadsheet = $reader->load($inputFileName);


//         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//         $spreadsheet = $reader->load("tb2.xlsx");
//         $reader->setReadDataOnly(true);
// //        dd($spreadsheet);
//         $d=$spreadsheet->getSheet(0)->rangeToArray('C5:C100');
//         dd($d);
//         $sheetData = $spreadsheet->getActiveSheet()->toArray();
//         dd($sheetData);
//         $i=1;
//         $out = new \Symfony\Component\Console\Output\ConsoleOutput();
//         unset($sheetData[0]);
//         foreach ($sheetData as $t) {
//             $out->writeln($i."---".$t[0].",".$t[1]."...");
// //            echo $i."---".$t[0].",".$t[1]."...";
//             $i++;
//         }
	
    }
}

