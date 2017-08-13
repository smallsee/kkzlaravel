<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:32
 */

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;

class HomeVideoTransformer extends TransformerAbstract
{
    public function transform($video){
        return [
          'id' => $video['id'],
          'title' => $video['title'],
          'thumb' => $video['thumb'],
          'tag' => explode(',',$video['tag']),
            'akira' =>  explode(',',str_replace(" ","",str_replace("\n","",$video['akira']))),
          'see' => $video['see'],
            'is_new' => (boolean)$video['is_new'],
            'issue_date' => $video['issue_date'],
            'update_date' => $video['update_date'],
            'files_count' => count($video['files']),
            'commits_count' => count($video['commits']),
            'commits' => $video['commits'],
        ];
    }

}