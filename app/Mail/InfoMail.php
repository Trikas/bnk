<?php

namespace App\Mail;

use App\Exports\ExportInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
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
        $name = rand(10000, 99999).'invoices.xlsx';
        Excel::store(new ExportInvoice($this->trans), $name, 'public');
        return $this->from('astrowinbank@astrowinbank.com')
            ->subject('New payment')->view('admin.pdf.new-payment-info')
            ->with('trans', $this->trans)
           ->attach(asset('storage/public/'.$name));
    }

}
