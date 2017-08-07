<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class VideoTransformer extends TransformerAbstract
{
    public function transform($video){
        return [
          'id' => $video['id'],
          'title' => $video['title'],
          'thumb' => $video['thumb'],
          'address' => $video['address'],
          'language' => $video['language'],
          'episodes' => $video['episodes'],
          'version' => $video['version'],
          'is_new' => (boolean)$video['is_new'],
          'issue_date' => $video['issue_date'],
          'update_date' => $video['update_date'],
          'akira' =>  explode(',',str_replace(" ","",str_replace("\n","",$video['akira']))),
          'tag' => explode(',',$video['tag']),
          'see' => $video['see'],
          'files' => $video['files'],
          'introduction' => $video['introduction'],
        ];
    }

}