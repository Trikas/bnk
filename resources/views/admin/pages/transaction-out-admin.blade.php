@extends('layouts.cabinet')

@section('content')

    <div class="main-content main-content_height portfolio" >
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Осуществленные денежные переводы</h2>
                </div>
                <div class="card card__content">
                    <div class="card">
                        <div class="card__list">
                            <form autocomplete="off" action="{{route('transaction.out')}}" method="post" id="from-form" style="display: flex; justify-content: center;     align-items: center;">
                                @csrf
                                <div class="price-input">
                                    <p>Информация, введенная за период</p>
                                </div>
                                {{--<div class="price-input">
                                    По фразе: <input minlength="2" class="myInput"name="search" @isset($search) value="{{$search}}" @endisset  placeholder="EB1910181528245 ">
                                </div>--}}
                                <div class="price-input">
                                    C: <input class="myInput datepicker" utocomplete="off" name="from_date" @isset($from_date) value="{{$from_date}}"  @else {{date('d.m.Y')}} @endisset  placeholder="30.04.2019"> <img src="/images/cal.png" style=" margin-bottom: -4px;">
                                </div>
                                <input type="hidden" name="acc" value="{{$account->id ?? ''}}">
                                <div class="price-input">
                                    По: <input class="myInput datepicker" name="to_date" @isset($to_date) value="{{$to_date}}" @else {{date('d.m.Y')}} @endisset placeholder="20.03.2020"> <img src="/images/cal.png" style="margin-bottom: -4px;">
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

                                <div class="table__head_col">Референс</div>
                                <div class="table__head_col">Сумма зачисления</div>
                                <div class="table__head_col">Тип платежа</div>
                                <div class="table__head_col">Детали платежа</div>
                                @if(Auth::user()->role === 'admin')
                                    <div class="table__head_col">Действия</div>
                                @endif
                            </div>

                            <input type="hidden" value="" id="num_id">
                            @foreach($transactions as $item)
                                @if($item->status == 1)

                                    <div class="table__list ">

                                        <div class="table__list_col">
                                            <a href="overview-t1-d.html">
                                                {{$loop->iteration}}
                                            </a>
                                        </div>
                                        <div class="table__list_col table__list_col-center">
                                            <input data-val="{{$item->id}}" type="radio" class="clicker">
                                            <a href="{{route('transaction.info', $item->id)}}">{{$item->created_at->format('d-m-Y') ?? ''}}
                                            </a>
                                        </div>


                                        <div class="table__list_col table__list_col-right">

                                        </div>

                                        <div class="table__list_col table__list_col-right">
                                            {{$item->amount}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->account->currency_id)}}
                                        </div>

                                        <div class="table__list_col table__list_col-right">
                                            {{-- $item->type  --}} OUR
                                        </div>



                                        <div class="table__list_col table__list_col-right">
                                            <a href="{{route('transaction.info', $item->id)}}">
                                                {{$item->description}}</a>
                                        </div>
                                        @if(Auth::user()->role === 'admin')
                                            <div class="table__list_col table__list_col-center">
                                                @if($item->status == 4)
                                                    <a onclick="return confirm('Одобрить перевод?');" href="/transactions/status/1/{{$item->id}}">
                                                        <button style="width:85px" class="btn btn-success">ОДОБРИТЬ</button></a>
                                                    <br>
                                                    <a onclick="return confirm('Отклонить перевод?');" href="/transactions/status/3/{{$item->id}}" >
                                                        <button class="btn" style="width:85px;background: red">ОТКЛОНИТЬ</button></a>
                                                @else
                                                    @if($item->status === 1) Одобрено @endif
                                                    @if($item->status === 3) Отклонено @endif

                                                @endif
                                            </div>
                                        @endif

                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="pagination pagination_offset">
                            <p>Cтраница {{ $transactions->currentPage()}} из {{ $transactions->count() }}:</p>

                            {{ $transactions->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
                <div class="table__buttons table__buttons_offset">
                    <a href="#" onclick="history.back()" class="btn">Назад</a>
                </div>


                <div class="table__buttons ">
                    <a class="btn" href="#" id="op_go">Описание</a>
                    @if(Auth::user()->role !== 'admin')
                        <a class="btn" href="{{route('export.trans.out', $account->id)}}" >Файл в формате Excel</a>
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