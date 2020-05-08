<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Transaction;
use App\Mail\InfoMail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PDF;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getTransactions($request);
        return view('admin.pages.transaction-1', $data);
    }

    public function getIn(Request $request)
    {
        $data = $this->getAllTransactions($request, 'IN');
        return view('admin.pages.transactions-in', $data);
    }

    public function getOut(Request $request)
    {
        $data = $this->getAllTransactions($request, 'OUT');

        return view('admin.pages.transactions-out', $data);
    }

    public function arhive(Request $request)
    {
        $data = $this->getTransactions($request);
        return view('admin.pages.transaction-2', $data);
    }

    public function adminIn()
    {
        $accounts = Account::get();

        $data['transactions'] = Transaction::orderBy('created_at','desc')->paginate($this->per_page);
        $data['trans'] = Transaction::orderBy('id', 'desc')->first();
        $data['accounts'] = $accounts;
        $data['account'] = $account ?? Auth::user()->account;

        return view('admin.pages.transaction-2', $data);
    }

    public function paymentsAll(Request $request)
    {
        $data = $this->getTransactions($request);
        return view('admin.pages.payment.payment-all', $data);
    }


    public function getTransactions($request, $type = null)
    {

        $transactions = Transaction::query();

        if($request->has('account')){
            $account = Account::find($request->account);
            if(Auth::user()->role === 'admin'){

            }else{
                $transactions->where('account_id', $request->account)->whereUserId(Auth::id());
            }

        }else{

            if(Auth::user()->role === 'admin'){

            }else{

                if($request->has('acc') && $request->acc != null){
                    $account = Account::find($request->acc);
                    if($account->user_id != Auth::id())
                        abort('403');
                }else{
                    $account = Auth::user()->account;
                }
                $transactions->where('account_id', $account->id)->whereUserId(Auth::id());

            }


        }

        $accounts = Auth::user()->accounts;

        $data = [];

        if($request->has('from_date')){
            if($request->from_date != null){
                $data['from_date'] = $this->makeDateToDate($request->from_date);
                $transactions->where('created_at','>=' , $data['from_date']);
                $data['from_date'] = $this->ReMakeDate($request->from_date);            }
        }else{

            $data['from_date'] = Carbon::now()->subMonth(2)->format('d.m.Y');
            $transactions->where('created_at','>=' , $data['from_date']);
            $data['from_date'] = Carbon::now()->subMonth(2)->format('d.m.Y');
        }

        if($request->has('to_date')){
            if($request->to_date != null){
                $data['to_date'] = $this->makeDate($request->to_date);
                $transactions->where('created_at','<=' , $data['to_date']);
                $data['to_date'] = $this->ReMakeDate($request->to_date);
            }
        }else{
            $data['to_date'] = Carbon::now()->format('d.m.Y');
            $transactions->where('created_at','<=' , $data['to_date'] );
            $data['to_date'] = Carbon::now()->format('d.m.Y');
        }

        if($request->has('search')){
            if($request->search != null){
                $data['search'] = trim( $request->search );
                $transactions->where('description','like' , '%' . $data['search'] . '%');
            }
        }

        if($type != null){
            $transactions->where('type' , $type);
        }

        $data['transactions'] = $transactions->orderBy('id','desc')->paginate($this->per_page);
        $data['trans'] = Transaction::orderBy('id', 'desc')->first();
        $data['accounts'] = $accounts;
        $data['account'] = $account ?? Auth::user()->account;

        if(isset($data['from_date'])){
            if( strpos($data['from_date'], "-")  ){
                $data['from_date'] = $this->ReMakeDate($data['from_date']);
            }
        }

        if(isset($data['to_date'])){
            if( strpos($data['to_date'], "-")  ){
                $data['to_date'] = $this->ReMakeDate($data['to_date']);
            }
        }


        return $data;
    }




    public function getAllTransactions($request, $type = null)
    {
        $transactions = Transaction::query();
        if($request->has('acc') && $request->acc != null){
            $account = Account::find($request->acc);
            if($account->user_id != Auth::id())
                abort('403');
        }else{
            $account = Auth::user()->account;
        }

        $accounts = Auth::user()->accounts;


        $data = [];

        if($request->has('from_date')){
            if($request->from_date != null){
                $data['from_date'] = $this->makeDate($request->from_date);
                $transactions->where('created_at','>' , $data['from_date']);
                $data['from_date'] = $this->makeDate($data['from_date']);
            }
        }

        if($request->has('to_date')){
            if($request->to_date != null){
                $data['to_date'] = $this->makeDate($request->to_date);
                $transactions->where('created_at','<' , $data['to_date'] );
                $data['to_date'] = $this->makeDate($data['to_date']);
            }
        }

        if($request->has('search')){
            if($request->search != null){
                $data['search'] =  trim( $request->search );
                $transactions->where('description','like' , '%' . $data['search'] . '%');
            }
        }

        if($type != null){
            $transactions->where('type' , $type);
        }

        $data['transactions'] = $transactions->orderBy('created_at', 'desc')->paginate($this->per_page);


        $data['trans'] = Transaction::orderBy('id', 'desc')->first();
        $data['accounts'] = $accounts;
        $data['account'] = $account;

        return $data;
    }


    public function ReMakeDate($date)
    {
        if( strpos($date, ".") ){
            $dt = Carbon::createFromFormat('d.m.Y', $date);
            return $dt->toDateString();
        }else{
            $dt = Carbon::createFromFormat('Y-m-d', $date);
            return $dt->format('d.m.Y');
        }

    }

    public function makeDate($date)
    {
        if( strpos($date, ".") ){
            $dt = Carbon::createFromFormat('d.m.Y', $date)->addHours(24);
            return $dt->toDateString();

        }else{
            $dt = Carbon::createFromFormat('Y-m-d', $date)->addHours(24);
            return $dt->format('d.m.Y');
        }
    }

    public function makeDateToDate($date)
    {
        if( strpos($date, ".") ){
            $dt = Carbon::createFromFormat('d.m.Y', $date)->addDay();
            return $dt->toDateString();

        }else{
            $dt = Carbon::createFromFormat('Y-m-d', $date)->addDay();
            return $dt->format('d.m.Y');
        }
    }


    public function apply($id)
    {
        if(Auth::user()->role === 'admin'){
            $trans = Transaction::find($id);
            $trans->status = 1;
            $trans->save();
            return back();
        }
        return abort('403');
    }


    // Подробная информация о переводе
    public function info($id)
    {
        $trans = Transaction::findOrFail($id);

        if(Auth::id() != $trans->user_id){
            if(Auth::user()->role !== 'admin'){
                return abort('403');
            }
        }

        if($trans->type === 'OUT')
            return view('admin.pages.info-out', compact('trans'));
        return view('admin.pages.info', compact('trans'));

    }


    public function changeStatus($status, $id)
    {
        if(Auth::user()->role != 'admin')
            return abort('403');

        $trans = Transaction::findOrFail($id);
        $trans->status = (int) $status;
        $trans->save();

        if($trans->status === 3){
            $acc = Account::find($trans->account_id);
            if($trans->type == 'OUT'){
                $acc->balance_current = $acc->balance_current + $trans->amount;
                $acc->save();
            }
        }


        return back();
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
