<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

<div class="lk lk_bg b-container">
    <div class="wrapper wrapper_large">
        <div class="lk__content" id="vue-app" v-blockui="preloaders.form">
            <div class="lk-lang">
                <a href="#" class="ru active">Ру</a>
                <a href="#" onclick="alert('The system is temporarily unavailable')" class="en">En</a>
            </div>
            <div class="lk__top-line">
                <div class="lk-logo">
                    <img src="/images/winbank.png" alt="">
                </div>
            </div>
            <div class="lk__item">
                <form class="lk__join"  method="post" action="{{route('login')}}">
                    <h2 class="lk__join_title">web banking</h2>
					@if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="lk__join_list">
                        <label class="label label_default">
                            <div class="img-join">
                                <img src="/images/join-lk.png" alt="">
                            </div>
                            @csrf
                            <input type="text" required name="username" placeholder="Логин" class="input input_default">
                        </label>
                        <label class="label label_default">
                            <div class="img-pass">
                                <img src="/images/pass-lk.png" alt="">
                            </div>
                            <input type="password" required name="password" placeholder="Пароль" class="input input_default">
                        </label>
                        <label class="label label_default">
                            <div class="img-pin">
                                <img src="/images/pin-lk.png" alt="">
                            </div>
                            <input type="password"  name="pin" placeholder="extraPIN" class="input input_default">
                        </label>
                    </div>

                    <div class="lk__button">
                        <button class="btn btn_form" type="submit">Вход</button>
                        <a href="/forget/forgot.php" target="_blank" class="button btn_link">Я забыл (-а) свой ПИН-код</a>
                    </div>

                </form>
                <a href="#" class="lk__desc">
                    <img src="/images/lk-img.jpg" alt="">
                </a>
            </div>
            <div class="lk__bottom-line">
                <div class="lk__bottom-line_item">
                    <h2 class="lk__mottom-line_title">
                        Безопасность транзакций
                    </h2>
                    <div class="lk__bottom-line_subtitle">
                        <p>
                            Система WINBANK понимает насколько важна безопасность при проведении электронных платежей и содержит все необходимые элементы и передовые технологии для ее обеспечения.

                            <a href="#">Вот как это делается</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="page">
    <div class="page-single">
        <div class="container" id="vue-app" v-blockui="preloaders.form">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">

                    </div>
                    <form class="card" @submit.prevent="submit">
                        <div class="card-body p-6">
                            <div class="card-title">Login to your account</div>
                            <div class="form-group">
                                <label class="form-label">Username</label>
                                <input type="text" v-model="model.email" class="form-control" :class="{ 'is-invalid': controlValidation.email }" placeholder="Enter your Username">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" v-model="model.password" class="form-control" class="form-control" :class="{ 'is-invalid': controlValidation.password }" placeholder="Password">
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<script src="js/vendors.bundle.js"></script>
<script src="/js/app/login.bundle.js"></script>
</body>
</html>