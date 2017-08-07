<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform($user){
        return [
          'name' => $user['name'],
          'email' => $user['email']
        ];
    }

}