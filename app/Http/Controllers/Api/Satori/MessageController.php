<?php

namespace App\Http\Controllers\Api\Satori;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller {
//    public function __construct(){
//        $this->middleware('auth:sanctum');
//    }

    public function sent(Request $request){
        $message = auth()->user()->messages()->create()([
            'content' => $request->message,
            'chat_id' => $request->chat_id,
        ])->load('user');

        //broadcast(new MessageSent($message))->toOthers();

        return $message;
        /*return response() -> json([
            'success' => true,
            'message' => 'mensaje enviado correctamente',
            //'data' =>  $message,
        ], 200);*/
    }

    public function sentMessage(Request $request){
        $message = Message::create($request->all());
        return response()->json([
           'success' => true,
           'message' => 'mensaje enviado correctamente',
           'data' => $message
        ], 200);
    }
}
