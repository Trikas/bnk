@extends('layouts.cabinet')

@section('title') Счета @stop

@section('content')
    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">
                <div class="overview__line">
                    <h2 class="overview__title">Обзор</h2>
                </div>
                <div class="table table__name">
                    <span>Просмотр краткой сводки по Вашему портфелю и получение детальной информации о движениях по счету.</span>
                </div>
                <div class="table">
                    <div class="table__head">
                        <div class="table__head_col">Счет</div>
                        <div class="table__head_col">Тип / Валюта</div>
                        <div class="table__head_col">Доступный остаток</div>
                    </div>
                    <form id="account_form_go" action="{{route('account.show')}}" method="post">
                        @csrf
                        <input type="hidden" name="account" value="" id="acc_data_field">
                    </form>
                    @isset($accounts)
                        @foreach($accounts as $item)
                            <div class="table__list" >
                        <div class="table__list_col">
                            <input type="radio" >
                            <a href="#" class="account_details_class" account_data="{{$item->id}}">{{ $item->number }}</a>
                        </div>
                        <div class="table__list_col table__list_col-center">{{\App\Helpers\CurrencyHelper::getCurrency($item->currency_id)}}</div>
                        <div class="table__list_col table__list_col-right">
                            {{number_format($item->balance_current, 2, ',', ' ')}} {{\App\Helpers\CurrencyHelper::getCurrencyCode($item->currency_id)}}
                        </div>
                    </div>
                        @endforeach
                    @endisset
                </div>

                <div class="table__buttons table__buttons_offset">
                    <a class="btn" href="/transactions" >Движение средств по счету</a>

                    <a class="btn" href="/account" >Детали счета</a>

                    <a class="btn" href="/transactions/out" >Account Statements</a>
                </div>
                <div class="table__buttons ">
                    <a class="btn" href="/export/accounts" >Файл в формате Excel</a>

                    <a class="btn" href="#" onclick="print()">Печать</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/app/accounts-browse.bundle.js"></script>
    <script>
        var menuItemId = 'accounts_browse';
    </script>
@endsection