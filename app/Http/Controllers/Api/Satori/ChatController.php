<?php

namespace App\Http\Controllers\Api\Satori;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Satori\MessageWS;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function chat_with(User $user_id){
        $userA = auth()->user();
        $userB = $user_id;
        $chat = $userA->chats()->wherehas('users', function ($q) use ($userB){
            $q->where('chat_user.user_id', $userB->id);
        })->first();

        if(!$chat){
            $chat = Chat::create([]);
            $chat->users()->sync([$userA->id, $userB->id]);
        }
        //return redirect()->route('chat.show', $chat);
        return response([
            'message' => 'chat exitoso',
            'data' => [
                'userA' => $userA,
                'userB' => $userB,
                'chat' => $chat
            ]
        ], 200);
    }

    public function show(Chat $chat_id){
        abort_unless($chat_id->users->contains(auth()->id()), 403);
        return view('chat', [
            'chat' => $chat_id
        ]);
//        return response([
//            'message' => 'chat uwu',
//            'data' => $chat_id
//        ], 200);
    }

    public function get_users(Chat $chat){
        $users = $chat->users;
        return response()->json([
            'users' => $users
        ]);
    }

/*
    public function getMessages(Chat $chat){
        $messages = $chat -> messages()->with('user')->get();
        return response()->json([
           'messages' => $messages
        ]);
    }*/

    public function getMessages(Chat $chat_id){
        $userId = Auth::id();
        $id = $chat_id;
        $messages = Message::where('chat_id', $id->id)->get();
        Message::where('seen_message', 0)->where('chat_id', $id->id)->where('receiver_id', $userId)->update(['seen_message' => 1]);
        return response()->json([
            'success' => true,
            'message' => 'datos obtenidos correctamente',
            'data' => MessageWS::collection($messages),
        ], 200);
    }
}
