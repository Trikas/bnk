<?php


namespace App\Helpers;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FeedbackHelper
{
    public static function saveFile($request)
    {
        if ($request->file) {
            $pathToFile = Storage::disk('public')->put('feedbackFile', $request->file('file'));
            session([
                'pathToFile' => $pathToFile,
                'nameFile' => basename($pathToFile)
            ]);
        }
    }
}
