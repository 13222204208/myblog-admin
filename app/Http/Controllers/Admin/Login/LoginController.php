<?php

namespace App\Http\Controllers\Admin\Login;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login(Request $request)
    {   
        $data = $request->all();
        return $this->userService->userLogin($data);
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
