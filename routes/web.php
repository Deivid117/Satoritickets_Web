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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('chat/{chat_id}/get_users', 'App\Http\Controllers\Api\Satori\ChatController@get_users')->name('chat.get_users');
Route::get('chat/with/{user_id}', 'App\Http\Controllers\Api\Satori\ChatController@chat_with')->name('chat.with');
Route::get('chat/{chat_id}', 'App\Http\Controllers\Api\Satori\ChatController@show')->name('chat.show');
// NO SIRVE
Route::post('message/sent', 'App\Http\Controllers\Api\Satori\MessageController@sent')->name('message.sent');
