<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $file;
    private $typeFeedback;
    private $descriptionFeedback;
    private $typeAnswer;
    private $email;
    private $phone;

    /**
     * Create a new message instance.
     *
     * @param $file
     * @param $typeFeedback
     * @param $descriptionFeedback
     * @param $typeAnswer
     * @param $email
     * @param $phone
     */
    public function __construct($file, $typeFeedback, $descriptionFeedback, $typeAnswer, $email, $phone)
    {
        $this->file = $file;
        $this->typeFeedback = $typeFeedback;
        $this->descriptionFeedback = $descriptionFeedback;
        $this->typeAnswer = $typeAnswer;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from('astrowinbank@astrowinbank.com')
            ->subject('Feedback')
            ->view('admin.pdf.feedback-new',
                [
                    'typeFeedback' => $this->typeFeedback,
                    'descriptionFeedback' => $this->descriptionFeedback,
                    'typeAnswer' => $this->typeAnswer,
                    'email' => $this->email,
                    'phone' => $this->phone,
                ]
            );
        if ($this->file) {
            $this->attach($this->file);
        }
        return $this;
    }
}
