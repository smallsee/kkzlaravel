<?php
namespace App\Repositories\Eloquent;

use App\Fav;

class FavRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Fav::class;
    }



}