<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Message;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => ['required', 'min:6', 'max:20', 'regex:/^[a-zA-Z]'],
            'password' => ['required', 'min:6', 'max:20', 'alpha_num'],
            'name'  => ['required'],
            'email'  => ['required', 'email'],
            'mobile'  => ['required', 'numeric', '|regex:/(09)[0-9]{8}'],
        ]);
        if ($validator->fails()) {
            return [
                'success' => 0,
                'errorCode' => 403,
                'errorMessage' => $validator->errors()->first(),
            ];
        }
        User::create([
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
        return [
            'success'=> 1,
            'errorCode' => 0,
            'errorMessage' => 'success',
        ];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => ['required', 'min:6', 'max:20', 'regex:/^[a-zA-Z]'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return [
                'success' => 0,
                'errorCode' => 403,
                'errorMessage' => $validator->errors()->first(),
            ];
        }
        if (!$token = auth('api')->attempt($request->all())) {
            return [
                'success' => 0,
                'errorCode' => 401,
                'errorMessage' => 'Unauthorized'
            ];
        }
        return [
            'success'=> 1,
            'errorCode' => 0,
            'errorMessage' => 'success',
            'token' => $token
        ];
    }

    public function message(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'message' => ['required'],
        ]);
        if ($validator->fails()) {
            return [
                'success' => 0,
                'errorCode' => 403,
                'errorMessage' => $validator->errors()->first(),
            ];
        }
        $message = Message::create([
            'message' => $request->message,
            'reply_id' => 0
        ]);
        return [
            'success'=> 1,
            'errorCode' => 0,
            'errorMessage' => 'success',
            'message_id' => $message->id
        ];
    }

    public function reply(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'message' => ['required'],
            'reply_id' => ['required'],
        ]);
        if ($validator->fails()) {
            return [
                'success' => 0,
                'errorCode' => 403,
                'errorMessage' => $validator->errors()->first(),
            ];
        }
        $message = Message::create([
            'message' => $request->message,
            'reply_id' => $request->reply_id
        ]);
        return [
            'success'=> 1,
            'errorCode' => 0,
            'errorMessage' => 'success',
            'token' => $token
        ];
    }
}
