<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FeedbackHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequestStep1;
use App\Http\Requests\SaveImageFeedbackFormRequest;
use App\Mail\FeedbackMail;
use App\Services\FeedbackService;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    public function feedbackForm()
    {
//        dd(session());
        return view('admin.pages.feedback.feedback-form');
    }

    public function feedbackFormStep2Store(FeedbackRequestStep1 $requestStep1)
    {
        if (stristr(\Request::server('HTTP_REFERER'), 'feedback-step1')) {
            session($requestStep1->all());
            return redirect(route('feedback.form.step2.show'));
        }
        return back();
    }

    public function feedbackFormStep2Show()
    {
        if (stristr(\Request::server('HTTP_REFERER'), 'feedback-step1') || stristr(\Request::server('HTTP_REFERER'), 'feedback-step2')) {
            return view('admin.pages.feedback.feedback-form-save-image');
        }
        return back();
    }

    public function clearForm()
    {
        if (stristr(\Request::server('HTTP_REFERER'), 'feedback-step2')) {
            session([
                'typeFeedback' => null,
                'descriptionFeedback' => null,
                'typeAnswer' => null,
                'email' => null,
                'phone' => null,
                'afterTime' => null,
                'beforeTime' => null,
            ]);
            return redirect(route('feedback.form'));
        }
        return back();
    }

    public function feedbackFormStep3Store(SaveImageFeedbackFormRequest $feedbackFormRequest)
    {
        if (stristr(\Request::server('HTTP_REFERER'), 'feedback-step2')) {
            FeedbackHelper::saveFile($feedbackFormRequest);
            $uid = Str::upper(Str::random(3)) . '-' . rand(10000000, 99999999);
            FeedbackService::saveFeedback($uid);
            session([
                'uid' => $uid
            ]);
            return redirect(route('feedback.form.step3.show'));
        }
        return back();
    }

    public function feedbackFormStep3Show()
    {
        if (stristr(\Request::server('HTTP_REFERER'), 'feedback-step2')) {
            return view('admin.pages.feedback.feedback-form-print-rezult');
        }
        return redirect('/');
    }
}
