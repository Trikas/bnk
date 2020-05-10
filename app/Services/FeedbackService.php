<?php


namespace App\Services;


use App\Helpers\FeedbackHelper;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FeedbackService
{
    public static function saveFeedback($uid)
    {
        session([
            'typeFeedbackPrint' => session('typeFeedback'),
            'descriptionFeedbackPrint' => session('descriptionFeedback'),
            'typeAnswerPrint' => session('typeAnswer'),
            'emailPrint' => session('email'),
            'phonePrint' => session('phone'),
            'nameFilePrint' => session('nameFile'),
        ]);
        $pathToFile = !empty(session('pathToFile')) ? asset(Storage::url(session('pathToFile'))) : null;
        Mail::to('freemiumd@gmail.com')->send(
            new FeedbackMail(
                $pathToFile,
                session('typeFeedback'),
                session('descriptionFeedback'),
                session('typeAnswer'),
                session('email'),
                session('phone'),
                $uid
            ));
        FeedbackHelper::destroyVariableOld();
    }
}
