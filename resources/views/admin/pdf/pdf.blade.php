<style>
    body { font-family: DejaVu Sans, sans-serif; width: 700px; }
    .title-div{
        width:700px;
        border:1px solid #000;
    }
    .right-div{
        padding-left:5px ;
    }
    .left-div, .right-div{
        height: 191px;
    }

    .left-div{
        width:160px;
        float: left;
        border-right:1px solid #000;
        background: #D3D3EA;
        font-size: 13px;
        padding-left:10px;

    }
    .left-div p, .right-div p {
        padding:0;
        margin-left: 2px;
        margin-bottom: 0;
        margin-top: 2px;
        font-size: 12px;
    }
    .left-div p span{
        font-weight: bold;
    }
    .mc-1{
        float: left;
        width:440px;

    }

    #transact tr th{
        font-size: 12px;
        font-weight: normal;
    }
    #transact tr td{
        margin-bottom: 10px;
    }

    /* TABLE */
    .t-title{
        height: 30px;
        width: 100%;
        color:white;
        background: black;
        margin:0 auto;
        margin-top:7px;
    }
    .t-title div{
        float: left;
        color:white;
        text-align: center;
        margin: 0 0px;
        font-size: 13px;
    }
    .t-title div:nth-child(1), .mtable-cont .rows div:nth-child(1){ width: 85px; }
    .t-title div:nth-child(2), .mtable-cont .rows div:nth-child(2){ width: 185px; }
    .t-title div:nth-child(3), .mtable-cont .rows div:nth-child(3){ width: 165px; }
    .t-title div:nth-child(4), .mtable-cont .rows div:nth-child(4){ width: 85px; }
    .t-title div:nth-child(5), .mtable-cont .rows div:nth-child(5){ width: 85px; }
    .t-title div:nth-child(6), .mtable-cont .rows div:nth-child(6){ width: 85px; }

    .mtable-cont .rows{
        width: 100%;
        float: none;
        height: 30px;
        display: block;
    }
    .mtable-cont .rows div{
        height: 50px;
        float: left;
        text-align: center;
        overflow: hidden;
        font-size: 10px;
    }
</style>
<style>
    .page-break {
        page-break-after: always;
    }
</style>

<style>
    .footer-blue p{
        color:white;
        font-size: 9px;
        margin: 1px;
        padding: 1px;
    }
    .footer-blue{
        background: #29317A;
        width:100%;
        height: 65px;
        text-align: center;
    }
</style>
<body>
    @include('admin.pdf.pdf-top')

    <div class="mtable-cont" style="position:relative;">
        @foreach($trans as $item)
            @if($loop->iteration % 12 == 0)
                <br><br>
            <div class="footer-blue" style="position: absolute; bottom:50px;">
                    <p style="padding-top: 7px;">AstroBank Limited - HEAD OFFICE</p>
                    <p>1 Spyrou Kyprianou Avenue, 1065 Nicosia, P.O.Box 25700, 1393 Nicosia Cyprus</p>
                    <p>BIC: PIRBCY2N, E-mail: info@astrobank.com, Web site: http://www.astrobank.com</p>
                </div>
                <div class="page-break"></div>

                @include('admin.pdf.pdf-top')
            @endif
            <div class="rows" style="font-weight: 600; overflow: hidden; ">
                <div style="overflow: hidden">{{$item->created_at->format('d.m.Y') ?? 'Unknown'}} </div>
                <div  style="overflow: hidden">{{$item->description  ?? 'Unknown'}}</div>
                <div  style="overflow: hidden">{{$item->created_at->format('d.m.Y') ?? 'Unknown'}}</div>
                <div  style="overflow: hidden">@if($item->type == 'OUT') {{$item->amount}} @endif</div>
                <div  style="overflow: hidden"> @if($item->type == 'IN') {{$item->amount}} @endif</div>
                <div  style="overflow: hidden">{{$item->balance}}</div>
            </div>

            <div class="clear" style="clear: both"></div>
            @if($loop->last)
                    <p ><div style="border: 2px solid #000" class="rows">
                        <div style="width: 550px; text-align: left; font-weight: bold; font-size: 14px">Выписка о текущем состоянии</div>
                        <div style=" font-weight: bold; font-size: 14px">{{$item->balance}}</div>
                    </div>
                    </p>
            @endif
        @endforeach

    </div>
<!--
<table border="0" id="transact" style="font-size: 11px; font-weight: normal;  ">
    <tr style="color:white; margin: 0; background: #000; text-align: center; border:0" >
        <th style="width:100px; border:0;">Дата</th>
        <th style="padding: 5px">Описание операции</th>
        <th>Дата валютирования</th>
        <th style="width:40px">Списание</th>
        <th>Зачисление</th>
        <th>Баланс</th>
    </tr>

    @foreach($trans as $item)
        <tr>
            <td style="height: 90px; text-align: center">{{$item->created_at->format('d-m-Y')}}</td>
            <td style=" text-align: center; font-size: 10px">{{$item->description ?? ''}}</td>
            <td style=" text-align: center">{{$item->created_at->format('d-m-Y')}}</td>
            <td style=" text-align: center">
                @if($item->type == 'OUT')  {{$item->amount}}  @endif
            </td>

            <td style=" text-align: center">
                @if($item->type == 'IN') {{$item->amount}} @endif
            </td>
            <td style=" text-align: center">
                {{$item->balance}}
            </td>


        </tr>
        @if ($loop->last)
            <tr>

            </tr>
        @endif
    @endforeach

</table>





</body>