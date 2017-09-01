<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class ArtTransformer extends TransformerAbstract
{
    public function transform($art){
        return [
          'id' => $art['id'],
          'title' => $art['title'],
          'status' => $art['status'],
          'see' => $art['see'],
          'images' => json_decode($art['images']),
            'user' => $art['user'],
        ];
    }

}