<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Template extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
        $templateProcessor->setValue('firstname', 'Sohail');
        $templateProcessor->setValue('lastname', 'Saleem');
        $templateProcessor->saveAs('MyWordFile.docx');

    }
}
