<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class CommitTransformer extends TransformerAbstract
{
    public function transform($commit){
        return [
          'content' => $commit['content'],
          'user' => $commit['user'],
        ];
    }

}