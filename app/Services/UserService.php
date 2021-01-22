<?php

namespace App\Services;

use App\Traits\ApiResponse;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Yish\Generators\Foundation\Service\Service;

class UserService 
{
    use ApiResponse;
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function userLogin($data)
    {
        $user= $this->repository->firstBy('username',$data['username']);

        if(!$user){
            return  $this->failed('用户不存在');
          }
  
          if (!Hash::check($data['password'],$user->password)) {
              return  $this->failed('密码不正确');
          }
          
          if (! $token = JWTAuth::attempt($data)) {
              return  $this->failed();
          }
          $xToken['token'] = $token;
          
          $this->repository->updateBy('username',$data['username'],['login_last_time'=>Carbon::now()]);
          return $this->success($xToken);
    }

    public function userList($limit,$page,$username)
    {
        $item = $this->repository->userList($limit,$page,$username);
        $total = $this->repository->userListCount($username);

        $data['item'] = $item;
        $data['total'] = $total;

        return $data;
    }

    public function del($id)
    {
        return $this->repository->destroy($id);
    }

    public function updateUser($id,$data)
    {
        return $this->repository->update($id,$data);
    }
}
