<?php

namespace App\Exports;

use App\Account;
use App\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionExport implements FromCollection
{
    protected $aid;
    protected $type = null;

    public function __construct($acc_id, $type = null)
    {
        if($type != null)
            $this->type = $type;
        $this->aid = $acc_id;
    }

    public function collection()
    {
        if($this->type != null)
            return Transaction::whereAccountId($this->aid)->whereType($this->type)->where('status','!=',3)
                ->where('status','!=',4)->get();
        return Transaction::whereAccountId($this->aid)->where('status','!=',3)
            ->where('status','!=',4)->get();
    }
}
