@extends('layouts.cabinet')
@section('title') Форма обратной связи @stop

@section('content')
    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Форма обратной связи (Шаг 3 из 3)
                    </h2>
                </div>
                <div class="select__row">


                </div>

                <div class="select__tab tab-widget">

                    <form action="{{route('feedback.form.step3.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <span>Предмет: </span><b>{{session('typeFeedback')}}</b>
                        <br>
                        <span>Описание вопроса: </span> <b>{{session('descriptionFeedback')}}</b>
                        <br>
                        @if(session('typeAnswer')=='email')
                            <span>Контактный адрес электронной почты:</span> <b>{{session('email')}}</b>
                        @else
                            <span>Контактный телефон:</span> <b>{{session('phone')}}</b> <br>
                        @endif
                        @if(session('nameFile'))
                            <span>Прикрепленный файл: </span>{{session('nameFile')}} <br><br>
                        @endif
                        <a href="{{route('feedback.generatePdf')}}"><button type="button">Печать</button></a>
                    </form>
                </div>
            </div>

        </div>
@endsection

@section('scripts')

@endsection
