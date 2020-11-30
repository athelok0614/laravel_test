<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $aResp = [
            'successs' => 1,
            'errorCode' => 0,
            'errorMessage' => 'success',        
        ];
        
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        $mobile = $request->input('mobile');
        $email = $request->input('email');

        $model = new Member;
        $model->name = $name;
        $model->username = $username;
        $model->password = $password;
        $model->mobile = $mobile;
        $model->email = $email;
        $model->save();
        
        return $aResp;

    }

    public function login(Request $request)
    {
        $aResp = [
            'successs' => 1,
            'errorCode' => 0,
            'errorMessage' => 'success',
            'token' => '',
        ];

        $username = $request->input('username');
        $password = $request->input('password');
        $model = new Member;
        //先暫時用手機號當查詢
        $data = $model->where('mobile',$username)->where('password',$password)->get();
        if(!empty($data))
        {   
            return $aResp = [
                'successs' => 0,
                'errorCode' => 301,
                'errorMessage' => '用戶不存在',  
                'token' => '',      
            ];
        }
        $aResp['token'] = auth('api')->attempt($data);
        
        return $aResp;

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
