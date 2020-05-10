<?php

namespace App\Mail;

use App\Exports\ExportInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
        $name = rand(10000, 99999) . 'invoices.pdf';
        $customPaper = array(0,0,960,680);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('mail-invoice', ['trans' => $this->trans]))->setPaper($customPaper);
        return $this->from('astrowinbank@astrowinbank.com')
            ->view('empty-message')
            ->subject('New payment')
            ->attachData($pdf->output(), $name);
    }

}
