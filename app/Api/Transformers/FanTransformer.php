<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class FanTransformer extends TransformerAbstract
{
    public function transform($fan){
        return [
          'fan_id' => $fan['fan_id'],
          'star_id' => $fan['star_id'],
        ];
    }

}