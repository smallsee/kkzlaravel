<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class ShopTransformer extends TransformerAbstract
{
    public function transform($shop){
        return [
          'id' => $shop['id'],
          'title' => $shop['title'],
          'desc' => $shop['desc'],
          'num' => $shop['num'],
          'price' => $shop['price'],
            'category_id' => explode(',',$shop['category_id']),
          'is_sale' => (boolean)$shop['is_sale'],
          'is_hot' => (boolean)$shop['is_hot'],
          'sale_price' => $shop['sale_price'],
          'thumb' => json_decode($shop['thumb']),
          'status' => $shop['status'],
            'user' => $shop['user']['name'],
        ];
    }

}