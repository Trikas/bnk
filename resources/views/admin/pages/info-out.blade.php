@extends('layouts.cabinet')


@section('content')

    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Подробная информация о переводе
                    </h2>
                </div>

                <div class="card card__content card__content_center">

                    <div class="card__content_row">

                        <div class="card__list">
                            <div class="card__list_name">
                                Account IBAN:
                            </div>
                            <div class="card__list_price">
                                {{$trans->account->iban}}
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="card__list_name">
                                Дата операции:
                            </div>
                            <div class="card__list_price">
                                {{$trans->created_at->format('d-m-Y')}}
                            </div>
                        </div>
                        

                        <div class="card__list">
                            <div class="card__list_name">
                                Сумма
                            </div>
                            <div class="card__list_price" @if($trans->type == 'OUT') style="color:red" @endif>
                                @if($trans->type == 'OUT') - @endif {{$trans->amount}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($trans->account->currency_id)}}
                            </div>
                        </div>
                    <!--
                        <div class="card__list">
                            <div class="card__list_name">
                                Курс:
                            </div>
                            <div class="card__list_price color color_red">
                                @if(\App\Helpers\CurrencyHelper::getCurrencyCode($trans->account->currency_id) == 'EUR')
                        {{\App\Helpers\CurrencyHelper::$eur}}
                    @else
                        {{\App\Helpers\CurrencyHelper::$eur}}
                    @endif
                            </div>
                        </div>
                        -->
                        <div class="card__list">
                            <div class="card__list_name">
                                Счет списания
                            </div>
                            <div class="card__list_price">
                                {{$trans->account->number}}
                            </div>
                        </div>

                        <div class="card__list">
                            <div class="card__list_name">
                                Счет комиссионых выплат
                            </div>
                            <div class="card__list_price">
                                {{$trans->account->number}}
                            </div>
                        </div>

                        <div class="card__list">
                            <div class="card__list_name">
                                Дата валютирования
                            </div>
                            <div class="card__list_price">
                                {{$trans->created_at->format('d-m-Y')}}
                            </div>
                        </div>
                    <!--
                        <div class="card__list">
                            <div class="card__list_name">
                                Номер транзакции:
                            </div>
                            <div class="card__list_price">
                                {{$trans->payment->number ?? 'Unknown'}}
                            </div>
                        </div>
                        -->

                        <!--
                        <div class="card__list">
                            <div class="card__list_name">
                               Комиссия:
                            </div>
                            <div class="card__list_price color color_red">
                                0
                            </div>
                        </div>
                        -->
                        <div class="card__list">
                            <div class="card__list_name">
                                Описание платежа:
                            </div>
                            <div class="card__list_price" style="max-width: 400px;">
                                {{$trans->description}}
                            </div>
                        </div>
                    </div>


                </div>




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
