<?php

Route::get('/login', 'HomeController@index');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/forgot/{email}', 'Auth\ForgotPasswordController@forgot');


Route::group(['middleware' => 'auth'], function(){

    Route::get('/pin', 'Admin\PinController@getPins')->name('pin');
    Route::get('home', 'Admin\HomeController@index')->name('home');
    Route::get('/', 'Admin\HomeController@index')->name('home');
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('accounts', 'Admin\AccountController@index')->name('accounts');
    Route::get('accounts/{id}', 'Admin\AccountController@bills')->name('account.bills');
    Route::any('account', 'Admin\AccountController@show')->name('account.show');
    //import
    Route::get('import', 'ImportController@index');
    Route::post('import', 'ImportController@import')->name('import');

    Route::any('transactions', 'Admin\TransactionController@index')->name('transaction.show');
    Route::any('transactions/arhive', 'Admin\TransactionController@arhive')->name('transaction.arhive');
    Route::any('transactions/all', 'Admin\TransactionController@paymentsAll')->name('transaction.all');
    Route::any('transactions/in', 'Admin\TransactionController@getIn')->name('transaction.in');
    Route::any('transactions/out', 'Admin\TransactionController@getOut')->name('transaction.out');
    Route::get('transactions/apply/{id}', 'Admin\TransactionController@apply')->name('transaction.apply');
    Route::get('transactions/status/{status}/{id}', 'Admin\TransactionController@changeStatus')->name('transaction.status');

    Route::any('transactions/incoming', 'Admin\TransactionController@adminIn')->name('transaction.income');


    Route::get('transactions/info/{id}', 'Admin\TransactionController@info')->name('transaction.info');

    Route::view('transactions/about', 'admin.pages.perevod')->name('page.transaction.about');



    Route::get('payment/create', 'Admin\PaymentController@create')->name('payment.create');
    Route::post('payment/create', 'Admin\PaymentController@postAdminPayment')->name('payment.post');

    //Платеж
    Route::any('payment/add', 'Admin\PaymentController@addPayment')->name('payment.add');
    Route::post('payment', 'Admin\PaymentController@store')->name('payment.store');
    Route::post('/payment/finish', 'Admin\PaymentController@finish')->name('payment.finish');
    Route::post('/payment/step3', 'Admin\PaymentController@step3')->name('payment.step3');

    Route::get('payment/between', 'Admin\PaymentBetweenController@index')->name('between.index');
    Route::post('payment/between', 'Admin\PaymentBetweenController@store')->name('between.post');

    Route::get('statement', 'Admin\StatementController@index')->name('statement.index');
    Route::get('statms', 'Admin\StatementController@getStatements')->name('statement.get');
    Route::post('statement', 'Admin\StatementController@post')->name('statement.post');

    Route::get('services', 'Admin\ServiceController@index')->name('services.index');
    Route::get('register', 'Admin\ServiceController@register')->name('services.register');

    Route::any('logs', 'LogController@index')->name('logs.index');




    Route::get('test2', 'Test2Controller@index');

    # Export
    Route::get('export/trans/{id}', 'Admin\ExportController@transactions')->name('export.trans');
    Route::get('export/trans/{id}/in', 'Admin\ExportController@transactionsIn')->name('export.trans.in');
    Route::get('export/trans/{id}/out', 'Admin\ExportController@transactionsOut')->name('export.trans.out');


    Route::get('export/accounts', 'Admin\ExportController@accounts')->name('export.accounts');
    Route::get('feedback-step1', 'Admin\FeedbackController@feedbackForm')->name('feedback.form');
    Route::post('feedback-step2', 'Admin\FeedbackController@feedbackFormStep2Store')->name('feedback.form.step2.store');
    Route::get('feedback-step2', 'Admin\FeedbackController@feedbackFormStep2Show')->name('feedback.form.step2.show');
    Route::get('feedback-clear', 'Admin\FeedbackController@clearForm')->name('feedback.form.clear');
    Route::post('feedback-step3', 'Admin\FeedbackController@feedbackFormStep3Store')->name('feedback.form.step3.store');
    Route::get('feedback-step3', 'Admin\FeedbackController@feedbackFormStep3Show')->name('feedback.form.step3.show');
    Route::get('feedback-generatePdf', 'Admin\FeedbackController@generatePdf')->name('feedback.generatePdf');

});

    Route::any('test', 'TestController@index')->name('test');
    Route::view('done', 'admin.pages.payment.done')->name('done');

