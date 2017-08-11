<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class WeekTransformer extends TransformerAbstract
{
    public function transform($week){
        return [
          'id' => $week['id'],
          'name' => $week['date'],
        ];
    }

}