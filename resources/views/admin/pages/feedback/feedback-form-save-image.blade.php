@extends('layouts.cabinet')
@section('title') Форма обратной связи @stop

@section('content')
    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Форма обратной связи
                    </h2>
                </div>

                <div class="pin-text">
                    Тут вы можете написать администратору
                </div>


                <div class="select__row">


                </div>

                <div class="select__tab tab-widget">

                    <form action="{{route('feedback.form.step2')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <span>Предмет: </span><b>{{session('typeFeedback')}}</b>
                        <br>
                        <span>Описание вопроса: </span> <b>{{session('descriptionFeedback')}}</b>
                        <br>
                        @if(session('typeAnswer')=='email')
                        <span>Контактный адрес электронной почты:</span> <b>{{session('email')}}</b>
                        @else
                            <span>Контактный телефон:</span> <b>{{session('phone')}}</b>
                        @endif
                        <br><br>
                        <span>Выберите тип файла(.doc, .txt, .zip и тд) для загрузки: </span><input type="checkbox" value="on" name="fileCheck"><br>
                        <span>Прикрепить документ(.docx, .doc, .txt, .zip, .pdf, .png, .jpg ): </span><input type="file" name="file"><br><br>
                        <a href="{{route('feedback.form.clear')}}"><button type="button"> Отменить</button></a> &nbsp;<a href="{{route('feedback.form')}}"><button type="button"> Изменить</button></a> &nbsp; <input type="submit" value="Подтвердить">
                    </form>
                </div>
            </div>

        </div>
@endsection

@section('scripts')

@endsection
