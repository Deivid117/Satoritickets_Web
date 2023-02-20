<?php

namespace App\Http\Controllers\Api\Satori;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Satori\UserWS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){

        $this->validateLogin($request);

        if(Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => true,
                'message' => 'Sesión iniciada con éxito',
                'api_token' => $request->user()->createToken($request->email)->plainTextToken,
                'user' => Auth::user()
            ], 200);
        }
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }

    public function validateLogin(Request $request){
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    public function login2(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $userExists = User::whereEmail($email)->first();
        if (!$userExists) {
            return response()->json([
                'success' => false,
                'message' => 'No hay registros que coincidan con los datos proporcionados'
            ]);
        } else {
            if (\Hash::check($password, $userExists->password)) {

                    $token = \Str::random(60);
                $userExists->api_token = bcrypt($token);

                    if ($userExists->save()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Exito',
                            'data' => new UserWS($userExists),

                        ]);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Ocurrió un error al iniciar sesión'
                        ]);
                    }

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Las credenciales no son correctas'
                ]);
            }
        }
    }


    public function logout() {
        Auth::logout();
        return response()->json([
            'success' => true,
            'message' => 'Sesión terminada'
        ]);
    }
}
