<?php

namespace App\Repositories;

use App\Models\User;
use Yish\Generators\Foundation\Repository\Repository;

class UserRepository extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function userList($limit,$page,$username)//查询所有用户
    {
        return $this->model->when($username,function($query) use ($username){
            return $query->where('username','like','%'.$username.'%');
        })->skip($page)->take($limit)->get();
    }

    public function userListCount($username)
    {
        return $this->model->when($username,function($query) use ($username){
            return $query->where('username','like','%'.$username.'%');
        })->count();
    }

}
