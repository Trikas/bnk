@extends('layouts.cabinet')

@section('content')

    <div class="main-content main-content_height portfolio">
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Архив денежных переводов</h2>
                </div>
                <div class="card card__content">
                    @if(Auth::user()->role === 'admin')

                    @else


                        <div class="card__content_blue">
                            <div class="card__list">
                                <div class="name">Счет:</div>
                                <div class="price">
                                    <div list="">
                                        <form id="account_select_form" action="{{route('transaction.arhive')}}" method="post">
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
                                    <div class="price">{{$account->iban ?? ''}}</div>
                                </div>
                                <div class="card__list">
                                    <div class="name">Валюта:</div>
                                    <div class="price">{{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}</div>
                                </div>
                                <div class="card__list">
                                    <div class="name">Текущий баланс:</div>
                                    <div class="price">
                                        <div>
                                            {{$account->balance_current ?? '0'}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                        </div>
                                    </div>
                                </div>
                                <div class="card__list">
                                    <div class="name">Доступный остаток:</div>
                                    <div class="price">
                                        <div>
                                            {{$account->balance_available_current ?? 0}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($account->currency_id)}}
                                        </div>
                                    </div>
                                </div>
                                <div class="card__list">
                                    <div class="name">Критерий поиска:</div>
                                    <div class="price price_row">
                                        <form autocomplete="off" action="/transactions" method="get" id="from-form">
                                            <div class="price-input">
                                                По фразе: <input minlength="2" class="myInput" name="search" @isset($search) value="{{$search}}" @endisset  placeholder="EB1910181528245 ">
                                            </div>
                                            <div class="price-input">
                                                C: <input class="myInput datepicker" name="from_date" @isset($from_date) value="{{$from_date}}" @endisset  placeholder="2019-04-30">
                                            </div>
                                            <div class="price-input">
                                                По: <input class="datepicker myInput" name="to_date" @isset($to_date) value="{{$to_date}}" @endisset placeholder="2019-04-30">
                                            </div>

                                            <div class=" " style="margin-top:10px;">
                                                <button type="submit" class="btn btn-success">Фильтровать</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif

                    <div class="table table_center table_offset">
                        <div class="table__head">
                            <div class="table__head_col">Вид поручения</div>
                            <div class="table__head_col">Дата введения информации</div>
                            <div class="table__head_col">Дата выполнения операции</div>
                            <div class="table__head_col">Сумма</div>
                            <div class="table__head_col">Получатель</div>
                            <div class="table__head_col">Статус</div>
                            @if(Auth::user()->role === 'admin')
                                <div class="table__head_col">Применить оплату</div>
                            @endif

                        </div>


                        @foreach($transactions as $item)
                            @if($item->type === 'OUT')
                                @continue
                            @endif
                            <div class="table__list ">
                                <div class="table__list_col">
                                    <input type="radio" name="table">
                                    <a href="overview-t1-d.html">
                                        Денежный перевод
                                    </a>
                                </div>
                                <div class="table__list_col table__list_col-center">
                                    {{$item->created_at->format('d-m-Y')}}
                                </div>
                                <div class="table__list_col table__list_col-right" >
                                    {{$item->created_at->format('d-m-Y')}}
                                </div>
                                <div class="table__list_col table__list_col-right" >
                                    {{$item->amount}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->account->currency_id)}}
                                </div>
                                <div class="table__list_col table__list_col-right">
                                    {{$item->payment->recipier_name ?? $item->description}}
                                </div>

                                <div class="table__list_col table__list_col-right">
                                    {{\App\Helpers\CurrencyHelper::getStatusName($item->status)}}
                                </div>
                                @if(Auth::user()->role === 'admin')
                                    <div class="table__list_col table__list_col-right">
                                        @if($item->status == 4)
                                            <a class="btn btn-success" href="{{route('transaction.apply', $item->id)}}">Применить</a>
                                        @else
                                            Успешно применен
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach


                    </div>




                    <div class="pagination pagination_offset">
                        {{ $transactions->links() }}
                    </div>
                </div>
                <div class="table__buttons table__buttons_offset">
                    <a href="#" class="btn"  onclick="history.back();return false;">Назад</a></div>
                </div>
                <div class="table__buttons "><a href="#" class="btn">Details</a> <a href="#" class="btn">Файл в формате Excel</a> <a href="#" class="btn">Сохранить в HTML</a> <a href="#" class="btn">Печать</a></div>
            </div>
        </div>
    </div>


@stop

@section('menu')
    {!! \App\Helpers\_Helper::getMenu('second') !!}
@stop