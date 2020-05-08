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

                    <form action="{{route('feedback.form.step1')}}" method="post">
                        @csrf
                        <span>Предмет: </span>
                        @error('typeFeedback')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <select name="typeFeedback">
                            <option selected hidden disabled>--Выбрать--</option>
                            <option value="Проблема с транзакцией" {{old('typeFeedback')=='Проблема с транзакцией' || session('typeFeedback')=='Проблема с транзакцией' ? 'selected' : ''}}>Проблема с транзакцией</option>
                            <option value="Техническая проблема" {{old('typeFeedback')=='Техническая проблема' || session('typeFeedback')=='Техническая проблема' ? 'selected' : ''}}>Техническая проблема</option>
                            <option value="Общие комментарии" {{old('typeFeedback')=='Общие комментарии' || session('typeFeedback')=='Общие комментарии' ? 'selected' : ''}}>Общие комментарии</option>
                        </select><br><br>
                        @error('descriptionFeedback')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span>Описание вопроса: </span><br>
                        <textarea name="descriptionFeedback" id="" cols="37" rows="10">@include('admin.pages.feedback.old-data-to-input', ['key'=>'descriptionFeedback'])</textarea>
                        <br><br>
                        @error('typeAnswer')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span>Ответ будет выслан:</span><br><br>
                        <span>Электронная почта</span>
                        <input type="radio" id="radioButton" name="typeAnswer" value="email" {{old('typeAnswer')=='email' || session('typeAnswer')=='email' ? 'checked' : ''}}>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="email" name="email" value="@include('admin.pages.feedback.old-data-to-input', ['key'=>'email'])">
                        <br><br>
                        <span>По номеру телефона</span>
                        <input type="radio" id="radioButton" name="typeAnswer" value="phone" {{old('typeAnswer')=='phone' || session('typeAnswer')=='phone' ? 'checked' : ''}}>
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="number" name="phone" id="phone" value="@include('admin.pages.feedback.old-data-to-input', ['key'=>'phone'])" data-mask="(___) ___-____"><br><br>
                        @error('afterTime')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('beforeTime')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <span>Часы работы c </span>
                        <input type="time" name="afterTime" value="@include('admin.pages.feedback.old-data-to-input', ['key'=>'afterTime'])"> До
                        <input type="time" name="beforeTime" value="@include('admin.pages.feedback.old-data-to-input', ['key'=>'beforeTime'])"><br><br>

                        <input type="submit" value="Далее">
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('scripts')

@endsection
