@extends('layouts.cabinet')


@section('content')

    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 style="font-size: 13px" class="overview__title">
                        Подтверждение входящего платежа
                    </h2>
                </div>
                <style>
                    .bl-2i{
                        font-size: 12px;
                        text-align: left;
                    }
                </style>





                <style>
                    table {
                        border-bottom: gainsboro 1px;
                        border-left: gainsboro 1px;
                        border-right: gainsboro 1px;
                        border-top: gainsboro 1px;
                        font-family: Verdana, Arial;
                        font-size: 8pt;
                    }
                    td {
                        font-family: Verdana, Arial;
                        font-size: 8pt;
                    }
                    .ContentClass {
                        background-color: #ffffff;
                        border-top: #A7B6CC 1px solid;
                    }
                    .MainContent {
                        padding-left: 5px;
                    }
                    #mainareadiv {
                        height: 100%;
                        overflow-x: auto;
                        overflow-y: auto;
                        padding-left: 10px;
                    }
                    .clsbgcolortop {
                        background-color: #A7B6CC;
                    }
                    table.tblnav {
                        height: 100%;
                    }
                    form {
                        margin: 0px;
                    }
                    html, body {
                        overflow: hidden;
                    }
                    body {
                        background-color: #A7B6CC;
                        font-family: Verdana;
                        font-size: 8pt;
                        scrollbar-face-color: #e3e5e7;
                        scrollbar-highlight-color: #e3e5e7;
                        scrollbar-shadow-color: #e3e5e7;
                        scrollbar-3dlight-color: #cccccc;
                        scrollbar-arrow-color: #000000;
                        scrollbar-track-color: #ffffff;
                        scrollbar-darkshadow-color: #cccccc;
                    }
                    table.remittanceAdvice td {
                        vertical-align: top;
                    }
                </style>

                <body id="_masterBody" style="margin: 0px; height: 100%; -webkit-overflow-scrolling: touch;" width="980px; height:600px !important;">
                <form id="_mainForm" style="height: 400px">
                    <div id="navandmain" style="height: 431px;">
                        <table width="100%" class="tblnav clsbgcolortop" id="_content" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr align="left" valign="middle">
                                <td align="left" class="ContentClass" id="_mainArea" valign="top" style="width: 100%; height: 100%;">
                                    <div id="mainareadiv" style="width: 1169px; max-height: 631px;">
                                        <div id="_updatePanel">
                                            <div id="_printableArea">
                                                <div class="MainContent" id="_printableAreaInner" style="margin: 2px 0px 5px; padding: 0px;">
                                                    <div id="_controlContentDiv">
                                                        <table width="555" align="center" class="remittanceAdvice" border="0" cellspacing="1" cellpadding="1">
                                                            <tbody>
                                                            <tr>
                                                                <td width="50%" align="left" valign="top" style="padding-bottom: 20px;" colspan="2">
                                                                    <img id="_mainContentPlaceHolder_receivedRemittanceAdviceCtrl00__imgLogo" src="/images/logo-info.png">
                                                                    <br>

                                                                </td>
                                                                <td width="50%" align="right" valign="top" style="padding-bottom: 20px;">
                                                                    <table width="75%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="left">
                                                                                <b>
                                                                                    JETLUX LTD</b>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">
                                                                                DARTFORD ROAD 6-8
                                                                                <br>MARCH
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">
                                                                                &nbsp;7305613
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: center;" colspan="3">
                                                                    <b><u>
                                                                            ДЕБЕТОВОЕ АВИЗО</u></b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top" colspan="3">
                                                                    <table width="100%" class="remittanceAdvice" border="0" cellspacing="1" cellpadding="1">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td nowrap="">
                                                                                ИДЕНТИФИКАЦИОННЫЙ НОМЕР ПЛАТЕЖА
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100">
                                                                                {{$trans->payment->number ?? ''}}
                                                                            </td>
                                                                            <td width="100">
                                                                                &nbsp;
                                                                            </td>
                                                                            <td align="left" nowrap="">
                                                                                ДАТА
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100" align="right">
                                                                                {{$trans->created_at->format('d.m.Y') ?? ''}}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td nowrap="">
                                                                                ПОЛУЧАТЕЛЬ
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100">
                                                                                JETLUX LTD
                                                                            </td>
                                                                            <td>
                                                                                &nbsp;
                                                                            </td>
                                                                            <td align="left" nowrap="">
                                                                                ПОЛУЧЕННАЯ СУММА
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100" align="right" nowrap="nowrap">
                                                                                {{number_format($trans->amount, 2, ',', ' ')}}
                                                                                {{\App\Helpers\CurrencyHelper::getCurrencyCode($trans->account->currency_id)}}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td nowrap="">
                                                                                НОМЕР СЧЕТА
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td colspan="5">
                                                                                {{$trans->account->number}}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="7">
                                                                                &nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td nowrap="" colspan="3">
                                                                                <u><b>
                                                                                        ВАШ СЧЕТ БЫЛ КРЕДИТОВАН</b></u>
                                                                            </td>
                                                                            <td>
                                                                                &nbsp;
                                                                            </td>
                                                                            <td nowrap="" colspan="3">
                                                                                <u><b>
                                                                                        КОМИССИИ ЗА ПЕРЕВОД БЫЛИ ВЫЧТЕНЫ ИЗ ПОЛУЧЕННОЙ СУММЫ</b></u>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td nowrap="">
                                                                                СУММА ЗАЧИСЛЕНИЯ
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100">
                                                                                {{number_format($trans->amount, 2, ',', ' ')}}
                                                                                {{\App\Helpers\CurrencyHelper::getCurrencyCode($trans->account->currency_id)}}
                                                                            </td>
                                                                            <td>
                                                                                &nbsp;
                                                                            </td>
                                                                            <td align="left" nowrap="">
                                                                                AMOUNT DEBITED
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100" align="right">
                                                                                ---
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="7">
                                                                                &nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center" colspan="7">
                                                                                <u><b>
                                                                                        ANALYTICALLY</b></u>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td nowrap="">
                                                                                КУРС КОНВЕРТАЦИИ
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100" align="left">
                                                                                ---
                                                                            </td>
                                                                            <td>
                                                                                &nbsp;
                                                                            </td>
                                                                            <td align="left" nowrap="">
                                                                                КОМИССИЯ ЗА ОБРАБОТКУ
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100" align="right">
                                                                                ---
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td nowrap="">
                                                                                ДАТА ВАЛЮТИРОВАНИЯ
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100" align="left">
                                                                                {{$trans->created_at}}
                                                                            </td>
                                                                            <td>
                                                                                &nbsp;
                                                                            </td>
                                                                            <td align="left" nowrap="">
                                                                                КОМИССИЯ ЗА КОНВЕРТАЦИЮ
                                                                            </td>
                                                                            <td>
                                                                                :
                                                                            </td>
                                                                            <td width="100" align="right">
                                                                                ---
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height: 20px; text-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;" colspan="3">
                                                                    <b>
                                                                        ДЕТАЛИ ПЛАТЕЖА</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <b>
                                                                        БАНК-КОРРЕСПОНДЕНТ</b>:

                                                                </td>
                                                                <td>
                                                                    {{$trans->payment->recipier_bank ?? ''}}
                                                                </td>
                                                                <td>
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td id="_mainContentPlaceHolder_receivedRemittanceAdviceCtrl00_instrAmountCell">
                                                                                <b>
                                                                                    ОТПРАВЛЕННАЯ СУММА</b>:
                                                                            </td>

                                                                            <td align="right">
                                                                                {{number_format($trans->amount, 2, ',', ' ')}}
                                                                                {{\App\Helpers\CurrencyHelper::getCurrencyCode($trans->account->currency_id)}}
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <br>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <b>
                                                                        &nbsp;  </b>:
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td id="_mainContentPlaceHolder_receivedRemittanceAdviceCtrl00_exchangeRateDetailsCell">
                                                                                <b>
                                                                                </b>:
                                                                            </td>

                                                                            <td align="right">
                                                                                ---
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <b>
                                                                        ОТПРАВИТЕЛЬ</b>:
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    <b>
                                                                        ДЕТАЛИ ПЛАТЕЖА</b>:
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                        
                                                                    {{$trans->payment->payer_name ?? '--'}}  {{$trans->payment->payer_phone}}
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td width="280">
                                                                    {{$trans->payment->payer_bank }} 
                                                                    {{$trans->description}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td id="_mainContentPlaceHolder_receivedRemittanceAdviceCtrl00_senderChargesCell">

                                                                            </td>

                                                                            <td align="right">
                                                                                ---
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td style="width: 600px; padding-top: 50px;" colspan="3">

                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                </body>










                <div class="table__buttons table__buttons_offset">
                    <a class="btn" href="#" onclick="history.back()">Назад</a>
                </div>
                <div class="table__buttons ">



                    <a class="btn" href="#" onclick="print()">Печать</a>
                </div>

            </div>
        </div>

    </div>

@endsection



@section('menu')
    {!! \App\Helpers\_Helper::getMenu('second') !!}
@stop