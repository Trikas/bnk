<style>
    body { font-family: DejaVu Sans, sans-serif; }
    body{ width: 100px;}
</style>
<table align="center" class="remittanceAdvice" border="0" cellspacing="1"
       cellpadding="1">
    <tbody>
    <tr>
        <td width="50%" align="left" valign="top"
            colspan="2">

            <br>

        </td>
        <td width="50%" align="right" valign="top">
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
            <table width="100%" class="remittanceAdvice" border="0" cellspacing="1"
                   cellpadding="1">
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
        <td style="height: 20px; text-align: center; border-bottom-color: black; border-bottom-width: 1px; border-bottom-style: solid;"
            colspan="3">
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
                &nbsp; </b>:
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
        <td>
            {{$trans->payment->payer_bank }} {{$trans->payment->recipier_bank }}
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
    </tbody>
</table>
