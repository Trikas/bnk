<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Http\Controllers\Controller;
use App\Jobs\SendPdf;
use App\Mail\SendMail;
use App\Statement;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PDF;
use ZipArchive;

class StatementController extends Controller
{
    public function index()
    {
        $accounts = Auth::user()->accounts;
        return view('admin.pages.statement.statement', compact('accounts'));
    }

    public function post(Request $request)
    {
        $acc_id = $request->account[0];

        $account = Account::find($acc_id);

        if( $account->user_id != Auth::id() )
            return abort('403');

        $trans = Transaction::query();

        $trans->where('user_id', Auth::id())->where('account_id', $account->id);

        if($request->has('from_date')){
            if($request->from_date != null){
                $data['from_date'] = $this->makeDate($request->from_date);

                $trans->where('created_at','>' , $data['from_date']);
            }
        }else{
            $data['from_date'] = Carbon::today()->subYear();
            $trans->where('created_at','>' , $data['from_date']);
        }


        if($request->has('to_date')){

            if($request->to_date != null){

                $data['to_date'] = $this->makeDate($request->to_date);
                $trans->where('created_at','<' , $data['to_date']);
            }
        }else{
            $data['to_date'] = Carbon::today();
            $trans->where('created_at','<' , $data['to_date']);
        }

        if($request->has('password') && $request->has('password_confirm')){
            if($request->password == $request->password_confirm){
                $data['pass'] = $request->password;
            }
        }


        $trans = $trans->get();

        $data['email'] = $request->email;


        //SendPdf::dispatch($account, $trans , $data);
        //return "OK";
        return $this->send($account, $trans , $data);


    }



    public function send($acc, $trans,  $data2)
    {
        if( null == count($trans) )
            return "За выбранный период нет выписок!";


        $data2['from_date'] = $this->makeNewDate($data2['from_date']);
        $data2['to_date'] = $this->makeNewDate($data2['to_date']);

        //return view('admin.pdf.new', compact('trans', 'acc', 'data2'));
        $pdf = PDF::loadView('admin.pdf.new', compact('trans', 'acc', 'data2'));

        //return $pdf->download('invoice.pdf');
        //return $pdf->stream();

        $f = public_path();

        $s_name = date('d-m-y') . "_" . Auth::id() . "_" . Str::random(4) . ".pdf";
        $s_file = $f . '/' . $s_name;
        $pdf->save($s_file);

        if( array_key_exists('pass', $data2) ){
            sleep(1);
            $pass = $data2['pass'];
            $str = "zip -P $pass $s_name.zip $s_name";
            system($str);

            $data = [
                'name' => 'Eugene',
                'attach' =>  "$s_name.zip"
            ];
            unlink($s_file);
        }else{

            $data = [
                'name' => 'Eugene',
                'attach' =>  $s_name
            ];


        }






        //$this->password(public_path() . "/hello2.pdf");


        $this->statementSave($s_name,  $data2['from_date'],  $data2['to_date']);

        Mail::to($data2['email'])
            ->send(new SendMail($data));

        return redirect('done');
    }

    public function makeDate($date)
    {
        $dt = Carbon::createFromFormat('d.m.Y', $date);
        return $dt->toDateString();
        /*
        if( strpos($date, "/") ){
            $dt = Carbon::createFromFormat('d/m/Y', $date);
            return $dt->toDateString();
        }else{
            return $date;
        }
        */
    }

    public function changeDateFromat($date)
    {
        $date = Carbon::createFromFormat('d.m.Y', $date);
        return $date->format('d.m.Y');
    }

    public function makeNewDate($data)
    {
        $date = Carbon::createFromFormat('Y-m-d', $data);
        return $date->format('d.m.Y');
    }


    public function getStatements()
    {
        return view('admin.pages.getstatemnts');
    }

    public function statementSave($file, $from, $to)
    {
        $st = new Statement();
        $st->from = $from;
        $st->to = $to;
        $st->user_id = Auth::id();
        $st->url = $file;
        $st->save();
        return true;
    }

}
