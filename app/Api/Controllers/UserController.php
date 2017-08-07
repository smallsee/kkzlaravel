<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;


use App\Api\Transformers\UserTransformer;
use App\User;

class UserController extends BaseController
{
    public function index() {
        $user = User::all();

        return $this->collection($user, new UserTransformer());
    }

    public function show($id){
        $user = User::find($id);

        if(! $user){
          return $this->response->errorNotFound('User not found');
        }

        return $this->item($user, new UserTransformer());
    }

}