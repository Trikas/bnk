<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequestStep1 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'typeFeedback' => 'required',
            'descriptionFeedback' => 'required|max:10000',
            'typeAnswer' => 'required',
            'afterTime' => 'required_if:typeAnswer, phone',
            'beforeTime' => 'required_if:ypeAnswer, phone|after:afterTime',
            'email' => 'required_if:typeAnswer,email',
            'phone' => 'required_if:typeAnswer,phone',
        ];
    }
}
