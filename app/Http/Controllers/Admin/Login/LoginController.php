<?php

namespace App\Http\Controllers\Admin\Login;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {   
        $data = $request->all();
        $username = $request->username;
        $password = $request->password;
        $user = User::where('username', $username)->first();
        if(!$user){
          return  $this->failed('用户不存在');
        }

        if (!Hash::check($password,$user->password)) {
            return  $this->failed('密码不正确');
        }
        
        if (! $token = JWTAuth::attempt($data)) {
            return  $this->failed();
        }
        $xToken['token'] = $token;

        return $this->success($xToken);

    }

    public function info()
    {

        $user= auth('api')->user();
        return $this->success($user);
    }

    public function logout()
    {
        return $this->success();
    }
}
