<?php
namespace App\Repositories\Eloquent;

use App\Fan;

class FanRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Fan::class;
    }

    public function hasFan($attributes){
        $model = new $this->model;
        $hasfan = $model->where([
            ['fan_id',$attributes['fan_id']],
            ['star_id',$attributes['star_id']]
        ])->first();

        if ($hasfan){
            return 0;
        }else{
            return 1;
        }
    }


}