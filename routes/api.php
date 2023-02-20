<?php

use Illuminate\Support\Facades\Route;

// // V1
//Route::apiResource('v1/posts', PostV1::class)
//    ->only(['index', 'show', 'destroy'])
//    ->middleware('auth:sanctum');
//
//// V2
//Route::apiResource('v2/posts', PostV2::class)
//    ->only(['index', 'show'])
//    ->middleware('auth:sanctum');

//Route::post(
//    'login',
//    'LoginController@login'
//)->name('login');

Route::post('satori/login2', [\App\Http\Controllers\Api\Satori\LoginController::class, 'login2']);

//Route::get('satori/logout', [\App\Http\Controllers\Api\Satori\LoginController::class, 'logout']);

Route::get('satori/getPdf/{ticket_id}', [\App\Http\Controllers\Api\Satori\TicketController::class,'getTicketPdf2']);

Route::middleware("auth:api_user")->group(function () {

    Route::get('satori/getUsers', [\App\Http\Controllers\Api\Satori\UserController::class, 'getUsers']);

    Route::get('satori/getChats', [\App\Http\Controllers\Api\Satori\UserController::class, 'getUserMessage']);

    Route::get('satori/getTickets/{status}', [\App\Http\Controllers\Api\Satori\TicketController::class, 'getTickets']);

    //NO SE USA
    //Route::get('satori/getTicketDetails/{ticket_id}', [\App\Http\Controllers\Api\Satori\TicketController::class, 'getTicketDetails']);

    Route::post('satori/addTickets', [\App\Http\Controllers\Api\Satori\TicketController::class, 'addTicket']);

    Route::post('satori/changeStatusTicket/{ticket_id}/{status}', [\App\Http\Controllers\Api\Satori\TicketController::class, 'changeStatus']);

    //NO USAR
    //Route::get('satori/chat/{chat_id}', [\App\Http\Controllers\Api\Satori\ChatController::class, 'show']);

    Route::get('satori/with/{user_id}', [\App\Http\Controllers\Api\Satori\ChatController::class, 'chat_with']);

    //NO SIRVE
    //Route::post('satori/message/sent', [\App\Http\Controllers\Api\Satori\MessageController::class, 'sent']);

    Route::get('satori/{chat_id}/getMessages', [\App\Http\Controllers\Api\Satori\ChatController::class, 'getMessages']);

    Route::post('satori/sentMessage', [\App\Http\Controllers\Api\Satori\MessageController::class, 'sentMessage']);

});

// NO SIRVE
//Route::get('satori/chat/{chat_id}/get_users', [\App\Http\Controllers\Api\Satori\ChatController::class, 'get_users']);

