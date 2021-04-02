<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class File extends Controller
{
    public function __invoke(Request $request)
    {
        if($request->all())
        {
            $path = $request->file('avatar')->store('public');
            dd($path);
        }
        else
        {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            Storage::disk('public')->put('me.txt', 'hello world');
            if(Storage::disk('public')->exists('hello.jpg')) {
                info('Hello exists'); // going in log file in storage
                $out->writeln("Hello exists");
            }
            else {
                info('Nothing here');
                $out->writeln("Nothing here");
            }
        }
    }
}
