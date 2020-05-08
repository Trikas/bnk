@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')


    <div class="main-content main-content_height" >
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Оформить платеж
                    </h2>
                </div>

                <div class="pin-text">
                    Тут вы можете создать платеж
                </div>


                <div class="select__row">




                </div>

                <div class="select__tab tab-widget">

                    <form action="{{route('payment.post')}}" method="post">

                        @csrf

                        <div class="select__row_text">
                            <span class="red">*</span> На счет
                        </div>
                        <select name="account" id="account_sel">
                            @isset($accounts)
                                @foreach($accounts as $item)
                                    <option  value="{{$item->id}}">{{$item->user->email}} {{$item->user->name}} {{$item->user->last_name}} | {{$item->number}} | {{$item->balance_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}</option>
                                @endforeach
                            @endisset
                        </select>

                        <p style="margin:10px 0;"><label for="">Наименование плательщика</label></p>
                        <p><textarea name="payer_name" id="" cols="20" rows="4"></textarea></p>

                        <p style="margin:10px 0;"><label for="number">Идентификационный Номер платежа</label></p>
                        <p><input type="text" name="number" id="number" value="F{{\Illuminate\Support\Str::random(8)}}"></p>

                        <p style="margin:10px 0;"><label for="">Сумма платежа</label></p>
                        <p><input type="text" name="amount" ></p>

                        <p style="margin:10px 0;"><label for="">Валюта</label></p>
                        <p>
                            <select name="currency_id" id="">
                                <option value="1">EUR</option>
                                <option value="2">USD</option>
                            </select>
                        </p>

                        <p style="margin:10px 0;"><label for="">Детали платежа</label></p>
                        <p><textarea name="description" id="" cols="20" rows="4"></textarea></p>




                </div>


                <div class="form__button">
                    <button type="submit" class="btn btn_blue">
                        Сохранить
                    </button>
                </div>
                </form>


            </div>
        </div>

    </div>




@stop