@extends('layouts.cabinet')

@section('title') Логи @stop

@section('content')
    <div class="main-content main-content_height portfolio">
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Логи</h2>
                </div>
                <div class="card card__content">


                    <div class="table table_center table_offset">
                        <div class="table__head">
                            <div class="table__head_col">Дата</div>
                            <div class="table__head_col">Время</div>
                            <div class="table__head_col">Имя пользователя</div>
                            <div class="table__head_col">Вид операции</div>
                            <div class="table__head_col">Статус</div>
                            <div class="table__head_col">Канал</div>
                        </div>

                        @foreach($logs as $item)
                        <div class="table__list ">

                            <div class="table__list_col table__list_col-center">
                                {{ $item->created_at->format('d.m.Y') }}
                            </div>

                            <div class="table__list_col table__list_col-right">
                                {{ $item->created_at->format('H:i:s') }}
                            </div>
                            <div class="table__list_col table__list_col-right">
                                {{$item->user->name}}
                            </div>

                            <div class="table__list_col table__list_col-right">
                                {{$item->operation}}
                            </div>

                            <div class="table__list_col table__list_col-right">
                                {{$item->status}}
                            </div>

                            <div class="table__list_col table__list_col-right">
                                {{$item->chanel}}
                            </div>
                        </div>
                            @endforeach

                    </div>
                    {{$logs->links()}}
                    <div class="" style="padding-top:30px; margin-bottom: 100px">



                    </div>




                </div>
            </div>
        </div>



    </div>
@stop