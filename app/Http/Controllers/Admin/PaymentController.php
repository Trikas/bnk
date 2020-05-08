<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Country;
use App\Helpers\CurrencyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Mail\InfoMail;
use App\Payment;
use App\Template;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {

    }

    public function addPayment(Request $request)
    {

        if($request->has('template') && $request->template != null){
            $t = Template::find($request->template);
        }else{
            $t = null;
        }

        if($request->has('account')){
            $account = Account::whereId($request->account)->where('user_id', Auth::id())->first();
        }else{
            $account = Auth::user()->account;
        }

        $accounts = Auth::user()->accounts;

        $countries = Country::get();

        $templates = Template::whereUserId(Auth::id())->get();

        return view('admin.pages.payment.add',
            compact('accounts', 'account', 'countries', 'templates', 't'));
    }



    public function store(PaymentRequest $request)
    {
        if($request->has('save'))
            $this->makeTemplate($request);

        $request->session()->put('form_data',$request->all());


        if($request->has('account') && $request->account != null){
            $acc = Account::find($request->account);
        }else{
            $acc = Account::find($request->account_old);
            $request->session()->put('form_data.account', $request->account_old);
        }


        // Конвертация валюты, если отличается от счета

        if($request->currency != $acc->currency_id){
            $amount = CurrencyHelper::Calculate($request->amount, $acc->currency_id, (int) $request->currency);
            $request->session()->put('form_data.amount', round($amount, 2));
        }
        // Comision

        $com_sum = CurrencyHelper::getComission($request->comision, session('form_data.amount'), $request->currency);


        $request->session()->put('form_data.comision_amount', $com_sum);


        //dump('В разделе ведутся работы. Приносим извинения за неудобства!');
        //dd(session('form_data'));
        return view('admin.pages.payment.step2');

    }

    #finishing step3 Исходящий ПЛАТЕЖ
    public function step3(Request $request)
    {



        $account = session('form_data.account');
        $comision = CurrencyHelper::getComission(session('form_data.comision'), session('form_data.amount'));


        // Проверка на акаунт, или принадлежит Юзеру
        if(!$acc = Account::whereId($account)->whereUserId(Auth::id())->first())
            return abort('403');


        //$comision = CurrencyHelper::getComission(session('form_data.comision'), session('form_data.amount'));
        $comision = session('form_data.comision_amount');


        if($acc->currency_id != 2){
          //  $comision = CurrencyHelper::Calculate($comision, $acc->currency_id, 2);
        }


        // Очистить сумму от лишних символов
        if(stristr(session('form_data.amount'), ',') == true) {
            $pamount = str_replace(',','', session('form_data.amount'));
        }else{
            $pamount = session('form_data.amount');
        }

        //



        //Создать платеж исходящий
        $pnum = 'OUT TRASF  EB20022' . rand(10101, 99909) ;
        $info = $pnum . ' F023 ' . 'F023T000' . rand(10101, 99909) ;
        $payment = new Payment();
        $payment->fill(session('form_data'));
        $payment->amount = $pamount +  $comision;
        $payment->number = $pnum;
        $payment->recipier_info = $info . session('form_data.recipier_name');
        $payment->save();
        $last_trans = Transaction::whereUserId(Auth::id())->whereAccountId($acc->id)->orderBy('id', 'desc')->first();
        // Транзакция без комиссии
        $trans = new Transaction();
        $trans->account_id = $acc->id;
        $trans->payment_id = $payment->id;
        $trans->user_id = Auth::id();
        $trans->country_id = session('form_data.country_id');
        $trans->type = 'OUT';
        $trans->amount =  $pamount; //+  $comision;
        $trans->description = $info . " " .session('form_data.recipier_name') ;
        $trans->status = Transaction::STATUS_NEW;


        if(isset($last_trans->balance)){
            $trans->balance = $acc->balance_current - ( $pamount  );
        }else{
            return('Обнаружена подозрительная операция!
             Администратор свяжется с вами! ');
        }

        $trans->save();



        //Comission
        // Отдельная транзакция для комиссии
        if( session('form_data.comision') != 3 ){
            $last_part = ' COMMISSION AND/OR SWIFT CHARGE ';
            $trans2 = new Transaction();
            $trans2->account_id = $acc->id;
            $trans2->payment_id = $payment->id;
            $trans2->user_id = Auth::id();
            $trans2->country_id = session('form_data.country_id');
            $trans2->type = 'OUT';
            $trans2->amount =  $comision;
            $trans2->description = $info . $last_part ;
            $trans2->status = Transaction::STATUS_NEW;

        }

        $trans2->balance = $trans->balance - ( $comision  );

        $trans2->save();

        // Списываем с баланса аккаунта
        $acc->balance_current = $acc->balance_current - ($pamount +  $comision);
        $acc->save();

        //session('form_data')
        return view('admin.pages.payment.done');
    }

    public function finish(Request $request)
    {
        return view('admin.pages.payment.step3');
    }

    public function makeTemplate($request)
    {
       if($request->has('save_input') && $request->save_input != null){
           $template = new Template();
           $template->fill($request->all());
           $template->name = $request->save_input;
           $template->recipier_name = $request->payer_phone;
           $template->account_id = $request->account;
           $template->user_id = Auth::id();
           $template->save();
           return $template;
       }
       return true;

    }

    public function create()
    {
        if(Auth::user()->role !== 'admin'){
            abort('403');
        }

        $accounts = Account::with('user')->get();
        $countries = Country::get();

        return view('admin.pages.payment.create', compact('countries', 'accounts'));
    }

    // Вставить данные платежа созданного админом
    public function postAdminPayment(Request $request)
    {
        if(Auth::user()->role !== 'admin')
            abort('403');

        $account = Account::findOrFail($request->account);
        $user_id = Account::findOrFail($request->account)->user->id;

        $last_trans = Transaction::whereUserId($user_id)
            ->whereAccountId($account->id)
            ->orderBy('id', 'desc')
            ->first();

        if((int) $request->currency_id != $account->currency_id){
            $amount = CurrencyHelper
                ::Calculate($request->amount, $request->currency_id, $account->currency_id);
        }else{
            $amount = $request->amount;
        }

        if(stristr($request->amount, ',') == true) {
            $pamount = str_replace(',','.', $request->amount);
        }else{
            $pamount = $request->amount;
        }

        if(stristr($amount, ',') == true) {
            $amount = str_replace(',','.', $amount);
        }


        //Создать платеж
        $pnum = 'F0023TI' . rand(10101, 99909) ;
        $payment = new Payment();
        $payment->fill($request->all());
        $payment->number = $pnum;
        $payment->amount = $pamount;
        $payment->recipier_info = 'INWARD TRANSF ' . $pnum . " B/O " .  $request->payer_name . " " . $request->description;
        $payment->save();

        $trans = new Transaction();
        $trans->fill($request->all());
        $trans->user_id = $user_id;
        $trans->account_id = $request->account;
        $trans->type = 'IN';
        $trans->amount = $amount;
        $trans->status = 1;
        $trans->payment_id = $payment->id;
        $trans->description = 'INWARD TRANSF ' . $pnum . " B/O " .  $request->payer_name . " " . $request->description;
        $trans->balance = $last_trans->balance + $amount;
        $trans->save();

        $account->balance_current = $account->balance_current + $amount;
        $account->save();

        $this->sendInfo($trans);

        return view('admin.pages.payment.done');
    }

    public function sendInfo($trans)
    {

        $data = [
            'email' => 'kievaero@gmail.com',
            'name' => 'Info'
        ];

        Mail::to($data['email'])
            ->send(new InfoMail($data, $trans));

        return true;
    }


}
