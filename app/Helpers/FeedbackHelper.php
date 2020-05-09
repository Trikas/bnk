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

    public static function destroyVariableOld()
    {
        session([
            'typeFeedback' => null,
            'descriptionFeedback' => null,
            'email' => null,
            'phone' => null,
            'pathToFile' => null,
            'afterTime' => null,
            'beforeTime' => null,
            'nameFile' => null,
            'typeAnswer' => null,
        ]);
    }
}
