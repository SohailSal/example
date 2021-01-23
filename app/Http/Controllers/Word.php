<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Word extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $text = $section->addText("Hello, World");
        $text = $section->addText("Wow man",array('name'=>'Arial','size' => 20,'bold' => true));
          
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('wordy.docx');
        return response()->download(public_path('wordy.docx'));
    }
}
