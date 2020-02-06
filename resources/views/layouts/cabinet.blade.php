<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/styles.css">
    <title>@section('title') AstroBank @show</title>
</head>

<body>
    <header class="header header_bg">
        <div class="wrapper wrapper_default">
            <div class="header__content">
                <div class="header__logo">
                    <a href="/home">
                        <img src="/images/astroBank.png" alt="">
                    </a>
                    <div class="header__data current-date">
                        <span></span>
                    </div>
                </div>
                <div class="header__navbar">
                    <a href="/dashboard">
                        <img src="/images/home.gif" alt="">
                    </a>
                    <a href="#">
                        <img src="/images/sitemap1.gif" alt="">
                    </a>
                    <a href="/logout" class="logout-btn"><img src="/images/exit.gif" alt=""></a>
                </div>

            </div>
            <!-- <span style="color:white; font-size: 10px; margin-bottom: 5px">{{date('Y-m-d H:i:s')}}</span> -->
        </div>

        <script
                src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous"></script>

        <script src="/js/my.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( ".datepicker" ).datepicker();
            } );
        </script>
    </header>
    <main class="main main_bg" id="vue-app" v-blockui="preloaders.page">
        <div class="wrapper wrapper_default">
            <div class="wrapper__content">
                @if(Auth::user()->role === 'admin')
                        <div class="main-menu_col">
                            <a href="{{route('transaction.arhive')}}" data-menu-id="remittances_index" class="main-menu__list">Денежные переводы</a>
                            <a href="{{route('payment.create')}}" data-menu-id="remittances_index" class="main-menu__list">Создать платеж</a>
                        </div>

                @else
                    @include('parts.mainmenu')
                @endif

                    @yield('content')

            </div>
        </div>
    </main>
    <style>
        .pagination li{
            list-style: none;
            font-size: 20px;
        }
        .pagination li a{
            color:#86a4cc;
        }
        li.page-item.active{
            margin-left: 24px;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
        }

        .block-table{
            width:50%;
            float: left;
            text-align: right;
            padding:10px 20px;
            border:1px solid #DEE6F0;
            font-weight: bold;
        }
        .block-table1{
            width:50%;
            float: left;
            padding: 10px 20px;
            border:1px solid #DEE6F0;
        }
        .info{
            background: #DEE6F0;
            text-align: center;
            margin:0 auto;
            font-weight: bold;
            padding: 10px;
        }
    </style>
    <script src="/js/main.js"></script>


    @yield('scripts')

    

    

</body>
</html>