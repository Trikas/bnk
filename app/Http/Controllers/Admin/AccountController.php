<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Accounttype;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CurrencyHelper;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function index()
    {
        $types = Accounttype::whereUserId(Auth::id())->get();

        foreach ($types as $item){
            $count[] = $item->accounts(Auth::id())->count();

            $bills = $item->accounts(Auth::id());
            $amount[] = $this->makeMoney($bills);
        }

        return view('admin.pages.review', compact('types', 'count', 'amount'));
    }



    // Показать счет
    public function bills($id)
    {
        $accounts = Account::whereUserId(Auth::id())->where('accounttype_id', $id)->get();
        return view('admin.pages.bills', compact('accounts'));
    }

    public function show(Request $request)
    {

        if($request->has('account')){
            $account = Account::findOrFail($request->account);
        }else{
            $default_account = Auth::user()->account;
            $account = Account::findOrFail($default_account->id);
        }

        if($account->user_id !== Auth::id())
            abort(403);


        $today = new Carbon('last day of last month');
        $lmonth = Carbon::now()->subMonths(1)->startOfMonth()->toDateString();

        $tr_this_month = Transaction::whereUserId(Auth::id())
            ->where('created_at', '>' , $today)
            ->where('account_id', $account->id)
            ->get();
        $tr_last_month = Transaction::whereUserId(Auth::id())
            ->where('created_at', '<' , $today)
            ->where('created_at', '>' , $lmonth)
            ->where('account_id', $account->id)
            ->get();


        $accounts = Auth::user()->accounts()->get();

        return view('admin.pages.bill_detail', compact('account', 'accounts', 'tr_this_month', 'tr_last_month'));

    }


    // Перевести все в Евро,
    // в независимости от валюты
    public function makeMoney($bills)
    {
        $summ = 0;
        foreach ($bills as $item) {
            $summ = $summ + CurrencyHelper::change($item);
        }
        return $summ;
    }



}
