<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class File extends Controller
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
        Storage::disk('public')->put('me.txt', 'hello world');
        if(Storage::disk('public')->exists('hello.jpg')) {
            info('hello exists'); // going in log file in storage
            $out->writeln("Hello exists");
        }
        else {
            info('Nothing here');
            $out->writeln("Nothing exists");
        }
    }
}
