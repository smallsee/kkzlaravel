<?php
namespace App\Repositories\Eloquent;

use App\Week;

class WeekRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Week::class;
    }



}