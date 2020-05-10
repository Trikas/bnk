@extends('layouts.cabinet')
@section('title') Форма обратной связи @stop

@section('content')
    <div class="main-content main-content_height">
        <div class="row">
            <div class="col col--lg-12">

                <div class="overview__line">
                    <h2 class="overview__title">
                        Форма обратной связи (Шаг 1 из 3)
                    </h2>
                </div>

                <div class="select__row">


                </div>

                <div class="select__tab tab-widget">

                    <form action="{{route('feedback.form.step2.store')}}" method="post" class="feedback-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                @error('typeFeedback')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('descriptionFeedback')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('typeAnswer')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('afterTime')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('beforeTime')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div><br>
                        </div><br>
                        <div class="row">
                            <div class="col--sm-4">
                                <span class="optionLine">Предмет:</span>
                            </div>
                            <div class="col--sm-6">

                                <select name="typeFeedback">
                                    <option selected hidden disabled>--Выбрать--</option>
                                    <option
                                        value="Проблема с транзакцией" {{old('typeFeedback')=='Проблема с транзакцией' || session('typeFeedback')=='Проблема с транзакцией' ? 'selected' : ''}}>
                                        Проблема с транзакцией
                                    </option>
                                    <option
                                        value="Техническая проблема" {{old('typeFeedback')=='Техническая проблема' || session('typeFeedback')=='Техническая проблема' ? 'selected' : ''}}>
                                        Техническая проблема
                                    </option>
                                    <option
                                        value="Общие комментарии" {{old('typeFeedback')=='Общие комментарии' || session('typeFeedback')=='Общие комментарии' ? 'selected' : ''}}>
                                        Общие комментарии
                                    </option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col--sm-4">
                                <span class="center-label optionLine">Описание вопроса:</span>
                            </div>
                            <div class="col-lg-6">
                                <textarea name="descriptionFeedback" id="" cols="40"
                                          rows="10">@include('admin.pages.feedback.old-data-to-input', ['key'=>'descriptionFeedback'])</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col--sm-4">
                                <span class="optionLine" style="margin-top: 10%;">Ответ будет выслан:</span>
                            </div>
                            <div class="col--sm-5">
                                <input type="radio" id="radioButton" name="typeAnswer"
                                       value="email" {{old('typeAnswer')=='email' || session('typeAnswer')=='email' ? 'checked' : ''}}>
                                <span>Электронная почта</span><br><br>
                                <input type="radio" id="radioButtonPhone" name="typeAnswer"
                                       value="phone" {{old('typeAnswer')=='phone' || session('typeAnswer')=='phone' ? 'checked' : ''}}>
                                <span>По номеру телефона</span>
                            </div>
                            <div class="col--sm-3">
                                <input type="email"  name="email"
                                       value="@include('admin.pages.feedback.old-data-to-input', ['key'=>'email'])"><br><br>
                                <input type="number" name="phone" id="phone"
                                       value="@include('admin.pages.feedback.old-data-to-input', ['key'=>'phone'])"
                                       data-mask="(___) ___-____"><br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col--sm-4"><span class="optionLine" style="margin-top: 3%;">Часы работы:</span></div>

                            <div class="col-sm-4">
                                c &nbsp;<input type="time" name="afterTime" class="timeOptions" value="@include('admin.pages.feedback.old-data-to-input', ['key'=>'afterTime'])"
                                    {{old('typeAnswer')=='phone' || session('typeAnswer')=='phone' ? '' : 'disabled'}}
                                >
                                &nbsp;До&nbsp;
                            </div>
                            <div class="col-sm-4"><input type="time" name="beforeTime" class="timeOptions"
                                                         value="@include('admin.pages.feedback.old-data-to-input', ['key'=>'beforeTime'])"
                                    {{old('typeAnswer')=='phone' || session('typeAnswer')=='phone' ? '' : 'disabled'}}
                                ><br><br>
                            </div>
                        </div>
                        <div class="table__buttons">
                            <input class="btn" type="submit" value="Далее">
                        </div>

                    </form>
                </div>
            </div>
        </div>
@endsection

@section('scripts')

@endsection
