<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;
use Str;


class TelegramController extends Controller
{
    public function update()
    {
        $data = Telegram::getUpdates();

        dd($data);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required' , 'message' => 'required']);

        $data = "<b>Name : </b>"
        ." "."$request->name\n"
        ."<b>Message : </b>\n"
        ." ".$request->message;
        
        Telegram::sendMessage([
            'chat_id' => '-1001678367759',
            'parse_mode' => 'HTML',
            'text' => $data
        ]);

        return redirect()->back();
    }

    public function storePhoto(Request $request)
    {
        $image = $request->img;

        Telegram::sendPhoto([
            'chat_id' => '-1001678367759',
            'photo' => InputFile::createFromContents(file_get_contents($image->getRealPath()) , Str::random(10). '.' .$image->getClientOriginalExtension()),
            'caption' => 'This my image',
        ]);

        return redirect()->back();
    }

    
}
