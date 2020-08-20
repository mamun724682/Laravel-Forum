<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('discussion', 'DiscussionController');
Route::resource('discussion/{discussion}/replies', 'ReplyController');

Route::post('discussion/{discussion}/replies/{reply}/mark-as-best-reply', 'DiscussionController@bestReply')->name('discussion.best-reply');

Route::get('users/notifications', 'UserController@notifications')->name('users.notifications');

Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name('login.github');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');