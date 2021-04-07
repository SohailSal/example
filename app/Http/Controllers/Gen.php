<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use App\Models\Balance;

class Gen extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("Hello world");
        $spreadsheet = new Spreadsheet();

        $colArray = ['C:C','D:D'];
        foreach ($colArray as $key=>$col) {
            $spreadsheet->getActiveSheet()->getStyle($col)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        }

        $spreadsheet->getActiveSheet()->getStyle('A3:D3')->applyFromArray(
            array(
               'fill' => array(
                   'fillType' => Fill::FILL_SOLID,
                   'color' => array('rgb' => '484848' )
               ),
               'font'  => array(
                   'bold'  =>  true,
                   'color' => array('rgb' => 'FFFFFF')
               ),
               'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
               ),
            )
          );

        $rowArray = ['CODE', 'ACCOUNT NAME', 'DEBIT', 'CREDIT'];
        $spreadsheet->getActiveSheet()->fromArray($rowArray, NULL, 'A3');
        
        $widthArray = ['20','50','30','30'];
        foreach (range('A','D') as $key=>$col) {
            $spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth($widthArray[$key]);  
        }

        $data = \App\Models\Balance::all()
                ->map(function ($bal){
                    return [
                        'code' => $bal->account->number,
                        'account' => $bal->account->name,
                        'opening' => floatval($bal->op_debit) - floatval($bal->op_credit),
                        'closing' => floatval($bal->cl_debit) - floatval($bal->cl_credit),
                    ];
                }) 
              ->toArray();
//dd($data);
        $cnt=count($data);

        $spreadsheet->getActiveSheet()->fromArray($data, NULL, 'A4');

        // $total = 0;
        // for($i=0;$i<$cnt;$i++){
        //     $total = $total + $data[$i]['ledger'];
        // }

        // $tstr= $cnt+5;
        // $tcell= "H".strval($tstr);
        // $spreadsheet->getActiveSheet()->setCellValue($tcell, $total);

        // $styleArray = [
        //     'borders' => [
        //         'outline' => [
        //             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
        //             'color' => ['rgb' => '484848'],
        //         ],
        //     ],
        // ];
        // $spreadsheet->getActiveSheet()->getStyle($tcell)->applyFromArray($styleArray);
        
        $writer = new Xlsx($spreadsheet);
        $writer->save('top.xlsx');
    }
}
