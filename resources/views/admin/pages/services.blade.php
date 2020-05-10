@extends('layouts.cabinet')

@section('title') Услуги @stop

@section('content')
    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">
                <div class="portfolio__content">
                    <h2 class="portfolio__title">
                        Услуги
                    </h2>

                    <div class="main-list">
                        <a href="/register">Реестр подтвержденных операций:</a>
                        <span>Просмотр реестра подтвержденных операций</span>
                    </div>
                    <div class="main-list">
                        <a href="/logs">Отчет:</a> <span>Просмотр в режиме реального времени всех Ваших действий и операций и их сортировка с использованием определенных критериев поиска.</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop
