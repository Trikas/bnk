
<div class="left" style="float:left;">
    <img style="width:165px; height:75px; margin: 7px 0 20px 0;" src="{{ public_path('images/logo5.png')}}" alt="ss">
    <div style="font-weight: bold; font-size: 8pt; margin-left: 10px;">AstroBank Limited</div>
    <br>
    <div style="font-weight: bold; font-size: 8pt; margin-left: 10px; margin-top: -25px">BIC: PIRBCY2N</div>

</div>

<div class="right" style="float: right;">
    <h2 style="font-weight: normal; margin-top: 0; font-style: normal; font-size: 18pt;">Операции по счету</h2>
    <div class="line" style="text-align: right; width: 235px;  font-size: 7pt">С: {{ $data2['from_date']  }}</div>
    <div class="line" style="text-align: right; width: 235px; font-size: 7pt ">ПО: {{ $data2['to_date']  }}</div>
</div>

<div class="clear" style="clear: both"></div>
<br>
<div class="clear" style="clear: both"></div>

<div class="title-div" style="border-bottom: 1px solid #000">
    <div class="left-div">
        <p>Ваш cчет: </p>
        <br> <br><br>
        <p style="margin-top: -5px">IBAN: </p>
        <br>
        <p>Ваше отделение: </p>
        <br> <br>
        <p>Владелец: </p>
        <br> <br>

    </div>


    <div class="right-div" >
        <div class="mc-1">
            <table style="font-size: 9pt;">
                <tr>
                    <td style="width: 100px;">Номер cчета:</td>
                    <td  style="">Тип:</td>
                </tr>
                <tr>
                    <td  style="width: 100px; margin-top: -10px;">{{$acc->number}}</td>
                    <td >COMMERCIAL CURRENT ACC {{\App\Helpers\CurrencyHelper::getCurrencyCode($acc->id)}}</td>
                </tr>
            </table>
            <br>

            <p>{{$acc->iban}}</p>
            <br>

            <p>INTERNATIONAL BANKING UNIT - <br> NICOSIA
            </p><p>&nbsp;</p>


            <p >JETLUX LTD [Основной владелец]</p>
            <br>


        </div>
        <div class="mc-2" >
            <p>Валюта</p>
            <p>{{\App\Helpers\CurrencyHelper::getCurrencyCode($acc->currency_id)}} </p>
            <br>

        </div>


    </div>
</div>


<div class="clearfix" style="clear: both"></div>

<div class="mtable">
    <div class="t-title">
        <div>Дата</div>
        <div>Описание операции</div>
        <div>Дата валютирования</div>
        <div>Списание</div>
        <div>Зачисление</div>
        <div>Баланс</div>
    </div>

</div>
<div class="clearfix" style="clear: both"></div>
<br>