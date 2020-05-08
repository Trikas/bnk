<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequestStep1;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedbackForm()
    {
//        dd(session());
        return view('admin.pages.feedback.feedback-form');
    }

    public function feedbackFormStep1(FeedbackRequestStep1 $requestStep1)
    {
        session($requestStep1->all());
        return view('admin.pages.feedback.feedback-form-save-image');
    }

    public function clearForm()
    {
        if (stristr(\Request::server('HTTP_REFERER'), 'feedback-step1')) {
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

    public function feedbackFormStep2()
    {
        
    }
}
