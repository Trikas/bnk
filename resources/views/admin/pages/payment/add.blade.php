@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')
    <style>
        p, h4{font-size:12px;}
        h2{font-size: 13px}
    </style>
    <form action="/payment/add" method="post" id="tempate_form_go">
    @csrf
    <input type="hidden" name="template" id="template_input">
    <input type="submit" style="display: none">
    </form>
    <div class="main-content main-content_height container-fluid">
        <div class="row">
            <div class="col col--lg-12" style="margin-top:10px;">
                <h2>Денежные переводы - оформление новых (Этап 1 из 3)</h2>
                <hr>
                <div class="btext" style="margin-top:20px;margin-bottom:10px;">
                    <h4>ВАЖНАЯ ИНФОРМАЦИЯ</h4>
                    <p style="font-size:12px;">
                        Для того, чтобы ускорить выполнение перевода и избежать возврата или дополнительных комиссий очень важно всегда включать в свои инструкции счет получаетя в формате IBAN<br>
                        (особенно для тех стран, где это является обязательным, например, ЕС и ЕЭ3 страны) и корректный банковский идентификационный код (BIC). В противном случае Ваша транзакция<br>
                        может быть отложена, возвращена, или за нее могут быть списаны дополнительные комиссии.
                    </p>
                    <br>
                    <p  style="font-size:12px;">Поля отмеченные звездочкой (*) являются обязательными.</p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" style="color:red">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="pform">
                        <div class="pformname"><p  style="font-size:12px;"><span>* </span>Со счета</p></div>
                        <div class="pformitem">
                            <form id="account_select_form222" action="/payment/add" method="post">

<!-- <input class="form-control" id="selectAccount" name="account" value="" placeholder="Счёт" /> -->


                            <select name="account" id="account_select222" required>
                                    <option disabled>Описание &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Номер &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Номер &nbsp;&nbsp;&nbsp;</span></option>
                                    @isset($accounts)
                                        @foreach($accounts as $item)
                                            <option @if($account->id === $item->id) selected @endif value="{{$item->id}}">{{$item->number}}  {{$item->iban}} {{$item->balance_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}</option>
                                        @endforeach
                                    @endisset
                                </select>


                            </form>
                        </div>
                        <div class="pformalign"></div>
                        <form action="{{route('payment.store')}}" method="post">
                            <div class="pformname"><p  style="font-size:12px;">Наименование Плательщика</p></div>
                            <div class="pformitem"><textarea name="payer_name"  rows="4" readonly style="color: lightgray;">JETLUX LTD, MARCHUNITED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KINGDOM(default)DARTFORD ROAD6-8"</textarea></div>

<div class="pformname"><p  style="font-size:12px;"><span>* </span> Номер телефона Плательщика</p></div>
                            <div class="pformitem">
                                <input type="text" name="payer_phone" value="{{$t->recipier_phone ?? ''}}" required>
                            </div>
                    </div>
                    <div class="blueline">
                        <div class="bluelineitem">
                            <span  style="font-size:12px;">Пожалуйста, введите реквизиты получателя или выберите соответсвующие реквизиты из списка:</span>
                        </div>
                        <div class="bluelineitem" style="margin-left:10px;">
                            <input type="hidden" class="put-me" name="account" value="">
                            <input type="hidden"    name="account_old" value="{{$account->id}}">
                            <select id="template_trigger">
                                <option value="0">Выберите</option>
                                @isset($templates)
                                    @foreach($templates as $item)
                                        <option @if(isset($t) && $t->id === $item->id) selected @endif value="{{$item->id}}">{{$item->name}} | {{$item->recipier_name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <div class="pform">
                        <div class="pformname"><p  style="font-size:12px;"><span>* </span> Страна назначения</p></div>
                        <div class="pformitem">
                            <select name="country_id" value="recipier_country" required>
<option selected disabled value='' >Выбрать</option>
                                @foreach($countries as $item)
                                    <option @if(isset($t) && ($t->country_id == $item->id)) selected @endif  id="{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pformalign"></div>
                        <div class="pformname"><p  style="font-size:12px;"><span>* </span> Валюта</p></div>

                        <div class="pformitem">
                            <select required name="currency" id="">
                                <option selected disabled value='' >Выбрать</option>
                                <option value="1">{{\App\Helpers\CurrencyHelper::getCurrencyCode(1)}}</option>
                                <option value="2">{{\App\Helpers\CurrencyHelper::getCurrencyCode(2)}}</option>
                            </select>
                        </div>
                        <div class="pformalign"></div>

<div class="pformname"><p style="font-size:12px;"><span>* </span> Сумма</p></div>
                        <div class="pformitem">
                            <input name="amount" value="{{$t->price ?? ''}}" class="moneyInput" required type="text">
                        </div>
                        <div class="pformalign"></div>
                    </div>
                    <div class="mftitle">
                        <h4 ><u>Сведения о Получателе</u></h4>
                    </div>
                    <div class="pform">
<div class="pformname"><p style="font-size:12px"><span>* </span> IBAN/ Счет Получателя</p></div>

                        <div class="pformitem">
                            <input value="{{$t->iban ?? ''}}" required name="iban" style="width:400px;">
                        </div>
                        <div class="pformalign"></div>
<div class="pformname"><p style="font-size:12px"><span>* </span> Полное имя и адрес</p></div>

                        <div class="pformitem">
                            <input type="text"  value="{{$t->recipier_name ?? ''}}"  required name="recipier_name" style="width:500px;">
                        </div>
                        <div class="pformalign"></div>
<div class="pformname"><p style="font-size:12px"><span>* </span> БИК Банка Получателя</p></div>

                        <div class="pformitem">
                            <input type="text"  value="{{$t->bic_bank ?? ''}}" name="bic_bank" >
                        </div>
                        <div class="pformalign"></div>
                        <div class="pformname"><u>Банк Получателя</u></div>
                        <div class="pformitem">
                            <input type="text"  value="{{$t->recipier_bank ?? ''}}" name="recipier_bank" style="width:400px;">
                        </div>
                        <div class="pformalign"></div>
                    </div>
                    <div class="blueline">
                        <div class="bluelineitem"><input type="checkbox" name="option22" value="a3"> <span>Сохранить перевод в качестве шаблона:</span></div><div class="bluelineitem" style="margin-left:10px;"><input type="text" name="22"></div>
                    </div>
                    <br>
                    <div class="mftitle" style="margin-bottom:10px;">
                        <h4><u>Подробная информация о переводе</u></h4>
                    </div>
                    <div class="pform">
<div class="pformname"><p style="font-size:12px"><span>* </span> Детали платежа</p></div>

                        <div class="pformitem">
                            <textarea rows="3" name="recipier_info" required>{{$t->recipier_info ?? ''}}</textarea>
                        </div>
                        <div class="pformalign"></div>
<div class="pformname"><p style="font-size:12px"><span>* </span> Комиссия</p></div>

                        <div class="pformitem">
                            <select name="comision" id="" required>
                                <option value="1">Общая</option>
                                <option value="2">Все расходы возложены на Отправителя</option>
                                <option value="3">Все расходы возложены на Получателя</option>
                            </select>
                        </div>
                    </div>
                    <div class="offerta">
                        <input type="checkbox" name="conditions" value="a3" required><span>Я прочитал, понял и <a href="/conditions.pdf" target="_blank"><u>принимаю условия</u></a>, которые применяются к входящим/исходящим Переводам, и обязаюсь их соблюдать.</span>
                    </div>
                    <input type="submit" style="display: none;">
                    <div class="formbut" style="margin-top:10px;">
                        <button class="gogobut">Далее</button>
                    </div>


                @csrf
                </form>

            </div>
        </div>
    </div>




<script src="/js/autoNumeric.min.js"></script>

<script>
new AutoNumeric('.moneyInput', {
    currencySymbol : '',
    decimalCharacter : '.',
    digitGroupSeparator : ',',
});
</script>

@stop



@section('scripts')

<link href="/js/inputpicker/jquery.inputpicker.css" rel="stylesheet" />
<script src="/js/inputpicker/jquery.inputpicker.js"></script>

<script>




$('#selectAccount').inputpicker({

    data:[
           @foreach($accounts as $item)

            @if($item->currency_id === 1)
                @php($desc = "COMMERCIAL CURRENT ACC EUR")
            @endif

            @if($item->currency_id === 2)
                @php($desc = "COMMERCIAL CURRENT ACC USD")
            @endif

              {id: "{{$item->id}}", number:"{{$item->number}}", iban:"{{$item->iban}}", balance_current:"{{$item->balance_current}}", ccy: "{{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}"},
         @endforeach

    ],
    fields:[
        {name:'number',text:'Номер'},
        {name:'iban',text:'IBAN'},
        {name:'balance_current',text:'Текущий баланс'},
        {name:'ccy', text:'Валюта'}
    ],
    headShow: true,
    fieldText : 'number',
    fieldValue: 'id',
	filterOpen: true,
    });



</script>



@endsection
