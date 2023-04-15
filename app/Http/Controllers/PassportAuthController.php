<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'required',
            'email'=>'required',
            'password'=> 'required|mim:8',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
        ]);

        // Token  توليد ال 
        $token = $user->createToken('ChristianeLaravel')->accessToken;
        return response()->json(['token' => $token],200);

    }




    public function login(Request $request)
    {
        //   تحقق فقط 
        $user = [
   
            'email'=>$request->email,
            'password'=> $request->password,
        ];

        // attemp   : محاولة الدخول 
        if (auth->attempt($data))
        { 
            //  بي المعلومات يلي هوي ولدها  token   تولدي ال
            $token = auth()->user()->createToken('ChristianeLaravel')->accessToken;
            return response()->json(['token' => $token],200);
        }
        else
        {
            return response()->json(['error' => 'Unauthorised'],401);
 
        }

    }



    public function userInfo()
    {
        $userData = auth()->user();
        return response()->json(['userData' => $userData],200);
    }
}
