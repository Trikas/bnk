<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $trans;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $trans)
    {
        $this->data = $data;
        $this->trans = $trans;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('astrowinbank@astrowinbank.com')
            ->subject('New payment')->view('admin.pdf.new-payment-info')
            ->with('trans', $this->trans);
    }
    
}
