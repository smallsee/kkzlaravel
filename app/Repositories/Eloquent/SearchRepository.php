<?php
namespace App\Repositories\Eloquent;

use App\Art;
use App\Article;
use App\Video;

class SearchRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Video::class;
    }

    function findLikeTitle(array $attributes) {
        $type = $attributes['type'];
        $title = $attributes['title'];

        if ($type === 'video'){
            $data = Video::where('title','like','%'.$title.'%')->get();
        }elseif ($type === 'article'){
            $data = Article::where('title','like','%'.$title.'%')->get();
        }elseif ($type === 'art'){
            $data = Art::where('title','like','%'.$title.'%')->get();
        }else{
            return 0;
        }

        return $data;
    }

}