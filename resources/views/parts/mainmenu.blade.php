<div class="main-menu">
    <div class="main-menu_col">
        <a href="{{route('dashboard')}}" data-menu-id="dashboard" class="main-menu__list @if(Request::is('dashboard')|| Request::is('accounts*') || Request::is('statement*') || Request::is('statms*')) active @endif">Мой портфель</a>
        <a href="{{route('page.transaction.about')}}" data-menu-id="remittances_index" class="main-menu__list @if(Request::is('transactions*') || Request::is('payment*')) active @endif">Денежный перевод</a>
        <a href="{{route('services.index')}}" data-menu-id="services_index" class="main-menu__list @if(Request::is('services*') || Request::is('logs*') || Request::is('register*')) active @endif">Услуги</a>
        <a href="{{route('feedback.form')}}"  class="main-menu__list">Написать администратору</a>
    </div>

    <div class="main-menu_col main-menu__white main-sub-menu my-portfolio sub-menu-item" data-menu-parent="dashboard" style="display: none">
        <a href="" class="main-sub-menu__list list-null" data-menu-id="accounts_index">Обзор</a>
        <div class="main-sub-menu__list toggler">
            <div class="circle toggler-trigger"></div>
            <a href="#" class="toggler-trigger" data-menu-id="account_managment">Осуществление операций по счету</a>

            <div class="toggler__content sub-menu-item">
                <div class="menu-dropdown-col">
                    <a data-menu-id="accounts_browse" href="" class="main-sub-menu__list @if(Request::is('accounts/*')) active @endif">Счета</a>
                    <a data-menu-id="transactions1" href="" class="main-sub-menu__list @if(Request::is('transactions/*')) active @endif">Движение средств по счету</a>
                    <a data-menu-id="undefined1" href="#" class="main-sub-menu__list @if(Request::is('statement*')) active @endif">Выписка по счету по электронной почте</a>
                    <a data-menu-id="undefined2" href="#" class="main-sub-menu__list @if(Request::is('transactions*')) active @endif">Выписка по электронной почте</a>
                    <a data-menu-id="statements" href="" class="main-sub-menu__list @if(Request::is('payment/between*')) active @endif">Выписка со счета</a>
                </div>
            </div>
        </div>

    </div>
    @php
        if(Request::is('services') || Request::is('logs*') || Request::is('register*')){
                $slug = 'third';
            }else{
                $slug = 'first';
            }
    @endphp
    @section('menu')
        {!! \App\Helpers\_Helper::getMenu($slug ) !!}
    @show
    <style>
        .time-line{
            margin-left:10px; margin-top:5px; background:#E7E7E7; height: 15px; width: 90%;
            -webkit-box-shadow: inset -4px 7px 20px -5px rgba(212,212,212,1);
            -moz-box-shadow: inset -4px 7px 20px -5px rgba(212,212,212,1);
            box-shadow: inset -4px 7px 20px -5px rgba(212,212,212,1);
            overflow: hidden;
        }
        .ext{
            font-size: 10px; position: absolute;top:6px; left:80px;
        }
    </style>
    <div class="timer-warrper" style="position:relative; width:178px; height: 54px;background: #fff; border-radius: 10px;">
        <div class="renew" style="opacity: 0; cursor: default"><a href="#" id="ren11111111" style="font-size: 10px; margin-left:5px;padding: 5px; cursor: default; text-decoration: underline">Обновить</a></div>
        <div class="ext" >выход через <span id="min">9</span>:<span id="sec">59</span></div>
        <div class="time-line" style="position: relative">
            <img id="timeline" src="/images/timer.png" alt="" style="position: absolute; left: 0px;">
        </div>
    </div>



    <div class="main-menu_col main-menu__white main-sub-menu money sub-menu-item" data-menu-parent="remittances_index" style="display: none">
        <div class="main-sub-menu__list toggler">
            <div class="circle toggler-trigger"></div>
            <a href="#" class="toggler-trigger" data-menu-id="remittances_other">На счета клиентов AstroBank</a>

            <div class="toggler__content sub-menu-item">
                <div class="menu-dropdown-col">
                    <a data-menu-id="undefined3" href="#" class="main-sub-menu__list @if(Request::is('payment/between*')) active @endif">Между собственными счетами</a>
                    <a data-menu-id="undefined4" href="#" class="main-sub-menu__list">На счета третьих лиц</a>
                    <a data-menu-id="undefined5" href="#" class="main-sub-menu__list">Конверсионные платежи</a>
                </div>
            </div>
        </div>
        <div class="main-sub-menu__list toggler">
            <div class="circle toggler-trigger"></div>
            <a data-menu-id="remittances" href="#" class="toggler-trigger">Денежные переводы</a>

            <div class="toggler__content sub-menu-item">
                <div class="menu-dropdown-col">
                    <a data-menu-id="remittances_create" href="#" class="main-sub-menu__list">Оформить новый денежный перевод</a>
                    <a data-menu-id="remittances_outgoing" href="#" class="main-sub-menu__list">Осуществленнные денежные переводы</a>
                    <a data-menu-id="remittances_incoming" href="" class="main-sub-menu__list">Входящие платежи</a>
                </div>
            </div>
        </div>
        <a data-menu-id="transactions2" href="" class="main-sub-menu__list list-null">Архив денежных переводов</a>
    </div>

    <div class="main-menu_col main-menu__white main-sub-menu services sub-menu-item" data-menu-parent="services_index"  style="display: none">
        <a data-menu-id="undefined6" href="#" class="main-sub-menu__list list-null">Реестр подтвержденных операций</a>
        <a data-menu-id="activity" href="" class="main-sub-menu__list list-null">Отчет</a>
    </div>
</div>
