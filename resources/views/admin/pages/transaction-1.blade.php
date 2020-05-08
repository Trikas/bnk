@extends('layouts.cabinet')

@section('content')

    <div class="main-content main-content_height" >
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Движение средств по счету
                    </h2>
                </div>

                <div class="card card__content">
                    <div class="card__content_blue">
                        <div class="card__list">
                            <div class="name">
                                Счет:
                            </div>
                            <div class="price">
                                <form id="account_select_form" action="{{route('transaction.show')}}" method="post">
                                    @csrf
                                    <select name="account" id="account_select">
                                        @isset($accounts)
                                            @foreach($accounts as $item)
                                                <option @if($account->id === $item->id) selected @endif value="{{$item->id}}">{{$item->number}}  {{$item->iban}} {{$item->balance_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}</option>
                                            @endforeach
                                        @endisset
                                    </select>

                                </form>
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                IBAN:
                            </div>
                            <div class="price">
                                {{$account->iban}}
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                Валюта:
                            </div>
                            <div class="price">
                                {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                Текущий баланс:
                            </div>
                            <div class="price">
                               {{$account->balance_current ?? 0}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                Доступный остаток:
                            </div>
                            <div class="price">
                                {{$account->balance_current ?? 0}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">
                                Критерий поиска:
                            </div>
                            <div class="price price_row">
                                <form autocomplete="off" action="/transactions" method="get" id="from-form" style="display: flex; justify-content: center;     align-items: center;">
                                    <div class="price-input">
                                        C: <input class="myInput datepicker" utocomplete="off" name="from_date" @isset($from_date) value="{{$from_date}}" @endisset  placeholder="30.04.2019"> <img src="/images/cal.png" style="margin-bottom: -4px;">
                                    </div>
                                    <div class="price-input">
                                        По: <input class="myInput datepicker" name="to_date" @isset($to_date) value="{{$to_date}}" @endisset placeholder="20.03.2020"> <img src="/images/cal.png" style=" margin-bottom: -4px;">
                                    </div>
                                    <input type="hidden" name="acc" value="{{$account->id}}">
                                    <div class=" ">
                                        <button type="submit" class="btn btn-success"  style="margin-bottom: 0;">Поиск</button>
                                    </div>

                                </form>                            </div>
                        </div>


                    </div>

                    <div class="table table_center table_offset">
                        <div class="table__head">
                            <div class="table__head_col">
                                Дата выполнения операции
                            </div>

                            <div class="table__head_col">
                                Детали платежа
                            </div>

                            <div class="table__head_col">
                                Сумма
                            </div>
                            <div class="table__head_col">
                                Остаток
                            </div>
                            <div class="table__head_col">
                                Дата валютирования
                            </div>
                            <div class="table__head_col">
                                Комментарии
                            </div>
                        </div>
                        @isset($transactions)
                            @foreach($transactions as $item)
                                <div class="table__list @if($loop->iteration % 2) table__list-gray @endif">
                                <div class="table__list_col">
                                    <input data-val="{{$item->id}}" type="radio" class="clicker">
                                    <a href="{{route('transaction.info', $item->id)}}">{{$item->created_at->format('d-m-Y')}} </a>
                                </div>
                                <div class="table__list_col table__list_col-center">
                                   {{$item->type}}
                                </div>
                                <div class="table__list_col table__list_col-right" @if($item->type === 'OUT') style="color:red" @endif>
                                  @if($item->type === 'OUT') - @endif {{$item->amount}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                </div>
                                <div class="table__list_col table__list_col-right">
                                   {{$item->balance}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                </div>
                                <div class="table__list_col table__list_col-right">
                                    <a href="{{route('transaction.info', $item->id)}}"> {{$item->created_at->format('d-m-Y')}}</a>
                                </div>
                                <div class="table__list_col table__list_col-right">
                                    <a href="{{route('transaction.info', $item->id)}}"> {!! $item->description !!}</a>
                                </div>

                            </div>
                            @endforeach
                        @endisset


                    </div>

                    <div class="pagination pagination_offset">
                        {{$transactions->appends(request()->input())->links()}}

                        <!--
                        <p>Cтраница {{ $transactions->currentPage() }}</p>
@if ($transactions->hasMorePages())
	:&nbsp; <a href="{{ request()->fullUrlWithQuery(['page' => $transactions->currentPage() + 1]) }}">Далее</a>
@endif
-->

<!--
                        <p>Cтраница {{ $transactions->currentPage()}} из {{ $transactions->count() }}:</p>

                        {{ $transactions->appends(request()->except('page'))->links() }}
-->

                    </div>
                </div>
                <input type="hidden" value="" id="num_id">
                <div class="table__buttons table__buttons_offset">
                    <a class="btn" href="#" id="op_go">Описание</a>
                    <a class="btn" href="#" onclick="history.back()">Назад</a>
                </div>
                <div class="table__buttons ">
                    @if(Auth::user()->role !== 'admin')
                        <a class="btn" href="{{route('export.trans', $account->id)}}" >Файл в формате Excel</a>
                    @endif

                    <a class="btn" href="#" onclick="print()">Печать</a>
                </div>

            </div>
        </div>

    </div>


@stop


@section('menu')
    {!! \App\Helpers\_Helper::getMenu('second') !!}
@stop
