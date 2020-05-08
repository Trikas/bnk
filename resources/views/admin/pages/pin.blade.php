@extends('layouts.cabinet')

@section('title') Добавить платеж @stop

@section('content')


    <div class="main-content main-content_height table-width" >
        <div class="row">
            <div class="col col-lg-12">
                <div class="table-block blue" style="width: 100%">
                    <div class="table-row">
                        Выбирите пин для входа пользователя
                    </div>
                </div>
                <br>
                @foreach($users as $user)
                    @if($user->role != 'admin')
                    <div class="col-md-12" style="padding:10px">
                        {{$user->name}} | {{$user->email}} | {{$user->role}} |
                        <span style="font-weight: bold;">{{$user->pin->pin}}</span>
                    </div>
                    @endif
                @endforeach
                <p style="margin:20px"><a href="#" onclick="location.reload();">Обновить пины</a></p>
            </div>


@stop