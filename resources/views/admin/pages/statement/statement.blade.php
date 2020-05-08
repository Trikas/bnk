@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')
    <div class="main-content main-content_height container-fluid">
        <div class="row">
            <div class="col col--lg-12">
                <h2>Выписка по счету по электронной почте</h2>
                <hr>
                <h3>Параметры выписки</h3>
                <p class="leftmargin">Отправить в электронном виде выписку по счету:</p>
                <form autocomplete="off"  action="{{route('statement.post')}}" method="post">
                    @csrf
                    <div class="inputsrow">
                        <div class="price">

<input class="form-control" id="selectAccount" name="account[]" value="" placeholder="Номер" />

                            <!-- <select class="select select_account" name="account[]" required>
                                <option disabled selected>Номер Доступный остаток</option>
                            @foreach($accounts as $item)
                                    <option value="{{$item->id}}">{{$item->number}} {{$item->balance_current}} EUR</option>
                                @endforeach
                            </select> -->
                        </div>
                    </div>
                    <p class="leftmargin">За период:</p>
                    <div class="inputs_row periodwrap">
                        <span class="input_row"><label class="label">С:</label><input type="text" class="datepicker"  name="from_date"><img src="/images/cal.png"></span>
                        <span class="input_row"><label class="label">По:</label><input type="text" class="datepicker"  name="to_date"><img src="/images/cal.png"></span>
                    </div>
                    <span class="leftmargin att">Внимание:</span>
                    <p class="leftmargin">Выписки по счетам за период, превышающий 24 месяцев, не могут быть предоставлены.</p>
                    <h3>Формат файла</h3>
                    <p class="leftmargin">Отправить выписку по счету</p>
                    <div class="sendrow">
                        <span class="label vid">в виде</span>
                        <div class="formatrow">
                            <span><input type="radio" disabled><label> CSV</label></span>
                            <span><input type="radio" checked><label> PDF</label></span>
                        </div>
                    </div>
                    <h3>Обеспечение безопасности операции</h3>
                    <p class="leftmargin">Получить выписку по эл. почте</p>
                    <div class="inputs_row">
                        <span class="input_row"><label class="label">e-mail адрес:</label><input type="email" name="email" required ></span>
                    </div>
                    <p class="pm">Пожалуйста, введите произвольный пароль и его подтверждение для того, чтобы открыть полученную электронную выписку.</p>
                    <p class="pm"><strong>Примечание: </strong>Пароль для входа в интернет-сервис не должен использоваться в качестве пароля для подтверждения выписки</p>
                    <div class="inputs_row">
                        <span class="input_row"><label class="label">Пароль:</label><input type="password" name="password"></span>
                        <span class="input_row"><label class="label">Подтверждение пароля:</label><input type="password" name="password_confirm"></span>
                    </div>
                    <div class="submit-container">
                        <button class="btn btn_blue right" type="submit" >
                            Отправить
                        </button>
                    </div>
                </form>
            </div>
        </div>
{{--
    <div class="main-content main-content_height table-width" style="height: 700px; overflow: scroll">
        <div class="row">
            <div class="col col--lg-12">

                    <p style="border-bottom: 1px solid black; color:#627B9B">Выписка по счету по электронной почте</p>

                    <p style="font-weight: bold; margin-top:20px">Параметры выписки</p>


                <form autocomplete="off"  action="{{route('statement.post')}}" method="post">
                    @foreach($accounts as $item)
                        <input required type="radio" name="account[]" value="{{$item->id}}">{{$item->number}} <br>
                    @endforeach
                        <br>

                    @csrf
                    <p>С: <input type="text" class="datepicker" name="from_date"></p><br>
                    <p>ПО: <input type="text" class="datepicker" name="to_date" ></p><br>

                    <p>email: <input required type="email" class="" name="email"></p>
                    <br>
                    <p style="font-weight: bold">
                        Пароль на архив
                    </p>

                    <input type="password" name="password"><br>
                    <input type="password" name="password_confirm"><br>

                    <input type="submit" value="отправить">
                </form>
                
            </div>--}}

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

        {id: "{{$item->id}}", desc:"{{ $desc }}",number:"{{$item->number}}", left: "{{number_format($item->balance_current, 2, ',', ' ')}}", ccy: "{{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}"},
   @endforeach

    ],
    fields:[
        {name:'desc',text:'Описание'},
        {name:'number',text:'Номер'},
        {name:'left',text:'Доступный остаток'},
        {name:'ccy', text:'Валюта'}
    ],
    headShow: true,
    fieldText : 'number',
    fieldValue: 'id',
	filterOpen: true
    });

</script>


@endsection

