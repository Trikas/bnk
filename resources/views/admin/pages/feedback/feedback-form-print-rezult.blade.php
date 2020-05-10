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

                    <form action="{{route('feedback.form.step3.store')}}" method="post" enctype="multipart/form-data" class="feedback-form">
                        @csrf
                        <div class="add-file">Ваш запрос успешно принят по Вашим персональным идентивикационным кодом <b>{{session('uid')}}</b></div><br>
                        <span>Предмет: </span><b>{{session('typeFeedbackPrint')}}</b>
                        <br>
                        <span>Описание вопроса: </span> <b>{{session('descriptionFeedbackPrint')}}</b>
                        <br>
                        @if(session('typeAnswerPrint')=='email')
                            <span>Контактный адрес электронной почты:</span> <b>{{session('emailPrint')}}</b><br>
                        @else
                            <span>Контактный телефон:</span> <b>{{session('phonePrint')}}</b> <br>
                        @endif
                        @if(session('nameFilePrint'))
                            <div class="add-file">
                            <span>Прикрепленный файл: </span>{{session('nameFilePrint')}} <br><br>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

        </div>
@endsection

@section('scripts')

@endsection
