<?php

namespace App\Http\Controllers\Api\Satori;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Satori\UserWS;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUsers(){

        $userId = Auth::id();
        $user = User::find($userId);

        $typeUser = auth()->user()->type_user;

        // Usuarios según su rol 1 -> Admin --- 2 -> Cliente
        if($typeUser == 1){
            $list_users = User::where('type_user', 2)->get();
        } else {
            $list_users = User::where('type_user', 1)->get();
        }
        return response()->json([
            'success' => true,
            'message' => 'datos obtenidos correctamente',
            'data' => UserWS::collection($list_users),
        ], 200);
    }

    public function getUserMessage(){
//        $userId = Auth::id();
//        $typeUser = auth()->user()->type_user;
//
//
//        $messages = Message ::where('chat_id', 5)->latest()->get();
//        $messages2 = Message::all();
//
//        $prueba = Message::where('user_id', $userId)->latest()->first();
//
//        // Usuarios según su rol 1 -> Admin --- 2 -> Cliente
//        if($typeUser == 1){
//            $list_users = User::where('type_user', 2)->get();
//            $id = User::find(1);
//            $names = $id->name;
//            //$name = $id->getFullNameAttribute();
//            //$chat = User::id()->where('type_user', 2) ;
//        } else {
//            $list_users = User::where('type_user', 1)->get();
//        }



//        return response()->json([
//            'success' => true,
//            'message' => 'datos obtenidos correctamente',
//            'data' => [
//                'user' => UserWS::collection($list_users),
//                'UserA' => $userId,
//                //'message' => $messages, //$messages[count($messages)-1]
//                //'id' => $messages2,
//                'last_message' => $prueba
//            ]
//        ], 200);

        $typeUser = auth()->user()->type_user;

        // Usuarios según su rol 1 -> Admin --- 2 -> Cliente
        if($typeUser == 1){
            $list_users = User::where('type_user', 2)->get();
        } else {
            $list_users = User::where('type_user', 1)->get();
        }

        return response() -> json([
           'success'=>true,
           'message'=>'datos obtenidos correctamente',
           'data'=>[
               'user' => UserWS::collection($list_users),
               'messages' =>
               \DB::select( \DB::raw(
                   "SELECT * FROM messages msg INNER JOIN (SELECT max(created_at) created_at FROM messages GROUP BY chat_id ORDER BY created_at) m2 ON msg.created_at = m2.created_at"
               ))
            ]
        ]);
    }
}
