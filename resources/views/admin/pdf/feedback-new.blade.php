<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    @page { margin-top: 10px; margin-bottom: 10px; }
    body { margin-top: 10px; margin-bottom: 10px;}
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
        font-size: 9pt;
    }
    .left-div p{
        margin-top: 7px;
    }
    .left-div p span{
        font-weight: bold;
    }
    .mc-1{
        float: left;
        width:440px;

    }

    #transact tr th{
        font-size: 10px;
        font-weight: bold;
    }
    #transact tr td{
        font-size: 10pt;
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
        margin: 0 0;
        font-size: 7pt;
        font-weight: bold;
    }
    .t-title div:nth-child(1), .mtable-cont .rows div:nth-child(1){ width: 85px; }
    .t-title div:nth-child(2), .mtable-cont .rows div:nth-child(2){ width: 185px; }
    .t-title div:nth-child(3), .mtable-cont .rows div:nth-child(3){ width: 165px; }
    .t-title div:nth-child(4), .mtable-cont .rows div:nth-child(4){ width: 85px; }
    .t-title div:nth-child(5), .mtable-cont .rows div:nth-child(5){ width: 85px; }
    .t-title div:nth-child(6), .mtable-cont .rows div:nth-child(6){ width: 85px; }

    .mtable-cont .rows div:nth-child(4){ text-align: right; }
    .mtable-cont .rows div:nth-child(5){ text-align: right; }
    .mtable-cont .rows div:nth-child(6){ text-align: right; }

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
        font-size: 10pt;
        font-weight: bold;
    }

    .page-break {
        page-break-after: always;
    }

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

    td{
        vertical-align: top;
    }
</style>
<body>

<div class="mtable-cont" style="position:relative;">
    <span>Предмет: </span><b>{{$typeFeedback}}</b>
    <br>
    <span>Описание вопроса: </span> <b>{{$descriptionFeedback}}</b>
    <br>
    @if($typeAnswer=='email')
        <span>Контактный адрес электронной почты:</span> <b>{{$email}}</b><br>
    @else
        <span>Контактный телефон:</span> <b>{{$phone}}</b> <br>
    @endif
    @if($pathToFile)
        <span>Прикрепленный файл: </span><br><br><br>
        <img src="{{$pathToFile}}" alt="" width="200">
    @endif
</div>
