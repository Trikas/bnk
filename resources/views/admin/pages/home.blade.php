@extends('layouts.cabinet')
@section('title')
Добро пожаловать! | {{env('sitename', 'AstroBank')}}
@stop
@section('content')
    <div class="main-content main-content_height portfolio">
        <div class="row">
            <div class="col col--lg-12" v-if="isLoaded" v-blockui="preloaders.page">
                <div class="main__name">
                    <span>Name:</span>
                    <span class="bold">JETLUX LTD</span>
                </div>
                <div class="main__last-data">

                    <span>Последний визит (дата и время)</span>
                    <span class="bold">
                            {{$lastVisit}}
                    </span>


                </div>

                <div class="main_welcome">
      <span>
        Добро пожаловать, {{ $user->full_name }}
      </span>
                </div>

                <div class="main__massage">
      <span>
        <span class="italic">Ваши сообщения:</span>  У Вас нет сообщений
      </span>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/app/home_index.bundle.js"></script>
@endsection