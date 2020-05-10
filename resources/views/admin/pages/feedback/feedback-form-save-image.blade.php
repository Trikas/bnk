@extends('layouts.cabinet')
@section('title') Форма обратной связи @stop

@section('content')
    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Форма обратной связи (Шаг 2 из 3)
                    </h2>
                </div>

                <div class="select__row">


                </div>

                <div class="select__tab tab-widget">

                    <form action="{{route('feedback.form.step3.store')}}" method="post" enctype="multipart/form-data"
                          class="feedback-form">
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
                        <span>Выберите тип файла(.doc, .txt, .zip и тд) для загрузки: </span>
                        <input type="checkbox" value="on" name="fileCheck" class="fileCheck" {{old('fileCheck') ? 'checked' : ''}}><br><br>
                        @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div @if(empty(old('fileCheck'))) style="display: none" @endif class="add-file">
                            <span>Прикрепить документ(.docx, .doc, .txt, .zip, .pdf, .png, .jpg ): </span><input
                                type="file" name="file">
                        </div>
                        <br><br>
                        <div class="table__buttons">
                            <a class="btn" href="{{route('feedback.form.clear')}}">
                                 Отменить
                            </a> &nbsp;
                            <a class="btn" href="{{route('feedback.form')}}">
                                 Изменить
                            </a> &nbsp;
                            <input class="btn" type="submit" value="Подтвердить">
                        </div>

                    </form>
                </div>
            </div>

        </div>
@endsection

@section('scripts')

@endsection
