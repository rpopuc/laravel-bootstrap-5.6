<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (env('APP_ENV') == 'local') {
        if (!\Schema::hasTable('migrations')) {
            $firstRun = true;
            Artisan::call('migrate', ['--seed' => true]);
        }
        Artisan::call('migrate');
    }

    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/events', function () {
    return view('example.events');
});

Route::get('/event', function () {
    return [
        [
            'type' => 'Evento',
            'title' => 'Um evento',
            'body' => 'Um evento aconteceu',
        ],
        [
            'type' => 'Notificação',
            'title' => 'Uma notificação',
            'body' => 'Uma notificação aconteceu',
        ],
    ];
});
