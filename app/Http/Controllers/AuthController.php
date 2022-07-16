<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

         $name = $request->input('name');
         $email = $request->input('email');
         $password = $request->input('password');

         $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
         ]);

         if($user->save()) {
            $user->signing = [
                'href' => 'api/v1/user/signin',
                'method' => 'POST',
                'params' => 'email', 'password'
            ];

            $response = [
                'msg' => 'User Created',
                'user' => $user
            ];

            return response()->json($response, 201);
         }

         $response = [
            'msg' => 'An error occurred'
         ];

         return response()->json($response, 404);
    }

    public function signing(Request $request)
    {
        return 'It works';
    }
}
