@extends('layouts.cabinet')

@section('title') Детали счета {{$account->nubmer}}@stop

@section('content')


    <div class="main-content main-content_height portfolio" style="height:600px; overflow: scroll ">
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Детали счета</h2>
                </div>
                <div class="card card__content">
                    <div class="card__list">
                        <div class="name">Счет:</div>
                        <div class="price">
                            <div>
                                <form id="account_select_form" action="{{route('account.show')}}" method="post">
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
                    </div>
                    <div>
                        <div class="card__list">
                            <div class="name">IBAN:</div>
                            <div class="price">{{$item->iban}}</div>
                        </div>
                        <div class="card__list">
                            <div class="name">Валюта:</div>
                            <div class="price">{{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}</div>
                        </div>
                        <div class="card__list-title"  ><span>Владелец:</span></div>
                        <div class="card__list"  >
                            <div class="name">Основной владелец:</div>
                            <div class="price">JETLUX LTD</div>
                        </div>
                        <div class="card__list"  >
                            <div class="name">Debit Interest Rate:0</div>
                            <div class="price"></div>
                        </div>
                        <div class="card__list-title"><span>Детали платежа:</span></div>
                        <div class="card__list">
                            <div class="name">Текущий баланс:</div>
                            <div class="price">
                                <div>
                                    {{$account->balance_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                </div>
                            </div>
                        </div>
                        @php
                            $sym = \App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id);
                        @endphp
                        <div class="card__list">
                            <div class="name">Доступный баланс:</div>
                            <div class="price">
                                <div>
                                    {{$account->balance_available_current}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                </div>
                            </div>
                        </div>
                        <div class="card__list" >
                            <div class="name">Исходящий остаток:</div>
                            <div class="price">6 273,99 {{$sym}}</div>
                        </div>
                        <div class="card__list">
                            <div class="name">Наименьший остаток месяца:</div>
                            <div class="price">
                                <div>
                                    {{$tr_this_month->min('balance')}} {{$sym}}
                                </div>
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">Средний остаток месяца:</div>
                            <div class="price">
                                <div>
                                    {{ number_format($tr_this_month->avg('balance'), 2, ',', ' ')}} {{$sym}}
                                </div>
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">Входящий остаток текущего месяца:</div>
                            <div class="price">
                                <div>
                                    {{ number_format($tr_this_month->sum('balance'), 2, ',', ' ')}} {{$sym}}
                                </div>
                            </div>
                        </div>
                        <div class="card__list">
                            <div class="name">Входящий остаток последнего месяца:</div>
                            <div class="price">
                                <div>
                                    {{ number_format($tr_last_month->avg('balance'), 2, ',', ' ')}} {{$sym}}
                                </div>
                            </div>
                        </div>
                        <div class="card__list" >
                            <div class="name">Просроченная задолжность:</div>
                            <div class="price">0,00 {{$sym}}</div>
                        </div>
                        <div class="card__list card__list_offset" >
                            <div class="name">процентная ставка за превышение лимита:</div>
                            <div class="price">9,5</div>
                        </div>
                        <div class="card__list">
                            <div class="name">Тип Счета:</div>
                            <div class="price">LEGAL COMMERCIAL USD</div>
                        </div>
                        <div class="card__list" >
                            <div class="name">Дата последнего депозита:</div>
                            @isset($tr_this_month)
                                @if(count($tr_this_month) > 0)
                                    <div class="price">{{$tr_this_month->last()->created_at->format('d-m-Y') ?? ''}}</div>
                                @endif
                            @endisset
                        </div>
                        <!--
                        <div class="card__list" >
                            <div class="name">Дата оприходования последнего процента:</div>
                            <div class="price">27/2/2018</div>
                        </div>
                        -->
                        <div class="card__list">
                            <div class="name">Дата открытия счета:</div>
                            <div class="price">{{$account->created_at->format('d-m-Y')}}</div>
                        </div>
                        <!--
                        <div class="card__list" >
                            <div class="name">Дата предварительного формирования выписок:</div>
                            <div class="price">30/11/2019</div>
                        </div>
                        <div class="card__list" >
                            <div class="name">Дата последнего формирования выписок:</div>
                            <div class="price">31/12/2019</div>
                        </div>
                        <div class="card__list">
                            <div class="name">Дата последнего платежа:</div>
                            <div class="price">23.01.2020</div>
                        </div>
                        -->

                    </div>
                </div>
                <div class="table__buttons ">
                    <a href="#" class="btn"  onclick="history.back();return false;">Назад</a></div>
                <div class="table__buttons ">
                    <a href="#" class="btn"  onclick="print()">Печать</a></div>
            </div>
        </div>
    </div>


@stop

