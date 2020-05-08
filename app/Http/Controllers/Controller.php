<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $per_page = 10;

    public function clear($id)
    {
        $tr = Transaction::where('account_id', $id)->delete();
        return 'done';
    }


}
