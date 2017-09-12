<?php
namespace App\Repositories\Eloquent;

use App\User;

class UserRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return User::class;
    }



}