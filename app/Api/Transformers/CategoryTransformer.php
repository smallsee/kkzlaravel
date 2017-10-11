<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform($category){
        return [
          'id' => $category['id'],
          'title' => $category['title'],
          'parent_id' => $category['parent_id'],
        ];
    }

}