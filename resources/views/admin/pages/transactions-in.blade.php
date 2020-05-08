@extends('layouts.cabinet')

@section('content')

    <div class="main-content main-content_height portfolio" >
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Входящие платежи</h2>
                </div>
                <div class="card card__content">
                    <div class="card">
                        <div class="card__list">
                            <form autocomplete="off" action="/transactions/in" method="get" id="from-form" style="display: flex; justify-content: center;     align-items: center;">
                                <div class="price-input">
                                    <p>Информация, введенная за период</p>
                                </div>
                                {{--<div class="price-input">
                                    По фразе: <input minlength="2" class="myInput"name="search" @isset($search) value="{{$search}}" @endisset  placeholder="EB1910181528245 ">
                                </div>--}}
                                <div class="price-input">
                                    C: <input class="myInput datepicker" utocomplete="off" name="from_date" @isset($from_date) value="{{$from_date}}" @endisset  placeholder="30.04.2019"> <img src="/images/cal.png" style="margin-bottom: -4px;">
                                </div>
                                <input type="hidden" name="acc" value="{{$account->id ?? ''}}">
                                <div class="price-input">
                                    По: <input class="myInput datepicker" name="to_date" @isset($to_date) value="{{$to_date}}" @endisset placeholder="20.03.2020"> <img src="/images/cal.png" style="margin-bottom: -4px;">
                                </div>

                                <div class=" ">
                                    <button type="submit" class="btn btn-success"  style="margin-bottom: 0;">Поиск</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div>
                        <div class="table table_center table_offset" style="display: table; border-spacing: 2px; box-sizing: border-box;">
                            <div class="table__head" style="font-size: 8pt;">

                                <div class="table__head_col">#</div>
                                <div class="table__head_col">Дата валютирования</div>
                                <div class="table__head_col">Сумма зачисления</div>
                                <div class="table__head_col">Детали платежа</div>
                                
                            </div>
                            @foreach($transactions as $item)
                                @if($item->status == 3)
                                    @continue
                                @endif
                                <div class="table__list ">
                                    <div class="table__list_col">
                                        <input data-val="{{$item->id}}" type="radio" class="clicker">

                                           {{$loop->iteration}}

                                    </div>
                                    <div class="table__list_col table__list_col-center">
                                        <input data-val="{{$item->id}}" type="radio" class="clicker">
                                        <a href="{{route('transaction.info', $item->id)}}"> {{$item->created_at->format('d-m-Y') ?? ''}} </a>
                                    </div>
                                    <div class="table__list_col table__list_col-right" @if($item->type === 'OUT') style="color:red" @endif>
                                        @if($item->type === 'OUT') - @endif {{$item->amount}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->account->currency_id)}}
                                    </div>
                                    <div class="table__list_col table__list_col-right">
                                        @if(isset($item->payment->recipier_info) && $item->payment->recipier_info != null)
                                             <a href="{{route('transaction.info', $item->id)}}"> {{$item->payment->recipier_info ?? $item->description}} </a>
                                            @else
                                            <a href="{{route('transaction.info', $item->id)}}"> {{$item->description}}  </a>
                                        @endif
                                    </div>


                                </div>
                            @endforeach
                        </div>
                        <div class="pagination pagination_offset">
                            <p>Cтраница {{ $transactions->currentPage()}} из {{ $transactions->count() }}:</p>

                            {{ $transactions->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
                <div class="table__buttons table__buttons_offset">
                    <a href="#" class="btn"  onclick="history.back();return false;">Назад</a></div>
                </div>

                <input type="hidden" value="" id="num_id">
                <div class="table__buttons ">
                    <a class="btn" href="#" id="op_go">Подробнее</a>
                    @if(Auth::user()->role !== 'admin')
                        <a class="btn" href="{{route('export.trans.in', $account->id)}}" >Файл в формате Excel</a>
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