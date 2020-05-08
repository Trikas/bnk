@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')
    <style>
        * { font-size: 12px !important;}
    </style>
    <div class="main-content main-content_height container-fluid">
        <div class="row">
            <div class="col col--lg-12" style="margin-top:10px;">
                <h2>Денежные переводы - оформление новых (Этап 3 из 3)</h2>
                <div class="formtable">
                    <table class="formtableitem">
                        <div class="formtabletitle">
                            <p>Ваша операция успешно завершена.</p>
                        </div>
                        <tr>
                            <td class="formtableitemleft">Идентификационный номер платежного поручения</td>
                            <td class="formtableitemright">EB1912300943832</td>
                        </tr>
                    </table>
                    <table class="formtableitem">
                        <div class="formtabletitle">
                            <p>Детали платежа</p>
                        </div>
                        <tr>
                            <td class="formtableitemleft">Со счета</td>
                            <td class="formtableitemright">{{\App\Helpers\_Helper::getAccountNumber(session('form_data.account'))}}</td>
                        </tr>
                        <tr>
                            <td class="formtableitemleft">Наименование Плательщика</td>
                            <td class="formtableitemright">{{session('form_data.payer_name')}}</td>
                        </tr>
                        <tr>
                            <td class="formtableitemleft">Номер телефона Плательщика</td>
                            <td class="formtableitemright">{{session('form_data.payer_phone')}}</td>
                        </tr>
                        <tr>
                            <td class="formtableitemleft">Страна назначения</td>
                            <td class="formtableitemright">{{\App\Helpers\_Helper::getCountry(session('form_data.country_id'))}}</td>
                        </tr>
                    </table>
                    <div class="mintitletable">
                        <p><u>Сведения о Получателе</u></p>
                    </div>
                    <table class="formtableitem">
                        <tr>
                            <td class="formtableitemleft">IBAN/ Счет Получателя</td>
                            <td class="formtableitemright">{{session('form_data.iban')}}</td>
                        </tr>
                        <tr>
                            <td class="formtableitemleft">Тип счета</td>
                            <td class="formtableitemright">IBAN</td>
                        </tr>
                        <tr>
                            <td class="formtableitemleft">Полное имя и адрес</td>
                            <td class="formtableitemright">{{session('form_data.recipier_name')}}</td>
                        </tr>
                        <tr>
                            <td class="formtableitemleft">БИК Банка Получателя</td>
                            <td class="formtableitemright">{{session('form_data.bic_bank')}}</td>
                        </tr>
                        <tr>
                            <td class="formtableitemleft">Банк Получателя</td>
                            <td class="formtableitemright">{{session('form_data.recipier_bank')}}</td>
                        </tr>
                    </table>
                    <div class="mintitletable">
                        <p><u>Подробная информация о переводе</u></p>
                    </div>
                    <table class="formtableitem">
                        <tr>
                            <td class="formtableitemleft">Детали платежа</td>
                            <td class="formtableitemright">{{session('form_data.recipier_info')}}</td>
                        </tr>
                        <tr>
                            <td class="formtableitemleft">Комиссия</td>
                            <td class="formtableitemright">{{\App\Helpers\CurrencyHelper::getComisionTitle(session('form_data.comision'))}}</td>
                        </tr>
                    </table>
                    <table class="formtableitem">
                        <div class="tableoferta">
                            <input type="checkbox" checked="checked" onclick="return false;" name="oggerta" value="a3" required readonly><span>Я прочитал, понял и <a href="/conditions.pdf" target="_blank"><u>принимаю условия</u></a>, которые применяются к входящим/исходящим Переводам, и обязаюсь их соблюдать.</span>
                        </div>
                        <div class="formtabletitle">
                            <p>В случае исполнения Вашего платежа сегодня ({{date('d-m-Y')}}), с Вашего счета была бы списана сумма в размере</p>
                        </div>
                        <tr>
                            <td class="formtableitemleft">Основная сумма:</td>
                            <td class="formtableitemright">{{session('form_data.amount')}} {{ \App\Helpers\CurrencyHelper::getCurrencyCode(session('form_data.currency'))}}</td>
                        </tr>
                        <tr>
                            <td class="formtableitemleft">Комиссия и расходы:</td>
                            <td class="formtableitemright">  {{ session('form_data.comision_amount') }} @if(session('form_data.currency') == "2") USD @else EUR @endif </td>
                        </tr>
                    </table>
                    <table class="formtableitem" style="width:100%">
                        <div class="formtabletitle">
                            <p>Планирование</p>
                        </div>
                        <tr>
                            <td class="formtableitemleft">Исполнить</td>
                            <td class="formtableitemright">{{Carbon\Carbon::now()->format('d.m.Y')}}</td>
                        </tr>
                    </table>
                </div>
                <div class="finachek" style="margin-top:20px;">
                    <p><b>Дата валютирования:</b> {{Carbon\Carbon::now()->format('d.m.Y')}}</p>
                </div>
                <div class="chekltext">
                    <span>По факту исполнения Вашего денежного перевода Вы сможете посмотреть информацию о списанных с Вашего счета комиссиях и расходах в системе Пиреос Онлайн (Операция по счету, выполненные денежные переводы,</span>
                    <span>Архив Платежей/Денежных переводов)</span>
                </div>

                <div class="finachek" style="margin-top:20px;">
                    <p><b>Дата валютирования:</b> {{Carbon\Carbon::now()->format('d.m.Y')}}</p>
                    <p style="mergin-top:15px;">Для просмотра Ваших платежных поручений, пожалуйста выберите <a href="/transactions/arhive">Архив денежных переводов</a></p>
                </div>
                <form action="/payment/step3" method="post">

                    <div class="table__buttons " style="margin-top: 20px">
                        @csrf
                        <button class="btn btn-success" type="submit">Завершить</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@stop